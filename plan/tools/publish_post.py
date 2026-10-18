"""Đăng / cập nhật 1 bài blog lên teamdevdesign.net (Botble CMS) qua SSH.

Usage:
    python publish_post.py ../posts/<slug> --dry-run     # chỉ xử lý ảnh + in SQL, KHÔNG ghi gì lên server
    python publish_post.py ../posts/<slug>               # đăng thật (backup -> upload ảnh -> SQL -> clear cache -> verify)
    python publish_post.py ../posts/<slug> --update      # cập nhật bài đã tồn tại (theo slug)

Các bước: seo_check -> ảnh webp + thumbnail -> lookup DB -> build SQL (1 transaction)
          -> backup mysqldump -> upload ảnh -> chạy SQL -> php artisan cache:clear -> verify URL.
"""
from __future__ import annotations

import argparse
import datetime as dt
import json
import re
import sys
import urllib.request
from pathlib import Path

from config import (AUTHOR_ID, AUTHOR_TYPE, BACKUP_DIR, CATEGORY_SLUG_PREFIX, CATEGORY_TYPE,
                    MEDIA_FOLDER_ID, MEDIA_SUBDIR, POST_SLUG_PREFIX, POST_TYPE, SITE_URL,
                    TAG_SLUG_PREFIX, TAG_TYPE, TRANSLATION_LANG)
from image_tool import image_size, to_webp
from seo_check import check as seo_check
from sql_builder import esc, insert, php_json, q, slugify, update
from ssh_client import Remote

BACKUP_TABLES = ["posts", "posts_translations", "slugs", "meta_boxes", "post_categories",
                 "post_tags", "categories", "categories_translations", "tags",
                 "tags_translations", "media_files"]

IMG_SRC_RE = re.compile(r'(<img\b[^>]*?\bsrc=")(images/[^"]+)("[^>]*>)', re.I)


def log(msg: str) -> None:
    print(msg, flush=True)


# ------------------------------------------------------------------ images
def process_images(post_dir: Path, meta: dict, content: str) -> tuple[str, list[dict], str]:
    """Trả về (content đã thay src, danh sách media, đường dẫn ảnh đại diện trong DB)."""
    slug = meta["slug"]
    build = post_dir / "build"
    media: list[dict] = []

    feat = meta["featured_image"]
    feat_files = to_webp(post_dir / feat["file"], build, slug)
    featured_url = f"{MEDIA_SUBDIR}/{feat_files[0].name}"
    media.append({"files": feat_files, "url": featured_url, "name": slug.replace("-", "_"),
                  "alt": feat.get("alt") or meta["name"]})

    def repl(m: re.Match) -> str:
        rel = m.group(2)
        src = post_dir / rel
        base = f"{slug}-{slugify(Path(rel).stem)}"
        files = to_webp(src, build, base)
        url = f"{MEDIA_SUBDIR}/{files[0].name}"
        tag_rest = m.group(3)
        alt_m = re.search(r'alt="([^"]*)"', m.group(0))
        if not any(x["url"] == url for x in media):
            media.append({"files": files, "url": url, "name": base.replace("-", "_"),
                          "alt": alt_m.group(1) if alt_m else base})
        w, h = image_size(files[0])
        extra = ""
        if "width=" not in m.group(0):
            extra += f' width="{w}" height="{h}"'
        if "loading=" not in m.group(0):
            extra += ' loading="lazy"'
        return f'{m.group(1)}{SITE_URL}/storage/{url}"{extra}{tag_rest[1:]}'

    content = IMG_SRC_RE.sub(repl, content)
    return content, media, featured_url


