<section {!! $shortcode->htmlAttributes() !!} class="shortcode-hero-banner shortcode-hero-banner-style-3 section-hero-3 position-relative fix section-padding">
    <div class="container">
        <div class="row align-items-center position-relative">
            <div class="col-lg-7 position-relative z-1 mb-lg-0 pb-10 mb-">
                <div class="text-start mb-lg-0 mb-5">
                    @if ($subtitle = $shortcode->subtitle)
                        <div class="border-linear-1 rounded-pill d-inline-block mb-3">
                            <div class="text-primary bg-white px-4 py-2 rounded-pill fw-medium position-relative z-2">
                                {!! BaseHelper::clean($subtitle) !!}
                            </div>
                        </div>
                    @endif

                    @if ($title = $shortcode->title)
                        <{{ $titleTag = infinia_title_tag($shortcode, 'h1') }} class="ds-1 my-3 me-4 lh-1">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
                    @endif

                    @if ($description = $shortcode->description)
                        <p class="fs-5 text-900 my-6">
                            {!! BaseHelper::clean($description) !!}
                        </p>
                    @endif

                    @php
                        $primaryButtonLabel = $shortcode->primary_action_label;
                        $primaryButtonUrl = $shortcode->primary_action_url;

                        $secondaryButtonLabel = $shortcode->secondary_action_label;
                        $secondaryButtonUrl = $shortcode->secondary_action_url;
                    @endphp

                    @if($primaryButtonLabel && $primaryButtonUrl)
                        <a href="{{ $primaryButtonUrl }}" class="btn btn-gradient" data-aos="fade-zoom-in" data-aos-delay="100">
                            {!! BaseHelper::clean($primaryButtonLabel) !!}

                            @if($primaryIcon = $shortcode->primary_action_icon)
                                <x-core::icon :name="$primaryIcon" />
                            @endif
                        </a>
                    @endif

                    @if($secondaryButtonLabel && $secondaryButtonUrl)
                        <a href="{{ $secondaryButtonUrl }}" class="ms-md-3 btn btn-outline-secondary hover-up" data-aos="fade-zoom-in" data-aos-delay="100">
                            @if($secondaryIcon = $shortcode->secondary_action_icon)
                                <x-core::icon :name="$secondaryIcon" />
                            @endif

                            {!! BaseHelper::clean($secondaryButtonLabel) !!}
                        </a>
                    @endif
                    <div class="mt-6 pt-4 max-w-300px">
                        @if ($bottomTitle = $shortcode->bottom_title)
                            <p class="mb-2">{!! BaseHelper::clean($bottomTitle) !!}</p>
                        @endif

                        @if ($brands)
                            <div class="partners-slider" data-display-item="2">
                                @foreach($brands as $brand)
                                    @continue(! $brandLogo = Arr::get($brand, 'image'))
                                    <div class="mx-2">
                                        <a href="{{ Arr::get($brand, 'url') }}" target="_blank">
                                            {{ RvMedia::image($brandLogo, Arr::get($brand, 'name'), attributes: ['class' => 'filter-invert rounded-4']) }}
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-7 position-xl-absolute mb-lg-10 top-50 end-0 translate-middle-lg-y z-0">
                <div class="row">
                    <div class="col-6 align-self-end">
                        @if ($image4 = $shortcode->main_image_4)
                            <div class="border-5 border-white border rounded-4  mb-4 d-block d-xl-none">
                                {{ RvMedia::image($image4, infinia_image_alt($shortcode), attributes: ['class' => 'rounded-4']) }}
                            </div>
                        @endif

                        @if ($image3 = $shortcode->main_image_3)
                            <div class="border-5 border-white border rounded-4 mb-4">
                                {{ RvMedia::image($image3, infinia_image_alt($shortcode), attributes: ['class' => 'rounded-4']) }}
                            </div>
                        @endif
                    </div>
                    <div class="col-6 align-self-end">
                        @if ($image1 = $shortcode->main_image_1)
                            <div class="border-5 border-white border rounded-4 mb-4">
                                {{ RvMedia::image($image1, infinia_image_alt($shortcode), attributes: ['class' => 'rounded-4']) }}
                            </div>
                        @endif

                        @if ($image2 = $shortcode->main_image_2)
                            <div class="border-5 border-white border rounded-4">
                                {{ RvMedia::image($image2, infinia_image_alt($shortcode), attributes: ['class' => 'rounded-4']) }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="position-absolute top-50 start-50 translate-middle pb-10 pe-10">
                    <img class="rotateme" src="{{ $shortcode->floating_image ? RvMedia::getImageUrl($shortcode->floating_image) : Theme::asset()->url('images/shapes/star-rotate.png') }}" alt="star" />
                </div>
                <div class="position-absolute top-50 start-50 translate-middle">
                    <div class="ellipse-primary"></div>
                </div>
            </div>
        </div>
    </div>
</section>
