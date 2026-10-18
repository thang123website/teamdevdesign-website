# Tổng Hợp Kiến Thức SEO Giao Diện (Infinia Theme)

Tài liệu này tổng hợp lại các lỗi SEO phổ biến thường gặp trên website sử dụng Theme Infinia (đặc biệt là trang chủ và trang Giới thiệu) và cách khắc phục vĩnh viễn, để sau này nếu làm trang mới không bị mắc lại.

## 1. Lỗi Cấu Trúc Heading (Không có thẻ H1, H2)

### Nguyên nhân:
Giao diện (Theme Infinia) được xây dựng dựa trên các Block (Shortcode). Mặc định, các lập trình viên code Theme thường dùng các thẻ `<h3>`, `<h5>` hoặc `<h4>` để định hình kích thước chữ (Typography) cho đẹp mắt, thay vì quan tâm đến cấu trúc chuẩn SEO.
Hậu quả là khi check SEOquake, trang sẽ báo lỗi `H1: 0`, cấu trúc H2, H3 bị lộn xộn.

### Cách khắc phục (Đã được áp dụng vào Code):
Không thể sửa bằng tay trên Admin UI mà phải can thiệp trực tiếp vào mã nguồn của các Shortcode tại thư mục:
`platform/themes/infinia/partials/shortcodes/...`

1. **Thẻ H1 (Chỉ có duy nhất 1 thẻ trên mỗi trang):**
   - Đối với **Trang Chủ**: Thẻ H1 thường nằm ở Banner to nhất. Chúng ta đã cấu hình chuyển thẻ của khối `simple-slider` từ `<h3>` thành `<h1>`. Tuy nhiên, vì người dùng có thể muốn gán H1 ở nơi khác, chúng ta đã **trả nó về lại H3**. Hiện tại H1 đang được bạn tự thêm bằng tay trong Admin.
   - Đối với **Trang Giới Thiệu**: Thẻ H1 được gán vào khối `our-mission style="2"`. Code đã được sửa từ `<h5>` thành `<h1>` trong file `our-mission/styles/style-2.blade.php`.

2. **Thẻ H2 (Dành cho các Tiêu đề mục lớn):**
   - Đã tiến hành thay thế hàng loạt các thẻ `<h3>` và `<h5>` thành `<h2>` trong các file mã nguồn:
     - `services/styles/style-6.blade.php`
     - `our-history/styles/style-3.blade.php`
     - `features/styles/style-6.blade.php`
     - `features/styles/style-4.blade.php`
     - `teams/styles/style-6.blade.php`
     - `projects/styles/style-2.blade.php`
     - `blog/styles/style-2.blade.php`
   - Nhờ vậy, tất cả các khối nội dung bên dưới Banner đều sẽ tự động nhận thẻ chuẩn là H2.

### Lưu ý cho tương lai:
Nếu bạn tạo một trang mới và sử dụng một "Style Shortcode" hoàn toàn lạ (ví dụ `services style="1"`), trang đó có thể lại bị báo lỗi Heading do Style 1 chưa được sửa code. Khi đó, bạn chỉ cần mở file `platform/themes/infinia/partials/shortcodes/[tên-khối]/styles/style-1.blade.php` ra và sửa lại chữ `<h3>` thành `<h2>` là xong!

---

## 2. Lỗi Cấu Hình Title & Meta Description

### Nguyên nhân:
Admin CMS cung cấp nơi để nhập SEO Title và SEO Description cho từng Trang (Pages), nhưng mặc định nếu không nhập, nó sẽ tự động lấy tên trang (rất ngắn) để hiển thị, dẫn đến SEOquake báo vàng hoặc đỏ.

### Cách cấu hình CHUẨN:
- **Tiêu đề SEO (Title):** Phải là một câu có chứa "Từ khóa quan trọng" + "Tên thương hiệu".
  - *Ví dụ:* `Thiết Kế Website Chuyên Nghiệp Chuẩn SEO | TeamDevDesign`
- **Mô tả SEO (Meta Description):** Viết 1 câu văn súc tích, độ dài từ **150 - 160 ký tự**. Tóm tắt chính xác dịch vụ và kích thích người dùng click.
  - *Ví dụ:* `TeamDevDesign chuyên cung cấp dịch vụ thiết kế website doanh nghiệp, thương mại điện tử, Landing Page chuẩn SEO. Tốc độ siêu tốc, tối ưu tỷ lệ chuyển đổi.`
- **Lưu ý:** Không cần quan tâm nếu SEOquake báo chấm than màu cam ở Meta Description khi bạn đã viết ~150 ký tự, vì chuẩn Google hiện tại chỉ hiển thị khoảng 150-160 ký tự trên Mobile. Cảnh báo cam của SEOquake là theo chuẩn cũ (160-300 ký tự).

### Nơi cấu hình:
- **Trang chủ:** Nằm ở mục `Tùy chọn giao diện (Theme Options)` -> `Tổng quan`.
- **Trang Giới thiệu / Liên hệ / Các trang khác:** Nằm ở mục `Trang (Pages)` -> Tìm tên trang -> Kéo xuống dưới cùng (phần SEO Meta Tags).

---

## 3. Quy Trình Xuất Bản/Cập Nhật Mã Nguồn Lên Máy Chủ
Mỗi khi sửa đổi một file `.blade.php` ở máy tính (Local), để code có hiệu lực trên web thực tế (Live), cần phải:
1. Upload đè file đó qua giao thức SSH/SFTP lên đúng thư mục gốc: `/home/u850692085/domains/teamdevdesign.net/public_html/...`
2. Chạy lệnh xóa Cache của Laravel để ép hệ thống biên dịch lại giao diện:
   `php artisan view:clear`

Toàn bộ quy trình này đã được tự động hóa thông qua các script Python trong thư mục `plan/tools/` (như `ssh_client.py`).
