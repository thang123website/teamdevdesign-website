"""Đăng mới / cập nhật 1 dịch vụ từ plan/services/<slug>/ lên site.

    python publish_service.py ../services/<slug> --dry-run   # chỉ kiểm tra, không ghi server
    python publish_service.py ../services/<slug>             # ghi thật
    python publish_service.py --all                          # đẩy toàn bộ thư mục services/

Quy trình: kiểm tra SEO -> backup DB (backups/) -> upload ảnh images/ -> ghi DB (service, slug,
SEO meta, icon meta, FAQ, đăng ký media + thumbnail) -> clear cache -> kiểm tra HTTP 200.

Quy ước (đã gặp lỗi thật nếu làm khác):
  * meta_boxes.reference_type = Botble\\Portfolio\\Models\\Service (1 dấu "\\", KHÔNG addslashes)
  * meta_value luôn dạng JSON mảng: [{"seo_title": ...}] hoặc ["icons/icon-9.png"]
  * mỗi service chỉ 1 dòng seo_meta (trùng dòng => admin đọc dòng rỗng)
  * ảnh phải nằm trong media_files + có thumbnail thì admin mới hiện preview
  * dịch vụ mới: để "id": null, FAQ "category_id": null và trong content dùng category_ids="{{FAQ}}"
"""
from __future__ import annotations

import argparse
import datetime as dt
import json
import re
import sys
import urllib.request
from pathlib import Path

from config import BACKUP_DIR, SERVICE_MEDIA_SUBDIR, SERVICES_DIR, SITE_URL
from laravel import run_php
from ssh_client import Remote

sys.stdout.reconfigure(encoding="utf-8")

PHP = r"""
use Botble\Portfolio\Models\Service;
use Botble\Faq\Models\Faq;
use Botble\Faq\Models\FaqCategory;
use Botble\Slug\Models\Slug;
use Botble\Media\Models\MediaFile;
use Botble\Media\Facades\RvMedia;
use Illuminate\Support\Facades\DB;

$p = $payload;
DB::beginTransaction();
try {
    // ---- 1. Service ----
    $service = $p['id'] ? Service::query()->find($p['id']) : null;
    if (! $service && $p['slug']) {
        $rid = Slug::query()->where('reference_type', Service::class)->where('key', $p['slug'])->value('reference_id');
        $service = $rid ? Service::query()->find($rid) : null;
    }
    $service = $service ?: new Service();
    $service->fill([
        'category_id' => $p['category_id'],
        'name'        => $p['name'],
        'description' => $p['description'],
        'image'       => $p['image'],
        'images'      => $p['images'] ?: [],
        'is_featured' => $p['is_featured'],
        'order'       => $p['order'],
        'status'      => $p['status'],
    ]);
    $service->content = $service->content ?: '';
    $service->save();

    // ---- 2. Slug ----
    Slug::query()->updateOrCreate(
        ['reference_type' => Service::class, 'reference_id' => $service->id],
        ['key' => $p['slug'], 'prefix' => 'services']
    );

    // ---- 3. FAQ ----
    $content = $p['content'];
    $faqOut = [];
    foreach ($p['faqs'] as $group) {
        $cat = $group['category_id'] ? FaqCategory::query()->find($group['category_id']) : null;
        if (! $cat) {
            $cat = FaqCategory::query()->create(['name' => $group['category'], 'status' => 'published', 'order' => 0]);
        } elseif ($group['category'] && $cat->name !== $group['category']) {
            $cat->update(['name' => $group['category']]);
        }
        Faq::query()->where('category_id', $cat->id)->delete();
        foreach ($group['items'] as $it) {
            Faq::query()->create(['question' => $it['question'], 'answer' => $it['answer'], 'category_id' => $cat->id, 'status' => 'published']);
        }
        $content = str_replace('{{FAQ}}', (string) $cat->id, $content);
        $faqOut[] = ['category_id' => $cat->id, 'category' => $cat->name, 'items' => $group['items']];
    }
    $service->content = $content;
    $service->save();

    // ---- 4. Meta boxes (SEO + icon...) - luôn 1 dòng / key, value dạng [x] ----
    $metas = $p['meta'];
    $metas['seo_meta'] = array_filter($p['seo'], fn ($v) => $v !== null && $v !== '');
    foreach ($metas as $key => $value) {
        DB::table('meta_boxes')->where('reference_id', $service->id)->where('meta_key', $key)
            ->where('reference_type', '!=', Service::class)->where('reference_type', 'like', '%Portfolio%Service')->delete();
        $rows = DB::table('meta_boxes')->where('reference_type', Service::class)->where('reference_id', $service->id)
            ->where('meta_key', $key)->orderBy('id')->get();
        $json = json_encode([$value], JSON_UNESCAPED_UNICODE);
        if ($rows->isEmpty()) {
            DB::table('meta_boxes')->insert(['reference_type' => Service::class, 'reference_id' => $service->id,
                'meta_key' => $key, 'meta_value' => $json, 'created_at' => now(), 'updated_at' => now()]);
        } else {
            DB::table('meta_boxes')->where('id', $rows->first()->id)->update(['meta_value' => $json, 'updated_at' => now()]);
            DB::table('meta_boxes')->whereIn('id', $rows->skip(1)->pluck('id'))->delete();
        }
    }
    DB::commit();
} catch (\Throwable $e) {
    DB::rollBack();
    echo "ERROR: " . $e->getMessage();
    exit(1);
}

// ---- 5. Media library + thumbnail (ngoài transaction) ----
$folderId = DB::table('media_files')->where('url', 'like', 'services/%')->value('folder_id') ?? 0;
foreach ($p['media'] as $url) {
    $path = public_path('storage/' . $url);
    if (! file_exists($path)) continue;
    $file = MediaFile::query()->where('url', $url)->first() ?: MediaFile::query()->create([
        'name' => pathinfo($url, PATHINFO_FILENAME), 'alt' => $p['name'], 'folder_id' => $folderId,
        'mime_type' => mime_content_type($path), 'size' => filesize($path), 'url' => $url, 'user_id' => 1, 'options' => [],
    ]);
    RvMedia::generateThumbnails($file);
}

echo json_encode(['id' => $service->id, 'faqs' => $faqOut, 'content' => $content], JSON_UNESCAPED_UNICODE);
"""

