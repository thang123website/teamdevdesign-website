<section {!! $shortcode->htmlAttributes() !!} class="shortcode-our-history shortcode-our-history-style-4 section-cta-14 position-relative section-padding">
    <div class="container position-relative z-2">
        <div class="text-center">
            @if ($subtitle = $shortcode->subtitle)
                <div class="d-flex align-items-center justify-content-center bg-primary-soft border border-2 border-white d-inline-flex rounded-pill px-4 py-2" data-aos="zoom-in" data-aos-delay="50">
                    <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                    <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
                </div>
            @endif

            @if ($title = $shortcode->title)
                <{{ $titleTag = infinia_title_tag($shortcode, 'h5') }} class="ds-5 my-3 fw-regular">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
            @endif
        </div>
        <div class="row mt-8">
            <div class="col-10 mx-auto">
                <div class="position-relative">
                    <div class="zoom-img rounded-4 border-5 border-white border position-relative z-2">
                        @if ($image = $shortcode->image)
                            {{ RvMedia::image($image, infinia_image_alt($shortcode), attributes: ['class' => 'rounded-3']) }}

                        @endif

                        @if(($floatingButtonLabel = $shortcode->floating_action_label) && ($floatingButtonUrl = $shortcode->floating_action_url))
                                <div class="position-absolute top-50 start-50 translate-middle z-2">
                                    <a href="{{ $floatingButtonUrl }}" class="d-inline-flex align-items-center rounded-4 text-nowrap backdrop-filter px-3 py-2 popup-video hover-up me-3 shadow-1">
                                        @if($floatingActionIcon = $shortcode->floating_action_icon)
                                            <span class="backdrop-filter me-2 icon-shape icon-md rounded-circle">
                                            <x-core::icon :name="$floatingActionIcon" />
                                        </span>
                                        @endif

                                        <span class="fw-bold fs-7 text-900">
                                        {!! BaseHelper::clean($floatingButtonLabel) !!}
                                    </span>
                                    </a>
                                </div>
                            @endif
                    </div>
                    <div class="position-absolute top-100 start-0 translate-middle z-1">
                        <img class="alltuchtopdown" src="{{ Theme::asset()->url('images/shapes/vector-2.png') }}" alt="" aria-hidden="true">
                    </div>
                    <div class="vector-2 position-absolute z-2">
                        <img class="alltuchtopdown" src="{{ Theme::asset()->url('images/shapes/vector.png') }}" alt="" aria-hidden="true">
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($backgroundImage = $shortcode->background_image)
        <div class="position-absolute top-0 start-50 translate-middle-x z-0">
            {{ RvMedia::image($backgroundImage, __('Background image')) }}
        </div>
    @endif

    <div class="rotate-center ellipse-rotate-success position-absolute z-1"></div>
    <div class="rotate-center-rev ellipse-rotate-primary position-absolute z-1"></div>
</section>
