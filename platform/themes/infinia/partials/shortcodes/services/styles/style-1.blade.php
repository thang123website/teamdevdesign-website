<section {!! $shortcode->htmlAttributes() !!} class="section-padding shortcode-services shortcode-services-style-1"
    @style($variablesStyle)
>
    <div class="container">
        <div class="text-center">
            @if($shortcode->subtitle)
                <div class="d-flex align-items-center justify-content-center bg-primary-soft border border-2 border-white d-inline-flex rounded-pill px-4 py-2" data-aos="zoom-in" data-aos-delay="50">
                    <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                    <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                </div>
            @endif
            @if($shortcode->title)
                <{{ $titleTag = infinia_title_tag($shortcode, 'h3') }} class="ds-3 my-3" data-aos="fade-zoom-in" data-aos-delay="100">{!! infinia_clean_title($shortcode->title) !!}</{{ $titleTag }}>
            @endif
            @if($shortcode->description)
                <p data-aos="fade-zoom-in" data-aos-delay="50">
                    {!! BaseHelper::clean(nl2br($shortcode->description)) !!}
                </p>
            @endif
        </div>
        <div class="row mt-6 position-relative">
            @foreach($services->split(3) as $row)
                <div class="col-lg-4">
                    @foreach($row as $service)
                        <div
                            @class([
                                'rounded-4 shadow-1 bg-white position-relative z-1 hover-up',
                                'p-2 mt-lg-8' => $loop->first && $loop->parent->first,
                                'p-2 mt-lg-8 mt-5' => $loop->first && $loop->parent->last,
                                'p-2 mt-5' => $loop->first || $loop->last,
                            ])
                            data-aos="fade-zoom-in"
                            data-aos-delay="50"
                        >
                            <div class="card-service bg-white p-6 border rounded-4">
                                @if($iconImage = $service->getMetaData('icon_image', true))
                                    <img src="{{ RvMedia::getImageUrl($iconImage) }}" alt="" aria-hidden="true" class="service-icon">
                                @elseif($icon = $service->getMetaData('icon', true))
                                    <x-core::icon :name="$icon" class="service-icon" />
                                @endif
                                <strong class="d-block fs-6 my-3">{{ $service->name }}</strong>
                                <p class="mb-6">{!! BaseHelper::clean(nl2br($service->description)) !!}</p>
                                <a href="{{ $service->url }}" title="{{ $service->name }}" class="rounded-pill border icon-shape d-inline-flex gap-3 icon-learn-more">
                                    <svg class="plus" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <g clip-path="url(#clip0_226_5470)">
                                            <path
                                                class="fill-dark"
                                                d="M15.375 7.375H8.625V0.625C8.625 0.279813 8.34519 0 8 0C7.65481 0 7.375 0.279813 7.375 0.625V7.375H0.625C0.279813 7.375 0 7.65481 0 8C0 8.34519 0.279813 8.625 0.625 8.625H7.375V15.375C7.375 15.7202 7.65481 16 8 16C8.34519 16 8.625 15.7202 8.625 15.375V8.625H15.375C15.7202 8.625 16 8.34519 16 8C16 7.65481 15.7202 7.375 15.375 7.375Z"
                                                fill="#111827"
                                            />
                                        </g>
                                        <defs>
                                            <clipPath>
                                                <rect width="16" height="16" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="18" height="10" viewBox="0 0 18 10" fill="none">
                                        <path class="fill-dark" d="M13.0633 0.0634766L12.2615 0.86529L15.8294 4.43321H0V5.56716H15.8294L12.2615 9.13505L13.0633 9.93686L18 5.00015L13.0633 0.0634766Z" fill="#111827" />
                                    </svg>
                                    <span class="fw-bold fs-7 text-900">{{ __('Learn More') }}</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
            @if($shortcode->background_image)
                <div class="position-absolute top-50 start-50 translate-middle z-0">
                    {{ RvMedia::image($shortcode->background_image, infinia_image_alt($shortcode)) }}
                </div>
            @endif
        </div>
    </div>
</section>