IMG_RE = re.compile(r"\.(jpe?g|png|webp|gif|svg)$", re.I)


def validate(meta: dict, content: str) -> list[str]:
    errs, warns = [], []
    for k in ("name", "slug", "category_id", "description", "image"):
        if not meta.get(k):
            errs.append(f"thiếu '{k}'")
    seo = meta.get("seo", {})
    t, d = seo.get("seo_title", ""), seo.get("seo_description", "")
    if not t:
        errs.append("thiếu seo.seo_title")
    elif len(t) > 65:
        warns.append(f"seo_title dài {len(t)} ký tự (nên <= 65)")
    if not d:
        errs.append("thiếu seo.seo_description")
    elif not 120 <= len(d) <= 165:
        warns.append(f"seo_description {len(d)} ký tự (nên 120-165)")
    if re.search(r"<h1[\s>]", content, re.I):
        errs.append("content có <h1> - trang đã có H1 là tên dịch vụ, dùng <h2 class=\"h4\">")
    if "{{FAQ}}" in content and not any(g.get("category_id") is None for g in meta.get("faqs", [])):
        errs.append("content có {{FAQ}} nhưng không có nhóm FAQ mới (category_id = null)")
    for w in warns:
        print("  ! " + w)
    return errs


def media_paths(meta: dict, content: str) -> list[str]:
    paths = {meta.get("image"), meta.get("seo", {}).get("seo_image")}
    paths |= set(meta.get("images") or [])
    paths |= {v for v in meta.get("meta", {}).values() if isinstance(v, str) and IMG_RE.search(v)}
    paths |= set(re.findall(r'="([^"]+\.(?:jpe?g|png|webp|gif|svg))"', content, re.I))
    return sorted(p for p in paths if p and not p.startswith("http"))


