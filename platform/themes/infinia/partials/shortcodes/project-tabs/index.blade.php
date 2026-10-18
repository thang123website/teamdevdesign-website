<section {!! $shortcode->htmlAttributes() !!} class="section-team-1 position-relative fix section-padding">
    <div class="container position-relative z-2">
        <div class="text-center">
            @if ($subtitle = $shortcode->subtitle)
                <div class="d-flex align-items-center justify-content-center bg-primary-soft border border-2 border-white d-inline-flex rounded-pill px-4 py-2" data-aos="zoom-in" data-aos-delay="50">
                    <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true" />
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
        <div class="text-center mt-6">
            <div class="button-group filter-button-group filter-menu-active">
                @foreach($tabs as $tab)
                    @continue(! $tabTitle = Arr::get($tab, 'title'))

                    <button @class(['btn btn-md btn-filter mb-2 me-2', 'active' => $loop->first]) data-filter="{{ ! Arr::get($tab, 'project_ids') ? '*' : '.' . Str::slug($tabTitle) }}">{!! BaseHelper::clean($tabTitle) !!}</button>
                @endforeach
            </div>
        </div>
    </div>
    <div class="container mt-6">
        <div class="masonary-active justify-content-between row">
            <div class="grid-sizer"></div>
            @foreach($projects as $project)
                @php
                    $additionalClass = '';

                    foreach ($tabs as $tab) {
                        $tabTitle = Arr::get($tab, 'title');

                        if (is_string($tab['project_ids']) && in_array($project->getKey(), explode(',', $tab['project_ids']))) {
                            $additionalClass .= ' ' . Str::slug($tabTitle);
                        }
                    }
                @endphp

                <div class="filter-item col-12 col-md-4 {{ $additionalClass }}">
                    <div class="project-item zoom-img rounded-2 fix position-relative">
                        {{ RvMedia::image($project->image, $project->name, 'vertical_thumb', attributes: ['clas' => 'rounded-2']) }}

                        <a href="{{ $project->url }}" class="card-team text-start rounded-3 position-absolute bottom-0 start-0 end-0 z-1 backdrop-filter w-auto p-4 m-3 ">
                            <span class="shadow-sm d-flex align-items-center bg-white-keep d-inline-flex rounded-pill px-2 py-1 mb-3">
                                <span class="bg-primary fs-9 fw-bold rounded-pill px-2 py-1 text-white">Xem</span>
                                <span class="fs-7 fw-medium text-primary mx-2">Dự án</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19" fill="none">
                                    <path d="M10.3125 5.5625L14.4375 9.5L10.3125 13.4375" stroke="#6D4DF2" stroke-width="1.125" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M14.25 9.5H3.5625" stroke="#6D4DF2" stroke-width="1.125" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                            <h5 class="text-700">{{ $project->name }}</h5>

                            @if ($projectDescription = $project->description)
                                <p class="fs-7 mb-0">{!! BaseHelper::clean($projectDescription) !!}</p>
                            @endif
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @php
        $primaryButtonLabel = $shortcode->primary_action_label;
        $primaryButtonUrl = $shortcode->primary_action_url;

        $secondaryButtonLabel = $shortcode->secondary_action_label;
        $secondaryButtonUrl = $shortcode->secondary_action_url;
    @endphp

    @if (($primaryButtonLabel && $primaryButtonUrl) || ($secondaryButtonUrl && $secondaryButtonLabel))
        <div class="container">
            <div class="row mt-6">
                <div class="col-lg-7">
                    <div class="d-flex align-items-center justify-content-lg-end justify-content-center">
                        @if ($primaryButtonLabel && $primaryButtonUrl)
                            <a href="{{ $primaryButtonUrl }}" class="btn btn-gradient">
                                {!! BaseHelper::clean($primaryButtonLabel) !!}
                                @if($shortcode->primary_action_icon)
                                    <x-core::icon class="ms-2" :name="$shortcode->primary_action_icon" />
                                @endif
                            </a>
                        @endif

                        @if ($secondaryButtonUrl && $secondaryButtonLabel)
                            <a href="{{ $secondaryButtonUrl }}" class="ms-5 text-decoration-underline fw-bold">
                                {!! BaseHelper::clean($secondaryButtonLabel) !!}

                                @if($shortcode->secondary_action_icon)
                                    <x-core::icon class="ms-2" :name="$shortcode->secondary_action_icon" />
                                @endif
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($backgroundImage = $shortcode->background_image)
        <div class="position-absolute top-0 start-50 translate-middle-x z-0">
            {{ RvMedia::image($backgroundImage, __('Background image')) }}
        </div>
    @endif

    <div class="rotate-center ellipse-rotate-success position-absolute z-1"></div>
    <div class="rotate-center-rev ellipse-rotate-primary position-absolute z-1"></div>
</section>
