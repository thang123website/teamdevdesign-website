<section {!! $shortcode->htmlAttributes() !!} class="shortcode-hero-banner shortcode-hero-banner-style-1 hero-banner position-relative overflow-hidden section-padding">
    <div class="container">
        <div class="row content align-items-center">
            <div class="col-lg-6 col-md-12 mb-lg-0 mb-5">
                <div class="pe-2">
                    @if($shortcode->subtitle)
                        <div class="d-flex align-items-center bg-linear-1 d-inline-flex rounded-pill px-2 py-1">
                            <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                            <span class="fs-7 fw-medium text-primary mx-2">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19" fill="none">
                                <path d="M10.3125 5.5625L14.4375 9.5L10.3125 13.4375" stroke="#6342EC" stroke-width="1.125" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M14.25 9.5H3.5625" stroke="#6342EC" stroke-width="1.125" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    @endif
                    @if($shortcode->title)
                        <{{ $titleTag = infinia_title_tag($shortcode, 'h3') }} class="ds-3 mt-4 mb-5" data-aos="fade-zoom-in" data-aos-delay="0">{!! infinia_clean_title($shortcode->title) !!}</{{ $titleTag }}>
                    @endif
                    @if($shortcode->description)
                        <p class="pe-10 mb-5" data-aos="fade-zoom-in" data-aos-delay="100">{!! BaseHelper::clean($shortcode->description) !!}</p>
                    @endif
                    @if($shortcode->primary_action_label)
                        <a href="{{ $shortcode->primary_action_url }}" class="btn btn-gradient" data-aos="fade-zoom-in" data-aos-delay="100">
                            {{ $shortcode->primary_action_label }}
                            @if($shortcode->primary_action_icon)
                                <x-core::icon :name="$shortcode->primary_action_icon" />
                            @endif
                        </a>
                    @endif
                    @if($shortcode->secondary_action_label)
                        <a href="{{ $shortcode->secondary_action_url }}" class="ms-md-3 ms-2 btn btn-outline-secondary hover-up" data-aos="fade-zoom-in" data-aos-delay="100">
                            @if($shortcode->secondary_action_icon)
                                <x-core::icon :name="$shortcode->secondary_action_icon" />
                            @endif
                            {{ $shortcode->secondary_action_label }}
                        </a>
                    @endif
                    @if($shortcode->bottom_image)
                        {{ RvMedia::image($shortcode->bottom_image, infinia_image_alt($shortcode), attributes: ['style' => 'width: 100%; max-width: 26rem; margin-top: 20px']) }}
                    @endif
                </div>
            </div>
            <div class="col-lg-6 position-relative justify-content-center">
                @if($shortcode->right_background_image)
                    {{ RvMedia::image($shortcode->right_background_image, infinia_image_alt($shortcode), attributes: ['class' => 'hero-img']) }}
                @endif
                @foreach(range(1, 3) as $i)
                    @php
                        $image = $shortcode->{"shape_{$i}_image"};

                        if (! $image) {
                            continue;
                        }
                    @endphp

                    <div @class(["shape-{$i}", 'position-absolute', 'd-none d-md-block' => ! $loop->first])>
                        {{ RvMedia::image($image, infinia_image_alt($shortcode), attributes: ['data-aos' => 'zoom-in', 'data-aos-delay' => $i * 100, 'class' => $loop->first ? 'rightToLeft' : '']) }}
                    </div>
                @endforeach
                @if($shortcode->floating_card_image)
                    <div class="alltuchtopdown card-hero backdrop-filter rounded-3 text-center d-inline-block p-3 position-absolute">
                        {{ RvMedia::image($shortcode->floating_card_image, infinia_image_alt($shortcode), attributes: ['class' => 'rounded-3']) }}
                        @if($shortcode->floating_card_title)
                            <strong class="d-block fs-6 mt-3">{{ $shortcode->floating_card_title }}</strong>
                        @endif
                        @if($shortcode->floating_card_description)
                            <p class="fs-7 text-700">
                                {!! BaseHelper::clean(nl2br($shortcode->floating_card_description)) !!}
                            </p>
                        @endif
                        @if($shortcode->floating_card_button_label)
                            <a href="{{ $shortcode->floating_card_button_url }}" class="shadow-sm d-flex align-items-center bg-white d-inline-flex rounded-pill px-2 py-1 mb-3">
                                <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                                <span class="fs-7 fw-medium text-primary mx-2">{{ $shortcode->floating_card_button_label }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19" fill="none">
                                    <path d="M10.3125 5.5625L14.4375 9.5L10.3125 13.4375" stroke="#6D4DF2" stroke-width="1.125" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M14.25 9.5H3.5625" stroke="#6D4DF2" stroke-width="1.125" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
