"""Kéo dữ liệu dịch vụ ĐANG CHẠY trên site về local -> plan/services/<slug>/

    python export_services.py            # export tất cả
    python export_services.py --no-images

Mỗi dịch vụ tạo:
    service.json   - thông tin + SEO + meta (icon...) + FAQ
    content.html   - nội dung (có shortcode)
    images/        - ảnh đại diện + ảnh dùng trong shortcode (tên file giữ nguyên như trên server)

Chạy lệnh này TRƯỚC khi sửa để chắc chắn local = bản mới nhất trên site.
"""
from __future__ import annotations

import argparse
import json
import re
import sys

from config import SERVICES_DIR
from laravel import run_php
from ssh_client import Remote

sys.stdout.reconfigure(encoding="utf-8")

PHP = r"""
use Botble\Portfolio\Models\Service;
use Illuminate\Support\Facades\DB;

$out = [];
foreach (Service::query()->with('category')->orderBy('order')->orderBy('id')->get() as $s) {
    $metas = [];
    foreach (DB::table('meta_boxes')->where('reference_type', Service::class)->where('reference_id', $s->id)->get() as $m) {
        $v = json_decode($m->meta_value, true);
        $metas[$m->meta_key] = (is_array($v) && array_key_exists(0, $v) && count($v) === 1) ? $v[0] : $v;
    }
    $seo = $metas['seo_meta'] ?? [];
    unset($metas['seo_meta']);

    // FAQ: lấy theo category_ids trong shortcode [faqs ...]
    $faqs = [];
    if (preg_match_all('/\[faqs[^\]]*category_ids="([^"]+)"/', (string) $s->content, $mm)) {
        foreach ($mm[1] as $ids) {
            foreach (array_filter(array_map('intval', explode(',', $ids))) as $cid) {
                $cat = DB::table('faq_categories')->where('id', $cid)->first();
                $faqs[] = [
                    'category_id' => $cid,
                    'category'    => $cat->name ?? null,
                    'items'       => DB::table('faqs')->where('category_id', $cid)->orderBy('id')
                        ->get(['question', 'answer'])->map(fn ($x) => (array) $x)->all(),
                ];
            }
        }
    }

    $out[] = [
        'id'          => $s->id,
        'slug'        => DB::table('slugs')->where('reference_type', Service::class)->where('reference_id', $s->id)->value('key'),
        'name'        => $s->name,
        'category'    => $s->category->name ?? null,
        'category_id' => $s->category_id,
        'description' => $s->description,
        'image'       => $s->image,
        'images'      => $s->images ?: [],
        'is_featured' => (bool) $s->is_featured,
        'order'       => (int) $s->order,
        'status'      => (string) $s->status,
        'seo'         => [
            'seo_title'       => $seo['seo_title'] ?? '',
            'seo_description' => $seo['seo_description'] ?? '',
            'seo_image'       => $seo['seo_image'] ?? '',
            'index'           => $seo['index'] ?? 'index',
        ],
        'meta'        => $metas,
        'faqs'        => $faqs,
        'content'     => (string) $s->content,
    ];
}
echo json_encode($out, JSON_UNESCAPED_UNICODE);
"""

IMG_ATTR = re.compile(r'(?:image|image_\d+|background_image)="([^"]+\.(?:jpe?g|png|webp|gif|svg))"', re.I)


def collect_images(item: dict) -> set[str]:
    paths = {item.get("image"), item["seo"].get("seo_image")}
    paths |= set(item.get("images") or [])
    for v in item["meta"].values():
        if isinstance(v, str) and re.search(r"\.(jpe?g|png|webp|gif|svg)$", v, re.I):
            paths.add(v)
    paths |= set(IMG_ATTR.findall(item["content"]))
    return {p for p in paths if p and not p.startswith("http")}


def main() -> None:
    ap = argparse.ArgumentParser()
    ap.add_argument("--no-images", action="store_true")
    args = ap.parse_args()

    with Remote() as r:
        raw = run_php(r, PHP)
        data = json.loads(raw[raw.index("["):])
        for item in data:
            slug = item["slug"] or f"service-{item['id']}"
            d = SERVICES_DIR / slug
            (d / "images").mkdir(parents=True, exist_ok=True)

            content = item.pop("content").replace("\r\n", "\n").replace("\r", "\n")
            (d / "content.html").write_text(content.strip() + "\n", encoding="utf-8", newline="\n")
            (d / "service.json").write_text(json.dumps(item, ensure_ascii=False, indent=2) + "\n", encoding="utf-8", newline="\n")

            missing = []
            if not args.no_images:
                for p in sorted(collect_images({**item, "content": content})):
                    remote = f"{r.root}/public/storage/{p}"
                    if r.exists(remote):
                        r.download(remote, str(d / "images" / p.split("/")[-1]))
                    else:
                        missing.append(p)
            print(f"#{item['id']:<3} {slug:<45} ok" + (f"  (thiếu trên server: {missing})" if missing else ""))
    print(f"\n=> {len(data)} dịch vụ đã export vào {SERVICES_DIR}")


if __name__ == "__main__":
    main()
