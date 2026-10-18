<section {!! $shortcode->htmlAttributes() !!} class="shortcode-projects shortcode-projects-style-2 section-project-2 pt-120 pb-8">
    <div class="container">
        <div class="row mb-8">
            <div class="col-lg-6">
                @if ($subtitle = $shortcode->subtitle)
                    <div class="d-flex align-items-center justify-text-center bg-primary-soft border border-2 border-white d-inline-flex rounded-pill px-3 py-1">
                        <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                        <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
                    </div>
                @endif

                @if ($title = $shortcode->title)
                    <{{ $titleTag = infinia_title_tag($shortcode, 'h2') }} class="ds-3 mt-3 mb-3">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
                @endif

                @if ($description = $shortcode->description)
                    <p class="fs-5 fw-medium">{!! BaseHelper::clean($description) !!}</p>
                @endif
            </div>
            <div class="col-lg-2 col-md-3 col-6 ms-auto align-self-end mb-lg-7 mt-lg-0 mt-4">
                <div class="position-relative z-0">
                    <div class="swiper-button-prev shadow bg-white ms-lg-7">
                        <i class="bi bi-arrow-left"></i>
                    </div>
                    <div class="swiper-button-next shadow bg-white">
                        <i class="bi bi-arrow-right"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="swiper slider-1 pt-2 pb-8">
                <div class="swiper-wrapper">
                    @foreach($projects as $project)
                        <div class="swiper-slide">
                            <div class="text-center">
                                <div class="zoom-img position-relative d-inline-block z-1">
                                    <div class="rounded-3 fix">
                                        {{ RvMedia::image($project->image, $project->name, 'vertical_thumb', attributes: ['class' => 'img-fluid w-100']) }}
                                    </div>
                                    <a href="{{ $project->url }}" class="card-team text-start rounded-3 position-absolute bottom-0 start-0 end-0 z-1 backdrop-filter w-auto p-4 m-4 hover-up">
                                        @if($project->client)
                                            <p class="fs-7 text-primary mb-1">{{ $project->client }}</p>
                                        @endif
                                        <strong class="d-block fs-6">{{ $project->name }}</strong>
                                        @if ($projectDescription = $project->description)
                                            <p class="text-900 truncate-3-custom">{!! BaseHelper::clean($projectDescription) !!}</p>
                                        @endif
                                    </a>
                                    @if ($place = $project->place)
                                        <a href="{{ $project->url }}" class="badge text-primary bg-white px-3 py-2 rounded-pill m-4 fs-7 position-absolute top-0 end-0 z-1">{{ $place }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
