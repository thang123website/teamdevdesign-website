<div {!! $shortcode->htmlAttributes() !!}  class="shortcode-call-to-action shortcode-call-to-action-style-2 container pt-120 pb-120">
    <div class="row">
        <div class="col-10 mx-auto">
            <div class="banner bg-primary-light rounded-3 position-relative p-8">
                <div class="d-flex flex-column flex-lg-row align-items-end position-relative z-1">
                    <div class="me-auto">
                        @if ($title = $shortcode->title)
                            <strong class="d-block fs-6 fw-regular ds-6 text-white">{!! BaseHelper::clean($title) !!}</strong>
                        @endif

                        @if (($primaryActionLabel = $shortcode->primary_action_label) && ($primaryActionUrl = $shortcode->primary_action_url))
                            <a href="{{ $primaryActionUrl }}" class="btn btn-success d-inline-block mt-3">
                                {!! BaseHelper::clean($primaryActionLabel) !!}

                                @if ($primaryActionIcon = $shortcode->primary_action_icon)
                                    <x-core::icon class="ms-2" :name="$primaryActionIcon"/>
                                @endif
                            </a>
                        @endif
                    </div>

                    @if ($image = $shortcode->image)
                        <div class="position-relative mt-lg-0 mt-8">
                            {{ RvMedia::image($image, infinia_image_alt($shortcode), attributes: ['class' => 'rounded-2']) }}
                            <div class="position-absolute rectangle-banner3 bg-primary rounded-2"></div>
                        </div>
                    @endif
                </div>
                <img class="position-absolute top-0 end-0 z-0" src="{{ Theme::asset()->url('images/shapes/bg-line-1.png') }}" alt="line 1">
                <img class="position-absolute bottom-0 start-0 z-0" src="{{ Theme::asset()->url('images/shapes/bg-line-2.png') }}" alt="line 2">
            </div>
        </div>
    </div>
</div>