# ------------------------------------------------------------------ lookups
def lookup(remote: Remote, meta: dict) -> dict:
    slug = meta["slug"]
    found: dict = {}
    rows = remote.mysql_query(
        f"SELECT reference_id FROM slugs WHERE `key`={q(slug)} AND prefix={q(POST_SLUG_PREFIX)} LIMIT 1")
    found["slug_owner"] = None
    if rows:
        owner = remote.mysql_query(
            f"SELECT reference_type FROM slugs WHERE `key`={q(slug)} AND prefix={q(POST_SLUG_PREFIX)} LIMIT 1")
        found["slug_owner"] = (owner[0][0], int(rows[0][0]))

    cat = meta["category"]
    cat_slug = cat.get("slug") or slugify(cat["name"])
    rows = remote.mysql_query(
        f"SELECT reference_id FROM slugs WHERE `key`={q(cat_slug)} AND reference_type={q(CATEGORY_TYPE)} LIMIT 1")
    if not rows:
        rows = remote.mysql_query(f"SELECT id FROM categories WHERE name={q(cat['name'])} LIMIT 1")
    found["category_id"] = int(rows[0][0]) if rows else None
    found["category_slug"] = cat_slug
    found["category_next_order"] = int(remote.mysql_query(
        "SELECT IFNULL(MAX(`order`),0)+1 FROM categories")[0][0])

    found["tags"] = {}
    for name in meta.get("tags", []):
        tslug = slugify(name)
        rows = remote.mysql_query(
            f"SELECT reference_id FROM slugs WHERE `key`={q(tslug)} AND reference_type={q(TAG_TYPE)} LIMIT 1")
        if not rows:
            rows = remote.mysql_query(f"SELECT id FROM tags WHERE LOWER(name)=LOWER({q(name)}) LIMIT 1")
        found["tags"][name] = int(rows[0][0]) if rows else None
    return found


def existing_media(remote: Remote, urls: list[str]) -> set[str]:
    if not urls:
        return set()
    rows = remote.mysql_query(
        "SELECT url FROM media_files WHERE deleted_at IS NULL AND url IN (" + ",".join(q(u) for u in urls) + ")")
    return {r[0] for r in rows}


