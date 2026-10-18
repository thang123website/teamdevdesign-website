@php
    $primaryButtonLabel = $shortcode->primary_action_label;
    $primaryButtonUrl = $shortcode->primary_action_url;

    $secondaryButtonLabel = $shortcode->secondary_action_label;
    $secondaryButtonUrl = $shortcode->secondary_action_url;
@endphp

<section {!! $shortcode->htmlAttributes() !!} class="shortcode-services shortcode-services-style-5 section-team-1 position-relative fix section-padding"
    @style($variablesStyle)
>
    <div class="container position-relative z-2">
        <div class="text-center">
            @if ($subtitle = $shortcode->subtitle)
                <div class="d-flex align-items-center justify-content-center bg-primary-soft border border-2 border-white d-inline-flex rounded-pill px-4 py-2" data-aos="zoom-in" data-aos-delay="50">
                    <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true" />
                    <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
                </div>
            @endif

            @if ($title = $shortcode->title)
                <{{ $titleTag = infinia_title_tag($shortcode, 'h3') }} class="ds-3 my-3 fw-regular">{!! infinia_clean_title($title) !!}
                </{{ $titleTag }}>
            @endif

        </div>
        <div class="row mt-6 position-relative">
            @foreach($services as $service)
                <div class="col-lg-4 col-md-6">
                    <div class="p-2 rounded-4 shadow-1 bg-white position-relative z-1 hover-up mb-4">
                        <div class="card-service bg-white p-6 border rounded-4 text-center">
                            <div class="bg-primary-soft icon-flip position-relative icon-shape icon-xxl rounded-3 me-5">
                                <div class="icon">
                                    @if($iconImage = $service->getMetaData('icon_image', true))
                                        <img src="{{ RvMedia::getImageUrl($iconImage) }}" alt="" aria-hidden="true" class="service-icon filter-invert">
                                    @elseif($icon = $service->getMetaData('icon', true))
                                        <x-core::icon :name="$icon" class="service-icon filter-invert" />
                                    @endif
                                </div>
                            </div>
                            <h5 class="my-3">{{ $service->name }}</h5>
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
                        </div>
                    </div>
                </div>
            @endforeach
            <svg class="position-absolute top-50 start-50 translate-middle z-0" xmlns="http://www.w3.org/2000/svg" width="828" height="699" viewBox="0 0 828 699" fill="none">
                <path class="fill-primary-soft" d="M0 130.481C0 110.236 15.1267 93.1822 35.2276 90.7667L783.228 0.880261C807.04 -1.98124 828 16.611 828 40.5945V533.155C828 552.691 813.888 569.369 794.622 572.603L46.6224 698.173C22.2271 702.269 0 683.462 0 658.725V130.481Z" fill="#F5EEFF" />
            </svg>
        </div>

        <div class="text-center mt-6 d-flex flex-wrap justify-content-center align-items-center gap-3">
            @if($primaryButtonLabel && $primaryButtonUrl)
                <a href="{{ $primaryButtonUrl }}" class="btn btn-gradient">
                    {!! BaseHelper::clean($primaryButtonLabel) !!}
                    @if($shortcode->primary_action_icon)
                        <x-core::icon class="ms-2" :name="$shortcode->primary_action_icon" />
                    @endif
                </a>
            @endif

            @if($secondaryButtonUrl && $secondaryButtonLabel)
                <a href="{{ $secondaryButtonUrl }}" class="btn btn-outline-secondary hover-up">
                    @if($shortcode->secondary_action_icon)
                        <x-core::icon :name="$shortcode->secondary_action_icon" />
                    @endif
                    {!! BaseHelper::clean($secondaryButtonLabel) !!}
                </a>
            @endif
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
