@php
    $bgColor = $shortcode->background_color;
    $bgColor = $bgColor === 'transparent' ? null : $bgColor;
@endphp

<section {!! $shortcode->htmlAttributes() !!} class="shortcode-platforms-featured shortcode-platforms-featured-style-1 section-feature-5"
    @style([
        "--shortcode-background-color: $bgColor" => $bgColor,
    ])
>
    <div class="container-fluid position-relative section-padding bg-1">
        <div class="container">
            <div class="row align-items-center">
                @if ($image = $shortcode->image)
                    <div class="col-lg-5">
                        <div class="photo-description position-relative  rounded-4">
                            {{ RvMedia::image($image, infinia_image_alt($shortcode), attributes: ['class' => 'rounded-4 border border-2 border-white position-relative z-1']) }}
                            <div class="box-gradient-1 ms-lg-8 position-absolute bottom-0 start-0 bg-linear-1 rounded-4 z-0"></div>
                        </div>
                    </div>
                @endif

                <div class="col-lg-6 offset-lg-1 mt-lg-0 mt-5">
                    @if ($title = $shortcode->title)
                        <{{ $titleTag = infinia_title_tag($shortcode, 'h4') }} class="ds-4 fw-regular">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
                    @endif

                    @if ($description = $shortcode->description)
                        <p class="fs-5">{!! BaseHelper::clean($description) !!}</p>
                    @endif

                    @if (($actionLabel = $shortcode->primary_action_label) && ($actionUrl = $shortcode->primary_action_url))
                        <a href="{{ $actionUrl }}" class="btn btn-gradient hover-up mt-4">
                            {!! BaseHelper::clean($actionLabel) !!}

                            @if ($actionIcon = $shortcode->primary_action_icon)
                                <x-core::icon class="ms-2" :name="$actionIcon" />
                            @endif
                        </a>
                    @endif
                </div>
            </div>

            @if ($tabs)
                <div class="row py-90">
                    <div class="col-lg-10 px-lg-0 mx-lg-auto d-lg-flex justify-content-lg-between">
                        @foreach($tabs as $tab)
                            @continue(! $tabTitle = Arr::get($tab, 'title'))
                            <a href="{{ Arr::get($tab, 'url') }}" class="px-4 py-3 bg-white hover-up rounded-pill text-500 fs-5 text-nowrap d-inline-block mb-lg-0 mb-3" data-aos="fade-zoom-in" data-aos-delay="{{ ($loop->index + 1) * 100 }}">
                                {!! BaseHelper::clean($tabTitle) !!}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
