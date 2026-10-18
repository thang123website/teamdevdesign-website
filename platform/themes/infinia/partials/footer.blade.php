@php
    $footerPrimarySidebar = dynamic_sidebar('footer_primary_sidebar');
    $footerBottomSidebar = dynamic_sidebar('footer_bottom_sidebar');

    $backgroundColor = theme_option('footer_background_color', '#111827');
    $textColor = theme_option('footer_text_color', theme_option('text_color', '#ffffff'));
    $headingColor = theme_option('footer_heading_color', '#ffffff');
    $backgroundImage = theme_option('footer_background_image');
    $borderColor = theme_option('footer_border_color', '#ffffff');
    $backgroundImage = $backgroundImage ? RvMedia::getImageUrl($backgroundImage) : null;
@endphp

{!! dynamic_sidebar('footer_top_sidebar') !!}

{!! apply_filters('ads_render', null, 'footer_before', ['class' => 'my-2 text-center']) !!}

@if($footerPrimarySidebar || $footerBottomSidebar)
    <footer class="footer"
        @style([
        "--footer-background-color: $backgroundColor" => $backgroundColor,
        "--footer-heading-color: $headingColor" => $headingColor,
        "--footer-text-color: $textColor" => $textColor,
        "--footer-border-color: $borderColor" => $borderColor,
        "--footer-background-image: url($backgroundImage)" => $backgroundImage,
    ])
    >
        <div class="section-footer position-relative overflow-hidden">

            @if($footerPrimarySidebar)
                <div class="tp-footer-main-area tp-footer-border">
                    <div class="container-fluid">
                        <div class="container position-relative z-2">
                            <div class="row py-90">
                                {!! $footerPrimarySidebar !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="container-fluid">
                <div class="container position-relative z-2">
                    {!! $footerBottomSidebar !!}
                </div>
            </div>

            @if ($backgroundImage)
                <div class="position-absolute top-0 start-50 translate-middle-x z-0">
                    <img src="{{ $backgroundImage }}" alt="background image">
                </div>
            @endif

            @if ($backgroundColor && $backgroundColor !== 'transparent')
                <div class="position-absolute top-0 start-0 z-0">
                    <img src="{{ Theme::asset()->url('images/decorations/ellipse-left.png') }}" alt="" aria-hidden="true">
                </div>
                <div class="position-absolute top-0 end-0 z-0">
                    <img src="{{ Theme::asset()->url('images/decorations/ellipse-right.png') }}" alt="" aria-hidden="true">
                </div>
            @endif
        </div>
    </footer>
@endif

{!! apply_filters('ads_render', null, 'footer_after', ['class' => 'my-2 text-center']) !!}