def publish(r: Remote | None, sdir: Path, dry: bool) -> None:
    meta = json.loads((sdir / "service.json").read_text(encoding="utf-8"))
    content = (sdir / "content.html").read_text(encoding="utf-8").strip()
    print(f"\n== {sdir.name} (id={meta.get('id')})")

    errs = validate(meta, content)
    media = media_paths(meta, content)
    local_imgs = {f.name: f for f in (sdir / "images").glob("*")} if (sdir / "images").exists() else {}
    if errs:
        for e in errs:
            print("  x " + e)
        raise SystemExit(1)
    if dry:
        print(f"  ảnh dùng: {media}")
        print("  OK (dry-run, chưa ghi gì)")
        return

    # Upload ảnh có trong images/ (chỉ những ảnh thuộc thư mục services/)
    for url in media:
        name = url.split("/")[-1]
        if url.startswith(SERVICE_MEDIA_SUBDIR + "/") and name in local_imgs:
            remote = f"{r.root}/public/storage/{url}"
            if not r.exists(remote) or r.sftp.stat(remote).st_size != local_imgs[name].stat().st_size:
                r.upload(str(local_imgs[name]), remote)
                print(f"  ↑ {url}")
        elif not r.exists(f"{r.root}/public/storage/{url}"):
            raise SystemExit(f"  x ảnh {url} không có trên server và không có trong images/")
    r.run(f"chmod -R 775 {r.root}/public/storage/{SERVICE_MEDIA_SUBDIR}", check=False)

    payload = {**meta, "content": content, "media": media}
    out = run_php(r, PHP, payload)
    if "ERROR:" in out or "{" not in out:
        raise SystemExit("  x " + out.strip())
    res = json.loads(out[out.index("{"):])

    # Ghi lại id / FAQ id mới vào local để lần sau là "cập nhật"
    meta["id"], meta["faqs"] = res["id"], res["faqs"]
    (sdir / "service.json").write_text(json.dumps(meta, ensure_ascii=False, indent=2) + "\n", encoding="utf-8", newline="\n")
    (sdir / "content.html").write_text(res["content"].strip() + "\n", encoding="utf-8", newline="\n")
    print(f"  ✓ DB ok (service #{res['id']})")


def verify(slug: str) -> None:
    url = f"{SITE_URL}/services/{slug}"
    try:
        code = urllib.request.urlopen(urllib.request.Request(url, headers={"User-Agent": "Mozilla/5.0"}), timeout=30).status
    except Exception as e:  # noqa: BLE001
        code = getattr(e, "code", str(e))
    print(f"  {'✓' if code == 200 else 'x'} {url} -> {code}")


def main() -> None:
    ap = argparse.ArgumentParser()
    ap.add_argument("dir", nargs="?")
    ap.add_argument("--all", action="store_true")
    ap.add_argument("--dry-run", action="store_true")
    a = ap.parse_args()

    dirs = sorted(p for p in SERVICES_DIR.iterdir() if (p / "service.json").exists()) if a.all else [Path(a.dir).resolve()]
    if not dirs or not a.all and not a.dir:
        ap.error("cần đường dẫn thư mục dịch vụ hoặc --all")

    if a.dry_run:
        for d in dirs:
            publish(None, d, True)
        return

    with Remote() as r:
        BACKUP_DIR.mkdir(parents=True, exist_ok=True)
        bk = BACKUP_DIR / f"{dt.datetime.now():%Y%m%d_%H%M%S}_services.sql.gz"
        r.mysqldump(["pf_services", "slugs", "meta_boxes", "faqs", "faq_categories", "media_files"], str(bk))
        print(f"backup -> {bk.name}")
        for d in dirs:
            publish(r, d, False)
        r.artisan("cache:clear")
    for d in dirs:
        verify(json.loads((d / "service.json").read_text(encoding="utf-8"))["slug"])


if __name__ == "__main__":
    main()
