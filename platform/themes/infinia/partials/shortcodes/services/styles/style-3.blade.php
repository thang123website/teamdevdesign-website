<section {!! $shortcode->htmlAttributes() !!} class="shortcode-services shortcode-services-style-2 section-feature-12 border-bottom pb-120 pt-110"
    @style($variablesStyle)
>
    <div class="container">
        <div class="text-center">
            @if ($title = $shortcode->title)
                <{{ $titleTag = infinia_title_tag($shortcode, 'h5') }} class="ds-5">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
            @endif

            @if ($description = $shortcode->description)
                <p class="fs-5 pb-4">{!! BaseHelper::clean($description) !!}</p>
            @endif
        </div>
        <div class="row">
            @foreach($services as $service)
                <div class="col-lg-6">
                    <div class="feature-item mb-5 bg-neutral-100 p-7 rounded-4 hover-up">
                        <div class="icon-flip position-relative icon-shape icon-xxl rounded-3 mb-4">
                            <div class="icon">
                                @if($iconImage = $service->getMetaData('icon_image', true))
                                    <img src="{{ RvMedia::getImageUrl($iconImage) }}" alt="" aria-hidden="true" class="service-icon ">
                                @elseif($icon = $service->getMetaData('icon', true))
                                    <x-core::icon :name="$icon" class="service-icon filter-invert" />
                                @endif
                            </div>
                        </div>
                        <h4>{{ $service->name }}</h4>

                        @if ($serviceDescription = $service->description)
                            <p class="truncate-3-custom">
                                {!! BaseHelper::clean($serviceDescription) !!}
                            </p>

                        @endif

                        <a href="{{ $service->url }}" class="text-primary fs-7 fw-bold" title="{{ $service->name }}">
                            {{ __('Learn More') }}
                            <svg class=" ms-2 " xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none">
                                <g clip-path="url(#clip0_399_9647)">
                                    <path class="fill-dark" d="M13.5633 4.06348L12.7615 4.86529L16.3294 8.43321H0.5V9.56716H16.3294L12.7615 13.135L13.5633 13.9369L18.5 9.00015L13.5633 4.06348Z" fill="#111827"></path>
                                </g>
                                <defs>
                                    <clipPath>
                                        <rect width="18" height="18" fill="white" transform="translate(0.5)"></rect>
                                    </clipPath>
                                </defs>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
