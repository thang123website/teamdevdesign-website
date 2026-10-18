@if ($sliders->isNotEmpty())
    <div {!! $shortcode->htmlAttributes() !!} class="shortcode-simple-slider section-hero-5 position-relative">
        <div class="swiper slider-two"
             data-loop="{{ $shortcode->is_loop == 'yes' }}"
             data-autoplay="{{ ($shortcode->is_autoplay ?: 'yes') == 'yes' }}"
             data-autoplay-speed="{{ in_array($shortcode->autoplay_speed, [2000, 3000, 4000, 5000, 6000, 7000, 8000, 9000, 10000]) ? $shortcode->autoplay_speed : 5000 }}"
             style="--shortcode-slider-title-font-size: {{ ($shortcode->title_font_size ?: 64) }}px;"
        >
            <div class="swiper-wrapper">
                @foreach($sliders as $slider)
                    @php
                        $tabletImage = $slider->getMetaData('tablet_image', true) ?: $slider->image;
                        $mobileImage = $slider->getMetaData('mobile_image', true) ?: $tabletImage;

                        // Hiệu năng (LCP): in sẵn ảnh nền bằng CSS thay vì đợi JS gán, và preload ảnh slide đầu.
                        $slideId = 'hero-slide-' . $slider->getKey();
                        $desktopUrl = RvMedia::getImageUrl($slider->image, null, false, RvMedia::getDefaultImage());
                        $tabletUrl = RvMedia::getImageUrl($tabletImage, null, false, RvMedia::getDefaultImage());
                        $mobileUrl = RvMedia::getImageUrl($mobileImage, null, false, RvMedia::getDefaultImage());

                        if ($loop->first) {
                            add_filter('theme_front_meta', function (?string $html) use ($desktopUrl, $tabletUrl, $mobileUrl): string {
                                return $html
                                    . '<link rel="preload" as="image" fetchpriority="high" href="' . e($mobileUrl) . '" media="(max-width: 768px)">'
                                    . '<link rel="preload" as="image" fetchpriority="high" href="' . e($tabletUrl) . '" media="(min-width: 769px) and (max-width: 1199px)">'
                                    . '<link rel="preload" as="image" fetchpriority="high" href="' . e($desktopUrl) . '" media="(min-width: 1200px)">';
                            }, 1);
                        }
                    @endphp

                    <style>
                        #{{ $slideId }} { background-image: url("{{ $mobileUrl }}"); }
                        @media (min-width: 769px) { #{{ $slideId }} { background-image: url("{{ $tabletUrl }}"); } }
                        @media (min-width: 1200px) { #{{ $slideId }} { background-image: url("{{ $desktopUrl }}"); } }
                    </style>

                    <div class="swiper-slide">
                        <div id="{{ $slideId }}" class="position-relative py-188 img-pull"
                             data-original-image="{{ RvMedia::getImageUrl($slider->image, null, false, RvMedia::getDefaultImage()) }}"
                             @if ($tabletImage) data-tablet-image="{{ RvMedia::getImageUrl($tabletImage, null, false, RvMedia::getDefaultImage()) }}" @endif
                             @if ($mobileImage) data-mobile-image="{{ RvMedia::getImageUrl($mobileImage, null, false, RvMedia::getDefaultImage()) }}" @endif
                        >
                            <div class="container position-relative z-2">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="backdrop-filter p-8 position-relative rounded-3">
                                            @if ($subtitle = $slider->getMetaData('subtitle', true))
                                                <div class="bg-white bg-opacity-50 border border-primary-soft d-inline-flex rounded-pill px-4 py-1">
                                                    <span class="tag-spacing fs-6 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
                                                </div>
                                            @endif

                                            @if ($title = $slider->title)
                                                <{{ $titleTag = infinia_title_tag($shortcode, 'h2') }} class="ds-3 my-3">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
                                            @endif

                                            @if ($description = $slider->description)
                                                <p class="fs-5 text-900">{!! BaseHelper::clean($description) !!}</p>
                                            @endif

                                            @php
                                                $primaryActionLabel = $slider->getMetaData('primary_action_label', true);
                                                $primaryActionUrl = $slider->getMetaData('primary_action_url', true);

                                                $secondaryActionLabel = $slider->getMetaData('secondary_action_label', true);
                                                $secondaryActionUrl = $slider->getMetaData('secondary_action_url', true);
                                            @endphp

                                            @if(($primaryActionLabel && $primaryActionUrl) || ($secondaryActionLabel && $secondaryActionUrl))
                                                <div class="d-flex flex-column flex-md-row align-items-center">
                                                    @if ($primaryActionLabel && $primaryActionUrl)
                                                        <a href="{{ $primaryActionUrl }}" class="btn btn-gradient rounded-4">
                                                            {!! BaseHelper::clean($primaryActionLabel) !!}

                                                            @if ($primaryActionIcon = $slider->getMetaData('primary_action_icon', true))
                                                                <x-core::icon class="ms-2" :name="$primaryActionIcon" />
                                                            @endif
                                                        </a>
                                                    @endif

                                                    @if ($secondaryActionLabel && $secondaryActionUrl)
                                                        <a href="{{ $secondaryActionUrl }}" class="d-inline-flex align-items-center rounded-4 text-nowrap backdrop-filter align-self-md-stretch px-3 py-2 popup-video hover-up ms-md-3 mt-3 mt-md-0">
                                                            @if ($secondaryActionIcon = $slider->getMetaData('secondary_action_icon', true))
                                                                <span class="backdrop-filter me-2 icon-shape icon-md rounded-circle">
                                                                    <x-core::icon :name="$secondaryActionIcon" />
                                                                </span>
                                                            @endif
                                                            <span class="fw-bold fs-7 text-900">
                                                                {!! BaseHelper::clean($secondaryActionLabel) !!}
                                                            </span>
                                                        </a>
                                                    @endif
                                                </div>
                                            @endif

                                            @if ($slogan = $slider->getMetaData('slogan', true))
                                                <div class="position-absolute top-50 start-0 translate-middle d-none d-md-block z-2">
                                                    <div class="tag-home-5 rotate-90 backdrop-filter px-6 py-3 rounded-pill d-inline-flex d-flex align-items-center justify-content-center">
                                                        <p class="text-900 mb-0 fs-18px fw-bold">{!! BaseHelper::clean($slogan) !!}</p>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if ($backgroundImage = $slider->getMetaData('background_image', true))
                                <div class="position-absolute top-0 start-0 z-0">
                                    {{ RvMedia::image($backgroundImage, __('Background image')) }}
                                </div>
                            @endif

                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-prev d-none d-lg-flex shadow-2 position-absolute top-50 translate-middle-y bg-white ms-lg-7">
                <i class="bi bi-arrow-left"></i>
            </div>
            <div class="swiper-button-next d-none d-lg-flex shadow-2 position-absolute top-50 translate-middle-y bg-white me-lg-7">
                <i class="bi bi-arrow-right"></i>
            </div>
            <div class="swiper-pagination mb-8"></div>
        </div>
    </div>
@endif
