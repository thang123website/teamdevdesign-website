import os
import json
import shutil
import glob

services = [
    {
        "slug": "thiet-ke-website-bat-dong-san",
        "id": None,
        "name": "Thiết Kế Website Bất Động Sản Chuẩn SEO",
        "category_id": 2,
        "category": "Website Doanh Nghiệp",
        "description": "Dịch vụ thiết kế website bất động sản chuyên nghiệp, tích hợp bản đồ quy hoạch, VR 360, bộ lọc tìm kiếm thông minh và quản lý CRM.",
        "image": "services/service_bds_featured.jpg",
        "images": [],
        "is_featured": True,
        "order": 0,
        "status": "published",
        "seo": {
            "seo_title": "Thiết kế website bất động sản chuyên nghiệp, chuẩn SEO Top 1",
            "seo_description": "Công ty thiết kế website bất động sản uy tín, giá chỉ từ 3-8 triệu. Tích hợp bộ lọc thông minh, bản đồ VR 360, tốc độ cao chuẩn Core Web Vitals.",
            "seo_image": "services/service_bds_featured.jpg",
            "index": "index"
        },
        "meta": {
            "icon_image": "icons/icon-2.png"
        },
        "faqs": [
            {
                "category_id": None,
                "category": "FAQ - Website Bất Động Sản",
                "items": [
                    {"question": "Thời gian thiết kế website bất động sản là bao lâu?", "answer": "Thường từ 5 đến 15 ngày tùy theo tính năng (có tích hợp VR360, CRM hay không)."},
                    {"question": "Website có tích hợp bộ lọc tìm kiếm thông minh không?", "answer": "Có, chúng tôi tích hợp bộ lọc cực kỳ chi tiết từ giá, diện tích, hướng nhà, số phòng ngủ, cho đến pháp lý."}
                ]
            }
        ],
        "content": """<h2 class="h4 mb-3">Vì Sao Bất Động Sản Cần Một Website Riêng Biệt?</h2>
<p class="mb-3">Khách hàng mua nhà/đất thường có nhu cầu tra cứu thông tin dự án, pháp lý, tiện ích rất kỹ lưỡng. Một website bất động sản không chỉ là bộ mặt uy tín của sàn giao dịch mà còn là nơi lưu trữ toàn bộ dữ liệu, giúp khách hàng dễ dàng tìm kiếm và tin tưởng đầu tư.</p>

<shortcode>[content-checklist checklist="Bộ lọc tìm kiếm thông minh (Giá, Diện tích, Khu vực, Pháp lý)
Tích hợp Bản đồ Google Maps & Công nghệ VR 360
Quản lý dự án & Khách hàng tiềm năng (CRM) tích hợp
Cấu trúc dữ liệu (Schema Markup) chuẩn SEO
Tốc độ tải trang nhanh (Core Web Vitals chuẩn Google)
Bảo hành 6-12 tháng, bàn giao 100% source code" title="Các Tính Năng Cốt Lõi Của Một Website Bất Động Sản Top 1" image="services/service_bds_features.jpg"][/content-checklist]</shortcode>

<h2 class="h4 mt-4 pt-4 border-top mb-3">Báo Giá Thiết Kế Website Bất Động Sản</h2>
<p class="mb-3">Mức giá thay đổi tùy thuộc vào quy mô và nhu cầu thực tế của từng doanh nghiệp/cá nhân:</p>
<div class="table-responsive post-table-wrap mb-4">
    <table class="table table-bordered table-striped" style="min-width: 750px;">
        <thead class="table-light">
            <tr>
                <th>Gói Thiết Kế</th>
                <th>Môi Giới Cá Nhân (WordPress)</th>
                <th>Sàn Giao Dịch (Laravel)</th>
                <th>Chủ Đầu Tư Lớn (Next.js + App)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Mức giá</strong></td>
                <td>3.000.000đ - 8.000.000đ</td>
                <td>12.000.000đ - 30.000.000đ</td>
                <td>Từ 60.000.000đ trở lên</td>
            </tr>
            <tr>
                <td><strong>Tính năng chính</strong></td>
                <td>Đăng tin, Landing page dự án, Blog</td>
                <td>Quản lý bảng hàng, CRM, Bộ lọc nâng cao</td>
                <td>VR 360, App Mobile đồng bộ, API tích hợp</td>
            </tr>
            <tr>
                <td><strong>Chi phí ẩn (hàng năm)</strong></td>
                <td>~1.500.000đ (Domain + Hosting)</td>
                <td>~3.000.000đ (Server + CRM)</td>
                <td>~10.000.000đ (Hạ tầng Cloud + App Store)</td>
            </tr>
        </tbody>
    </table>
</div>

<shortcode>[projects style="1" limit="3" title="Mẫu Giao Diện Website Bất Động Sản Tiêu Biểu" description="Các dự án website nhà đất, bất động sản chúng tôi đã thực hiện:"][/projects]</shortcode>

<shortcode>[faqs style="1" category_ids="{{FAQ}}"][/faqs]</shortcode>""",
        "source_featured": "service_bds_featured*.jpg",
        "source_features": "service_bds_features*.jpg"
    },
    {
        "slug": "landing-page-website-marketing",
        "id": 3,
        "name": "Landing Page & Website Marketing",
        "category_id": 3,
        "category": "Website Tin tức / Blog / Cổng thông tin",
        "description": "Thiết kế Landing Page chuẩn CRO, tốc độ tải trang cực nhanh giúp x3 tỷ lệ chuyển đổi, tối ưu quảng cáo Facebook/Google Ads.",
        "image": "services/service_landing_featured.jpg",
        "images": [],
        "is_featured": False,
        "order": 0,
        "status": "published",
        "seo": {
            "seo_title": "Thiết kế Landing Page chuẩn SEO, tăng gấp 3 tỷ lệ chuyển đổi",
            "seo_description": "Báo giá thiết kế Landing Page 2026. Chuẩn Core Web Vitals, cấu trúc CRO tối ưu hóa chuyển đổi, tích hợp Facebook Pixel, Google Tag Manager.",
            "seo_image": "services/service_landing_featured.jpg",
            "index": "index"
        },
        "meta": {
            "icon_image": "icons/icon-8.png"
        },
        "faqs": [
            {
                "category_id": 7,
                "category": "FAQ - Landing Page",
                "items": [
                    {"question": "Landing page khác gì với website thông thường?", "answer": "Landing page là một trang đơn lẻ được thiết kế tập trung duy nhất vào một mục tiêu chuyển đổi (như điền form, đăng ký, mua hàng), không có menu điều hướng phức tạp để tránh làm phân tâm người dùng."},
                    {"question": "Tốc độ tải trang có thực sự quan trọng không?", "answer": "Rất quan trọng. Core Web Vitals (LCP < 2.5s) là tiêu chuẩn hiện tại. Mỗi giây chậm trễ có thể làm giảm khoảng 7% tỷ lệ chuyển đổi và tăng chi phí chạy Ads."},
                    {"question": "Tôi nên dùng WordPress, LadiPage hay Next.js?", "answer": "LadiPage phù hợp triển khai cực nhanh. WordPress phù hợp tùy biến cao, nhiều plugin. Next.js phù hợp cho dự án cần tốc độ siêu tốc và hiệu ứng phức tạp cao cấp."}
                ]
            }
        ],
        "content": """<h2 class="h4 mb-3">Landing Page Khác Gì Website Thông Thường?</h2>
<p class="mb-3">Website thông thường chứa rất nhiều thông tin và menu điều hướng khiến khách hàng dễ bị phân tâm. Trong khi đó, <strong>Landing Page (Trang đích)</strong> được thiết kế theo cấu trúc "Kim tự tháp đảo ngược", chỉ tập trung vào 1 mục tiêu duy nhất (Mua hàng hoặc Điền form). Việc loại bỏ các yếu tố gây xao nhãng giúp chiến dịch quảng cáo hiệu quả hơn vượt trội.</p>

<shortcode>[content-checklist checklist="Cấu trúc CRO: Vấn đề -> Giải pháp -> Lợi ích -> Social Proof -> CTA
Tốc độ cực nhanh chuẩn Core Web Vitals 2026 (LCP < 2,5s)
Thiết kế Mobile-First (hơn 70% traffic từ di động)
Tích hợp Facebook Pixel, Google Tag Manager
A/B Testing, Heatmap để tối ưu tỷ lệ chuyển đổi
Tỷ lệ chuyển đổi (CR) tốt đạt mức 3% - 5%" title="Cấu Trúc Một Landing Page 'Chốt Sale' Hiệu Quả" image="services/service_landing_features.jpg"][/content-checklist]</shortcode>

<h2 class="h4 mt-4 pt-4 border-top mb-3">Bảng Báo Giá Thiết Kế Landing Page 2026</h2>
<div class="table-responsive post-table-wrap mb-4">
    <table class="table table-bordered table-striped" style="min-width: 750px;">
        <thead class="table-light">
            <tr>
                <th>Gói Dịch Vụ</th>
                <th>Kéo Thả (LadiPage/Elementor)</th>
                <th>HTML/CSS Thuần (Tốc độ cao)</th>
                <th>Next.js (Chuyên sâu)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Mức giá</strong></td>
                <td>Từ 2.000.000 VNĐ</td>
                <td>Từ 4.000.000 VNĐ</td>
                <td>Từ 8.000.000 VNĐ</td>
            </tr>
            <tr>
                <td><strong>Ưu điểm</strong></td>
                <td>Triển khai nhanh, dễ tự sửa</td>
                <td>Tốc độ tải nhanh, không bị lệ thuộc</td>
                <td>Hiệu ứng 3D siêu mượt, siêu tốc độ</td>
            </tr>
            <tr>
                <td><strong>Phù hợp với</strong></td>
                <td>Chiến dịch ngắn hạn, test sản phẩm</td>
                <td>Chiến dịch dài hạn, chạy ads ngân sách lớn</td>
                <td>Sản phẩm cao cấp, cần uy tín cực lớn</td>
            </tr>
        </tbody>
    </table>
</div>

<shortcode>[projects style="1" limit="3" title="Dự Án Landing Page Chuyển Đổi Cao Đã Thực Hiện" description="Các mẫu Landing Page đã được chúng tôi A/B Testing tối ưu hóa:"][/projects]</shortcode>

<shortcode>[faqs style="1" category_ids="7"][/faqs]</shortcode>""",
        "source_featured": "service_landing_featured*.jpg",
        "source_features": "service_landing_features*.jpg"
    },
    {
        "slug": "phat-trien-plugin-wordpress",
        "id": None,
        "name": "Phát Triển Plugin WordPress Theo Yêu Cầu",
        "category_id": 5,
        "category": "Dịch vụ phát triển",
        "description": "Dịch vụ viết và lập trình Plugin WordPress chuyên nghiệp. Đồng bộ API, CRM, ERP, tối ưu hiệu năng và bảo mật, không xung đột hệ thống.",
        "image": "services/service_wp_plugin_featured.jpg",
        "images": [],
        "is_featured": True,
        "order": 0,
        "status": "published",
        "seo": {
            "seo_title": "Lập trình, phát triển Plugin WordPress theo yêu cầu | Báo giá 2026",
            "seo_description": "Nhận viết Plugin WordPress theo yêu cầu giá rẻ, tối ưu tốc độ, bảo mật cao. Đồng bộ hệ thống nội bộ ERP/CRM, tương thích WooCommerce hoàn hảo.",
            "seo_image": "services/service_wp_plugin_featured.jpg",
            "index": "index"
        },
        "meta": {
            "icon_image": "icons/icon-7.png"
        },
        "faqs": [
            {
                "category_id": None,
                "category": "FAQ - Plugin WordPress",
                "items": [
                    {"question": "Tôi cần chuẩn bị gì để nhận báo giá?", "answer": "Để có báo giá chính xác, bạn cần cung cấp: Mục tiêu plugin (giải quyết việc gì), Danh sách tính năng chi tiết, Yêu cầu tương thích (WooCommerce/Elementor...), và yêu cầu về dữ liệu/bảo mật."},
                    {"question": "Thời gian lập trình Plugin mất bao lâu?", "answer": "Tùy thuộc vào độ phức tạp. Thường 3-7 ngày cho plugin đơn giản, và 2-4 tuần cho các plugin tích hợp hệ thống lớn."}
                ]
            }
        ],
        "content": """<h2 class="h4 mb-3">Tại Sao Nên Viết Plugin WordPress Thay Vì Dùng Bản Có Sẵn?</h2>
<p class="mb-3">Trên thị trường có hàng nghìn plugin WordPress có sẵn, tuy nhiên chúng thường rất cồng kềnh, chứa nhiều tính năng thừa làm chậm website. Lập trình một plugin riêng biệt giúp <strong>"đo ni đóng giày"</strong> theo đúng luồng nghiệp vụ của công ty bạn, đảm bảo bảo mật tuyệt đối (không có mã độc backdoor), hoạt động nhẹ nhàng và tương thích 100% với hệ thống nội bộ hiện tại.</p>

<shortcode>[content-checklist checklist="Chuẩn WordPress Coding Standards, an toàn dữ liệu
Đồng bộ API, kết nối dễ dàng qua CRM, ERP, phần mềm kế toán
Không gây xung đột code với Theme và các Plugin khác
Tối ưu Database (Prepared statements, giảm thiểu truy vấn thừa)
Tương thích hoàn hảo với WooCommerce, Elementor
Bàn giao 100% Source Code kèm Tài liệu hướng dẫn sử dụng" title="Các Tiêu Chuẩn Chất Lượng Khi Chúng Tôi Viết Plugin" image="services/service_wp_plugin_features.jpg"][/content-checklist]</shortcode>

<h2 class="h4 mt-4 pt-4 border-top mb-3">Báo Giá Dịch Vụ Lập Trình Plugin WordPress</h2>
<p class="mb-3">Quy trình làm việc chuẩn mực: <em>Tiếp nhận yêu cầu → Chốt luồng nghiệp vụ → Báo giá trong 24h → Code trên môi trường Staging → Bàn giao.</em></p>
<div class="table-responsive post-table-wrap mb-4">
    <table class="table table-bordered table-striped" style="min-width: 750px;">
        <thead class="table-light">
            <tr>
                <th>Gói Lập Trình</th>
                <th>Cơ Bản</th>
                <th>Tích Hợp API</th>
                <th>Nâng Cao / Enterprise</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Mức giá</strong></td>
                <td>2.000.000đ - 5.000.000đ</td>
                <td>6.000.000đ - 15.000.000đ</td>
                <td>Từ 15.000.000đ trở lên</td>
            </tr>
            <tr>
                <td><strong>Mô tả</strong></td>
                <td>Xử lý Form, Tính toán, Báo giá tự động, Hiển thị UI.</td>
                <td>Đồng bộ dữ liệu đa nền tảng, Kéo thông tin tự động.</td>
                <td>Thay đổi core luồng thanh toán, Xử lý dữ liệu Big Data.</td>
            </tr>
            <tr>
                <td><strong>Bảo hành</strong></td>
                <td>6 Tháng</td>
                <td>6 Tháng</td>
                <td>12 Tháng</td>
            </tr>
        </tbody>
    </table>
</div>

<shortcode>[faqs style="1" category_ids="{{FAQ}}"][/faqs]</shortcode>""",
        "source_featured": "service_wp_plugin_featured*.jpg",
        "source_features": "service_wp_plugin_features*.jpg"
    },
    {
        "slug": "thiet-ke-zalo-mini-app",
        "id": None,
        "name": "Thiết Kế Zalo Mini App Trọn Gói",
        "category_id": 5,
        "category": "Dịch vụ phát triển",
        "description": "Giải pháp tiếp cận 80 triệu người dùng Zalo với Zalo Mini App. Tích hợp thanh toán ZaloPay, thông báo ZNS, thẻ thành viên Loyalty.",
        "image": "services/service_zalo_mini_app_featured.jpg",
        "images": [],
        "is_featured": True,
        "order": 0,
        "status": "published",
        "seo": {
            "seo_title": "Thiết kế Zalo Mini App chuyên nghiệp, chuẩn UI/UX từ Zalo",
            "seo_description": "Báo giá thiết kế Zalo Mini App 2026 trọn gói từ 6 triệu. Ứng dụng tích điểm, ZNS, bán hàng trực tiếp trên Zalo không cần tải app, tiếp cận 80 triệu khách hàng.",
            "seo_image": "services/service_zalo_mini_app_featured.jpg",
            "index": "index"
        },
        "meta": {
            "icon_image": "icons/icon-6.png"
        },
        "faqs": [
            {
                "category_id": None,
                "category": "FAQ - Zalo Mini App",
                "items": [
                    {"question": "Zalo có thu phí phát hành Mini App không?", "answer": "Không, Zalo không thu phí đăng ký tài khoản Zalo for Developers hay phí phát hành Mini App. Bạn chỉ cần trả chi phí lập trình cho đội ngũ kỹ thuật."},
                    {"question": "Dung lượng Zalo Mini App có bị giới hạn không?", "answer": "Có. Để đảm bảo trải nghiệm siêu tốc, Zalo giới hạn dung lượng của Mini App không được vượt quá 10MB."},
                    {"question": "Thời gian xét duyệt Zalo Mini App là bao lâu?", "answer": "Sau khi lập trình xong, quy trình gửi duyệt trên hệ thống Zalo thường mất từ 3 đến 7 ngày làm việc."}
                ]
            }
        ],
        "content": """<h2 class="h4 mb-3">Zalo Mini App Là Gì? Tại Sao Lại Là Xu Hướng 2026?</h2>
<p class="mb-3"><strong>Zalo Mini App</strong> là những "ứng dụng nhỏ" chạy trực tiếp trên nền tảng hệ sinh thái Zalo. Giải pháp này tiết kiệm đến 50-70% chi phí so với việc lập trình một Native App (iOS/Android) độc lập. Đặc biệt, khách hàng của bạn <strong>không cần tải app về máy</strong> (App-less) mà vẫn có thể đặt hàng, tích điểm, nhận khuyến mãi ngay trong khung chat Zalo, giúp tăng tỷ lệ tiếp cận và chuyển đổi lên gấp 3 lần.</p>

<shortcode>[content-checklist checklist="Tích điểm thành viên & Đổi thưởng (Loyalty Program)
Đặt hàng trực tuyến & Thanh toán liền mạch qua ZaloPay/MoMo
Gửi thông báo ZNS tự động (Trạng thái đơn hàng, chúc mừng sinh nhật)
Dung lượng nhẹ < 10MB, chuẩn Design Guidelines của Zalo
Phù hợp: F&B (Cafe/Trà sữa), Spa, Bán lẻ thời trang, Phòng khám
Đăng ký và duyệt App chuyên nghiệp (3-7 ngày làm việc)" title="Các Tính Năng Chốt Sale & Chăm Sóc Khách Hàng Vượt Trội" image="services/service_zalo_mini_app_features.jpg"][/content-checklist]</shortcode>

<h2 class="h4 mt-4 pt-4 border-top mb-3">Bảng Báo Giá Xây Dựng Zalo Mini App</h2>
<p class="mb-3">Chi phí phát triển Zalo Mini App phụ thuộc vào độ phức tạp về UI/UX và các tính năng tích hợp thanh toán, vận chuyển.</p>
<div class="table-responsive post-table-wrap mb-4">
    <table class="table table-bordered table-striped" style="min-width: 750px;">
        <thead class="table-light">
            <tr>
                <th>Gói Giải Pháp</th>
                <th>Starter (Cơ bản)</th>
                <th>Pro (Bán hàng)</th>
                <th>Enterprise (Tích hợp sâu)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Mức giá</strong></td>
                <td>6.000.000đ - 12.000.000đ</td>
                <td>15.000.000đ - 30.000.000đ</td>
                <td>Từ 35.000.000đ trở lên</td>
            </tr>
            <tr>
                <td><strong>Tính năng nổi bật</strong></td>
                <td>Hiển thị thông tin, Đặt lịch hẹn cơ bản, Form liên hệ.</td>
                <td>Bán hàng, Giỏ hàng, Tích điểm thành viên, Thanh toán ZaloPay.</td>
                <td>Tích hợp sâu API với hệ thống ERP/CRM nội bộ của doanh nghiệp.</td>
            </tr>
            <tr>
                <td><strong>Bảo hành & Hỗ trợ</strong></td>
                <td>12 Tháng</td>
                <td>12 Tháng</td>
                <td>12 Tháng (Hỗ trợ duyệt App)</td>
            </tr>
        </tbody>
    </table>
</div>

<shortcode>[projects style="1" limit="3" title="Mẫu Zalo Mini App Thiết Kế Chuyên Nghiệp" description="Tham khảo các giao diện Mini App đẹp, chuẩn UX/UI:"][/projects]</shortcode>

<shortcode>[faqs style="1" category_ids="{{FAQ}}"][/faqs]</shortcode>""",
        "source_featured": "service_zalo_mini_app_featured*.jpg",
        "source_features": "service_zalo_mini_app_features*.jpg"
    }
]

