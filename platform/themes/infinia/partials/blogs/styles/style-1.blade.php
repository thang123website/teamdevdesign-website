<div class="row">
    @foreach($posts as $post)
        <div class="col-md-6 mb-4 text-start">
            <a href="{{ $post->url }}" class="d-flex flex-md-row flex-column align-items-start h-100 hover-up text-decoration-none p-2 border rounded-4 bg-white shadow-sm transition-all custom-post-card">
                {{ RvMedia::image($post->image, $post->name, 'horizontal_thumb', attributes: ['class' => 'rounded-3 flex-shrink-0 post-thumbnail']) }}
                
                <div class="content ms-md-3 mt-md-0 mt-3 flex-grow-1">
                    <h2 class="fs-6 fw-bold mb-2 text-900 post-title" title="{{ $post->name }}">{{ $post->name }}</h2>
                    @if ($postDescription = $post->description)
                        <p class="text-muted mb-0 post-desc" title="{!! BaseHelper::clean(strip_tags($postDescription)) !!}">{!! BaseHelper::clean($postDescription) !!}</p>
                    @endif
                </div>
            </a>
        </div>
    @endforeach

    @if($posts->hasPages())
        <div class="col-12 mt-4">
            <div class="d-flex justify-content-center">
                {{ $posts->links(Theme::getThemeNamespace('partials.pagination')) }}
            </div>
        </div>
    @endif
</div>

<style>
    .custom-post-card {
        border: 1px solid #f1f1f1 !important;
    }
    .custom-post-card:hover {
        border-color: var(--primary-color, #0d6efd) !important;
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.05) !important;
    }
    
    .post-thumbnail {
        width: 160px !important;
        min-width: 160px !important;
        height: 105px !important;
        object-fit: cover;
    }
    
    .post-title {
        line-height: 1.4;
        color: #111;
        transition: color 0.3s ease;
        display: -webkit-box !important;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .custom-post-card:hover .post-title {
        color: var(--primary-color, #0d6efd) !important;
    }
    
    .post-desc {
        font-size: 0.9rem;
        display: -webkit-box !important;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    @media (max-width: 768px) {
        .post-thumbnail {
            width: 100% !important;
            min-width: 100% !important;
            height: 200px !important;
            margin-bottom: 15px;
        }
    }
</style>
