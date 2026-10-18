<section {!! $shortcode->htmlAttributes() !!} class="shortcode-features shortcode-features-style-6">
    <div class="container-fluid position-relative section-padding">
        <div class="container">
            <div class="row align-items-center">
                @php
                    $floatingCardTitle = $shortcode->floating_card_title;
                    $floatingCardImage = $shortcode->floating_card_image;
                @endphp

                <div class="col-lg-6 text-lg-start text-center">
                    <div class="position-relative z-1 d-inline-block mb-lg-0 mb-8">
                        @if ($image = $shortcode->image)
                            {{ RvMedia::image($image, infinia_image_alt($shortcode), attributes: ['class' => 'rounded-4 position-relative z-1']) }}
                        @endif

                        <div class="position-absolute bottom-0 start-md-100 start-0 translate-middle-md-x mb-md-8 backdrop-filter rounded-4 px-7 py-4 text-center z-1">
                            @if ($floatingCardTitle)
                                <p class="pt-2">{!! BaseHelper::clean($floatingCardTitle) !!}</p>
                            @endif

                            @if($floatingCardImage)
                                <div class="d-flex align-items-center justify-content-center py-4">
                                    {{ RvMedia::image($floatingCardImage, infinia_image_alt($shortcode), attributes: ['style' => 'max-width: 10.5rem']) }}
                                </div>
                            @endif
                        </div>
                        <div class="position-absolute top-0 start-0 translate-middle z-0 pt-5">
                            <img class="alltuchtopdown" src="{{ Theme::asset()->url('images/shapes/vector-2.png') }}" alt="" aria-hidden="true">
                        </div>
                    </div>
                </div>


                <div class="col-lg-6 mt-lg-0 mt-5">
                    @if ($title = $shortcode->title)
                        <{{ $titleTag = infinia_title_tag($shortcode, 'h2') }} class="ds-5">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
                    @endif

                    @if ($description = $shortcode->description)
                        <p class="fs-5 my-4">{!! BaseHelper::clean($description) !!}</p>
                    @endif

                    @if ($features)
                        <div class="accordion">
                            @foreach($features as $feature)
                                @php
                                    $featureTitle = Arr::get($feature, 'title');
                                    $featureDescription = Arr::get($feature, 'description');
                                @endphp

                                @continue(! $featureTitle || ! $featureDescription)

                                <div class="px-0 card p-3 border-0 border-bottom bg-transparent rounded-0">
                                    <div class="px-0 card-header border-0 bg-gradient-1">
                                        <a class="collapsed text-900 fw-bold d-flex align-items-center" data-bs-toggle="collapse" href="#{{ Str::slug($featureTitle) }}">
                                            <span class="icon-shape icon-xs fs-7 rounded-circle d-none d-md-block me-3 bg-primary text-white">1</span>
                                            <strong class="d-block fs-6 m-0">{!! BaseHelper::clean($featureTitle) !!}</strong>
                                            <span class="ms-auto arrow me-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="8" viewBox="0 0 13 8" fill="none">
                                                <path class="stroke-dark" d="M11.5 1L6.25 6.5L1 1" stroke="#111827" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                        </a>
                                    </div>
                                    <div id="{{ Str::slug($featureTitle) }}" @class(['collapse', 'show' => $loop->first]) data-bs-parent=".accordion">
                                        <p class="px-0 card-body fs-6 text-600">{!! BaseHelper::clean($featureDescription) !!}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
