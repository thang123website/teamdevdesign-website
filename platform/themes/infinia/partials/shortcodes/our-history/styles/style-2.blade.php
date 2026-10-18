<section {!! $shortcode->htmlAttributes() !!} class="shortcode-our-history shortcode-our-history-style-2 section-cta-2 bg-3 position-relative section-padding fix">
    <div class="container">
        <div class="text-center mb-8">
            @if ($subtitle = $shortcode->subtitle)
                <div class="d-flex align-items-center justify-content-center bg-primary-soft border border-2 border-white d-inline-flex rounded-pill px-4 py-2" data-aos="zoom-in" data-aos-delay="50">
                    <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">

                    <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
                </div>
            @endif

            @if ($title = $shortcode->title)
                <{{ $titleTag = infinia_title_tag($shortcode, 'h3') }} class="ds-3 my-3 fw-regular">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
            @endif
        </div>
        <div class="row">
            <div class="col-lg-5 pe-lg-0">
                <div class="bg-linear-1 text-center rounded-4 position-relative">
                    @if ($image = $shortcode->image)
                        {{ RvMedia::image($image, infinia_image_alt($shortcode), attributes: ['class' => 'rounded-4 border border-2 border-white mb-10 mt-5']) }}
                    @endif

                    @php
                        $primaryButtonLabel = $shortcode->default_action_label;
                        $primaryButtonUrl = $shortcode->default_action_url;
                    @endphp

                    @if ($primaryButtonLabel && $primaryButtonUrl)
                        <div class="position-absolute bottom-0 left-0 mb-3 w-100">
                            <a href="{{ $primaryButtonUrl }}" class="d-inline-flex align-items-center rounded-4 text-nowrap backdrop-filter px-3 py-2 popup-video hover-up me-3 shadow-1">
                                @if($shortcode->default_action_icon)
                                    <span class="backdrop-filter me-2 icon-shape icon-md rounded-circle">
                                        <x-core::icon :name="$shortcode->default_action_icon" />
                                    </span>
                                @endif
                            <span class="fw-bold fs-7 text-900">{!! BaseHelper::clean($primaryButtonLabel) !!}</span>
                            </a>
                        </div>
                    @endif

                    <div class="position-absolute top-0 end-0">
                        <img class="flickering" src="{{ Theme::asset()->url('images/icons/star-5.png') }}" alt="" aria-hidden="true">
                    </div>
                    <div class="position-absolute bottom-0 start-0">
                        <img class="alltuchtopdown" src="{{ Theme::asset()->url('images/icons/star-3.png') }}" alt="" aria-hidden="true">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 offset-lg-1 ps-lg-0 pe-lg-5 mt-lg-0 mt-6">
                @if ($contentTitle = $shortcode->content_title)
                    <h5 class="ds-5">{!! BaseHelper::clean($contentTitle) !!}</h5>
                @endif

                @if ($contentDescription = $shortcode->content_description)
                    <p class="fs-5 text-500">{!! BaseHelper::clean($contentDescription) !!}</p>
                @endif

                @if($features)
                    @php
                        $featuresChunk = array_chunk($features, ceil(count($features) / 2));
                    @endphp
                    <div class="d-md-flex align-items-center mt-4 mb-5">
                        @foreach($featuresChunk as $features)
                            <ul @class(['list-unstyled phase-items mb-0', 'ms-md-5' => $loop->last])>
                                @foreach($features as $feature)
                                    @continue(! $featureTitle = Arr::get($feature, 'title'))
                                    <li class="d-flex align-items-center mt-3">
                                        <img src="{{ Theme::asset()->url('images/icons/check.png') }}" alt="" aria-hidden="true">
                                        <span class="ms-2 text-900 fw-medium fs-6">{!! BaseHelper::clean($featureTitle) !!}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endforeach
                    </div>
                @endif

                @php
                    $authorName = $shortcode->author_name;
                    $authorAvatar = $shortcode->author_avatar;
                @endphp

                <div class="row position-relative mt-5 mt-md-0">
                    @if ($authorName && $authorAvatar)
                        <div class="col-md-6 d-flex align-items-center">
                            <div class="rounded-circle">
                                {{ RvMedia::image($authorAvatar, $authorName, attributes: ['class' => 'rounded-circle border border-5 border-primary-light']) }}
                            </div>
                            <div class="ms-3">
                                @if($authorSignature = $shortcode->author_signature)
                                    {{ RvMedia::image($authorSignature, $authorName, attributes: ['class' => 'filter-invert']) }}
                                @endif

                                <strong class="d-block fs-6 mt-1">{!! BaseHelper::clean($authorName) !!}
                                    @if($authorTitle = $shortcode->author_title)
                                        <span class="text-500 fs-6">, {!! BaseHelper::clean($authorTitle) !!}</span>
                                    @endif
                                </strong>
                            </div>
                        </div>
                    @endif

                    @php
                        $dataCountTitle = $shortcode->data_count_title;
                        $dataCount = $shortcode->data_count;
                        $dataCountUnit = $shortcode->data_count_unit;
                    @endphp

                    @if ($dataCountTitle && $dataCount)
                        <div class="col-md-6 d-flex align-items-center">
                            <span class="line-verticarl border-start h-50 pe-8 position-absolute top-50 start-50 translate-middle d-none d-md-block"></span>
                            <div class="counter-item-cover counter-item">
                                <div class="content text-center mx-auto">
                                    <h2 class="count ds-2 fw-black text-primary">
                                        @if ($dataCountUnit)
                                            {!! BaseHelper::clean($dataCountUnit) !!}
                                        @endif
                                        <span class="odometer" data-count="{{ $dataCount }}"></span>
                                    </h2>
                                </div>
                            </div>
                            <p class="ms-3 fs-5">{!! BaseHelper::clean($dataCountTitle) !!}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
