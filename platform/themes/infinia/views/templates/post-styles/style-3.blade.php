<section class="shortcode-blog-posts shortcode-blog-posts-style-3 section-blog-2 position-relative section-padding fix"
    @style($variablesStyle)
>
    <div class="container position-relative z-1">
        <div class="row">
            <div class="col-lg-4">
                <div class="pe-6">
                    @if ($subtitle = $shortcode->subtitle)
                        <div class="d-flex align-items-center justify-content-center bg-primary-soft border border-2 border-white d-inline-flex rounded-pill px-4 py-2" data-aos="zoom-in" data-aos-delay="50">
                            <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                            <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
                        </div>
                    @endif

                    @if ($title = $shortcode->title)
                        <h3 class="ds-3 mt-3 mb-3" data-aos="fade-zoom-in" data-aos-delay="0">{!! BaseHelper::clean($title) !!}</h3>
                    @endif

                    @if ($description = $shortcode->description)
                        <span class="fs-5 fw-medium" data-aos="fade-zoom-in" data-aos-delay="0">{!! BaseHelper::clean($description) !!}</span>
                    @endif


                    @if (($actionLabel = $shortcode->action_label) && ($actionUrl = $shortcode->action_url))
                        <div class="d-flex align-items-center mt-8">
                            <a href="{{ $actionUrl }}" class="fw-bold btn bg-white text-primary hover-up">
                                {!! BaseHelper::clean($actionLabel) !!}
                                <svg class="ms-2" xmlns="http://www.w3.org/2000/svg" width="24" height="14" viewBox="0 0 24 14" fill="none">
                                    <path class="fill-dark" d="M17.4177 0.417969L16.3487 1.48705L21.1059 6.24429H0V7.75621H21.1059L16.3487 12.5134L17.4177 13.5825L24 7.0002L17.4177 0.417969Z" fill="black"></path>
                                </svg>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="swiper slider-one p-2 mt-lg-0 mt-5">
                        <div class="swiper-wrapper">
                            @foreach($posts as $post)
                                <div class="swiper-slide">
                                    <div class="card border-0 position-relative rounded-3 d-inline-flex card-hover" data-aos="fade-zoom-in" data-aos-delay="{{ $loop->iteration }}00">
                                        {{ RvMedia::image($post->image, $post->name, attributes: ['class' => 'rounded-top-3']) }}
                                        <div class="card-body bg-white">
                                            @if($post->firstCategory)
                                                <a href="{{ $post->firstCategory->url }}" class="bg-primary-soft position-relative z-1 d-inline-flex rounded-pill px-3 py-2 mt-3">
                                                    <span class="tag-spacing fs-7 fw-bold text-linear-2">{{ $post->firstCategory->name }}</span>
                                                </a>
                                            @endif

                                            <strong class="d-block fs-6 my-3">{{ $post->name }}</strong>

                                            @if ($postDescription = $post->description)
                                                <p class="truncate-3-custom">{!! BaseHelper::clean($postDescription) !!}</p>
                                            @endif
                                        </div>
                                        <a href="{{ $post->url }}" title="{{ $post->name }}" class="position-absolute bottom-0 start-0 end-0 top-0 z-0"></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($backgroundImage = $shortcode->background_image)
        <div class="position-absolute top-0 start-50 translate-middle-x z-0">
            {{ RvMedia::image($backgroundImage) }}
        </div>
    @endif

    <div class="bouncing-blobs-container">
        <div class="bouncing-blobs-glass"></div>
        <div class="bouncing-blobs">
            <div class="bouncing-blob bouncing-blob--green"></div>
            <div class="bouncing-blob bouncing-blob--primary"></div>
        </div>
    </div>
</section>
