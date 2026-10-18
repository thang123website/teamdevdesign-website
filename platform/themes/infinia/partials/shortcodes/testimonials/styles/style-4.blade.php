<section {!! $shortcode->htmlAttributes() !!} class="shortcode-testimonials shortcode-testimonials-style-4 section-testimonial-3 position-relative section-padding fix">
    <div class="container position-relative z-1">
        <div class="row pb-9">
            <div class="col-lg-7 mx-lg-auto">
                <div class="text-center mb-lg-0 mb-5">
                    @if ($subtitle = $shortcode->subtitle)
                        <div class="d-flex align-items-center position-relative z-2 justify-content-center bg-primary-soft d-inline-flex rounded-pill border border-2 border-white px-3 py-1">
                            <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true" />
                            <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
                        </div>
                    @endif

                    @if ($title = $shortcode->title)
                        <{{ $titleTag = infinia_title_tag($shortcode, 'h5') }} class="ds-5 my-3 fw-regular">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
                    @endif

                    @if ($description = $shortcode->description)
                        <p class="fs-5 mb-0 text-900">{!! BaseHelper::clean($description) !!}</p>
                    @endif

                </div>
            </div>
        </div>
        <div class="row">
            <div class="swiper slider-1 pt-2 pb-3">
                <div class="swiper-wrapper">
                    @foreach($testimonials as $testimonial)
                        <div class="swiper-slide">
                            <div class="bg-neutral-100 card-testimonial-3 p-5 rounded-3 position-relative">
                                <div class="d-flex align-items-center mb-5">
                                    {{ RvMedia::image($testimonial->image, $testimonial->name, attributes: ['class' => 'rounded-circle avatar-lg', 'width' => 64]) }}

                                    <div class="d-flex flex-column">
                                        <strong class="d-block fs-6 ms-3 mb-0">{{ $testimonial->name }}</strong>

                                        @if ($company = $testimonial->company)
                                            <div class="flag ms-3">
                                                <span class="fs-8">{!! BaseHelper::clean($company) !!}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                @if ($content = $testimonial->content)
                                    <p class="text-900 border-bottom pb-4 mb-4">{!! BaseHelper::clean($content) !!}</p>
                                @endif

                                <div class="d-flex">
                                    @foreach(range(1, 5) as $i)
                                        <img src="{{ Theme::asset()->url('images/icons/star-yellow.png') }}" alt="star">
                                    @endforeach
                                </div>
                                <div class="position-absolute top-0 end-0 m-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" viewBox="0 0 52 52" fill="none">
                                        <g clip-path="url(#clip0_551_13914)">
                                            <path d="M0 29.7144H11.1428L3.71422 44.5715H14.8571L22.2857 29.7144V7.42871H0V29.7144Z" fill="#D1D5DB" />
                                            <path d="M29.7148 7.42871V29.7144H40.8577L33.4291 44.5715H44.5719L52.0005 29.7144V7.42871H29.7148Z" fill="#D1D5DB" />
                                        </g>
                                        <defs>
                                            <clipPath>
                                                <rect width="52" height="52" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
                <div class="text-center mt-8 position-relative z-3"></div>
            </div>
        </div>
    </div>

    @if ($backgroundImage = $shortcode->background_image)
        <div class="position-absolute top-0 start-50 translate-middle-x z-0">
            {{ RvMedia::image($backgroundImage, __('Background image')) }}
        </div>
    @endif

    <div class="rotate-center ellipse-rotate-success position-absolute z-0"></div>
    <div class="rotate-center-rev ellipse-rotate-primary position-absolute z-1"></div>
</section>
