<?php

use ArchiElite\Career\Forms\CareerForm;
use Botble\Base\Forms\FieldOptions\CoreIconFieldOption;
use Botble\Base\Forms\FieldOptions\MediaImageFieldOption;
use Botble\Base\Forms\FieldOptions\NumberFieldOption;
use Botble\Base\Forms\FieldOptions\OnOffFieldOption;
use Botble\Base\Forms\FieldOptions\TextareaFieldOption;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\Fields\CoreIconField;
use Botble\Base\Forms\Fields\MediaImageField;
use Botble\Base\Forms\Fields\NumberField;
use Botble\Base\Forms\Fields\OnOffField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Shortcode\Facades\Shortcode;
use Botble\Media\Facades\RvMedia;
use Botble\Menu\Facades\Menu;
use Botble\Newsletter\Facades\Newsletter;
use Botble\Newsletter\Forms\Fronts\NewsletterForm;
use Botble\Page\Forms\PageForm;
use Botble\Portfolio\Forms\ServiceForm;
use Botble\SimpleSlider\Forms\SimpleSliderItemForm;
use Botble\SimpleSlider\Http\Requests\SimpleSliderItemRequest;
use Botble\SimpleSlider\Support\SimpleSliderSupport;
use Botble\Theme\Facades\Theme;
use Botble\Theme\Supports\ThemeSupport;
use Botble\Theme\Typography\TypographyItem;
use Illuminate\Http\Request;

register_page_template([
    'default' => __('Default'),
    'full-width' => __('Full width'),
]);

