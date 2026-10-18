<section {!! $shortcode->htmlAttributes() !!} class="shortcode-our-mission shortcode-our-mission-style-3 section-hero-4 position-relative fix pt-150">
    <div class="container">
        <div class="row position-relative z-1">
            <div class="col-lg-6 text-center text-lg-start">
                <div class="position-relative d-inline-block">
                    @if ($image = $shortcode->image)
                        {{ RvMedia::image($image, infinia_image_alt($shortcode), attributes: ['class' => 'rounded-5 border border-5 border-white']) }}
                    @endif


                    @php
                        $floatingDataCountTitle = $shortcode->floating_data_count_title;
                        $floatingDataCount = $shortcode->floating_data_count;

                        $floatingButtonLabel = $shortcode->floating_button_label;
                        $floatingButtonUrl = $shortcode->floating_button_url;
                    @endphp

                    @if($floatingDataCountTitle && $floatingDataCount)
                        <div class="alltuchtopdown backdrop-filter rounded-4 text-center d-inline-block px-6 py-4 m-5 position-absolute bottom-0 end-0">
                            <h2 class="count text-900 fw-black">
                                <span class="odometer" data-count="{{ $floatingDataCount }}"></span>
                                @if ($floatingDataUnit = $shortcode->floating_data_count_unit)
                                    <span>{!! BaseHelper::clean($floatingDataUnit) !!}</span>
                                @endif
                            </h2>
                            <strong class="d-block fs-6 text-500">{!! BaseHelper::clean($floatingDataCountTitle) !!}</strong>

                            @if ($floatingDataCountSubtitle = $shortcode->floating_data_count_subtitle)
                                <p class="text-500 fs-7">{!! BaseHelper::clean($floatingDataCountSubtitle) !!}</p>
                            @endif

                            @if ($floatingButtonLabel && $floatingButtonUrl)
                                <a href="{{ $floatingButtonUrl }}" class="shadow-sm d-flex align-items-center bg-white d-inline-flex rounded-pill px-2 py-1 mb-3">
                                    @if ($charHighlight = $shortcode->floating_button_characters_highlight)
                                        <span class="bg-primary fs-9 fw-bold rounded-pill px-2 py-1 text-white">{!! BaseHelper::clean($charHighlight) !!}</span>
                                    @endif

                                    <span class="fs-7 fw-medium text-primary mx-2">{!! BaseHelper::clean($floatingButtonLabel) !!}</span>
                                </a>
                            @endif
                        </div>
                    @endif
                    <div class="position-absolute start-0 bottom-50 translate-middle-x">
                        <div class="alltuchtopdown">
                            <img src="{{ Theme::asset()->url('images/shapes/vector-1.png') }}" alt="arrow" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="position-relative align-self-end mt-10">
                    @if ($title = $shortcode->title)
                        <{{ $titleTag = infinia_title_tag($shortcode, 'h3') }} class="ds-3 fw-regular">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
                    @endif

                    @if ($description = $shortcode->description)
                        <p class="fs-5 text-500 py-3">{!! BaseHelper::clean($description) !!}</p>
                    @endif

                    @if (($buttonLabel = $shortcode->primary_action_label) && ($buttonUrl = $shortcode->primary_action_url))
                        <a href="{{ $buttonUrl }}" class="fw-bold btn bg-neutral-100 d-inline-flex align-items-center text-900 hover-up">
                            <span class="me-10">{!! BaseHelper::clean($buttonLabel) !!}</span>

                            @if ($primaryIcon = $shortcode->primary_action_icon)
                                <x-core::icon :name="$primaryIcon"/>
                            @endif
                        </a>

                    @endif

                    @if ($bottomDescription = $shortcode->bottom_description)
                        <p class="text-500 fs-8 pt-3 pb-8">{!! BaseHelper::clean($bottomDescription) !!}</p>
                    @endif
                    <div class="row">
                        @if (count($tabs) > 0)
                            <div class="row position-relative align-items-center justify-content-between">
                                @foreach($tabs as $tab)
                                    @php
                                        $itemTitle = Arr::get($tab, 'title');
                                        $itemData = Arr::get($tab, 'data');
                                    @endphp

                                    @continue(!$itemTitle || !$itemData)

                                    <div @class(['col d-flex align-items-center', 'pe-lg-8' => $loop->last])>
                                        @if($loop->last)
                                            <span class="line-verticarl border-start h-50 ms-4 position-absolute top-50 start-50 translate-middle d-none d-md-block"></span>
                                        @endif

                                        <div class="counter-item-cover counter-item">
                                            <div @class(['content text-center', 'ms-md-auto' => $loop->last, 'mx-auto' => $loop->first])>
                                                <h2 class="count fw-black text-900 text-nowrap"><span class="odometer" data-count="{{ $itemData }}"></span>
                                                    {!! BaseHelper::clean(Arr::get($tab, 'unit')) !!}
                                                </h2>
                                            </div>
                                        </div>
                                        <p class="ms-3 fs-5">{!! BaseHelper::clean($itemTitle) !!}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        @if (is_plugin_active('testimonial') && $testimonials->isNotEmpty())
                            <div class="row mt-8 mb-10">
                            <div class="swiper slider-two pb-5 mt-lg-0 mt-5">
                                <div class="swiper-wrapper">
                                    @foreach($testimonials as $testimonial)
                                        <div class="swiper-slide">
                                            <div class="d-flex">
                                                <div class="img align-self-start flex-shrink-0">
                                                    {{ RvMedia::image($testimonial->image, $testimonial->name, attributes: ['class' => 'rounded-circle', 'width' => 48]) }}
                                                </div>
                                                <div class="content ms-3">
                                                    <div class="d-flex">
                                                        @foreach(range(1, 5) as $i)
                                                            <img src="{{ Theme::asset()->url('images/icons/star-yellow.png') }}" alt="star" />
                                                        @endforeach
                                                    </div>
                                                    <p class="text-500 mt-2">{!! BaseHelper::clean($testimonial->content) !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="position-absolute top-0 end-0 z-1 flickering pt-9 pe-4">
                        <img src="{{ Theme::asset()->url('images/shapes/shine-effect.png') }}" alt="" aria-hidden="true" />
                    </div>
                </div>
            </div>
        </div>

        @if ($backgroundImage = $shortcode->background_image)
            <div class="position-absolute top-0 start-0 bottom-0 mb-5 bg-2 rounded-4 fix">
                {{ RvMedia::image($backgroundImage, __('Background image')) }}
            </div>

        @endif

        <div class="position-absolute bg-rotate d-none d-lg-block pb-10 ps-9 mb-8 z-0">
            <img src="{{ Theme::asset()->url('images/shapes/swing-1.png') }}" alt="swing" />
        </div>
    </div>
</section>
