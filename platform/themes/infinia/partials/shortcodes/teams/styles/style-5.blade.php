<section {!! $shortcode->htmlAttributes() !!} class="shortcode-teams shortcode-teams-style-5 section-team-2 section-padding position-relative">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="text-start mb-lg-0 mb-lg-5 mb-10">
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
                        <p class="fs-5 mb-0">{!! BaseHelper::clean($description) !!}</p>
                    @endif

                    @if (count($tabs))
                        <div class="row">
                            @foreach($tabs as $tab)
                                @continue(! $tabTitle = Arr::get($tab, 'title'))
                                <div class="col-lg-6 tab-item">
                                    <div class="d-flex align-items-center mt-8">
                                        @if ($iconImage = Arr::get($tab, 'icon_image'))
                                            {{ RvMedia::image($iconImage, $tabTitle, attributes: ['class' => 'icon']) }}
                                        @elseif($icon = Arr::get($tab, 'icon'))
                                            <x-core::icon :name="$icon"/>
                                        @endif

                                        <div class="ms-3">
                                            @if ($tabSubtitle = Arr::get($tab, 'subtitle'))
                                                <p class="fs-7">{{ $tabSubtitle }}</p>
                                            @endif

                                            @if ($tabUrl = Arr::get($tab, 'url'))
                                                <a href="{{ $tabUrl }}" class="text-decoration-none">
                                                    <div class="h5 mb-0">{!! BaseHelper::clean($tabTitle) !!}</div>
                                                </a>
                                            @else
                                                <h5 class="h5 mb-0">{!! BaseHelper::clean($tabTitle) !!}</h5>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    @foreach($teams->take(2) as $team)
                        <div class="col-md-6 mb-lg-4 mb-7" data-aos="fade-zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="position-relative d-inline-block z-1">
                                <div class="zoom-img rounded-3">
                                    <a href="{{ $team->url }}">
                                        {{ RvMedia::image($team->photo, $team->name, 'vertical_thumb', attributes: ['class' => 'img-fluid w-100']) }}
                                    </a>
                                </div>
                                <a href="{{ $team->url }}" class="card-team rounded-3 position-absolute bottom-0 start-0 end-0 z-1 backdrop-filter w-auto p-4 m-3 hover-up">
                                    <strong class="d-block fs-6">{{ $team->name }}</strong>
                                    <div class="d-flex">
                                        @if ($title = $team->title)
                                            <span class="fs-6 text-600 me-auto">{{ $title }}</span>
                                        @endif

                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="14" viewBox="0 0 24 14" fill="#007BFF">
                                            <path class="fill-primary" d="M17.4177 0.417969L16.3487 1.48705L21.1059 6.24429H0V7.75621H21.1059L16.3487 12.5134L17.4177 13.5825L24 7.0002L17.4177 0.417969Z" fill="white"></path>
                                        </svg>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @if ($teams->count() > 2)
            <div class="row">
                @foreach($teams->skip(2) as $team)
                    <div class="col-lg-3 col-md-6 mb-lg-4 mb-7" data-aos="fade-zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="position-relative d-inline-block z-1">
                            <div class="zoom-img rounded-3">
                                <a href="{{ $team->url }}">
                                    {{ RvMedia::image($team->photo, $team->name, 'vertical_thumb', attributes: ['class' => 'img-fluid w-100']) }}
                                </a>
                            </div>
                            <a href="{{ $team->url }}" class="card-team rounded-3 position-absolute bottom-0 start-0 end-0 z-1 backdrop-filter w-auto p-4 m-3 hover-up">
                                <strong class="d-block fs-6">{{ $team->name }}</strong>
                                <div class="d-flex">
                                    @if ($title = $team->title)
                                        <span class="fs-6 text-600 me-auto">{{ $title }}</span>
                                    @endif

                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="14" viewBox="0 0 24 14" fill="#007BFF">
                                        <path class="fill-primary" d="M17.4177 0.417969L16.3487 1.48705L21.1059 6.24429H0V7.75621H21.1059L16.3487 12.5134L17.4177 13.5825L24 7.0002L17.4177 0.417969Z" fill="white"></path>
                                    </svg>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    @if ($backgroundImage = $shortcode->background_image)
        <div class="position-absolute top-0 start-50 translate-middle-x z-0">
            {{ RvMedia::image($backgroundImage, __('Background image')) }}
        </div>
    @endif
    <div class="rotate-center ellipse-rotate-success position-absolute z-0"></div>
    <div class="rotate-center-rev ellipse-rotate-primary position-absolute z-0"></div>
</section>
