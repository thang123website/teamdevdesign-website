<div class="row">
    <div class="col-lg-10 mx-lg-auto mt-8">
        @foreach($posts as $post)
            <div class="border-top py-5 position-relative d-flex flex-column flex-md-row align-items-center" data-aos="fade-zoom-in" data-aos-delay="50">
                {{ RvMedia::image($post->image, $post->name, 'thumb', attributes: ['class' => 'rounded-3 w-100 w-md-auto h-100']) }}
                <div class="ms-5 w-lg-50 me-auto">
                    @if($post->firstCategory)
                        <a href="{{ $post->firstCategory->url }}" class="bg-primary-soft position-relative z-1 d-inline-flex rounded-pill px-3 py-2 mt-3">
                            <span class="tag-spacing fs-7 fw-bold text-linear-2">{{ $post->firstCategory->name }}</span>
                        </a>
                    @endif
                    <a href="{{ $post->url }}">
                        <h2 class="d-block fs-6 fw-bold my-3">{{ $post->name }}</h2>
                    </a>
                    <p>{{ Str::limit($post->description) }}</p>
                </div>
                <a href="{{ $post->url }}" class="rounded-pill bg-white border d-lg-inline-block px-4 py-2 d-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="11" viewBox="0 0 18 11" fill="none">
                        <path class="fill-dark" d="M13.0633 0.563232L12.2615 1.36505L15.8294 4.93297H0V6.06692H15.8294L12.2615 9.6348L13.0633 10.4366L18 5.49991L13.0633 0.563232Z" fill="#111827" />
                    </svg>
                    <span class="ms-2 fw-bold text-900">{{ __('Learn More') }}</span>
                </a>
            </div>
        @endforeach

        @if($posts->hasPages())
            <div class="container">
                <div class="row pt-5 text-start">
                    <div class="d-flex justify-content-start align-items-center">
                        {{ $posts->links(Theme::getThemeNamespace('partials.pagination')) }}
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
