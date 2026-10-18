# plan/ – Nội dung & công cụ cho teamdevdesign.net

```
plan/
├── README.md              ← file này (đọc trước khi thêm/sửa)
├── docs/                  ← kế hoạch, chiến lược SEO, prompt mẫu
│   ├── blog-automation-plan.md
│   ├── service-seo-plan.md
│   └── PROMPT_TEMPLATE.md
├── posts/                 ← BÀI VIẾT blog, mỗi bài 1 thư mục
│   └── <slug>/
│       ├── post.json      (tiêu đề, danh mục, tag, SEO…)
│       ├── content.html
│       ├── images/        (ảnh gốc: featured.jpg, …)
│       └── build/         (tự sinh khi publish – không sửa, đã gitignore)
├── services/              ← DỊCH VỤ, mỗi dịch vụ 1 thư mục
│   └── <slug>/
│       ├── service.json   (tên, mô tả, ảnh, SEO, icon, FAQ)
│       ├── content.html   (nội dung + shortcode)
│       └── images/        (ảnh đại diện + ảnh trong shortcode)
├── tools/                 ← script Python dùng chung
└── backups/               ← backup DB tự động trước mỗi lần ghi (gitignore)
```

## Cài đặt (1 lần)
```powershell
pip install paramiko pillow beautifulsoup4
```
Thông tin SSH đọc từ `.vscode/sftp.json`, DB đọc từ `.env` trên server – không cần cấu hình thêm.

## Lệnh – Bài viết
```powershell
cd plan/tools
python seo_check.py ../posts/<slug>                # chấm SEO
python publish_post.py ../posts/<slug> --dry-run   # build ảnh + SQL, không ghi server
python publish_post.py ../posts/<slug>             # đăng mới
python publish_post.py ../posts/<slug> --update    # cập nhật bài đã có
```

## Lệnh – Dịch vụ
```powershell
cd plan/tools
python export_services.py                              # 1. KÉO bản mới nhất từ site về (luôn chạy trước khi sửa)
#    ... sửa services/<slug>/content.html hoặc service.json ...
python publish_service.py ../services/<slug> --dry-run # 2. kiểm tra
python publish_service.py ../services/<slug>           # 3. đẩy lên site
python publish_service.py --all                        #    hoặc đẩy tất cả
python audit_live_seo.py                               # soát SEO trang live
```

> Nếu sửa trực tiếp trong admin, nhớ chạy lại `export_services.py` để local không bị cũ.

### Thêm dịch vụ mới
1. Copy 1 thư mục có sẵn trong `services/`, đổi tên thành slug mới.
2. Trong `service.json`: đặt `"id": null`, sửa `slug`, `name`, `category_id`, `description`, `seo`…
   Nhóm FAQ mới: `"category_id": null` + `"category": "FAQ - Tên dịch vụ"`.
3. Trong `content.html`: shortcode FAQ dùng `category_ids="{{FAQ}}"` (tool tự thay bằng id thật).
4. Bỏ ảnh vào `images/`, trong json/shortcode ghi đường dẫn `services/<tên-file>`.
5. `--dry-run` → chạy thật. Tool tự ghi lại `id` mới vào `service.json`.
6. Thêm vào menu trong admin: Giao diện → Menu.

### Quy ước nội dung dịch vụ
- Trang đã có H1 = tên dịch vụ → trong content **không dùng `<h1>`**, dùng `<h2 class="h4 …">`.
- `seo_title` ≤ 65 ký tự, `seo_description` 120–165 ký tự.
- Shortcode giao diện: `[content-checklist]`, `[content-features]`, `[projects]`, `[faqs]` – bọc trong `<shortcode>…</shortcode>`.
- Bảo hành: WordPress 6 tháng, nền tảng khác (Laravel/Next JS) 12 tháng.

### Lỗi đã gặp – tool đã tự xử lý, KHÔNG viết script tay
| Lỗi | Nguyên nhân |
|---|---|
| Admin không hiện SEO | `reference_type` bị `addslashes` → `Botble\\Portfolio\\...` |
| Admin không hiện SEO | `meta_value` lưu `{...}` thay vì `[{...}]` |
| Admin hiện SEO rỗng | 2 dòng `seo_meta` cho 1 dịch vụ |
| Ảnh đại diện admin bị vỡ | ảnh chưa có trong `media_files` / chưa có thumbnail |

## Khôi phục (rollback)
Backup nằm ở `backups/<thời gian>_<slug|services>.sql.gz`. Giải nén và import lại bằng `mysql` trên server.

## Bài đã đăng
| Ngày | Post ID | Slug | Danh mục |
|---|---|---|---|
| 2026-10-05 | 64 | [huong-dan-cai-dat-mail-server-tren-aapanel](https://teamdevdesign.net/huong-dan-cai-dat-mail-server-tren-aapanel) | Hosting & VPS (#18) |

## Dịch vụ đang chạy
| ID | Slug |
|---|---|
| 1 | [thiet-ke-website-doanh-nghiep](https://teamdevdesign.net/services/thiet-ke-website-doanh-nghiep) |
| 2 | [thiet-ke-website-thuong-mai-dien-tu](https://teamdevdesign.net/services/thiet-ke-website-thuong-mai-dien-tu) |
| 3 | [landing-page-website-marketing](https://teamdevdesign.net/services/landing-page-website-marketing) |
| 4 | [bao-tri-quan-tri-website](https://teamdevdesign.net/services/bao-tri-quan-tri-website) |
| 5 | [nang-cap-toi-uu-website](https://teamdevdesign.net/services/nang-cap-toi-uu-website) |
| 6 | [dich-vu-hosting-ten-mien](https://teamdevdesign.net/services/dich-vu-hosting-ten-mien) |
