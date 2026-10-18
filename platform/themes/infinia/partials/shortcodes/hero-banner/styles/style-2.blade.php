<section {!! $shortcode->htmlAttributes() !!} class="shortcode-hero-banner shortcode-hero-banner-style-2 section-hero-2 position-relative fix section-padding pb-lg-0">
    <div class="container">
        <div class="row text-center position-relative z-1">
            <div class="col">
                @if ($subtitle = $shortcode->subtitle)
                    <div class="border-linear-1 rounded-pill d-inline-block mb-2" data-aos="zoom-in" data-aos-delay="50">
                        <div class="text-primary bg-white px-4 py-2 rounded-pill fw-medium position-relative z-2">{!! BaseHelper::clean($subtitle) !!}</div>
                    </div>
                @endif

                @if ($title = $shortcode->title)
                    <{{ $titleTag = infinia_title_tag($shortcode, 'h3') }} class="ds-3 fw-normal position-relative z-2 mb-5">
                        {!! infinia_clean_title($title) !!}
                    </{{ $titleTag }}>
                @endif

                @php
                    $primaryButtonLabel = $shortcode->primary_action_label;
                    $primaryButtonUrl = $shortcode->primary_action_url;

                    $secondaryButtonLabel = $shortcode->secondary_action_label;
                    $secondaryButtonUrl = $shortcode->secondary_action_url;
                @endphp

                @if(($primaryButtonLabel && $primaryButtonUrl) || ($secondaryButtonUrl && $secondaryButtonLabel))
                    <div class="d-flex gap-3 flex-column flex-md-row justify-content-center">
                        @if($primaryButtonLabel && $primaryButtonUrl)
                            <a href="{{ $primaryButtonUrl }}" class="btn btn-gradient" data-aos="fade-zoom-in" data-aos-delay="50">
                                {!! BaseHelper::clean($primaryButtonLabel) !!}
                                @if($shortcode->primary_action_icon)
                                    <x-core::icon class="ms-2" :name="$shortcode->primary_action_icon" />
                                @endif
                            </a>
                        @endif

                        @if($secondaryButtonUrl && $secondaryButtonLabel)
                            <a href="{{ $secondaryButtonUrl }}" class="btn btn-outline-secondary hover-up" data-aos="fade-zoom-in" data-aos-delay="100">
                                @if($shortcode->secondary_action_icon)
                                    <x-core::icon :name="$shortcode->secondary_action_icon" />
                                @endif

                                {!! BaseHelper::clean($secondaryButtonLabel) !!}
                            </a>
                        @endif

                    </div>
                @endif

                <div class="mt-10 mt-md-8 position-relative z-1  text-900">
                    @if ($image = $shortcode->image)
                        {{ RvMedia::image($image, infinia_image_alt($shortcode), attributes: ['data-aos' => 'fade-up', 'data-aos-delay' => 100]) }}
                    @endif

                    <img src="{{ Theme::asset()->url('images/shapes/vector.png') }}" class="alltuchtopdown d-none d-md-block position-absolute bottom-0 end-0 pe-10 me-lg-10 mb-lg-10" />

                    <div class="position-md-absolute d-inline-block pt-10 pt-md-5 top-50 start-0 translate-middle-y mt-10">
                        <div class="alltuchtopdown backdrop-filter rounded-4 p-4">
                            @if ($floatingCardTitle = $shortcode->floating_card_title)
                                <strong class="d-block fs-6 text-900">{!! BaseHelper::clean($floatingCardTitle) !!}</strong>
                            @endif

                            @if ($floatingCardDescription = $shortcode->floating_card_description)
                                <p class="fs-6 text-900">{!! BaseHelper::clean($floatingCardDescription) !!}</p>
                            @endif


                            @if (count($floatingFeatures) > 0)
                                <ul class="list-unstyled phase-items text-900">
                                    @foreach($floatingFeatures as $floatingFeature)
                                        @continue(! $featureTitle = Arr::get($floatingFeature, 'title'))
                                        <li class="d-flex align-items-center mt-2">
                                            <img src="{{ Theme::asset()->url('images/icons/check.png') }}" alt="" aria-hidden="true">
                                            <span class="ms-2">{!! BaseHelper::clean($featureTitle) !!}</span>
                                        </li>
                                    @endforeach

                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="position-absolute top-0 start-0 ms-10 mt-10 pt-10">
                    <img src="{{ Theme::asset()->url('images/icons/star-1.png') }}" class="flickering" alt="star" />
                </div>
                <div class="rotateme position-absolute top-0 end-0 me-10 pe-8 z-0">
                    <img src="{{ Theme::asset()->url('images/icons/star-3.png') }}" class="flickering" alt="star">
                </div>
                <div class="position-absolute top-50 end-0 translate-middle-y pe-md-10 pe-5 pt-10 mt-8">
                    <div class="shake">
                        <img src="{{ Theme::asset()->url('images/icons/star-2.png') }}" class="flickering" alt="star">
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($bgImage = $shortcode->background_image)
        <div class="position-absolute top-0 start-50 translate-middle-x">
            {{ RvMedia::image($bgImage, infinia_image_alt($shortcode)) }}
        </div>
    @endif

    <div class="bouncing-blobs-container">
        <div class="bouncing-blobs-glass"></div>
        <div class="bouncing-blobs">
            <div class="bouncing-blob bouncing-blob--green"></div>
            <div class="bouncing-blob bouncing-blob--green"></div>
            <div class="bouncing-blob bouncing-blob--white"></div>
            <div class="bouncing-blob bouncing-blob--infor bouncing-blob--infor-2"></div>
            <div class="bouncing-blob bouncing-blob--purple"></div>
            <div class="bouncing-blob bouncing-blob--purple"></div>
            <div class="bouncing-blob bouncing-blob--infor bouncing-blob--infor-2"></div>
        </div>
    </div>

    @if(($socials = Theme::getSocialLinks()) && $shortcode->display_social_links)
        <div class="position-absolute top-50 start-0 translate-middle-y d-none d-md-block z-2">
            <div class="socials rotate-90 bg-white px-3 py-2 rounded-pill d-inline-flex d-flex align-items-center justify-content-center">
                @if($socialLinkTitle = $shortcode->social_links_box_title)
                    <p class="text-900 mb-0">{!! BaseHelper::clean($socialLinkTitle) !!}</p>
                @endif
                <ul class="list-unstyled d-flex mb-0">
                    @foreach($socials as $social)
                        @continue(! $social->getUrl() || ! $social->getIconHtml())
                        <li class="ms-3">
                            <a href="{{ $social->getUrl() }}" target="_blank">
                                {{ $social->getIconHtml() }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</section>
