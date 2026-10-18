@php
    $bgColor = $shortcode->background_color;
    $bgColor = $bgColor === 'transparent' ? null : $bgColor;
@endphp

<section {!! $shortcode->htmlAttributes() !!} class="shortcode-platforms-featured shortcode-platforms-featured-style-2 section-feature-5"
    @style([
        "--shortcode-background-color: $bgColor" => $bgColor,
    ])
>
    <div class="container-fluid position-relative section-padding bg-1">
        <div class="container">
            <div class="row align-items-start pb-5 pt-lg-5 pt-0">
                <div class="col-lg-5 order-2 order-lg-1 mt-lg-0 mt-10 pt-lg-0 pt-5">
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

                <div class="col-lg-6 offset-lg-1 order-1 order-lg-2 mt-5 text-lg-end text-center">
                    <div class="photo-description position-relative rounded-4 d-inline-block">
                        @if ($image = $shortcode->image)
                            {{ RvMedia::image($image, infinia_image_alt($shortcode), attributes: ['class' => 'rounded-4 border border-2 border-white position-relative z-1']) }}
                        @endif

                        <div class="position-absolute top-50 start-50 translate-middle z-0">
                            <div class="box-gradient-2 position-relative bg-linear-1 rounded-4 z-0">
                            </div>
                        </div>
                        @if ($image1 = $shortcode->image_1)
                            {{ RvMedia::image($image1, infinia_image_alt($shortcode), attributes: ['class' => 'position-absolute top-100 start-0 d-none d-md-block translate-middle rounded-4 border border-2 border-white position-relative z-1']) }}
                        @endif
                    </div>
                </div>
            </div>
            <div class="row pt-lg-150 pt-8 text-center d-none d-md-block">
                <div class="col-lg-10 col mx-lg-auto">
                    @if ($bottomDescription = $shortcode->bottom_description)
                        <p class="text-500">{!! BaseHelper::clean($bottomDescription) !!}</p>
                    @endif

                    @if($tabs)
                        <div class="compatible-group bg-white p-5 mt-5 rounded-4 d-md-flex justify-content-between">
                            @foreach($tabs as $tab)
                                @continue(! $tabTitle = Arr::get($tab, 'title'))
                                <div class="compatible hover-up">
                                    <a href="{{ Arr::get($tab, 'url') }}">
                                        @if ($iconImage = Arr::get($tab, 'icon_image'))
                                            {{ RvMedia::image($iconImage, infinia_image_alt($shortcode), attributes: ['class' => 'rounded-4']) }}
                                        @endif

                                        <p class="text-900 mt-3 mb-0">{!! BaseHelper::clean($tabTitle) !!}</p>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
