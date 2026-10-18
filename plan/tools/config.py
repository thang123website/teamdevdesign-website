"""Cấu hình chung cho bộ tool đăng bài blog.

- Thông tin SSH đọc từ .vscode/sftp.json (không hardcode mật khẩu).
- Thông tin DB đọc từ file .env TRÊN SERVER lúc chạy (khác .env local).
"""
from __future__ import annotations

import json
from pathlib import Path

# plan/tools/config.py -> parents[2] = thư mục gốc dự án
PROJECT_ROOT = Path(__file__).resolve().parents[2]
PLAN_DIR = PROJECT_ROOT / "plan"
POSTS_DIR = PLAN_DIR / "posts"          # bài viết blog:  posts/<slug>/post.json + content.html + images/
SERVICES_DIR = PLAN_DIR / "services"    # dịch vụ:        services/<slug>/service.json + content.html + images/
BACKUP_DIR = PLAN_DIR / "backups"
SFTP_CONFIG = PROJECT_ROOT / ".vscode" / "sftp.json"

# ---- Dịch vụ (plugin Portfolio) ----
SERVICE_TYPE = "Botble\\Portfolio\\Models\\Service"
SERVICE_SLUG_PREFIX = "services"
SERVICE_MEDIA_SUBDIR = "services"       # public/storage/services

SITE_URL = "https://teamdevdesign.net"

# ---- Hằng số theo schema Botble (đã khảo sát thực tế) ----
AUTHOR_ID = 1
AUTHOR_TYPE = "Botble\\ACL\\Models\\User"
POST_TYPE = "Botble\\Blog\\Models\\Post"
CATEGORY_TYPE = "Botble\\Blog\\Models\\Category"
TAG_TYPE = "Botble\\Blog\\Models\\Tag"

POST_SLUG_PREFIX = ""
CATEGORY_SLUG_PREFIX = ""
TAG_SLUG_PREFIX = "tag"

TRANSLATION_LANG = "en_US"          # các bài hiện có đều có 1 bản copy en_US
MEDIA_FOLDER_ID = 6                 # media_folders: posts
MEDIA_SUBDIR = "posts"              # public/storage/posts
THUMB_SIZES = [(150, 150), (400, 500), (600, 400), (600, 338), (400, 400), (1280, 400)]


def load_sftp_config() -> dict:
    with open(SFTP_CONFIG, encoding="utf-8") as f:
        return json.load(f)


def remote_root() -> str:
    return load_sftp_config()["remotePath"].rstrip("/")


def parse_env(text: str) -> dict:
    env: dict[str, str] = {}
    for line in text.splitlines():
        line = line.strip()
        if not line or line.startswith("#") or "=" not in line:
            continue
        k, v = line.split("=", 1)
        v = v.strip()
        if len(v) >= 2 and v[0] == v[-1] and v[0] in "\"'":
            v = v[1:-1]
        env[k.strip()] = v
    return env
