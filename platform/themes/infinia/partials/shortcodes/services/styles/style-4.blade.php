<section {!! $shortcode->htmlAttributes() !!} class="shortcode-services shortcode-services-style-4 bg-linear-3"
    @style($variablesStyle)
>
    <div class="container-fluid position-relative section-padding ">
        <div class="container">
            <div class="text-center mb-8">
                @if ($subtitle = $shortcode->subtitle)
                    <div class="d-flex align-items-center justify-content-center bg-primary-soft d-inline-flex rounded-pill border-white border px-3 py-1" data-aos="zoom-in" data-aos-delay="100">
                        <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                        <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
                    </div>
                @endif

                @if ($title = $shortcode->title)
                    <{{ $titleTag = infinia_title_tag($shortcode, 'h3') }} class="ds-3 my-3 fw-regular">
                        {!! infinia_clean_title($title) !!}
                    </{{ $titleTag }}>
                @endif

            </div>
            <div class="row">
                @foreach($services as $service)
                    <div class="col-lg-3 col-md-6 mt-4 mt-lg-0" data-aos="fade-zoom-in" data-aos-delay="0">
                        <div @class(['card-service bg-white p-5 rounded-4 hover-up', 'mt-lg-6' => $loop->odd])>
                            @if($iconImage = $service->getMetaData('icon_image', true))
                                <img src="{{ RvMedia::getImageUrl($iconImage) }}" alt="" aria-hidden="true" class="service-icon filter-invert">
                            @elseif($icon = $service->getMetaData('icon', true))
                                <x-core::icon :name="$icon" class="service-icon filter-invert" />
                            @endif

                            <strong class="d-block fs-6 my-3 fs-5">{{ $service->name }}</strong>
                            @if ($serviceDescription = $service->description)
                                <p class="mb-6 truncate-3-custom">{!! BaseHelper::clean($serviceDescription) !!}</p>
                            @endif
                            <a href="{{ $service->url }}" title="{{ $service->name }}" class="rounded-pill border icon-shape d-inline-flex gap-3 icon-learn-more">
                                <svg class="plus" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <g clip-path="url(#)">
                                        <path class="fill-dark" d="M15.375 7.375H8.625V0.625C8.625 0.279813 8.34519 0 8 0C7.65481 0 7.375 0.279813 7.375 0.625V7.375H0.625C0.279813 7.375 0 7.65481 0 8C0 8.34519 0.279813 8.625 0.625 8.625H7.375V15.375C7.375 15.7202 7.65481 16 8 16C8.34519 16 8.625 15.7202 8.625 15.375V8.625H15.375C15.7202 8.625 16 8.34519 16 8C16 7.65481 15.7202 7.375 15.375 7.375Z" fill="#111827"></path>
                                    </g>
                                </svg>
                                <svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="18" height="10" viewBox="0 0 18 10" fill="none">
                                    <path class="fill-dark" d="M13.0633 0.0634766L12.2615 0.86529L15.8294 4.43321H0V5.56716H15.8294L12.2615 9.13505L13.0633 9.93686L18 5.00015L13.0633 0.0634766Z" fill="#111827"></path>
                                </svg>
                                <span class="fw-bold fs-7 text-900">{{ __('Learn More') }}</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            @php
                $primaryButtonLabel = $shortcode->primary_action_label;
                $primaryButtonUrl = $shortcode->primary_action_url;

                $secondaryButtonLabel = $shortcode->secondary_action_label;
                $secondaryButtonUrl = $shortcode->secondary_action_url;
            @endphp

            @if(($primaryButtonLabel && $primaryButtonUrl) || ($secondaryButtonUrl && $secondaryButtonLabel))
                <div class="row mt-8">
                <div class="col-lg-7">
                    <div class="d-flex align-items-center justify-content-lg-end justify-content-center">
                        @if($primaryButtonLabel && $primaryButtonUrl)
                            <a href="{{ $primaryButtonUrl }}" class="btn btn-gradient" data-aos="fade-zoom-in" data-aos-delay="50">
                                {!! BaseHelper::clean($primaryButtonLabel) !!}
                                @if($shortcode->primary_action_icon)
                                    <x-core::icon class="ms-2" :name="$shortcode->primary_action_icon" />
                                @endif
                            </a>
                        @endif

                        @if($secondaryButtonUrl && $secondaryButtonLabel)
                            <a href="{{ $secondaryButtonUrl }}" class="ms-5 text-decoration-underline fw-bold">
                                {!! BaseHelper::clean($secondaryButtonLabel) !!}

                                @if($shortcode->secondary_action_icon)
                                    <x-core::icon :name="$shortcode->secondary_action_icon" />
                                @endif
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    @if($shortcode->background_image)
        <div class="position-absolute top-50 start-50 translate-middle z-0">
            {{ RvMedia::image($shortcode->background_image, infinia_image_alt($shortcode)) }}
        </div>
    @endif
</section>