base_dir = r"d:\DuAnCaNhan\teamdevdesign\plan\services"
artifact_dir = r"C:\Users\ADmin\.gemini\antigravity-ide\brain\073b893d-efbb-478a-a34e-0a9bba5c1744"

for s in services:
    s_dir = os.path.join(base_dir, s["slug"])
    os.makedirs(os.path.join(s_dir, "images"), exist_ok=True)
    
    for k in ["source_featured", "source_features"]:
        pattern = os.path.join(artifact_dir, s[k])
        matches = glob.glob(pattern)
        if matches:
            src = matches[-1]
            if "featured" in k:
                dst_name = s["image"].split("/")[-1]
            else:
                dst_name = s["image"].split("/")[-1].replace("featured", "features")
            
            dst = os.path.join(s_dir, "images", dst_name)
            shutil.copy2(src, dst)
            print(f"Copied {src} to {dst}")
    
    json_data = s.copy()
    del json_data["content"]
    del json_data["source_featured"]
    del json_data["source_features"]
    
    with open(os.path.join(s_dir, "service.json"), "w", encoding="utf-8") as f:
        json.dump(json_data, f, ensure_ascii=False, indent=2)
    
    with open(os.path.join(s_dir, "content.html"), "w", encoding="utf-8") as f:
        f.write(s["content"])

print("Done generating service files!")
