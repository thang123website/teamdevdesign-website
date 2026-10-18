<?php

use Botble\Base\Facades\BaseHelper;
use Botble\Shortcode\View\View;
use Botble\Theme\Theme;

return [
    'inherit' => null,

    'events' => [
        'beforeRenderTheme' => function (Theme $theme): void {
            $theme->addHtmlAttributes(['data-bs-theme' => theme_option('default_theme_mode', 'system')]);

            $version = get_cms_version();

            if (BaseHelper::isRtlEnabled()) {
                $theme->asset()->usePath()->add('bootstrap', 'css/vendors/bootstrap.rtl.min.css');
            } else {
                $theme->asset()->usePath()->add('bootstrap', 'css/vendors/bootstrap.min.css');
            }

            $theme->asset()->usePath()->add('swiper-bundle', 'css/vendors/swiper-bundle.min.css');
            $theme->asset()->usePath()->add('odometer', 'css/vendors/odometer.css');
            $theme->asset()->usePath()->add('magnific-popup-css', 'css/vendors/magnific-popup.css');
            $theme->asset()->usePath()->add('bootstrap-icons', 'fonts/bootstrap-icons/bootstrap-icons.min.css');
            $theme->asset()->usePath()->add('slick-css', 'css/vendors/slick.min.css');

            if (theme_option('tp_primary_font') === 'Satoshi-Variable') {
                $theme->asset()->usePath()->add('satoshi', 'fonts/satoshi/satoshi.css');
            }

            $theme->asset()->usePath()->add('main', 'css/main.css', version: $version);

            $theme->asset()->usePath()->add('theme', 'css/theme.css', version: $version);

            if (BaseHelper::isRtlEnabled()) {
                $theme->asset()->usePath()->add('theme-rtl', 'css/rtl.css', version: $version);
            }

            $theme->asset()->container('footer')->usePath()->add('jquery', 'js/vendors/jquery-3.7.1.min.js');
            $theme->asset()->container('footer')->usePath()->add('bootstrap', 'js/vendors/bootstrap.bundle.min.js');
            $theme->asset()->container('footer')->usePath()->add('swiper-bundle', 'js/vendors/swiper-bundle.min.js');
            $theme->asset()->container('footer')->usePath()->add('slick-js', 'js/vendors/slick.min.js');
            $theme->asset()->container('footer')->usePath()->add('jquery.maginific-popup', 'js/vendors/jquery.magnific-popup.min.js');
            $theme->asset()->container('footer')->usePath()->add('imagesloaded', 'js/vendors/imagesloaded.pkgd.min.js');
            $theme->asset()->container('footer')->usePath()->add('jquery.appear', 'js/vendors/jquery.appear.js');
            $theme->asset()->container('footer')->usePath()->add('jquery.odometer', 'js/vendors/jquery.odometer.min.js');

            $theme->asset()->container('footer')->usePath()->add('bouncing-blob', 'js/vendors/bouncing-blob.js');
            $theme->asset()->container('footer')->usePath()->add('isotope-js', 'js/vendors/isotope.pkgd.min.js');
            $theme->asset()->container('footer')->usePath()->add('main', 'js/main.js', version: $version);
            $theme->asset()->container('footer')->usePath()->add('theme', 'js/theme.js', version: $version);

            if (theme_option('animation_enabled', true) && ! BaseHelper::isRtlEnabled()) {
                $theme->asset()->usePath()->add('aos', 'css/vendors/aos.css');
                // Hiệu năng: bỏ gsap/ScrollTrigger/gsap-custom (không template nào dùng class hiệu ứng của chúng) và wow.js.
                $theme->asset()->container('footer')->usePath()->add('aos', 'js/vendors/aos.js');
            }

            if (function_exists('shortcode')) {
                $theme->composer(
                    [
                        'page',
                        'post',
                        'portfolio.service',
                        'portfolio.project',
                        'teams.team',
                    ],
                    function (View $view): void {
                        $view->withShortcodes();
                    }
                );
            }
        },
    ],
];
