"""Tiện ích build SQL an toàn cho MySQL (không cần pymysql)."""
from __future__ import annotations

import json
import re
import unicodedata

_ESCAPES = {
    "\\": "\\\\", "\0": "\\0", "\n": "\\n", "\r": "\\r",
    "\x1a": "\\Z", "'": "\\'", '"': '\\"',
}


def esc(value: str) -> str:
    return "".join(_ESCAPES.get(ch, ch) for ch in value)


def q(value) -> str:
    """Quote 1 giá trị Python thành literal SQL."""
    if value is None:
        return "NULL"
    if isinstance(value, bool):
        return "1" if value else "0"
    if isinstance(value, (int, float)):
        return str(value)
    if isinstance(value, str) and value.startswith("@") and re.fullmatch(r"@[a-z_0-9]+", value):
        return value  # biến SQL, ví dụ @post_id
    return "'" + esc(str(value)) + "'"


def insert(table: str, row: dict, on_duplicate: list[str] | None = None) -> str:
    cols = ", ".join(f"`{c}`" for c in row)
    vals = ", ".join(q(v) for v in row.values())
    sql = f"INSERT INTO `{table}` ({cols}) VALUES ({vals})"
    if on_duplicate:
        sql += " ON DUPLICATE KEY UPDATE " + ", ".join(f"`{c}`=VALUES(`{c}`)" for c in on_duplicate)
    return sql + ";"


def update(table: str, row: dict, where: str) -> str:
    sets = ", ".join(f"`{c}`={q(v)}" for c, v in row.items())
    return f"UPDATE `{table}` SET {sets} WHERE {where};"


def php_json(obj) -> str:
    """JSON giống json_encode() mặc định của PHP: escape unicode + escape '/'."""
    return json.dumps(obj, ensure_ascii=True, separators=(",", ":")).replace("/", "\\/")


def slugify(text: str) -> str:
    text = text.replace("đ", "d").replace("Đ", "D")
    text = unicodedata.normalize("NFD", text)
    text = "".join(ch for ch in text if unicodedata.category(ch) != "Mn")
    text = re.sub(r"[^a-zA-Z0-9]+", "-", text.lower()).strip("-")
    return re.sub(r"-{2,}", "-", text)
