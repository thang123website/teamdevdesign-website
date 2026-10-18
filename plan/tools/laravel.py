"""Chạy đoạn PHP trong môi trường Laravel trên server (Eloquent, Facades, RvMedia...).

Dùng thay cho `php artisan tinker` (server lệch phiên bản PHP nên artisan đôi khi lỗi).
File PHP tạm được upload, chạy, rồi xoá ngay - không để rác trên server.
"""
from __future__ import annotations

import json
import tempfile
import uuid
from pathlib import Path

from ssh_client import Remote

BOOTSTRAP = """<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\\Contracts\\Console\\Kernel::class)->bootstrap();
"""


def run_php(r: Remote, body: str, payload: dict | None = None) -> str:
    """Chạy `body` (code PHP, không có thẻ <?php). Nếu có `payload`, nó có sẵn trong biến $payload (array)."""
    name = f".tool_{uuid.uuid4().hex[:8]}"
    remote_php = f"{r.root}/{name}.php"
    remote_json = f"{r.root}/{name}.json"
    code = BOOTSTRAP
    if payload is not None:
        code += f"$payload = json_decode(file_get_contents(__DIR__ . '/{name}.json'), true);\n"
    code += body

    with tempfile.TemporaryDirectory() as tmp:
        php_local = Path(tmp) / "x.php"
        php_local.write_text(code, encoding="utf-8")
        r.upload(str(php_local), remote_php)
        if payload is not None:
            js_local = Path(tmp) / "x.json"
            js_local.write_text(json.dumps(payload, ensure_ascii=False), encoding="utf-8")
            r.upload(str(js_local), remote_json)
    try:
        return r.run(f"cd {r.root} && php {name}.php")
    finally:
        r.remove(remote_php)
        r.remove(remote_json)
