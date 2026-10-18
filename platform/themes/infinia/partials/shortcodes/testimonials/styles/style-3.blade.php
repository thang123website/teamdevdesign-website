@php
    $avatars = $testimonials->pluck('name', 'image')->all();
    $avatarChunks = array_chunk($avatars, ceil(count($avatars) / 2), true);
@endphp

<section {!! $shortcode->htmlAttributes() !!} class="shortcode-testimonials shortcode-testimonials-style-3 section-testimonial-4 section-padding position-relative overflow-hidden">
    <div class="container position-relative z-1">
        <div class="text-center">
            @if ($subtitle = $shortcode->subtitle)
                <div class="d-flex align-items-center justify-content-center bg-primary-soft border border-2 border-white d-inline-flex rounded-pill px-4 py-2" data-aos="zoom-in" data-aos-delay="50">
                    <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                    <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
                </div>
            @endif

            @if ($title = $shortcode->title)
                <{{ $titleTag = infinia_title_tag($shortcode, 'h5') }} class="ds-3 my-3">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
            @endif

            @if ($description = $shortcode->description)
                <p class="fs-5">{!! BaseHelper::clean($description) !!}</p>
            @endif
        </div>

        @if($avatarChunks)
            @foreach($avatarChunks as $avatars)
                <div @class(['row justify-content-center', 'd-none d-lg-flex' => $loop->last, 'mt-8' => $loop->first])>
                    @foreach($avatars as $avatar => $name)
                        @continue(! $avatar)
                        <div class="avatar-xxl rounded-circle" title="{{ $name }}">
                            {{ RvMedia::image($avatar, $name, 'thumb', attributes: ['class' => 'assessor rounded-circle border border-5 border-primary-soft']) }}
                        </div>
                    @endforeach
                </div>
            @endforeach
        @endif

        <div class="row mt-6">
            <div class="col-lg-6 mx-auto text-center">
                <div class="swiper slider-two pt-2 pb-3">
                    <div class="swiper-wrapper">
                        @foreach($testimonials as $testimonial)
                            <div class="swiper-slide">
                                <div class="px-lg-6">
                                    <div class="d-flex flex-column">
                                        <strong class="d-block fs-6 ms-3 mb-0">{{ $testimonial->name }}</strong>
                                        <div class="flag ms-3">
                                            @if ($company = $testimonial->company)
                                                <span class="fs-8">{{ $company }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    @if ($content = $testimonial->content)
                                        <p class="text-900 mt-5">{!! BaseHelper::clean($content) !!}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>

    @if($shortcode->background_image)
        <div class="position-absolute top-0 start-50 translate-middle-x z-0">
            {{ RvMedia::image($shortcode->background_image, infinia_image_alt($shortcode)) }}
        </div>
    @endif
    <div class="rotate-center ellipse-rotate-success position-absolute z-0"></div>
    <div class="rotate-center-rev ellipse-rotate-primary position-absolute z-0"></div>
</section>
