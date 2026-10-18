@php
    $serviceSidebar = dynamic_sidebar('service_sidebar');
    $style = request()->query('style') ?: theme_option('service_style', 'style-1');
    $style = in_array($style, ['style-1', 'style-2']) ? $style : 'style-1';

    // SEO: tiêu đề trang dịch vụ là H1 duy nhất (trước đây là H3 → trang không có H1).
    Theme::set('pageHeadingTag', 'h1');
    Theme::set('pageHeadingText', $service->name);

    // SEO: Schema.org Service (JSON-LD) giúp Google hiểu đây là trang dịch vụ của doanh nghiệp.
    $siteName = theme_option('site_title') ?: 'TeamDevDesign';
    $serviceSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        '@id' => $service->url . '#service',
        'name' => $service->name,
        'description' => strip_tags((string) $service->description),
        'url' => $service->url,
        'serviceType' => $service->category?->name ?: $service->name,
        'areaServed' => ['@type' => 'Country', 'name' => 'Việt Nam'],
        'availableLanguage' => ['vi', 'en'],
        'provider' => array_filter([
            '@type' => 'Organization',
            '@id' => url('/') . '#organization',
            'name' => $siteName,
            'url' => url('/'),
            'logo' => theme_option('logo') ? RvMedia::getImageUrl(theme_option('logo')) : null,
            'telephone' => theme_option('hotline') ?: '+84898614962',
        ]),
    ];

    if ($service->image) {
        $serviceSchema['image'] = RvMedia::getImageUrl($service->image);
    }
@endphp

<script type="application/ld+json">{!! json_encode($serviceSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) !!}</script>

{!! apply_filters('ads_render', null, 'service_before', ['class' => 'my-2 text-center']) !!}

@include(Theme::getThemeNamespace('views.portfolio.service-styles.' . $style))

{!! apply_filters('ads_render', null, 'service_after', ['class' => 'my-2 text-center']) !!}
