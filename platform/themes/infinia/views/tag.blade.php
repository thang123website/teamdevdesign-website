@php
    $displayBlogTopSidebar = false;
    // SEO: trang tag/tìm kiếm thường mỏng & trùng nội dung => không index nhưng vẫn cho bot đi theo link.
    SeoHelper::meta()->addMeta('robots', 'noindex, follow');
@endphp

@include(Theme::getThemeNamespace('views.loop'))
