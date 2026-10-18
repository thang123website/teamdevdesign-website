@php
    $keyId = 'faq-' . uniqid();
@endphp

<section {!! $shortcode->htmlAttributes() !!} class="shortcode-faqs shortcode-faqs-style-3 section-faqs-1 section-padding position-relative">
    <div class="container position-relative z-2">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="text-start">
                    @if ($subtitle = $shortcode->subtitle)
                        <div class="d-flex align-items-center position-relative z-2 justify-content-center bg-primary-soft d-inline-flex rounded-pill border border-2 border-white px-3 py-1">
                            <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true" />
                            <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
                        </div>
                    @endif

                    @if ($title = $shortcode->title)
                        <{{ $titleTag = infinia_title_tag($shortcode, 'h3') }} class="ds-3 my-3 fw-bold">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
                    @endif

                    @php
                        $image = $shortcode->image;
                        $image1 = $shortcode->image_1;
                    @endphp

                    @if ($image || $image1)
                        <div class="position-relative d-inline-block mt-3 mb-6">
                            @if ($image)
                                {{ RvMedia::image($image, infinia_image_alt($shortcode), attributes: ['class' => 'rounded-pill border border-3 border-white']) }}
                            @endif

                            @if ($image1)
                                {{ RvMedia::image($image1, infinia_image_alt($shortcode), attributes: ['class' => 'position-absolute z-1 top-0 start-50 mt-3 rounded-pill border border-3 border-white']) }}
                            @endif
                        </div>
                    @endif

                    @if ($description = $shortcode->description)
                        <p class="fs-5 mb-0">{!! BaseHelper::clean($description) !!}</p>
                    @endif

                    @php
                        $primaryButtonLabel = $shortcode->primary_action_label;
                        $primaryButtonUrl = $shortcode->primary_action_url;

                        $secondaryButtonLabel = $shortcode->secondary_action_label;
                        $secondaryButtonUrl = $shortcode->secondary_action_url;
                    @endphp

                    @if (($primaryButtonLabel && $primaryButtonUrl) || ($secondaryButtonLabel && $secondaryButtonUrl))
                        <div class="d-flex align-items-center mt-5">
                            <a href="{{ $primaryButtonUrl }}" class="btn btn-gradient">
                                {!! BaseHelper::clean($primaryButtonLabel) !!}

                                @if($shortcode->primary_action_icon)
                                    <x-core::icon class="ms-2" :name="$shortcode->primary_action_icon" />
                                @endif
                            </a>
                            @if($secondaryButtonUrl && $secondaryButtonLabel)
                                <a href="{{ $secondaryButtonUrl }}" class="ms-5 fw-bold" data-aos="fade-zoom-in" data-aos-delay="100">
                                    @if($shortcode->secondary_action_icon)
                                        <x-core::icon :name="$shortcode->secondary_action_icon" />
                                    @endif
                                    {{ $secondaryButtonLabel }}
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            @if($faqs->isNotEmpty())
                <div class="col-lg-6 mt-lg-0 mt-8 ">
                    <div class="accordion">
                        @foreach($faqs as $faq)
                            <div class="mb-3 card p-3 border  bg-white rounded-2 shadow-2">
                                <div class="px-0 card-header border-0 bg-gradient-1">
                                    <a class="collapsed text-900 fw-bold d-flex align-items-center" data-bs-toggle="collapse" href="#{{ $keyId }}-{{ $faq->getKey() }}">
                                        <strong class="d-block fs-6 m-0">{!! BaseHelper::clean($faq->question) !!}</strong>
                                        <span class="ms-auto arrow me-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="8" viewBox="0 0 13 8" fill="none">
                                                <path class="stroke-dark" d="M11.5 1L6.25 6.5L1 1" stroke="#111827" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </a>
                                </div>
                                <div id="{{ $keyId }}-{{ $faq->getKey() }}" @class(['collapse', 'show' => $loop->first]) data-bs-parent=".accordion">
                                    <p class="ps-0card-body">{!! BaseHelper::clean($faq->answer) !!}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
