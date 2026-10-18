<section {!! $shortcode->htmlAttributes() !!} class="shortcode-instruction-steps shortcode-instruction-steps-style-2 howitwork-2 section-padding position-relative fix">
    <div class="container position-relative z-1">
        <div class="text-center mb-8">
            @if ($subtitle = $shortcode->subtitle)
                <div class="d-flex align-items-center position-relative z-2 justify-content-center bg-primary-soft d-inline-flex rounded-pill border border-2 border-white px-3 py-1">
                    <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                    <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
                </div>
            @endif

            @if ($title = $shortcode->title)
                <{{ $titleTag = infinia_title_tag($shortcode, 'h3') }} class="ds-3 my-3 fw-black">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
            @endif

            @if ($description = $shortcode->description)
                <p class="fs-5 mb-0">{!! BaseHelper::clean($description) !!}</p>
            @endif

        </div>
    </div>

    @if ($backgroundImage = $shortcode->background_image)
        <div class="position-absolute top-0 start-50 translate-middle-x z-0">
            {{ RvMedia::image($backgroundImage, __('Background image')) }}
        </div>
    @endif

    <div class="container">
        <div class="row position-relative justify-content-center">
            @foreach($tabs as $tab)
                @continue(! $tabTitle = Arr::get($tab, 'title'))

                @php
                    $iconImage = Arr::get($tab, 'icon_image');
                    $icon = Arr::get($tab, 'icon');
                @endphp

                <div class="col-lg-4 text-center px-md-10">
                    <div class="card-service-4 text-center mt-2">
                        @if($iconImage || $icon)
                            <div class="bg-white icon-flip position-relative icon-shape icon-xxl rounded-3">
                                <div class="icon">
                                    @if ($iconImage)
                                        {{ RvMedia::image($iconImage) }}
                                    @else
                                        <x-core::icon :name="$icon" />
                                    @endif
                                </div>
                            </div>
                        @endif

                        <h5 class="my-3">{!! BaseHelper::clean($tabTitle) !!}</h5>
                        @if ($tabDescription = Arr::get($tab, 'description'))
                            <p class="mb-6">{!! BaseHelper::clean($tabDescription) !!}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        @if (count($tabs) == 3)
            <div class="navigation-arrow-1 d-none d-lg-block position-absolute top-50">
                <img src="{{ Theme::asset()->url('images/shapes/arrow-1.png') }}" alt="arrow">
            </div>

            <div class="navigation-arrow-2 d-none d-lg-block position-absolute">
                <img src="{{ Theme::asset()->url('images/shapes/arrow-2.png') }}" alt="arrow">
            </div>
        @elseif(count($tabs) < 3 && count($tabs) > 1)
            <div class="navigation-arrow-1 d-none d-lg-block position-absolute top-50">
                <img src="{{ Theme::asset()->url('images/shapes/arrow-1.png') }}" alt="arrow">
            </div>
        @endif

        @php
            $bottomDescription = $shortcode->bottom_description;
            $actionLabel = $shortcode->action_label;
            $actionUrl = $shortcode->action_url;
        @endphp

        @if($bottomDescription || ($actionLabel && $actionUrl))
            <div class="row">
                <div class="text-center mt-6">
                    @if(($actionLabel && $actionUrl))
                        <p class="text-900 fw-bold">
                            @if($bottomDescription) {!! BaseHelper::clean($bottomDescription) !!} @endif
                            <a href="{{ $actionUrl }}" class="text-primary text-decoration-underline">{!! BaseHelper::clean($actionLabel) !!}</a>
                        </p>
                    @else
                        <p class="text-900 fw-bold">{!! BaseHelper::clean($bottomDescription) !!}</p>
                    @endif
                </div>
            </div>
        @endif

        <div class="bouncing-blobs-container">
            <div class="bouncing-blobs-glass"></div>
            <div class="bouncing-blobs">
                <div class="bouncing-blob bouncing-blob--green"></div>
                <div class="bouncing-blob bouncing-blob--primary"></div>
            </div>
        </div>
    </div>
</section>
