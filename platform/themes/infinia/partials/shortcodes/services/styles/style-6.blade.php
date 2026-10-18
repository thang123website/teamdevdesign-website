<section {!! $shortcode->htmlAttributes() !!} class="shortcode-services shortcode-services-style-6 section-services-3 section-padding position-relative"
    @style($variablesStyle)
>
    <div class="container position-relative z-2">
        <div class="text-center">
            @if ($subtitle = $shortcode->subtitle)
                <div class="d-flex align-items-center justify-content-center bg-primary-soft border border-2 border-white d-inline-flex rounded-pill px-4 py-2" data-aos="zoom-in" data-aos-delay="50">
                    <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                    <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
                </div>
            @endif

            @if ($title = $shortcode->title)
                <{{ $titleTag = infinia_title_tag($shortcode, 'h2') }} class="ds-3 my-3 fw-regular">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
            @endif
        </div>
        <div class="row mt-6 position-relative">
            <div class="swiper slider-2 px-1">
                <div class="swiper-wrapper">
                    @foreach($services as $service)
                        <div class="swiper-slide">
                            <div class="card-service-4 position-relative bg-white p-6 border rounded-3 text-center shadow-1 hover-up mt-2">
                                <div class="bg-primary-soft icon-flip position-relative icon-shape icon-xxl rounded-3 me-5">
                                    <div class="icon">
                                        @if($iconImage = $service->getMetaData('icon_image', true))
                                            <img src="{{ RvMedia::getImageUrl($iconImage) }}" alt="" aria-hidden="true" class="service-icon filter-invert">
                                        @elseif($icon = $service->getMetaData('icon', true))
                                            <x-core::icon :name="$icon" class="service-icon filter-invert" />
                                        @endif
                                    </div>
                                </div>
                                <h5 class="my-3 truncate-1-custom" title="{{ $service->name }}">{{ $service->name }}</h5>
                                @if ($serviceDescription = $service->description)
                                    <p class="mb-6 truncate-3-custom">{!! BaseHelper::clean($serviceDescription) !!}</p>
                                @endif

                                <a href="{{ $service->url }}" title="{{ $service->name }}" class="text-primary fs-7 fw-bold">
                                    {{ __('Learn More') }}
                                    <svg class=" ms-2 " xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none">
                                        <g clip-path="url(#clip0_399_9647)">
                                            <path d="M13.5633 4.06348L12.7615 4.86529L16.3294 8.43321H0.5V9.56716H16.3294L12.7615 13.135L13.5633 13.9369L18.5 9.00015L13.5633 4.06348Z" fill="#111827" />
                                        </g>
                                        <defs>
                                            <clipPath>
                                                <rect width="18" height="18" fill="white" transform="translate(0.5)" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                                <div class="rectangle position-absolute bottom-0 start-50 translate-middle-x"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="swiper-button-prev d-none d-lg-flex shadow-2 position-absolute top-50 translate-middle-y bg-white ms-lg-7">
                <i class="bi bi-arrow-left"></i>
            </div>
            <div class="swiper-button-next d-none d-lg-flex shadow-2 position-absolute top-50 translate-middle-y bg-white">
                <i class="bi bi-arrow-right"></i>
            </div>
        </div>
    </div>

    @if($shortcode->background_image)
        <div class="position-absolute top-0 start-50 translate-middle-x z-0">
            {{ RvMedia::image($shortcode->background_image, infinia_image_alt($shortcode)) }}
        </div>
    @endif

    <div class="rotate-center ellipse-rotate-success position-absolute z-1"></div>
    <div class="rotate-center-rev ellipse-rotate-primary position-absolute z-1"></div>
</section>
