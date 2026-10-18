<section {!! $shortcode->htmlAttributes() !!} class="shortcode-our-mission shortcode-our-mission-style-1 section-cta-11 position-relative section-padding fix">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="d-flex justify-content-md-between justify-content-center position-relative">
                    <div class="d-flex flex-column align-items-end d-none d-md-flex">
                        @if ($image = $shortcode->image)
                            <div class="zoom-img rounded-3">
                                {{ RvMedia::image($image, $shortcode->title, attributes: ['class' => 'rounded-3']) }}
                            </div>
                        @endif

                        @if ($image2 = $shortcode->image_2)
                            <div class="zoom-img rounded-3 mt-2">
                                {{ RvMedia::image($image2, $shortcode->title, attributes: ['class' => 'rounded-3']) }}
                            </div>
                        @endif
                    </div>
                    <div>
                        @if (count($tabs) > 0)
                            <div class="d-flex justify-content-between mt-5">
                                @foreach($tabs as $tab)
                                    @php
                                        $itemTitle = Arr::get($tab, 'title');
                                        $itemData = Arr::get($tab, 'data');
                                        $itemTextColor = Arr::get($tab, 'text_color');
                                        $itemTextColor =  $itemTextColor ? ($itemTextColor !== 'transparent' ? $itemTextColor : null) : null;
                                        $itemBgColor = Arr::get($tab, 'background_color');
                                        $itemBgColor =  $itemBgColor ? ($itemBgColor !== 'transparent' ? $itemBgColor : null) : null;
                                    @endphp

                                    @continue(! $itemTitle || ! $itemData)

                                    <div class="tab-item alltuchtopdown tag-year backdrop-filter rounded-4 px-5 py-4 text-center z-1"
                                        @style([
                                            "--tab-text-color: {$itemTextColor}" => $itemTextColor,
                                            "--tab-bg-color: {$itemBgColor}" => $itemBgColor,
                                        ])
                                    >
                                        <h5 class="count fw-bold mb-2 text-nowrap"><span class="odometer" data-count="{{ $itemData }}"></span>
                                            @if($itemUnit = Arr::get($tab, 'unit')) {!! BaseHelper::clean($itemUnit) !!} @endif
                                        </h5>
                                        <p class=" text-nowrap mb-0">
                                            {!! BaseHelper::clean($itemTitle) !!}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        @if ($image1 = $shortcode->image_1)
                            <div class="zoom-img rounded-3">
                                {{ RvMedia::image($image1, $shortcode->title, attributes: ['class' => 'rounded-3 mw-lg-310']) }}
                            </div>
                        @endif

                    </div>
                    <div class="position-absolute bottom-0 start-0 flickering ms-6 mb-4 z-0 d-none d-md-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="86" height="86" viewBox="0 0 86 86" fill="none">
                            <path d="M0.235352 64.6171C23.6511 58.8609 27.3738 62.5843 21.6183 86C31.9666 62.5843 45.1375 62.5843 55.4859 86C49.7296 62.5843 53.4531 58.8615 76.8688 64.6171C53.4531 54.2688 53.4531 41.0978 76.8688 30.7495C53.4531 36.5057 49.7303 32.7823 55.4859 9.36658C45.1375 32.7823 31.9666 32.7823 21.6183 9.36658C27.3745 32.7823 23.6511 36.5051 0.235352 30.7495C23.6511 41.0978 23.6511 54.2688 0.235352 64.6171Z" fill="#64E1B0" />
                            <path d="M85.7917 4.74567C80.5949 6.02293 79.7687 5.19679 81.046 0C78.7493 5.19679 75.8266 5.19679 73.5298 0C74.8071 5.19679 73.981 6.02293 68.7842 4.74567C73.981 7.0424 73.981 9.96508 68.7842 12.2618C73.981 10.9846 74.8071 11.8107 73.5298 17.0075C75.8266 11.8107 78.7493 11.8107 81.046 17.0075C79.7687 11.8107 80.5949 10.9846 85.7917 12.2618C80.5949 9.96508 80.5949 7.0424 85.7917 4.74567Z" fill="#64E1B0" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 ps-lg-8 mt-lg-0 mt-5">
                @if ($subtitle = $shortcode->subtitle)
                    <div class="d-flex align-items-center justify-content-center bg-primary-soft border border-2 border-white d-inline-flex rounded-pill px-4 py-2" data-aos="zoom-in" data-aos-delay="50">
                        <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true" />
                        <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
                    </div>
                @endif

                @if ($title = $shortcode->title)
                    <{{ $titleTag = infinia_title_tag($shortcode, 'h5') }} class="ds-5 my-3">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
                @endif

                @if ($description = $shortcode->description)
                    <p class="fs-5 text-500 mb-8">{!! BaseHelper::clean($description) !!}</p>
                @endif

                @if (is_plugin_active('testimonial') && $testimonials->isNotEmpty())
                    <div class="d-flex flex-column flex-md-row">
                        @foreach($testimonials as $testimonial)
                            <div @class(['evaluate-1 me-2', 'mt-md-0 mt-5' => !$loop->first])>
                                <div class="d-flex align-items-center">
                                    @if ($testimonialImage = $testimonial->image)
                                        {{ RvMedia::image($testimonialImage, $testimonial->name, attributes: ['class' => 'rounded-circle', 'width' => 64]) }}
                                    @endif

                                    <div class="d-flex flex-column ps-3 flex-shrink-0">
                                        <div class="d-flex">
                                            @php
                                                $ratingImageUrl = Theme::asset()->url('images/icons/star-yellow.png');
                                            @endphp
                                            @foreach(range(1, 5) as $i)
                                                <img src="{{ $ratingImageUrl }}" alt="star" />
                                            @endforeach
                                        </div>
                                        <strong class="d-block mt-2 mb-0 fs-6">{{ $testimonial->name }}</strong>
                                    </div>
                                </div>

                                @if ($testimonialContent = $testimonial->content)
                                    <p class="text-500 mt-3">{!! BaseHelper::clean($testimonialContent) !!}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if ($backgroundImage = $shortcode->background_image)
        <div class="position-absolute top-0 start-50 translate-middle-x z-0">
            {{ RvMedia::image($backgroundImage, infinia_image_alt($shortcode)) }}
        </div>
    @endif
    <div class="rotate-center ellipse-rotate-success position-absolute z-0"></div>
    <div class="rotate-center-rev ellipse-rotate-primary position-absolute z-1"></div>
</section>
