<section {!! $shortcode->htmlAttributes() !!} class="shortcode-teams shortcode-teams-style-2 section-team-5 section-padding position-relative">
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
                    <{{ $titleTag = infinia_title_tag($shortcode, 'h3') }} class="ds-3 my-3 fw-regular">
                        {!! infinia_clean_title($title) !!}
                    </{{ $titleTag }}>
                @endif

                @if ($description = $shortcode->description)
                    <p class="fs-5">
                        {!! BaseHelper::clean(nl2br($description)) !!}
                    </p>
                @endif
            </div>
        </div>
        <div class="row mt-6">
            @foreach($teams as $team)
                <div class="col-lg-3 col-md-6 text-center mb-8">
                    <div class="card-team position-relative d-inline-block hover-up">
                        <div class="zoom-img bg-primary-soft rounded-3">
                            <a href="{{ $team->url }}">
                                {{ RvMedia::image($team->photo, $team->name, attributes: ['class' => 'img-fluid w-100']) }}
                            </a>
                        </div>
                        <div class="d-flex">
                            <div>
                                <strong class="d-block fs-6 pt-3">
                                    <a href="{{ $team->url }}" class="text-900">{{ $team->name }}</a>
                                </strong>
                                @if($team->title)
                                    <p class="mb-0 text-start">{{ $team->title }}</p>
                                @endif

                            </div>
                            <div class="arrow-icon bg-white icon-shape icon-sm rounded-circle border text-end ms-auto mt-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M17.25 15.25V6.75H8.75" stroke="#6D4DF2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M17 7L6.75 17.25" stroke="#6D4DF2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>
                        </div>
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
