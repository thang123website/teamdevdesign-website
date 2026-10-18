<section {!! $shortcode->htmlAttributes() !!} class="shortcode-features shortcode-features-style-5 section-features-9 position-relative">
    <div class="container-fluid position-relative fix section-padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-6 mb-lg-0 mb-8 position-relative z-1">
                    @if ($subtitle = $shortcode->subtitle)
                        <div class="d-flex align-items-center justify-content-center bg-primary-soft d-inline-flex rounded-pill border-white border px-3 py-1">
                            <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true" />
                            <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
                        </div>
                    @endif

                    @if ($title = $shortcode->title)
                        <{{ $titleTag = infinia_title_tag($shortcode, 'h2') }} class=" mt-3 mb-4 fw-black">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
                    @endif

                    @if ($description = $shortcode->description)
                        <p class="mb-6">{!! BaseHelper::clean($description) !!}</p>
                    @endif

                    @if($checklist)
                        <ul class="list-unstyled phase-items">
                            @foreach($checklist as $item)
                                <li>
                                    <div class="phase-item d-flex align-items-center mb-3">
                                        <img src="{{ Theme::asset()->url('images/icons/check-primary.png') }}" alt="{{ $item }}" />
                                        <p class=" mb-0 ms-2 fs-5 text-900">{!! BaseHelper::clean($item) !!}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="col-lg-4 col-md-6 mb-lg-0 mb-8">
                    <div class="position-relative d-inline-block z-2">
                        @if ($floatingCardImage = $shortcode->floating_card_image)
                            {{ RvMedia::image($floatingCardImage, attributes: ['class' => 'rounded-4 border border-3 border-white']) }}
                        @endif

                        @php
                            $floatingCardButtonUrl = $shortcode->floating_card_button_url;
                            $floatingCardButtonLabel = $shortcode->floating_card_button_label;
                        @endphp

                        @if($floatingCardButtonUrl && $floatingCardButtonLabel)
                            <div class="position-absolute bottom-0 start-0 end-0 mb-3 mx-3 backdrop-filter rounded-3 text-start p-3">
                                <a href="{{ $floatingCardButtonUrl }}" class="d-flex align-items-center">
                                    @if ($floatingCardIconImage = $shortcode->floating_card_icon_image)
                                        {{ RvMedia::image($floatingCardIconImage) }}
                                    @endif

                                    <span class="ms-3">
                                        @if ($floatingCardTitle = $shortcode->floating_card_title)
                                            <span class="text-white mb-0 fs-7">{!! BaseHelper::clean($floatingCardTitle) !!}</span>
                                        @endif

                                        <span class="fs-4 d-block">{!! BaseHelper::clean($floatingCardButtonLabel) !!}</span>
                                    </span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                @if ($dataCounters)
                    <div class="col-lg-4 mb-lg-0 mb-8">
                        <div class="px-lg-8">
                            @foreach($dataCounters as $dataCounter)
                                @php
                                    $dataCountTitle = Arr::get($dataCounter, 'data_count_title');
                                    $dataCount = Arr::get($dataCounter, 'data_count');
                                @endphp

                                @continue(! $dataCountTitle || ! $dataCount)

                                <div class="d-flex align-items-center border-bottom pb-5 mt-5">
                                    <span class="h2 count fw-black "><span class="odometer" data-count="{{ $dataCount }}"></span></span>
                                    @if ($dataCounterUnit = Arr::get($dataCounter, 'data_count_unit'))
                                        <span class="fw-medium  fs-4 align-self-start">{!! BaseHelper::clean($dataCounterUnit) !!}</span>
                                    @endif

                                    <p class="ms-3">{!! BaseHelper::clean($dataCountTitle) !!}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
    <div class="bouncing-blobs-container rounded-4 fix">
        <div class="bouncing-blobs-glass rounded-4"></div>
        <div class="bouncing-blobs">
            <div class="bouncing-blob bouncing-blob--green"></div>
            <div class="bouncing-blob bouncing-blob--primary"></div>
            <div class="bouncing-blob bouncing-blob--infor bouncing-blob--infor-2"></div>
        </div>
    </div>
</section>
