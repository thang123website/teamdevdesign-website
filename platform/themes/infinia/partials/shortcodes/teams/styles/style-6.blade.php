<section {!! $shortcode->htmlAttributes() !!} class="shortcode-teams shortcode-teams-style-6 section-team-3 section-padding overflow-hidden position-relative">
    <div class="container">
        <div class="row position-relative z-1">
            <div class="text-center">
                @if ($subtitle = $shortcode->subtitle)
                    <div class="d-flex align-items-center justify-content-center bg-primary-soft border border-2 border-white d-inline-flex rounded-pill px-4 py-2" data-aos="zoom-in" data-aos-delay="50">
                        <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                        <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
                    </div>
                @endif

                @if ($title = $shortcode->title)
                    <{{ $titleTag = infinia_title_tag($shortcode, 'h2') }} class="ds-3 my-3">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
                @endif

                @if ($description = $shortcode->description)
                    <p>{!! BaseHelper::clean($description) !!}</p>
                @endif
            </div>
        </div>
        <div class="row mt-6">
            <div class="swiper slider-2 px-1">
                <div class="swiper-wrapper">
                    <!-- prettier-ignore -->
                    @foreach($teams as $team)
                        <div class="swiper-slide">
                            <div class="position-relative z-1">
                                <div class="zoom-img rounded-4">
                                    <a href="{{ $team->url }}">
                                        {{ RvMedia::image($team->photo, $team->name, 'vertical_thumb', attributes: ['class' => 'img-fluid w-100']) }}
                                    </a>
                                </div>
                                <a href="{{ $team->url }}" class="card-team text-start rounded-4 position-absolute bottom-0 start-0 end-0 z-1 p-4">
                                    <div class="position-relative z-1">
                                        <strong class="d-block fs-6 text-white">{{ $team->name }}</strong>
                                        <div class="d-flex">
                                            @if ($title = $team->title)
                                                <span class="fs-7 text-white me-auto">{{ $title }}</span>
                                            @endif

                                            <div class="arrow-icon bg-white-keep icon-shape icon-sm rounded-circle">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M17.25 15.25V6.75H8.75" stroke="#6D4DF2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M17 7L6.75 17.25" stroke="#6D4DF2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="bg-primary opacity-75 position-absolute bottom-0 start-0 end-0 top-0 z-0 rounded-4"></span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @if ($backgroundImage = $shortcode->background_image)
        <div class="position-absolute top-0 start-50 translate-middle-x z-0">
            {{ RvMedia::image($backgroundImage, infinia_image_alt($shortcode)) }}
        </div>
    @endif
    <div class="rotate-center ellipse-rotate-success position-absolute z-0"></div>
    <div class="rotate-center-rev ellipse-rotate-primary position-absolute z-0"></div>
</section>
