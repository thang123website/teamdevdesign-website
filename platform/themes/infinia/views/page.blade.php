@php
    Theme::set('breadcrumbEnabled', $page->getMetaData('breadcrumb_enabled', true));
    $isBlogPage = $page->id == get_blog_page_id();
    $htmlContent = $isBlogPage ? '' : Html::tag('div', BaseHelper::clean($page->content), ['class' => 'ck-content'])->toHtml();
@endphp

{!! apply_filters(PAGE_FILTER_FRONT_PAGE_CONTENT, $htmlContent, $page) !!}
