<section {!! $shortcode->htmlAttributes() !!} class="shortcode-projects shortcode-projects-style-1 section-case-studies pt-120">
    @if($shortcode->title || $shortcode->subtitle || $shortcode->description)
        <div class="container position-relative z-2">
            <div class="text-center">
                @if($shortcode->subtitle)
                    <div class="d-flex align-items-center justify-content-center bg-primary-soft border border-2 border-white d-inline-flex rounded-pill px-4 py-2" data-aos="zoom-in" data-aos-delay="50">
                        <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                        <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{{ $shortcode->subtitle }}</span>
                    </div>
                @endif
                @if($shortcode->title)
                    <{{ $titleTag = infinia_title_tag($shortcode, 'h2') }} class="h4 my-3 fw-bold">{!! infinia_clean_title($shortcode->title) !!}</{{ $titleTag }}>
                @endif
                @if($shortcode->description)
                    <p class="mb-3">{!! BaseHelper::clean($shortcode->description) !!}</p>
                @endif
            </div>
        </div>
    @endif
    <div class="container mt-4 pt-7">
        <div class="row">
            @foreach($projects as $project)
                <div class="text-center col-lg-4 col-md-6">
                    <div class="zoom-img position-relative mb-4 d-inline-block z-1">
                        <div class="rounded-3 fix">
                            {{ RvMedia::image($project->image, $project->name, 'vertical_thumb', attributes: ['class' => 'img-fluid w-100']) }}
                        </div>
                        <a href="{{ $project->url }}" class="card-team text-start rounded-3 position-absolute bottom-0 start-0 end-0 z-1 backdrop-filter w-auto p-3 m-2 hover-up">
                            @if($project->client)
                                <p class="fs-7 text-primary mb-1">{{ $project->client }}</p>
                            @endif
                            <strong class="d-block fs-6 text-truncate" title="{{ $project->name }}">{{ $project->name }}</strong>
                            @if($project->description)
                                <p class="text-900 mb-0 truncate-2-custom" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{!! BaseHelper::clean($project->description) !!}</p>
                            @endif
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @if($projects instanceof \Illuminate\Pagination\LengthAwarePaginator && $projects->hasPages())
        <div class="container">
            <div class="row pt-5 text-start">
                <div class="d-flex justify-content-start align-items-center">
                    {{ $projects->links(Theme::getThemeNamespace('partials.pagination')) }}
                </div>
            </div>
        </div>
    @endif
</section>
