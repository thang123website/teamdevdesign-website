"""Kiểm tra SEO cho 1 bài trước khi đăng.

Usage: python seo_check.py ../posts/<slug>
"""
from __future__ import annotations

import html
import json
import re
import sys
from html.parser import HTMLParser
from pathlib import Path

from config import SITE_URL
from sql_builder import slugify


class _Parser(HTMLParser):
    def __init__(self) -> None:
        super().__init__()
        self.text: list[str] = []
        self.headings: list[tuple[str, str]] = []
        self.imgs: list[dict] = []
        self.links: list[str] = []
        self._h: str | None = None
        self._hbuf: list[str] = []

    def handle_starttag(self, tag, attrs):
        a = dict(attrs)
        if tag in ("h1", "h2", "h3", "h4"):
            self._h, self._hbuf = tag, []
        elif tag == "img":
            self.imgs.append(a)
        elif tag == "a" and a.get("href"):
            self.links.append(a["href"])

    def handle_endtag(self, tag):
        if tag == self._h:
            self.headings.append((tag, "".join(self._hbuf).strip()))
            self._h = None

    def handle_data(self, data):
        self.text.append(data)
        if self._h:
            self._hbuf.append(data)


def check(post_dir: Path) -> tuple[list[str], list[str]]:
    meta = json.loads((post_dir / "post.json").read_text(encoding="utf-8"))
    content = (post_dir / "content.html").read_text(encoding="utf-8")
    p = _Parser()
    p.feed(content)

    kw = meta.get("focus_keyword", "").lower().strip()
    text = html.unescape(" ".join(p.text))
    words = re.findall(r"\w+", text.lower())
    plain = " ".join(words)
    errors: list[str] = []
    warns: list[str] = []

    def need(cond: bool, msg: str, hard: bool = True) -> None:
        if not cond:
            (errors if hard else warns).append(msg)

    st, sd = meta.get("seo_title", ""), meta.get("seo_description", "")
    need(bool(kw), "Thiếu focus_keyword")
    need(len(meta.get("name", "")) <= 255, "name > 255 ký tự")
    need(len(meta.get("description", "")) <= 400, "description > 400 ký tự")
    need(10 <= len(st) <= 65, f"seo_title nên 10–65 ký tự (hiện {len(st)})", hard=False)
    need(110 <= len(sd) <= 165, f"seo_description nên 110–165 ký tự (hiện {len(sd)})", hard=False)
    need(meta.get("slug") == slugify(meta.get("slug", "")), "slug không hợp lệ (phải không dấu, chữ thường, gạch ngang)")

    if kw:
        kw_words = " ".join(re.findall(r"\w+", kw))
        need(kw in meta.get("name", "").lower(), "Từ khoá chính không có trong name (H1)", hard=False)
        need(kw in st.lower(), "Từ khoá chính không có trong seo_title", hard=False)
        need(kw in sd.lower(), "Từ khoá chính không có trong seo_description", hard=False)
        need(slugify(kw) in meta.get("slug", ""), "Từ khoá chính không có trong slug", hard=False)
        need(kw_words in " ".join(words[:120]), "Từ khoá chính không xuất hiện trong ~100 từ đầu", hard=False)
        need(any(kw in h.lower() for t, h in p.headings if t in ("h2", "h3")), "Từ khoá chính không có trong H2/H3 nào", hard=False)
        n = plain.count(kw_words)
        density = n * len(kw_words.split()) / max(len(words), 1) * 100
        need(0.4 <= density <= 2.5, f"Mật độ từ khoá {density:.2f}% (nên 0.5–2%)", hard=False)

    need(not any(t == "h1" for t, _ in p.headings), "Content không được chứa <h1> (theme đã render H1 từ name)")
    need(sum(1 for t, _ in p.headings if t == "h2") >= 4, "Nên có ≥ 4 thẻ H2", hard=False)
    need(len(words) >= 1200, f"Bài ngắn ({len(words)} từ), nên ≥ 1200 từ", hard=False)
    for img in p.imgs:
        need(bool(img.get("alt")), f"Ảnh thiếu alt: {img.get('src')}")
    internal = [l for l in p.links if l.startswith("/") or l.startswith(SITE_URL)]
    external = [l for l in p.links if l.startswith("http") and not l.startswith(SITE_URL)]
    anchors = [l for l in p.links if l.startswith("#")]
    
    need(len(internal) >= 2, f"Nên có ≥ 2 internal link (hiện {len(internal)})", hard=False)
    need(len(external) >= 1, "Nên có ≥ 1 external link uy tín", hard=False)
    need(len(anchors) >= 3 or "mục lục" in text.lower() or "table of contents" in text.lower(), "Chưa có Mục lục (Table of Contents) hoặc Anchor links để tối ưu SXO", hard=False)

    print(f"Số từ: {len(words)} | H2: {sum(1 for t,_ in p.headings if t=='h2')} | Ảnh: {len(p.imgs)} | "
          f"Internal: {len(internal)} | External: {len(external)}")
    return errors, warns


if __name__ == "__main__":
    sys.stdout.reconfigure(encoding="utf-8")
    errs, warns = check(Path(sys.argv[1]))
    for w in warns:
        print("  ⚠️ ", w)
    for e in errs:
        print("  ❌", e)
    print("✅ SEO OK" if not errs and not warns else ("❌ Có lỗi" if errs else "⚠️  Có cảnh báo"))
    sys.exit(1 if errs else 0)