# ------------------------------------------------------------------ SQL
def build_sql(meta: dict, content: str, media: list[dict], featured_url: str,
              found: dict, have_media: set[str], post_id: int | None) -> str:
    now = dt.datetime.now().strftime("%Y-%m-%d %H:%M:%S")
    out = ["SET NAMES utf8mb4;", "START TRANSACTION;", f"SET @now = {q(now)};"]

    # 1. media_files
    for m in media:
        if m["url"] in have_media:
            continue
        out.append(insert("media_files", {
            "user_id": AUTHOR_ID, "name": m["name"], "alt": m["alt"], "folder_id": MEDIA_FOLDER_ID,
            "mime_type": "image/webp", "size": m["files"][0].stat().st_size, "url": m["url"],
            "options": "[]", "visibility": "public", "created_at": "@now", "updated_at": "@now",
        }))

    # 2. category
    cat = meta["category"]
    if found["category_id"]:
        out.append(f"SET @cat_id = {found['category_id']};")
    else:
        out.append("-- Danh mục mới")
        out.append(insert("categories", {
            "name": cat["name"], "parent_id": 0, "description": cat.get("description"),
            "status": "published", "author_id": AUTHOR_ID, "author_type": AUTHOR_TYPE,
            "order": found["category_next_order"], "is_featured": 0, "is_default": 0,
            "created_at": "@now", "updated_at": "@now",
        }))
        out.append("SET @cat_id = LAST_INSERT_ID();")
        out.append(insert("categories_translations", {
            "lang_code": TRANSLATION_LANG, "categories_id": "@cat_id",
            "name": cat["name"], "description": cat.get("description")}))
        out.append(insert("slugs", {
            "key": found["category_slug"], "reference_id": "@cat_id", "reference_type": CATEGORY_TYPE,
            "prefix": CATEGORY_SLUG_PREFIX, "created_at": "@now", "updated_at": "@now"}))
        seo = {"index": "index"}
        if cat.get("seo_title"):
            seo = {"seo_title": cat["seo_title"], "seo_description": cat.get("seo_description", ""), "index": "index"}
        out.append(insert("meta_boxes", {
            "meta_key": "seo_meta", "meta_value": php_json([seo]), "reference_id": "@cat_id",
            "reference_type": CATEGORY_TYPE, "created_at": "@now", "updated_at": "@now"}))

    # 3. tags
    tag_vars = []
    for i, (name, tid) in enumerate(found["tags"].items(), 1):
        var = f"@tag_{i}"
        tag_vars.append(var)
        if tid:
            out.append(f"SET {var} = {tid};")
            continue
        out.append(insert("tags", {
            "name": name, "author_id": AUTHOR_ID, "author_type": AUTHOR_TYPE, "description": None,
            "status": "published", "created_at": "@now", "updated_at": "@now"}))
        out.append(f"SET {var} = LAST_INSERT_ID();")
        out.append(insert("tags_translations", {
            "lang_code": TRANSLATION_LANG, "tags_id": var, "name": name, "description": None}))
        out.append(insert("slugs", {
            "key": slugify(name), "reference_id": var, "reference_type": TAG_TYPE,
            "prefix": TAG_SLUG_PREFIX, "created_at": "@now", "updated_at": "@now"}))

    # 4. post
    post_row = {
        "name": meta["name"], "description": meta["description"], "content": content,
        "status": meta.get("status", "published"), "author_id": AUTHOR_ID, "author_type": AUTHOR_TYPE,
        "is_featured": int(meta.get("is_featured", 0)), "image": featured_url,
    }
    if post_id:
        out.append(f"SET @post_id = {post_id};")
        out.append(update("posts", {**post_row, "updated_at": "@now"}, "id=@post_id"))
        out.append("DELETE FROM post_categories WHERE post_id=@post_id;")
        out.append("DELETE FROM post_tags WHERE post_id=@post_id;")
        out.append(f"DELETE FROM meta_boxes WHERE meta_key='seo_meta' AND reference_id=@post_id "
                   f"AND reference_type={q(POST_TYPE)};")
    else:
        out.append(insert("posts", {**post_row, "views": 0, "format_type": None,
                                    "created_at": "@now", "updated_at": "@now"}))
        out.append("SET @post_id = LAST_INSERT_ID();")
        out.append(insert("slugs", {
            "key": meta["slug"], "reference_id": "@post_id", "reference_type": POST_TYPE,
            "prefix": POST_SLUG_PREFIX, "created_at": "@now", "updated_at": "@now"}))

    # 5. bản dịch en_US (copy theo pattern các bài hiện có)
    if meta.get("translation_en", "copy") == "copy":
        out.append(insert("posts_translations", {
            "lang_code": TRANSLATION_LANG, "posts_id": "@post_id", "name": meta["name"],
            "description": meta["description"], "content": content,
        }, on_duplicate=["name", "description", "content"]))

    # 6. SEO meta
    out.append(insert("meta_boxes", {
        "meta_key": "seo_meta",
        "meta_value": php_json([{"seo_title": meta["seo_title"], "seo_description": meta["seo_description"],
                                 "index": "index", "seo_image": featured_url}]),
        "reference_id": "@post_id", "reference_type": POST_TYPE, "created_at": "@now", "updated_at": "@now"}))

    # 7. quan hệ
    out.append("INSERT INTO post_categories (category_id, post_id) VALUES (@cat_id, @post_id);")
    for var in tag_vars:
        out.append(f"INSERT INTO post_tags (tag_id, post_id) VALUES ({var}, @post_id);")

    out.append("COMMIT;")
    out.append("SELECT @post_id AS post_id, @cat_id AS category_id;")
    return "\n".join(out) + "\n"


