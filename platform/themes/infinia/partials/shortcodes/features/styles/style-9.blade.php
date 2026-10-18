@php
    $bgColor = $shortcode->background_color;
    $bgColor = $bgColor === 'transparent' ? null : $bgColor;
@endphp

<section {!! $shortcode->htmlAttributes() !!} class="section-feature-13 border-bottom border-top bg-1 section-padding shortcode-features shortcode-features-style-9"
    @style([
        "background-color: $bgColor !important" => $bgColor,
    ])
>
    <div class="text-center container">
        @if ($subtitle = $shortcode->subtitle)
            <div class="d-flex align-items-center justify-content-center bg-primary-soft border border-2 border-white d-inline-flex rounded-pill px-4 py-2" data-aos="zoom-in" data-aos-delay="50">
                <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true" />
                <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
            </div>
        @endif

        @if ($title = $shortcode->title)
            <{{ $titleTag = infinia_title_tag($shortcode, 'h5') }} class="ds-5 mb-3 mt-4">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
        @endif

        @if ($description = $shortcode->description)
            <p class="text-500">{!! BaseHelper::clean($description) !!}</p>
        @endif

        @php
            $image = $shortcode->image;
            $image1 = $shortcode->image_1;
        @endphp

        @if($image || $image1)
            <div class="container mt-8">
                <div class="d-flex">
                    @if ($image)
                        <div class="zoom-img rounded-3 me-2">
                            {{ RvMedia::image($image, infinia_image_alt($shortcode)) }}
                        </div>
                    @endif

                    @if ($image1)
                        <div class="zoom-img rounded-3 ms-2">
                            {{ RvMedia::image($image1) }}
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</section>
