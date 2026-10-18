<section class="shortcode-blog-posts shortcode-blog-posts-style-2 section-features-7 bg-neutral-100 section-padding"
    @style($variablesStyle)
>
    <div class="container">
        <div class="row mb-8 mb-lg-6">
            <div class="col-lg-6">
                @if($shortcode->subtitle)
                    <div class="d-flex align-items-center justify-content-center bg-primary-soft border border-2 border-white d-inline-flex rounded-pill px-4 py-2" data-aos="zoom-in" data-aos-delay="50">
                        <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                        <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                    </div>
                @endif
                @if($shortcode->title)
                    <h3 class="ds-3 mt-3 mb-3" data-aos="fade-zoom-in" data-aos-delay="50">{!! BaseHelper::clean($shortcode->title) !!}</h3>
                @endif

                @if ($description = $shortcode->description)
                    <p class="fs-5 fw-medium">
                        {!! BaseHelper::clean($description) !!}
                    </p>
                @endif
            </div>
            <div class="col-lg-2 col-md-3 col-5 ms-auto align-self-end mb-lg-7">
                <div class="position-relative z-0">
                    <div class="swiper-button-prev bg-white ms-lg-7">
                        <i class="bi bi-arrow-left"></i>
                    </div>
                    <div class="swiper-button-next bg-white">
                        <i class="bi bi-arrow-right"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="swiper slider-1 pb-3">
                <div class="swiper-wrapper">
                    @foreach($posts as $post)
                        <div class="swiper-slide">
                            <div class="card border-0 position-relative rounded-3 d-inline-flex card-hover" data-aos="fade-zoom-in" data-aos-delay="{{ $loop->iteration }}00">
                                {{ RvMedia::image($post->image, $post->name, attributes: ['class' => 'rounded-top-3']) }}
                                <div class="card-body bg-white p-6">
                                    @if($post->firstCategory)
                                        <a href="{{ $post->firstCategory->url }}" class="position-absolute z-1 top-0 start-0 m-3 bg-primary-soft border border-2 border-white d-inline-flex rounded-pill px-3 py-1">
                                            <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{{ $post->firstCategory->name }}</span>
                                        </a>
                                    @endif

                                    <strong class="d-block fs-6 mb-3">{{ $post->name }}</strong>

                                    @if ($postDescription = $post->description)
                                        <p class="truncate-3-custom">{!! BaseHelper::clean($postDescription) !!}</p>
                                    @endif

                                    <a href="{{ $post->url }}" class="fw-bold text-primary d-inline-block pt-3 position-relative z-1">{{ __('Keep Reading') }}
                                        <svg class="ms-2" xmlns="http://www.w3.org/2000/svg" width="24" height="14" viewBox="0 0 24 14" fill="none">
                                            <path class="fill-dark" d="M17.4177 0.417969L16.3487 1.48705L21.1059 6.24429H0V7.75621H21.1059L16.3487 12.5134L17.4177 13.5825L24 7.0002L17.4177 0.417969Z" fill="black" />
                                        </svg>
                                    </a>
                                </div>
                                <a href="{{ $post->url }}" title="{{ $post->name }}" class="position-absolute bottom-0 start-0 end-0 top-0 z-0"></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
