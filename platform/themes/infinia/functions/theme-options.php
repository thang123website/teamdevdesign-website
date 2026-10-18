<?php

use Botble\Theme\Events\RenderingThemeOptionSettings;
use Botble\Theme\Facades\Theme;
use Botble\Theme\ThemeOption\Fields\ColorField;
use Botble\Theme\ThemeOption\Fields\MediaImageField;
use Botble\Theme\ThemeOption\Fields\RadioField;
use Botble\Theme\ThemeOption\Fields\SelectField;
use Botble\Theme\ThemeOption\Fields\TextareaField;
use Botble\Theme\ThemeOption\Fields\ToggleField;
use Botble\Theme\ThemeOption\Fields\UiSelectorField;
use Botble\Theme\ThemeOption\ThemeOptionSection;

app('events')->listen(RenderingThemeOptionSettings::class, function (): void {
    theme_option()
        ->setSection([
            'title' => __('Header'),
            'id' => 'opt-text-subsection-header',
            'subsection' => true,
            'icon' => 'ti ti-layout-navbar',
            'fields' => [
                ToggleField::make()
                    ->name('sticky_header_enabled')
                    ->label(__('Enable sticky header'))
                    ->defaultValue(true),
                ToggleField::make()
                    ->label(__('Display header top?'))
                    ->id('display_header_top')
                    ->defaultValue(true)
                    ->name('display_header_top'),
                ColorField::make()
                    ->defaultValue('#000000')
                    ->label(__('Header top text color'))
                    ->id('header_top_text_color')
                    ->name('header_top_text_color'),
                ColorField::make()
                    ->defaultValue('#f5eeff')
                    ->label(__('Header top background color'))
                    ->id('header_top_background_color')
                    ->name('header_top_background_color'),
                SelectField::make()
                    ->label(__('Header layout'))
                    ->id('header_layout')
                    ->name('header_layout')
                    ->defaultValue('container')
                    ->options([
                        'full-width' => __('Full Width'),
                        'container' => __('Container'),
                    ]),
            ],
        ])
        ->setSection([
            'title' => __('Footer'),
            'id' => 'opt-text-subsection-footer',
            'subsection' => true,
            'icon' => 'ti ti-layout-bottombar',
            'fields' => [
                ColorField::make()
                    ->name('footer_background_color')
                    ->defaultValue('#111827')
                    ->label(__('Background color')),
                ColorField::make()
                    ->name('footer_border_color')
                    ->defaultValue('#ffffff')
                    ->label(__('Border color')),
                ColorField::make()
                    ->name('footer_heading_color')
                    ->defaultValue('#ffffff')
                    ->label(__('Text heading color')),
                ColorField::make()
                    ->name('footer_text_color')
                    ->defaultValue('#ffffff')
                    ->label(__('Text color')),
                MediaImageField::make()
                    ->name('footer_background_image')
                    ->label(__('Background image')),
            ],
        ])
        ->setSection(
            ThemeOptionSection::make('styles')
                ->title(__('Styles'))
                ->icon('ti ti-palette')
                ->priority(1)
                ->fields([
                    RadioField::make()
                        ->label(__('Default theme mode'))
                        ->name('default_theme_mode')
                        ->defaultValue('system')
                        ->options([
                            'system' => __('System'),
                            'light' => __('Light'),
                            'dark' => __('Dark'),
                        ]),
                    RadioField::make()
                        ->label(__('Hide theme mode switcher'))
                        ->name('hide_theme_mode_switcher')
                        ->defaultValue('no')
                        ->options([
                            'no' => __('No'),
                            'yes' => __('Yes'),
                        ]),
                    ToggleField::make()
                        ->sectionId('animation_enabled')
                        ->name('animation_enabled')
                        ->label(__('Enable animation?'))
                        ->defaultValue(true),
                    ColorField::make()
                        ->sectionId('styles')
                        ->name('primary_color')
                        ->label(__('Primary color'))
                        ->defaultValue('#6e4ef2'),
                    ColorField::make()
                        ->sectionId('styles')
                        ->name('primary_color_dark')
                        ->label(__('Primary color dark'))
                        ->defaultValue('#6342ec'),
                    ColorField::make()
                        ->sectionId('styles')
                        ->name('primary_color_dark_light')
                        ->label(__('Primary color dark light'))
                        ->defaultValue('#866dee'),
                    ColorField::make()
                        ->sectionId('styles')
                        ->name('primary_color_dark_soft')
                        ->label(__('Primary color dark soft'))
                        ->defaultValue('#271c52'),
                    ColorField::make()
                        ->sectionId('styles')
                        ->name('primary_gradient_from')
                        ->label(__('Primary gradient from'))
                        ->defaultValue('#6d4df2'),
                    ColorField::make()
                        ->sectionId('styles')
                        ->name('primary_gradient_to')
                        ->label(__('Primary gradient to'))
                        ->defaultValue('#8c71ff'),
                    ColorField::make()
                        ->defaultValue('#ffffff')
                        ->sectionId('select_text_color')
                        ->name('select_text_color')
                        ->label(__('Select text color')),
                    ToggleField::make()
                        ->name('back_to_top_enabled')
                        ->label(__('Enable back to top button'))
                        ->defaultValue(true),
                ])
        )
        ->setField(
            MediaImageField::make()
                ->name('404_image')
                ->sectionId('opt-text-subsection-general')
                ->label(__('404 Image'))
        )
        ->setField(
            MediaImageField::make()
                ->name('breadcrumb_background_image')
                ->sectionId('opt-text-subsection-breadcrumb')
                ->label(__('Background image'))
        )
        ->setField(
            ColorField::make()
                ->name('breadcrumb_background_color')
                ->sectionId('opt-text-subsection-breadcrumb')
                ->label(__('Background color'))
        )
        ->setField(
            MediaImageField::make()
                ->sectionId('opt-text-subsection-general')
                ->id('preloader_image')
                ->name('preloader_image')
                ->label(__('Preloader image'))
                ->helperText(__('Only support preloader default.'))
        )
        ->setField(
            UiSelectorField::make()
                ->sectionId('opt-text-subsection-blog')
                ->name('blog_list_style')
                ->label(__('Blog list style'))
                ->options([
                    'style-1' => [
                        'label' => __('Style :number', ['number' => 1]),
                        'image' => Theme::asset()->url('images/blog-styles/style-1.png'),
                    ],
                    'style-2' => [
                        'label' => __('Style :number', ['number' => 2]),
                        'image' => Theme::asset()->url('images/blog-styles/style-2.png'),
                    ],
                ])
                ->aspectRatio(UiSelectorField::RATIO_4_3)
                ->numberItemsPerRow(2)
                ->defaultValue('style-1')
        )
        ->setField(
            TextareaField::make()
                ->sectionId('opt-text-subsection-blog')
                ->name('suggest_keywords')
                ->label(__('Suggest keywords'))
                ->helperText(__('Separate by comma'))
        )
        ->setField(
            SelectField::make()
                ->sectionId('opt-text-subsection-blog')
                ->name('toc_headings')
                ->label(__('Thẻ H trong Mục lục (TOC)'))
                ->options([
                    'h2, h3, h4, h5, h6' => __('Tất cả (H2 -> H6)'),
                    'h2, h3, h4'         => __('H2, H3, H4'),
                    'h2, h3'             => __('Chỉ H2, H3'),
                    'h2'                 => __('Chỉ H2'),
                ])
                ->defaultValue('h2, h3, h4')
                ->helperText(__('Chọn cấp độ thẻ Heading (Tiêu đề) để tạo Mục lục tự động cho bài viết.'))
        )
        ->when(is_plugin_active('portfolio'), function () {
            theme_option()
                ->setSection([
                    'title' => __('Portfolio'),
                    'id' => 'opt-text-subsection-portfolio',
                    'subsection' => true,
                    'icon' => 'ti ti-briefcase',
                    'fields' => [
                        UiSelectorField::make()
                            ->id('service-style')
                            ->name('service_style')
                            ->label(__('Service style'))
                            ->options([
                                'style-1' => [
                                    'label' => __('Style :number', ['number' => 1]),
                                    'image' => Theme::asset()->url('images/service-styles/style-1.png'),
                                ],
                                'style-2' => [
                                    'label' => __('Style :number', ['number' => 2]),
                                    'image' => Theme::asset()->url('images/service-styles/style-2.png'),
                                ],
                            ])
                            ->aspectRatio(UiSelectorField::RATIO_4_3)
                            ->numberItemsPerRow(2)
                            ->defaultValue('style-1'),
                    ],
                ]);
        })
        ->when(is_plugin_active('team'), function () {
            theme_option()
                ->setSection([
                    'title' => __('Team'),
                    'id' => 'opt-text-subsection-team',
                    'subsection' => true,
                    'icon' => 'ti ti-users-group',
                    'fields' => [
                        UiSelectorField::make()
                            ->id('team-style')
                            ->name('team_style')
                            ->label(__('Team style'))
                            ->options([
                                'style-1' => [
                                    'label' => __('Style :number', ['number' => 1]),
                                    'image' => Theme::asset()->url('images/team-styles/style-1.png'),
                                ],
                                'style-2' => [
                                    'label' => __('Style :number', ['number' => 2]),
                                    'image' => Theme::asset()->url('images/team-styles/style-2.png'),
                                ],
                            ])
                            ->aspectRatio(UiSelectorField::RATIO_4_3)
                            ->numberItemsPerRow(2)
                            ->defaultValue('style-1'),
                    ],
                ]);
        })
        ->setField([
            'id' => 'logo_dark',
            'section_id' => 'opt-text-subsection-logo',
            'type' => 'mediaImage',
            'label' => __('Logo dark'),
            'attributes' => [
                'name' => 'logo_dark',
                'value' => null,
                'attributes' => ['allow_thumb' => false],
            ],
            'priority' => 99,
        ]);
});
