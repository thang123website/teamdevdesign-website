<section {!! $shortcode->htmlAttributes() !!}  class="shortcode-app-downloads section-cta-1 position-relative section-padding fix">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="text-start mb-lg-0 mb-5">
                    @if ($subtitle = $shortcode->subtitle)
                        <div class="d-flex align-items-center justify-content-center bg-primary-soft border border-2 border-white d-inline-flex rounded-pill px-4 py-2" data-aos="zoom-in" data-aos-delay="50">
                            <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                            <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
                        </div>
                    @endif

                    @if ($title = $shortcode->title)
                        <{{ $titleTag = infinia_title_tag($shortcode, 'h3') }} class="ds-3 my-3">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
                    @endif

                    @if ($description = $shortcode->description)
                        <p class="fs-5 mb-0">{!! BaseHelper::clean($description) !!}</p>
                    @endif

                    @if (count($features) > 0)
                        <ul class="list-unstyled my-6">
                            @foreach($features as $feature)
                                @continue(! $feature)
                                <li class="d-flex align-items-center mb-2" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                                    <img src="{{ Theme::asset()->url('images/icons/check-primary.png') }}" alt="" aria-hidden="true">
                                    <span class="mb-0 ms-2 fs-5 fw-bold">{!! BaseHelper::clean($feature) !!}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    @if (count($platforms) > 0)
                        <div class="d-flex align-items-center mb-8 gap-2">
                            @foreach($platforms as $platform)
                                @php
                                    $platformName = Arr::get($platform, 'name');
                                    $platformImage = Arr::get($platform, 'image');
                                @endphp

                                @continue(! $platformName || ! $platformImage)

                                <a target="_blank" href="{{ Arr::get($platform, 'url') }}">
                                    {{ RvMedia::image($platformImage, $platformName) }}
                                </a>
                            @endforeach
                        </div>
                    @endif

                    @php
                        $reviewsCardTitle = $shortcode->reviews_card_title;
                        $reviewCardImage = $shortcode->reviews_card_image;
                        $reviewCardData = $shortcode->reviews_card_data;
                        $reviewCardRate = $shortcode->reviews_card_rate;
                        $reviewCardUnit = $shortcode->reviews_card_unit;
                    @endphp

                    @if($reviewsCardTitle && $reviewCardData)
                        <div class="d-flex align-items-center">
                            @if($reviewCardImage)
                                <div class="d-flex">
                                    {{ RvMedia::image($reviewCardImage, $reviewsCardTitle, attributes: ['height' => 46]) }}
                                </div>
                            @endif

                            @if ($reviewCardRate && $reviewCardData)
                                <div @class(['ms-2' => $reviewCardImage])>
                                    <p class="text-900 mb-0 fs-8 fw-bold">{!! BaseHelper::clean($reviewsCardTitle) !!}</p>
                                    <span class="fs-6 fw-bold">{!! BaseHelper::clean($reviewCardRate) !!}
                                        <span class="text-secondary fw-medium">(<span class="odometer" data-count="{{ $reviewCardData }}"></span>{!! BaseHelper::clean($reviewCardUnit) !!})</span>
                                    </span>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            @if ($image = $shortcode->image)
                <div class="col-lg-6 text-lg-end text-center">
                    {{ RvMedia::image($image, $title) }}
                </div>
            @endif

        </div>
    </div>
    <div class="bouncing-blobs-container">
        <div class="bouncing-blobs-glass"></div>
        <div class="bouncing-blobs">
            <div class="bouncing-blob bouncing-blob--blue"></div>
            <div class="bouncing-blob bouncing-blob--primary"></div>
        </div>
    </div>
</section>
