@php
    $teamsChunk = $teams->chunk(7);
@endphp

<section {!! $shortcode->htmlAttributes() !!} class="shortcode-teams shortcode-teams-style-4 section-team-4 section-padding position-relative overflow-hidden">
    <div class="container">
        <div class="text-center">
            @if ($subtitle = $shortcode->subtitle)
                <div class="d-flex align-items-center justify-content-center bg-primary-soft border border-2 border-white d-inline-flex rounded-pill px-4 py-2" data-aos="zoom-in" data-aos-delay="50">
                    <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                    <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
                </div>
            @endif

            @if ($title = $shortcode->title)
                <{{ $titleTag = infinia_title_tag($shortcode, 'h3') }} class="ds-3 my-3">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
            @endif

            @if ($description = $shortcode->description)
                <p class="fs-5">{!! BaseHelper::clean($description) !!}</p>
            @endif

        </div>

        @foreach($teamsChunk as $teams)
            <div class="row mt-8 mb-lg-8 m-0">
                @foreach($teams->take(3) as $team)
                    <div class="col-lg-4 col-md-6 mb-lg-4 mb-8 text-center">
                        <div class="position-relative d-inline-block z-1">
                            <div class="zoom-img rounded-3">
                                <a href="{{ $team->url }}">
                                    {{ RvMedia::image($team->photo, $team->name, 'vertical_thumb', attributes: ['class' => 'img-fluid w-100']) }}
                                </a>
                            </div>
                            <div class="hover-up">
                                <a href="{{ $team->url }}" class="card-team text-start rounded-3 position-absolute top-100 translate-middle-y start-0 end-0 w-100 z-1 backdrop-filter w-auto p-4 mx-6 shadow-1">
                                    <strong class="d-block fs-6">{{ $team->name }}</strong>
                                    <span class="d-flex justify-content-between">
                                        @if ($title = $team->title)
                                            <span class="fs-6 text-600 me-auto">{{ $title }}</span>
                                        @endif

                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="14" viewBox="0 0 24 14" fill="#007BFF">
                                            <path d="M17.4177 0.417969L16.3487 1.48705L21.1059 6.24429H0V7.75621H21.1059L16.3487 12.5134L17.4177 13.5825L24 7.0002L17.4177 0.417969Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($teams->count() > 3)
                <div class="row mt-lg-10 mb-4">
                    @foreach($teams->skip(3) as $team)
                        <div class="col-lg-3 col-md-6 mb-lg-4 mb-8 text-center">
                            <div class="position-relative d-inline-block z-1">
                                <div class="zoom-img rounded-3">
                                    <a href="{{ $team->url }}">
                                        {{ RvMedia::image($team->photo, $team->name, 'vertical_thumb', attributes: ['class' => 'img-fluid w-100']) }}
                                    </a>
                                </div>
                                <div class="hover-up">
                                    <a href="{{ $team->url }}" class="card-team text-start rounded-3 position-absolute top-100 translate-middle-y start-0 end-0 w-100 z-1 backdrop-filter w-auto p-4 mx-6 shadow-1">
                                        <strong class="d-block fs-6">{{ $team->name }}</strong>
                                        <span class="d-flex justify-content-between">
                                        @if ($title = $team->title)
                                                <span class="fs-6 text-600 me-auto">{{ $title }}</span>
                                            @endif

                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="14" viewBox="0 0 24 14" fill="#007BFF">
                                            <path d="M17.4177 0.417969L16.3487 1.48705L21.1059 6.24429H0V7.75621H21.1059L16.3487 12.5134L17.4177 13.5825L24 7.0002L17.4177 0.417969Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endforeach
    </div>

    @if ($backgroundImage = $shortcode->background_image)
        <div class="position-absolute top-0 start-50 translate-middle-x z-0">
            {{ RvMedia::image($backgroundImage, infinia_image_alt($shortcode)) }}
        </div>
    @endif
    <div class="rotate-center ellipse-rotate-success position-absolute z-0"></div>
    <div class="rotate-center-rev ellipse-rotate-primary position-absolute z-0"></div>
</section>
