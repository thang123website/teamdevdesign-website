<section {!! $shortcode->htmlAttributes() !!} class="shortcode-features shortcode-features-style-10 bg-linear-3 head-1 pt-110">
    <div class="container">
        <div class="d-flex flex-lg-row flex-column align-items-center">
            <div class="mb-lg-0 mb-8">
                @if ($title = $shortcode->title)
                    <{{ $titleTag = infinia_title_tag($shortcode, 'h3') }} class="ds-3 fw-regular">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
                @endif

                @if ($description = $shortcode->description)
                    <div class="d-flex mt-3 justify-content-start align-items-center">
                        <div class="avt-hero icon-shape icon-xxl border border-5 border-white-keep bg-primary-soft rounded-circle">
                            <img class="" src="{{ Theme::asset()->url('images/icons/fire-primary.png') }}" alt="fire">
                        </div>
                        <strong class="d-block fs-6 text-500">{!! BaseHelper::clean($description) !!}</strong>
                    </div>
                @endif
            </div>

            @if ($image = $shortcode->image)
                <div class="ms-auto rounded-2 border border-5 border-white">
                    {{ RvMedia::image($image, infinia_image_alt($shortcode), attributes: ['class' => 'rounded-2']) }}
                </div>
            @endif
        </div>
    </div>
</section>
