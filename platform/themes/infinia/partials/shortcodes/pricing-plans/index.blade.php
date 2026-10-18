@php
    $style = $shortcode->style;

    $style = in_array($style, range(1, 4)) ? $style : 1;
@endphp

@include(Theme::getThemeNamespace("partials.shortcodes.pricing-plans.styles.style-$style"))
