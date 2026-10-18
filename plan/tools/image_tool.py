"""Xử lý ảnh: convert sang WEBP + sinh thumbnail giống Botble (150x150, 400x500, 600x400, 1280x400)."""
from __future__ import annotations

from pathlib import Path

from PIL import Image, ImageOps

from config import THUMB_SIZES

MAX_WIDTH = 1280


def to_webp(src: Path, out_dir: Path, base_name: str, quality: int = 82) -> list[Path]:
    """Trả về [ảnh gốc.webp, các thumbnail...]."""
    out_dir.mkdir(parents=True, exist_ok=True)
    img = Image.open(src)
    img = ImageOps.exif_transpose(img).convert("RGB")
    if img.width > MAX_WIDTH:
        h = round(img.height * MAX_WIDTH / img.width)
        img = img.resize((MAX_WIDTH, h), Image.LANCZOS)

    main = out_dir / f"{base_name}.webp"
    img.save(main, "WEBP", quality=quality, method=6)
    files = [main]
    for w, h in THUMB_SIZES:
        thumb = ImageOps.fit(img, (w, h), Image.LANCZOS, centering=(0.5, 0.5))
        p = out_dir / f"{base_name}-{w}x{h}.webp"
        thumb.save(p, "WEBP", quality=quality, method=6)
        files.append(p)
    return files


def image_size(path: Path) -> tuple[int, int]:
    with Image.open(path) as im:
        return im.size