app()->booted(function (): void {
    ThemeSupport::registerSiteCopyright();
    ThemeSupport::registerSocialLinks();
    ThemeSupport::registerPreloader();
    ThemeSupport::registerToastNotification();
    ThemeSupport::registerLazyLoadImages();
    ThemeSupport::registerSiteLogoHeight(37);

    Theme::typography()
        ->registerFontFamilies([
            new TypographyItem('primary', __('Primary'), 'Satoshi-Variable'),
        ])
        ->registerFontSizes([
            new TypographyItem('h1', __('Heading 1'), 60),
            new TypographyItem('h2', __('Heading 2'), 48),
            new TypographyItem('h3', __('Heading 3'), 38),
            new TypographyItem('h4', __('Heading 4'), 31),
            new TypographyItem('h5', __('Heading 5'), 25),
            new TypographyItem('h6', __('Heading 6'), 20),
            new TypographyItem('body', __('Body'), 16),
        ]);

    if (is_plugin_active('newsletter')) {
        Newsletter::registerNewsletterPopup();

        NewsletterForm::extend(function (NewsletterForm $form) {
            return $form->formClass('newsletter-form');
        });
    }

    add_filter('cms_custom_fonts', function (array $customFonts) {
        $customFonts[] = 'Satoshi-Variable';

        return $customFonts;
    }, 120);

    add_filter('theme_preloader_versions', function (): array {
        return [
            'v2' => __('Default'),
            'v1' => __('Simplify'),
            'v3' => __('Text Động (TeamDevDesign)'),
        ];
    }, 128);

    add_filter('theme_preloader', function (string $preloader): string {
        if (theme_option('preloader_version', 'v2') === 'v3') {
            return Theme::partial('preloader-v3');
        }
        if (theme_option('preloader_version', 'v2') === 'v2') {
            return Theme::partial('preloader');
        }

        return $preloader;
    }, 128);

    register_sidebar([
        'id' => 'blog_top_sidebar',
        'name' => __('Blog top sidebar'),
        'description' => __('Add widgets to the top of the blog page.'),
    ]);

    register_sidebar([
        'id' => 'footer_primary_sidebar',
        'name' => __('Footer Primary sidebar'),
        'description' => __('Customize the footer content with this sidebar widget.'),
    ]);

    register_sidebar([
        'id' => 'footer_top_sidebar',
        'name' => __('Footer Top sidebar'),
        'description' => __('Engage visitors before they reach the footer with this widget.'),
    ]);

    register_sidebar([
        'id' => 'footer_bottom_sidebar',
        'name' => __('Footer Bottom sidebar'),
        'description' => __("Display copyright text and partner images in the lower section of your website's footer."),
    ]);

    register_sidebar([
        'id' => 'header_sidebar',
        'name' => __('Header Sidebar'),
        'description' => __('Add widgets like the logo, navigation menu, and action buttons in the header.'),
    ]);

    register_sidebar([
        'id' => 'header_top_start_sidebar',
        'name' => __('Header Top Start Sidebar'),
        'description' => __('Add widgets to the left side of the header top.'),
    ]);

    register_sidebar([
        'id' => 'header_top_end_sidebar',
        'name' => __('Header Top End Sidebar'),
        'description' => __('Add widgets to the right side of the header top.'),
    ]);

    register_sidebar([
        'id' => 'service_sidebar',
        'name' => __('Service Details Sidebar'),
        'description' => __('Add widgets to the sidebar of the service details page.'),
    ]);

    register_sidebar([
        'id' => 'project_sidebar',
        'name' => __('Project Details Sidebar'),
        'description' => __('Add widgets to the sidebar of the project details page.'),
    ]);

    register_sidebar([
        'id' => 'team_sidebar',
        'name' => __('Team Details Sidebar'),
        'description' => __('Add widgets to the sidebar of the team details page.'),
    ]);

    RvMedia::addSize('vertical_thumb', 400, 500)
        ->addSize('horizontal_thumb', 600, 338)
        ->addSize('medium', 1280, 400);

    add_filter(THEME_FRONT_BODY, function (?string $html): string {
        return $html . view(Theme::getThemeNamespace('partials.header'));
    });

    add_filter(THEME_FRONT_FOOTER, function (?string $html): string {
        return $html
            . view(Theme::getThemeNamespace('partials.footer'))
            . view(Theme::getThemeNamespace('partials.scroll-to-top'));
    });

    if (is_plugin_active('portfolio')) {
        ServiceForm::extend(function (ServiceForm $form): void {
            $form
                ->add(
                    'icon',
                    CoreIconField::class,
                    CoreIconFieldOption::make()
                        ->label(__('Icon'))
                        ->metadata()
                )
                ->add(
                    'icon_image',
                    MediaImageField::class,
                    MediaImageFieldOption::make()
                        ->label(__('Icon image'))
                        ->helperText(__('It will replace above icon if this image is present'))
                        ->metadata()
                );
        });

        // Override view shortcode projects-list với theme partial
        add_filter('projects-list-shortcode', function (string $view): string {
            return Theme::getThemeNamespace('partials.shortcodes.projects-list.index');
        });
    }

    Menu::useMenuItemIconImage();

    PageForm::extend(function (PageForm $form): void {
        if (!Theme::breadcrumb()->enabled()) {
            return;
        }

        $form
            ->add(
                'breadcrumb_enabled',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Breadcrumb enabled'))
                    ->choices([
                        true => __('Yes'),
                        false => __('No'),
                    ])
                    ->metadata()
            )
            ->add(
                'breadcrumb_background',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Breadcrumb background'))
                    ->metadata()
            );
    });

    if (is_plugin_active('simple-slider')) {
        add_filter('core_request_rules', function (array $rules, Request $request) {
            if ($request instanceof SimpleSliderItemRequest) {
                return array_merge($rules, [
                    'subtitle' => ['nullable', 'string', 'max:255'],
                    'slogan' => ['nullable', 'string', 'max:255'],
                    'primary_action_label' => ['nullable', 'string', 'max:255'],
                    'primary_action_url' => ['nullable', 'string', 'max:255'],
                    'secondary_action_label' => ['nullable', 'string', 'max:255'],
                    'secondary_action_url' => ['nullable', 'string', 'max:255'],
                    'background_image' => ['nullable', 'string'],
                ]);
            }

            return $rules;
        }, 120, 2);

        SimpleSliderSupport::registerResponsiveImageSizes();

        SimpleSliderItemForm::extend(function (SimpleSliderItemForm $form) {
            return $form
                ->addAfter(
                    'title',
                    'subtitle',
                    TextField::class,
                    TextFieldOption::make()
                        ->metadata()
                        ->label(__('Subtitle'))
                        ->toArray()
                )
                ->addAfter('subtitle', 'slogan', TextField::class, TextFieldOption::make()->metadata()->label(__('Slogan')))
                ->addOpenFieldset('primary_action_open')
                ->add(
                    'primary_action_label',
                    TextField::class,
                    TextFieldOption::make()
                        ->metadata()
                        ->label(__('Primary action label'))
                )
                ->add(
                    'primary_action_url',
                    TextField::class,
                    TextFieldOption::make()
                        ->metadata()
                        ->label(__('Primary action URL'))
                )
                ->add('primary_action_icon', CoreIconField::class, CoreIconFieldOption::make()->label(__('Primary action icon')))
                ->addCloseFieldset('primary_action_close')
                ->addOpenFieldset('secondary_action_open')
                ->add(
                    'secondary_action_label',
                    TextField::class,
                    TextFieldOption::make()
                        ->metadata()
                        ->label(__('Secondary action label'))
                )
                ->add(
                    'secondary_action_url',
                    TextField::class,
                    TextFieldOption::make()
                        ->metadata()
                        ->label(__('Secondary action URL'))
                )
                ->add('secondary_action_icon', CoreIconField::class, CoreIconFieldOption::make()->label(__('Secondary action icon')))
                ->addCloseFieldset('secondary_action_close')
                ->add('background_image', MediaImageField::class, MediaImageFieldOption::make()->metadata()->label(__('Background image')));
        });
    }

    add_filter('ads_locations', function (array $locations) {
        return [
            ...$locations,
            'main_content_before' => __('Main Content (before)'),
            'main_content_after' => __('Main Content (after)'),
            'footer_before' => __('Footer (before)'),
            'footer_after' => __('Footer (after)'),
            'post_list_before' => __('Post List (before)'),
            'post_list_after' => __('Post List (after)'),
            'post_before' => __('Post Detail (before)'),
            'post_after' => __('Post Detail (after)'),
            'project_before' => __('Project Detail (before)'),
            'project_after' => __('Project Detail (after)'),
            'service_before' => __('Service Detail (before)'),
            'service_after' => __('Service Detail (after)'),
            'team_before' => __('Team Detail (before)'),
            'team_after' => __('Team Detail (after)'),
        ];
    }, 128);

    if (is_plugin_active('career')) {
        CareerForm::extend(function (CareerForm $form) {
            return $form
                ->addAfter(
                    'status',
                    'image',
                    MediaImageField::class,
                    MediaImageFieldOption::make()
                        ->label(__('Image'))
                        ->metadata()
                )
                ->addAfter(
                    'image',
                    'icon',
                    CoreIconField::class,
                    CoreIconFieldOption::make()
                        ->label(__('Icon'))
                        ->metadata()
                )
                ->addAfter(
                    'icon',
                    'icon_image',
                    MediaImageField::class,
                    MediaImageFieldOption::make()
                        ->label(__('Icon Image (It will override icon above if set)'))
                        ->metadata()
                )
                ->addAfter(
                    'salary',
                    'apply_url',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Apply URL'))
                        ->metadata()
                );
        });
    }

    add_filter('cms_installer_themes', function () {
        return [
            'home1' => [
                'label' => 'Home 1',
                'image' => Theme::asset()->url('images/demos/home-1.png'),
            ],
            'home2' => [
                'label' => 'Home 2',
                'image' => Theme::asset()->url('images/demos/home-2.png'),
            ],
            'home3' => [
                'label' => 'Home 3',
                'image' => Theme::asset()->url('images/demos/home-3.png'),
            ],
            'home4' => [
                'label' => 'Home 4',
                'image' => Theme::asset()->url('images/demos/home-4.png'),
            ],
            'home5' => [
                'label' => 'Home 5',
                'image' => Theme::asset()->url('images/demos/home-5.png'),
            ],
        ];
    }, 10);
});
