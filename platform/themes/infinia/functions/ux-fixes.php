<?php

use Botble\Base\Facades\BaseHelper;
use Illuminate\Foundation\Http\Events\RequestHandled;
use Illuminate\Http\Response;

/**
 * Hiệu năng/a11y: xử lý HTML trang ngoài (không áp dụng trang admin).
 * - CSS không cần cho phần đầu trang => tải không chặn render (preload + onload).
 * - <img> thiếu alt => alt="" (ảnh trang trí; ảnh nội dung đã có alt từ template).
 */
app('events')->listen(RequestHandled::class, function (RequestHandled $event): void {
    $request = $event->request;
    $response = $event->response;

    if (! $request->isMethod('GET') || ! $response instanceof Response || $response->getStatusCode() >= 300) {
        return;
    }

    if (! str_contains((string) $response->headers->get('Content-Type'), 'text/html')
        || $request->is(BaseHelper::getAdminPrefix() . '*')
        || $request->ajax()) {
        return;
    }

    $html = $response->getContent();
    if (! is_string($html) || ! str_contains($html, '</head>')) {
        return;
    }

    $deferCss = 'fonts\.googleapis\.com/css2|popup-chat\.min\.css|language-public\.css|cookie-consent\.css|odometer\.css'
        . '|magnific-popup\.css|bootstrap-icons\.min\.css|slick\.min\.css|live-chat\.css';

    $html = preg_replace_callback(
        '#<link\b(?=[^>]*rel=["\']stylesheet["\'])(?=[^>]*href=["\']([^"\']*(?:' . $deferCss . ')[^"\']*)["\'])[^>]*>#i',
        fn ($m) => '<link rel="preload" as="style" href="' . $m[1] . '" onload="this.onload=null;this.rel=\'stylesheet\'">'
            . '<noscript><link rel="stylesheet" href="' . $m[1] . '"></noscript>',
        $html
    ) ?? $html;

    $html = preg_replace('#<img\b(?![^>]*\balt=)#i', '<img alt=""', $html) ?? $html;

    // SEO: trang không có H1 (vd tắt breadcrumb) => nâng heading đầu tiên trong <main> lên H1, giữ cỡ chữ bằng class hN.
    if (stripos($html, '<h1') === false && ($mainPos = stripos($html, '<main')) !== false) {
        $tail = substr($html, $mainPos);
        $tail = preg_replace_callback('#<h([2-6])\b([^>]*)>(.*?)</h\1>#is', function ($m) {
            $attrs = preg_match('#\bclass=(["\'])#', $m[2])
                ? preg_replace('#\bclass=(["\'])#', 'class=$1h' . $m[1] . ' ', $m[2], 1)
                : ' class="h' . $m[1] . '"' . $m[2];

            return '<h1' . $attrs . '>' . $m[3] . '</h1>';
        }, $tail, 1);
        if (is_string($tail)) {
            $html = substr($html, 0, $mainPos) . $tail;
        }
    }

    if (! is_string($html) || $html === '') {
        return; // regex lỗi => giữ nguyên response gốc
    }

    $response->setContent($html);
});

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

    // A11y: slide nhân bản của slick có aria-hidden="true" nhưng chứa link bấm được => bỏ khỏi thứ tự tab.
    function fixSlick() {
        document.querySelectorAll('.slick-slide[aria-hidden="true"], .slick-cloned').forEach(function (slide) {
            slide.removeAttribute('tabindex');
            slide.querySelectorAll('a, button, input, [tabindex]').forEach(function (el) {
                el.setAttribute('tabindex', '-1');
            });
        });
        document.querySelectorAll('.slick-slide[aria-hidden="false"] a[tabindex="-1"]').forEach(function (el) {
            el.removeAttribute('tabindex');
        });
    }
    if (window.jQuery) {
        jQuery(document).on('init afterChange setPosition', '.slick-slider', fixSlick);
    }

    window.addEventListener('load', function () { fixSlick(); refresh(); });
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
