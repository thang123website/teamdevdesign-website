<section {!! $shortcode->htmlAttributes() !!} class="shortcode-projects shortcode-projects-style-3 section-team-1 position-relative fix section-padding">
    <div class="container position-relative z-2">
        <div class="text-center">
            @if ($subtitle = $shortcode->subtitle)
                <div class="d-flex align-items-center justify-content-center bg-primary-soft border border-2 border-white d-inline-flex rounded-pill px-4 py-2" data-aos="zoom-in" data-aos-delay="50">
                    <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                    <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
                </div>
            @endif

            @if ($title = $shortcode->title)
                <{{ $titleTag = infinia_title_tag($shortcode, 'h3') }} class="ds-3 my-3 fw-regular">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
            @endif
        </div>
        <div class="row mt-8">
            <div class="col-lg-6 mt-lg-0 mt-5">
                @php
                    $dataCount = $shortcode->data_count;
                @endphp

                @if($dataCount)
                    <div>
                        <div class="counter-item-cover counter-item">
                            <div class="content text-start mx-auto">
                                <h2 class="count ds-2 fw-bold text-primary my-0"><span class="odometer" data-count="{{ $dataCount }}"></span>
                                    @if($dataCountUnit = $shortcode->data_count_unit)
                                    {!! BaseHelper::clean($dataCountUnit) !!}
                                    @endif
                                </h2>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($description = $shortcode->description)
                    <p class="fs-5 text-500">{!! BaseHelper::clean($description) !!}</p>
                @endif
                <div class="accordion">
                    @foreach($tabs as $tab)
                        @php
                            $tabTitle = Arr::get($tab, 'title');
                            $tabDescription = Arr::get($tab, 'description');
                        @endphp

                        @continue(!$tabTitle || !$tabDescription)

                        <div class="px-0 card p-3 border-0 border-bottom bg-transparent rounded-0">
                            <div class="px-0 card-header border-0 bg-gradient-1">
                                <a class="collapsed text-900 fw-bold d-flex align-items-center" data-bs-toggle="collapse" href="#{{ Str::slug($tabTitle) }}">
                                    <span class="icon-shape icon-xs fs-7 rounded-circle d-none d-md-block me-3 bg-primary text-white">1</span>
                                    <strong class="d-block fs-6 m-0">{!! BaseHelper::clean($tabTitle) !!}</strong>
                                    <span class="ms-auto arrow me-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="8" viewBox="0 0 13 8" fill="none">
                                            <path class="stroke-dark" d="M11.5 1L6.25 6.5L1 1" stroke="#111827" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                            <div id="{{ Str::slug($tabTitle) }}" @class(['collapse', 'show' => $loop->first]) data-bs-parent=".accordion">
                                <p class="px-0 card-body fs-6 text-600">
                                    {!! BaseHelper::clean($tabDescription) !!}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            @if($projects->isNotEmpty())
                <div class="col-lg-6 px-lg-6 mt-lg-0 mt-8">
                    @foreach($projects as $project)
                        <a href="{{ $project->url }}" class="d-flex flex-column flex-md-row align-items-center mb-6 hover-up">
                            {{ RvMedia::image($project->image, $project->name, 'thumb', attributes: ['class' => 'rounded-3 w-100 w-md-auto']) }}
                            <div class="content mt-md-0 mt-4 ms-5">
                                <strong class="d-block fs-6 mb-2">{{ $project->name }}</strong>

                                @if ($projectDescription = $project->description)
                                    <p>{!! BaseHelper::clean($projectDescription) !!}</p>
                                @endif
                            </div>
                        </a>
                    @endforeach

                </div>
            @endif
        </div>
    </div>

    @if ($backgroundImage = $shortcode->background_image)
        <div class="position-absolute top-0 start-50 translate-middle-x z-0">
            {{ RvMedia::image($backgroundImage, __('Background image')) }}
        </div>
    @endif
    <div class="rotate-center ellipse-rotate-success position-absolute z-1"></div>
    <div class="rotate-center-rev ellipse-rotate-primary position-absolute z-1"></div>
</section>
