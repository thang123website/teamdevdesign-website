@php
    $bgColor = $shortcode->background_color;
    $bgColor = $bgColor === 'transparent' ? null : $bgColor;
@endphp

<section {!! $shortcode->htmlAttributes() !!} class="section-cta-8 bg-4 shortcode-features shortcode-features-style-8"
    @style([
        "background-color: $bgColor !important" => $bgColor,
    ])
>
    <div class="container-fluid position-relative section-padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    @if ($subtitle = $shortcode->subtitle)
                        <div class="d-flex align-items-center justify-content-center bg-primary-soft border border-2 border-white d-inline-flex rounded-pill px-4 py-2" data-aos="zoom-in" data-aos-delay="50">
                            <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                            <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
                        </div>
                    @endif

                    @if ($title = $shortcode->title)
                        <{{ $titleTag = infinia_title_tag($shortcode, 'h5') }} class="ds-5 mt-2">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
                    @endif

                    @if ($description = $shortcode->description)
                        <p>{!! BaseHelper::clean($description) !!}</p>
                    @endif

                    @foreach($features as $feature)
                        @continue(! $featureTitle = Arr::get($feature, 'title'))
                        @php
                            $icon = Arr::get($feature, 'icon');
                            $iconImage = Arr::get($feature, 'icon_image');
                        @endphp

                        <div class="d-flex pt-3 align-items-center">
                            @if ($icon || $iconImage)
                                <div class="bg-primary-soft icon-flip position-relative icon-shape icon-xxl rounded-3 mb-4">
                                    <div class="icon">
                                        @if($iconImage)
                                            {{ RvMedia::image($iconImage, $featureTitle) }}
                                        @else
                                            <x-core::icon :name="$icon" />
                                        @endif
                                    </div>
                                </div>
                            @endif
                                <div class="ps-5">
                                    <strong class="d-block fs-6">{!! BaseHelper::clean($featureTitle) !!}</strong>
                                    @if ($featureDescription = Arr::get($feature, 'description'))
                                        <p>{!! BaseHelper::clean($featureDescription) !!}</p>
                                    @endif
                                </div>
                            </div>
                    @endforeach
                </div>

                <div class="col-lg-6 offset-lg-1 text-center mt-lg-0 mt-8">
                    <div class="position-relative z-1 d-inline-block mb-lg-0 mb-8">
                        @if ($image = $shortcode->image)
                            {{ RvMedia::image($image, infinia_image_alt($shortcode), attributes: ['class' => 'rounded-4 position-relative z-1']) }}
                        @endif

                        @php
                            $floatingCardDataCount = $shortcode->floating_card_data_count;
                            $floatingCardTitle = $shortcode->floating_card_title;
                        @endphp

                        @if ($floatingCardDataCount && $floatingCardTitle)
                            <div class="alltuchtopdown tag-year position-absolute backdrop-filter bg-primary rounded-4 px-4 py-5 text-center z-1">
                                <span class="h2 count fw-black my-0 lh-1 text-white text-nowrap"><span class="odometer" data-count="{{ $floatingCardDataCount }}">
                                    @if ($floatingCardDataCountUnit = $shortcode->floating_card_data_count_unit)
                                        </span>{{ $floatingCardDataCountUnit }}</span>
                                    @endif
                                <p class="text-white text-nowrap mb-0">{!! BaseHelper::clean($floatingCardTitle) !!}</p>
                            </div>
                        @endif
                        <div class="position-absolute tag-dots z-0 pt-5">
                            <img class="alltuchtopdown" src="{{ Theme::asset()->url('images/shapes/vector-2.png') }}" alt="vector 2">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
