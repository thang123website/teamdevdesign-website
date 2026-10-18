@php
    $backgroundColor = $shortcode->background_color;
    $backgroundColor = $backgroundColor === 'transparent' ? null : $backgroundColor;
@endphp

<section {!! $shortcode->htmlAttributes() !!}  class="shortcode-call-to-action shortcode-call-to-action-style-1 container pt-120 pb-120">
    <div class="row">
        <div class="col-10 mx-auto">
            <div class="banner bg-primary-light rounded-3 position-relative px-8 py-lg-0 py-8"
                @style(["background-color: $backgroundColor !important;" => $backgroundColor])
            >
                <div class="d-flex flex-column flex-lg-row align-items-center justify-content-between position-relative z-1">
                    @if ($title = $shortcode->title)
                        <strong class="d-block fs-6 fw-regular ds-6 text-white">{!! BaseHelper::clean($title) !!}</strong>
                    @endif

                    @if ($image = $shortcode->image)
                        {{ RvMedia::image($image, infinia_image_alt($shortcode)) }}
                    @endif

                    @if (($primaryActionLabel = $shortcode->primary_action_label) && ($primaryActionUrl = $shortcode->primary_action_url))
                        <a href="{{ $primaryActionUrl }}" class="btn btn-success d-block mt-3 mt-lg-0">
                            {!! BaseHelper::clean($primaryActionLabel) !!}

                            @if ($primaryActionIcon = $shortcode->primary_action_icon)
                                <x-core::icon class="ms-2" :name="$primaryActionIcon"/>
                            @endif
                        </a>
                    @endif
                </div>
                <img class="position-absolute top-0 end-0 z-0" src="{{ Theme::asset()->url('images/shapes/bg-line-1.png') }}" alt="" aria-hidden="true">
                <img class="position-absolute bottom-0 start-0 z-0" src="{{ Theme::asset()->url('images/shapes/bg-line-2.png') }}" alt="line 2">
                <img class="flickering position-absolute top-0 end-50 me-5 mt-3 z-0" src="{{ Theme::asset()->url('images/shapes/shine-effect.png') }}" alt="" aria-hidden="true">
                <img class="flickering position-absolute bottom-0 start-50 ms-md-10 mb-3 ps-10 z-0" src="{{ Theme::asset()->url('images/shapes/shine-effect-1.png') }}" alt="shine effect 2">
            </div>
        </div>
    </div>
</section>
