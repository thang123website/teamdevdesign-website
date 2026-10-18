<section {!! $shortcode->htmlAttributes() !!} class="features-10 py-9 bg-primary-light shortcode-services shortcode-services-style-2 position-relative"
    @style($variablesStyle)
>
    <div class="container">
        <div class="row">
            @foreach($services as $service)
                <div class="col-lg-3 col-md-6">
                    <div class="feature-item mb-5 position-relative mb-lg-0 bg-white p-5 rounded-4 hover-up">
                        <div class="bg-primary-soft icon-flip position-relative icon-shape icon-xxl rounded-3 mb-4">
                            <div class="icon">
                                @if($iconImage = $service->getMetaData('icon_image', true))
                                    <img src="{{ RvMedia::getImageUrl($iconImage) }}" alt="" aria-hidden="true" class="service-icon">
                                @elseif($icon = $service->getMetaData('icon', true))
                                    <x-core::icon :name="$icon" class="service-icon" />
                                @endif
                            </div>
                        </div>

                        <a href="{{ $service->url }}" class="position-relative z-1">
                            <strong class="d-block fs-6">{{ $service->name }}</strong>
                        </a>

                        @if($description = $service->description)
                            <p class="truncate-3-custom">{!! BaseHelper::clean($description) !!}</p>
                        @endif

                        <a href="{{ $service->url }}" title="{{ $service->name }}" class="text-primary fs-7 fw-bold">
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
                        <div class="position-absolute end-0 top-0">
                            <img src="{{ Theme::asset()->url('images/shapes/bg-line.png') }}" alt="" aria-hidden="true">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
