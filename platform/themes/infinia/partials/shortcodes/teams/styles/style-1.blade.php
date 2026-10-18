<section {!! $shortcode->htmlAttributes() !!} class="shortcode-teams shortcode-teams-style-1 section-team-1 section-padding position-relative overflow-hidden">
    <div class="container">
        <div class="row position-relative z-1">
            <div class="text-center">
                @if($shortcode->subtitle)
                    <div class="d-flex align-items-center justify-content-center bg-primary-soft border border-2 border-white d-inline-flex rounded-pill px-4 py-2" data-aos="zoom-in" data-aos-delay="50">
                        <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                        <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                    </div>
                @endif
                @if($shortcode->title)
                    <{{ $titleTag = infinia_title_tag($shortcode, 'h3') }} class="ds-3 my-3" data-aos="fade-zoom-in" data-aos-delay="100">{!! infinia_clean_title($shortcode->title) !!}</{{ $titleTag }}>
                @endif
                @if($shortcode->description)
                    <p class="fs-5" data-aos="fade-zoom-in" data-aos-delay="100">
                        {!! BaseHelper::clean(nl2br($shortcode->description)) !!}
                    </p>
                @endif
            </div>
        </div>
        <div class="row mt-6">
            @php
                $index = 1;
            @endphp
            @foreach($teams as $team)
                @php
                    $index = $index >= 4 ? 1 : $index + 1;
                @endphp
                <div class="col-lg-3 col-md-6 mb-lg-4 mb-7 text-center" data-aos="fade-zoom-in" data-aos-delay="{{ $index }}00">
                    <div class="position-relative d-inline-block z-1">
                        <div class="zoom-img rounded-3">
                            {{ RvMedia::image($team->photo, $team->name, attributes: ['class' => 'img-fluid w-100']) }}
                        </div>
                        <a href="{{ $team->url }}" class="card-team text-start rounded-3 position-absolute bottom-0 start-0 end-0 z-1 backdrop-filter w-auto p-4 m-3 hover-up">
                            @if($team->name)
                                <strong class="d-block fs-6">{{ $team->name }}</strong>
                            @endif
                            <div class="d-flex">
                                @if($team->title)
                                    <span class="fs-6 text-600 me-auto">{{ $team->title }}</span>
                                @endif
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="14" viewBox="0 0 24 14" fill="#007BFF">
                                    <path class="fill-white" d="M17.4177 0.417969L16.3487 1.48705L21.1059 6.24429H0V7.75621H21.1059L16.3487 12.5134L17.4177 13.5825L24 7.0002L17.4177 0.417969Z" fill="white" />
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
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
