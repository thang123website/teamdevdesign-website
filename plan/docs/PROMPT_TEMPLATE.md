# Mẫu prompt viết & đăng bài blog mới (teamdevdesign.net)

Copy khối dưới, điền thông tin rồi gửi cho AI agent:

```
Viết bài blog mới theo `plan/docs/PROMPT_TEMPLATE.md` và `plan/docs/blog-automation-plan.md`
- URL tham khảo (nếu có): <url>
- Chủ đề: <chủ đề>
- Từ khoá chính: <keyword>
- Danh mục: <tên danh mục có sẵn | "tự chọn, tạo mới nếu không phù hợp">
- Tags: <tag1, tag2, ... | "tự đề xuất">
- Ảnh: 1 ảnh đại diện + <N> ảnh minh hoạ (AI tạo)
- Chế độ: <publish | dry-run | draft>
```

## Agent cần làm theo thứ tự
1. Đọc bài tham khảo (nếu có) → viết lại 100%, cập nhật thông tin mới, bổ sung phần thiếu (FAQ, lỗi thường gặp, bảng).
2. Tạo thư mục `plan/posts/<slug>/` gồm `post.json`, `content.html`, `images/`.
3. Tạo ảnh bằng AI, lưu vào `images/` (featured 16:9 + ảnh minh hoạ). Trong `content.html` chèn `<img src="images/<file>" alt="...">` – script tự đổi sang webp + URL thật.
4. Chạy `python seo_check.py ../posts/<slug>` → sửa đến khi `✅ SEO OK`.
5. Chạy `python publish_post.py ../posts/<slug> --dry-run` → xem `build/publish.sql`.
6. Chạy `python publish_post.py ../posts/<slug>` (thêm `--update` nếu sửa bài đã đăng).
7. Mở trình duyệt kiểm tra trang bài, danh mục, tags.

## 1. Quy chuẩn Nội dung
- **Độ dài**: 1500 - 2500 từ cho bài hướng dẫn/chuyên sâu. Dữ liệu KHÔNG được bịa đặt (No Hallucination). Mọi thông số, lệnh Terminal phải chuẩn xác từ thực tế.
- **Thẻ H2/H3**: Chỉ dùng H2/H3 (H1 do theme render từ `name`). Phải có ≥ 4 H2. Từ khóa chính xuất hiện trong ít nhất 1 H2. Style giống bài cũ: `<h2><span style="font-size:24px;">…</span></h2>`, `<h3><span style="font-size:22px;">…</span></h3>`.
- **Liên kết**: ≥ 2 internal link. Gợi ý: `/services/dich-vu-hosting-ten-mien`, `/services/bao-tri-quan-tri-website`, `/services/thiet-ke-website-doanh-nghiep`, `/lien-he`, `/gia-ca`. Có ≥ 1 external link uy tín.
- **Bảng/Khung màu**: Bảng: `<table style="border-collapse:collapse;width:100%;" border="1" cellpadding="8">`. Khung màu cho Tip/Lưu ý: `<div style="background-color: #e8f4fd; padding: 20px; border-left: 4px solid #0d6efd;">...</div>`.

## 2. Bắt buộc: Mục FAQ (Câu hỏi thường gặp)
Để ăn Rich Snippets (hiển thị Accordion tự động), bài viết BẮT BUỘC có mục FAQ ở cuối (trước Kết luận) theo đúng mã HTML sau:

```html
<hr>
<h2><span style="font-size:24px;">Câu hỏi thường gặp (FAQ)</span></h2>

<h3><span style="font-size:22px;">Câu hỏi số 1 của khách hàng?</span></h3>
<p>Câu trả lời ngắn gọn, trực diện (khoảng 3 - 4 dòng).</p>

<h3><span style="font-size:22px;">Câu hỏi số 2 của khách hàng?</span></h3>
<p>Câu trả lời và có thể chèn link nội bộ tại đây.</p>

<hr>
<h2><span style="font-size:24px;">Kết luận</span></h2>
<p>Lời kết và kêu gọi hành động (Call to action).</p>
```

## 3. Tiêu Chuẩn Về Hình Ảnh
- Bắt buộc có **tối thiểu 3 hình ảnh** trong mỗi bài.
- Thẻ `<img>` **bắt buộc** phải có thuộc tính `alt="..."` chứa từ khóa mô tả ý nghĩa bức ảnh.
- Không cần tự chuyển đổi sang định dạng `.webp`. Bạn chỉ cần lưu ảnh chất lượng cao vào mục `images/` và tham chiếu trong thẻ `<img>` với src như sau: `<img src="images/ten-anh.jpg" alt="...">`.
- Khi chạy tool `publish_post.py`, hệ thống sẽ tự động: cắt tạo đúng 6 kích thước thumbnail (kể cả 600x338), nén sang webp và đẩy lên CDN.
