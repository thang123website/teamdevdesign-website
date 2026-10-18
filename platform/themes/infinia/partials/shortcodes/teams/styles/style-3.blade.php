<section {!! $shortcode->htmlAttributes() !!} class="shortcode-teams shortcode-teams-style-3 section-team-6 section-padding position-relative">
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
                    <{{ $titleTag = infinia_title_tag($shortcode, 'h3') }} class="ds-3 my-3">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
                @endif

                @if ($description = $shortcode->description)
                    <p class="fs-5">{!! BaseHelper::clean($description) !!}</p>
                @endif
            </div>
        </div>
        <div class="row mt-6">
            @foreach($teams as $team)
                <div class="col-lg-3 col-md-6 mb-lg-4 mb-8 text-center">
                    <div class="card-team position-relative d-inline-block hover-up">
                        <div class="d-flex bg-primary-soft rounded-top-3 p-3">
                            <div>
                                <strong class="d-block fs-6">
                                    <a href="{{ $team->url }}" class="text-900">{{ $team->name }}</a>
                                </strong>
                                @if ($title = $team->title)
                                    <p class="mb-0">{{ $title }}</p>
                                @endif
                            </div>
                            <div class="arrow-icon bg-white icon-shape icon-sm rounded-circle border text-end ms-auto mt-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M17.25 15.25V6.75H8.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M17 7L6.75 17.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="zoom-img bg-primary-soft">
                            <a href="{{ $team->url }}">
                                {{ RvMedia::image($team->photo, $team->name, attributes: ['class' => 'img-fluid w-100']) }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @php
            $bottomDescription = $shortcode->bottom_description;
            $buttonLabel = $shortcode->primary_action_label;
            $buttonUrl = $shortcode->primary_action_url;
        @endphp

        @if (($buttonLabel && $buttonUrl) || $bottomDescription)
            <div class="row">
                <div class="text-center mt-6">
                    <div class="text-center">
                        @if($bottomDescription)
                            <p class="fs-4 mb-5 text-900">{!! BaseHelper::clean($bottomDescription) !!}</p>
                        @endif

                        @if($buttonLabel && $buttonUrl)
                            <a href="{{ $buttonUrl }}" class="btn btn-gradient">
                                {!! BaseHelper::clean($buttonLabel) !!}
                                @if($icon = $shortcode->primary_action_icon)
                                    <x-core::icon :name="$icon" class="ms-2" />
                                @endif
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
