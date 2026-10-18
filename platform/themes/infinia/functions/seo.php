<?php

/**
 * Các tiện ích SEO cho theme Infinia.
 *
 * - infinia_title_tag() / infinia_clean_title(): chọn thẻ heading cho tiêu đề shortcode.
 *   Nếu title có chèn <h1> (vd: "Giải pháp <b><h1>Thiết kế Website</h1></b>") thì thẻ bao ngoài
 *   tự thành H1 và các thẻ heading lồng bên trong bị bỏ đi => không còn H1 nằm trong H2.
 * - Thêm field "Thẻ tiêu đề (SEO)" vào mọi form shortcode có field "title".
 * - In schema Organization/ProfessionalService (JSON-LD) ở trang chủ.
 */

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Media\Facades\RvMedia;
use Botble\Theme\Events\RenderingThemeOptionSettings;
use Botble\Theme\Facades\Theme;
use Botble\Theme\ThemeOption\Fields\TextareaField;
use Botble\Theme\ThemeOption\Fields\TextField;
use Theme\Infinia\Forms\ShortcodeForm;

if (! function_exists('infinia_title_tag')) {
    function infinia_title_tag(mixed $shortcode, string $default = 'h2'): string
    {
        $tag = is_object($shortcode) ? strtolower((string) $shortcode->title_tag) : '';

        if (in_array($tag, ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div'], true)) {
            return $tag;
        }

        $title = is_object($shortcode) ? (string) $shortcode->title : '';

        if (preg_match('/<h1[\s>]/i', html_entity_decode($title))) {
            return 'h1';
        }

        return $default;
    }
}

if (! function_exists('infinia_clean_title')) {
    function infinia_clean_title(?string $title): string
    {
        $title = html_entity_decode((string) $title);

        // Bỏ thẻ heading lồng bên trong tiêu đề, giữ lại chữ.
        $title = preg_replace('/<\/?h[1-6][^>]*>/i', '', $title);

        return (string) BaseHelper::clean($title);
    }
}

if (! function_exists('infinia_image_alt')) {
    /**
     * Alt ảnh có ý nghĩa: lấy theo tiêu đề khối shortcode thay cho chữ "Hình ảnh" chung chung.
     */
    function infinia_image_alt(mixed $shortcode, ?string $fallback = null): string
    {
        $title = is_object($shortcode) ? (string) $shortcode->title : '';
        $title = trim(preg_replace('/\s+/u', ' ', strip_tags(html_entity_decode($title))));

        return $title ?: ($fallback ?: (string) theme_option('site_title'));
    }
}

app()->booted(function (): void {
    if (! class_exists(ShortcodeForm::class)) {
        return;
    }

    ShortcodeForm::beforeRendering(function ($form) {
        if (! $form->has('title') || $form->has('title_tag')) {
            return $form;
        }

        $form->addAfter(
            'title',
            'title_tag',
            SelectField::class,
            SelectFieldOption::make()
                ->label('Thẻ tiêu đề (SEO)')
                ->choices([
                    '' => 'Mặc định của giao diện',
                    'h1' => 'H1 - tiêu đề chính của trang (mỗi trang chỉ 1 khối)',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'div' => 'Không phải heading',
                ])
                ->helperText('Chọn H1 cho khối đầu tiên/khối chính của trang. Không gõ thẻ <h1> vào tiêu đề nữa.')
        );

        return $form;
    });
});

app('events')->listen(RenderingThemeOptionSettings::class, function (): void {
    theme_option()->setSection([
        'title' => 'SEO doanh nghiệp (Schema)',
        'id' => 'opt-text-subsection-seo-business',
        'subsection' => true,
        'icon' => 'ti ti-building-store',
        'fields' => [
            TextField::make()
                ->name('seo_business_name')
                ->label('Tên doanh nghiệp')
                ->defaultValue('TeamDevDesign'),
            TextField::make()
                ->name('seo_business_phone')
                ->label('Số điện thoại (định dạng +84...)'),
            TextField::make()
                ->name('seo_business_email')
                ->label('Email'),
            TextField::make()
                ->name('seo_business_street')
                ->label('Địa chỉ (số nhà, đường, phường)'),
            TextField::make()
                ->name('seo_business_locality')
                ->label('Quận/Huyện, Tỉnh/Thành')
                ->defaultValue('Bình Thạnh, Hồ Chí Minh'),
            TextareaField::make()
                ->name('seo_business_same_as')
                ->label('Link mạng xã hội (mỗi dòng 1 link: Facebook, Zalo OA, TikTok, YouTube...)'),
        ],
    ]);
});

// Hiệu năng: mở kết nối sớm tới Google Fonts (font Roboto chặn render).
add_filter('theme_front_meta', function (?string $html): string {
    return '<link rel="preconnect" href="https://fonts.googleapis.com">'
        . '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>'
        . $html;
}, 0);

add_filter(THEME_FRONT_HEADER, function (?string $html): ?string {
    if (! request()->is('/')) {
        return $html;
    }

    $siteUrl = rtrim(url('/'), '/');
    $logo = theme_option('logo');

    $schema = array_filter([
        '@context' => 'https://schema.org',
        '@type' => 'ProfessionalService',
        '@id' => $siteUrl . '/#organization',
        'name' => theme_option('seo_business_name') ?: Theme::getSiteTitle(),
        'url' => $siteUrl,
        'logo' => $logo ? RvMedia::getImageUrl($logo) : null,
        'image' => $logo ? RvMedia::getImageUrl($logo) : null,
        'description' => theme_option('seo_description'),
        'telephone' => theme_option('seo_business_phone') ?: theme_option('hotline'),
        'email' => theme_option('seo_business_email'),
        'priceRange' => '$$',
        'areaServed' => ['@type' => 'Country', 'name' => 'Việt Nam'],
        'address' => array_filter([
            '@type' => 'PostalAddress',
            'streetAddress' => theme_option('seo_business_street'),
            'addressLocality' => theme_option('seo_business_locality'),
            'addressCountry' => 'VN',
        ]),
        'sameAs' => array_values(array_filter(array_map('trim', preg_split('/\R/', (string) theme_option('seo_business_same_as'))))),
    ]);

    return $html . '<script type="application/ld+json">'
        . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG)
        . '</script>';
}, 30);
