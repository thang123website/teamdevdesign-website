<section {!! $shortcode->htmlAttributes() !!} class="shortcode-our-history shortcode-our-history-style-3 section-cta-4 pb-110">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 text-center">
                <div class="text-center rounded-4 position-relative d-inline-flex">
                    <div class="zoom-img rounded-4 position-relative z-1">
                        @if ($image = $shortcode->image)
                            {{ RvMedia::image($image, infinia_image_alt($shortcode), attributes: ['class' => 'rounded-4']) }}
                        @endif

                        @if(($floatingButtonLabel = $shortcode->floating_action_label) && ($floatingButtonUrl = $shortcode->floating_action_url))
                            <div class="position-absolute top-50 start-50 translate-middle z-2">
                                <a href="{{ $floatingButtonUrl }}" class="d-inline-flex align-items-center rounded-4 text-nowrap backdrop-filter px-3 py-2 popup-video hover-up me-3 shadow-1">
                                    @if($floatingActionIcon = $shortcode->floating_action_icon)
                                        <span class="backdrop-filter me-2 icon-shape icon-md rounded-circle">
                                            <x-core::icon :name="$floatingActionIcon" />
                                        </span>
                                    @endif

                                    <span class="fw-bold fs-7 text-900">
                                        {!! BaseHelper::clean($floatingButtonLabel) !!}
                                    </span>
                                </a>
                            </div>
                        @endif

                    </div>
                    <div class="position-absolute top-100 start-0 translate-middle z-0 pt-5">
                        <img class="alltuchtopdown" src="{{ Theme::asset()->url('images/shapes/vector-2.png') }}" alt="" aria-hidden="true">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-lg-0 mt-8">
                @if ($subtitle = $shortcode->subtitle)
                    <strong class="d-block fs-6 text-primary">{!! BaseHelper::clean($subtitle) !!}</strong>
                @endif

                @if ($title = $shortcode->title)
                    <{{ $titleTag = infinia_title_tag($shortcode, 'h2') }} class="ds-5 my-3">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
                @endif

                @if ($description = $shortcode->description)
                    <p class="fs-5 text-500">{!! BaseHelper::clean($description) !!}</p>
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
                    $primaryButtonLabel = $shortcode->primary_action_label;
                    $primaryButtonUrl = $shortcode->primary_action_url;

                    $secondaryButtonLabel = $shortcode->secondary_action_label;
                    $secondaryButtonUrl = $shortcode->secondary_action_url;
                @endphp

                @if(($primaryButtonLabel && $primaryButtonUrl) || ($secondaryButtonLabel && $secondaryButtonUrl))
                    <div class="row mt-8">
                        <div class="d-flex align-items-center">
                            @if ($primaryButtonLabel && $primaryButtonUrl)
                                <a href="{{ $primaryButtonUrl }}" class="btn btn-gradient">
                                    {!! BaseHelper::clean($primaryButtonLabel) !!}
                                    @if($shortcode->primary_action_icon)
                                        <x-core::icon class="ms-2" :name="$shortcode->primary_action_icon" />
                                    @endif
                                </a>
                            @endif

                            @if ($secondaryButtonUrl && $secondaryButtonLabel)
                                <a href="{{ $secondaryButtonUrl }}" class="ms-5 text-decoration-underline fw-bold">
                                    {!! BaseHelper::clean($secondaryButtonLabel) !!}
                                    @if($shortcode->secondary_action_icon)
                                        <x-core::icon class="ms-2" :name="$shortcode->secondary_action_icon" />
                                    @endif
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
