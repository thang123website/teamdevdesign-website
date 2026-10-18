<?php

/**
 * Sửa lỗi hiển thị chung của theme.
 *
 * AOS tính vị trí kích hoạt hiệu ứng lúc khởi tạo; khi ảnh lazy-load/slider/thanh admin làm bố cục
 * thay đổi sau đó, các khối gần cuối trang có thể không bao giờ đạt điểm kích hoạt => bị ẩn (opacity 0).
 * Script dưới: tính lại vị trí khi ảnh tải xong, và buộc hiện mọi khối đã nằm trong màn hình.
 */
add_filter(THEME_FRONT_FOOTER, function (?string $html): string {
    return $html . <<<'HTML'
<script>
(function () {
    function reveal() {
        var vh = window.innerHeight || document.documentElement.clientHeight;
        document.querySelectorAll('[data-aos]:not(.aos-animate)').forEach(function (el) {
            var r = el.getBoundingClientRect();
            if (r.top < vh * 0.95 && r.bottom > 0) {
                el.classList.add('aos-init', 'aos-animate');
            }
        });
    }

    var timer;
    function refresh() {
        clearTimeout(timer);
        timer = setTimeout(function () {
            if (window.AOS && typeof window.AOS.refresh === 'function') {
                window.AOS.refresh();
            }
            reveal();
        }, 150);
    }

    window.addEventListener('load', refresh);
    window.addEventListener('scroll', function () { requestAnimationFrame(reveal); }, { passive: true });
    document.addEventListener('load', function (e) {
        if (e.target && e.target.tagName === 'IMG') {
            refresh();
        }
    }, true);
    setTimeout(refresh, 3000);
})();
</script>
HTML;
}, 99);