# ------------------------------------------------------------------ verify
def verify(meta: dict) -> None:
    url = f"{SITE_URL}/{meta['slug']}"
    req = urllib.request.Request(url, headers={"User-Agent": "Mozilla/5.0 BlogTool"})
    try:
        with urllib.request.urlopen(req, timeout=30) as r:
            body = r.read().decode("utf-8", "ignore")
            title = re.search(r"<title>(.*?)</title>", body, re.S)
            log(f"  HTTP {r.status} {url}")
            log(f"  <title>: {title.group(1).strip() if title else '(không tìm thấy)'}")
    except Exception as e:  # noqa: BLE001
        log(f"  ⚠️ Không verify được {url}: {e}")


# ------------------------------------------------------------------ main
def main() -> int:
    sys.stdout.reconfigure(encoding="utf-8")
    ap = argparse.ArgumentParser()
    ap.add_argument("post_dir")
    ap.add_argument("--dry-run", action="store_true", help="Không ghi gì lên server")
    ap.add_argument("--update", action="store_true", help="Cập nhật bài đã tồn tại theo slug")
    ap.add_argument("--no-backup", action="store_true")
    args = ap.parse_args()

    post_dir = Path(args.post_dir).resolve()
    meta = json.loads((post_dir / "post.json").read_text(encoding="utf-8"))
    content = (post_dir / "content.html").read_text(encoding="utf-8").strip()

    log("1) Kiểm tra SEO")
    errs, warns = seo_check(post_dir)
    for w in warns:
        log(f"   ⚠️  {w}")
    if errs:
        for e in errs:
            log(f"   ❌ {e}")
        return 1

    log("2) Xử lý ảnh (webp + thumbnail)")
    content, media, featured_url = process_images(post_dir, meta, content)
    for m in media:
        log(f"   - {m['url']} ({m['files'][0].stat().st_size // 1024} KB, {len(m['files'])} file)")

    with Remote() as remote:
        log("3) Tra cứu DB (read-only)")
        found = lookup(remote, meta)
        post_id = None
        if found["slug_owner"]:
            rtype, rid = found["slug_owner"]
            if rtype != POST_TYPE:
                log(f"   ❌ Slug đã được dùng bởi {rtype}#{rid}")
                return 1
            if not args.update:
                log(f"   ❌ Slug đã tồn tại (post #{rid}). Dùng --update để cập nhật.")
                return 1
            post_id = rid
            log(f"   Cập nhật post #{post_id}")
        log(f"   Category: {'#' + str(found['category_id']) if found['category_id'] else 'TẠO MỚI'} "
            f"| Tags: {', '.join(f'{k}=' + (str(v) if v else 'mới') for k, v in found['tags'].items())}")
        have_media = existing_media(remote, [m["url"] for m in media])

        sql = build_sql(meta, content, media, featured_url, found, have_media, post_id)
        sql_file = post_dir / "build" / "publish.sql"
        sql_file.write_text(sql, encoding="utf-8")
        log(f"4) SQL đã build: {sql_file}")

        if args.dry_run:
            log("   (dry-run) Dừng tại đây, không ghi gì lên server.")
            return 0

        if not args.no_backup:
            BACKUP_DIR.mkdir(parents=True, exist_ok=True)
            bk = BACKUP_DIR / f"{dt.datetime.now():%Y%m%d_%H%M%S}_{meta['slug']}.sql.gz"
            log(f"5) Backup DB -> {bk}")
            remote.mysqldump(BACKUP_TABLES, str(bk))

        log("6) Upload ảnh -> public/storage/" + MEDIA_SUBDIR)
        remote_dir = f"{remote.root}/public/storage/{MEDIA_SUBDIR}"
        for m in media:
            for f in m["files"]:
                remote.upload(str(f), f"{remote_dir}/{f.name}")

        log("7) Chạy SQL (transaction)")
        out = remote.mysql_file(str(sql_file))
        log("   " + out.strip().replace("\n", "\n   "))

        log("8) Clear cache")
        log("   " + remote.artisan("cache:clear").strip())

    log("9) Verify")
    verify(meta)
    log("✅ Hoàn tất")
    return 0


if __name__ == "__main__":
    sys.exit(main())
