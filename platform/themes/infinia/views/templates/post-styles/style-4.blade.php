<section class="shortcode-blog-posts shortcode-blog-posts-style-4 section-blog-3 position-relative pb-5 fix"
    @style($variablesStyle)
>
    <div class="container position-relative z-1">
        <div class="row align-items-end mb-5">
            <div class="col-md-auto col-12 me-auto">
                @if ($subtitle = $shortcode->subtitle)
                    <div class="d-flex align-items-center justify-content-center bg-primary-soft border border-2 border-white d-inline-flex rounded-pill px-4 py-2" data-aos="zoom-in" data-aos-delay="50">
                        <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                        <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
                    </div>
                @endif

                @if ($title = $shortcode->title)
                    <h3 class="ds-3 mt-3 mb-3">{!! BaseHelper::clean($title) !!}</h3>
                @endif

                @if ($description = $shortcode->description)
                    <span class="fs-5 fw-medium">{!! BaseHelper::clean($description) !!}</span>
                @endif
            </div>

            @if(($actionLabel = $shortcode->action_label) && ($actionUrl = $shortcode->action_url))
                <div class="col-md-auto col-12 pt-md-0 pt-3">
                    <a href="{{ $actionUrl }}" class="ms-md-5 fw-bold text-primary">{!! BaseHelper::clean($actionLabel) !!}
                        <svg class="ms-2" xmlns="http://www.w3.org/2000/svg" width="24" height="14" viewBox="0 0 24 14" fill="none">
                            <path class="fill-dark" d="M17.4177 0.417969L16.3487 1.48705L21.1059 6.24429H0V7.75621H21.1059L16.3487 12.5134L17.4177 13.5825L24 7.0002L17.4177 0.417969Z" fill="black" />
                        </svg>
                    </a>
                </div>
            @endif
        </div>
        <div class="row mt-5">
            <!-- Cột nội dung chính -->
            <div class="col-lg-8 pe-lg-5" style="border-right: 1px solid #e5e7eb;">
                <div class="row">
                    @php
                        $postsChunk = $posts->chunk(ceil($posts->count() / 2));
                    @endphp
                    @foreach($postsChunk as $chunk)
                        <div class="col-md-6 pe-lg-4">
                            @foreach($chunk as $post)
                                <a href="{{ $post->url }}" class="d-flex flex-md-row flex-column align-items-start mb-4 hover-up text-decoration-none">
                                    {{ RvMedia::image($post->image, $post->name, 'thumb', attributes: ['class' => 'rounded-3 flex-shrink-0', 'style' => 'width: 90px; height: 90px; object-fit: cover;']) }}
                                    
                                    <div class="content ms-md-4 mt-md-0 mt-3 flex-grow-1">
                                        <strong class="d-block fs-6 mb-2 text-900" style="line-height: 1.4;">{{ $post->name }}</strong>
                                        @if ($postDescription = $post->description)
                                            <p class="text-muted" style="font-size: 0.9rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{!! BaseHelper::clean($postDescription) !!}</p>
                                        @endif
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Cột Sidebar bên phải -->
            <div class="col-lg-4 mt-5 mt-lg-0 ps-lg-5">
                <style>
                    .custom-blog-sidebar .widget {
                        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
                        transition: transform 0.3s ease;
                    }
                    .custom-blog-sidebar .widget:hover {
                        transform: translateY(-5px);
                    }
                    .custom-blog-sidebar .cat-item {
                        transition: all 0.3s ease;
                        border: 1px solid transparent;
                    }
                    .custom-blog-sidebar .cat-item:hover {
                        background-color: var(--primary-color, #0d6efd) !important;
                        border-color: var(--primary-color, #0d6efd);
                    }
                    .custom-blog-sidebar .cat-item:hover span,
                    .custom-blog-sidebar .cat-item:hover svg {
                        color: #fff !important;
                    }
                    .custom-blog-sidebar .featured-img-wrap {
                        overflow: hidden;
                    }
                    .custom-blog-sidebar .featured-img-wrap img {
                        transition: transform 0.5s ease;
                    }
                    .custom-blog-sidebar .featured-item:hover .featured-img-wrap img {
                        transform: scale(1.1);
                    }
                    .custom-blog-sidebar .featured-item h5 a {
                        transition: color 0.3s ease;
                    }
                    .custom-blog-sidebar .featured-item:hover h5 a {
                        color: var(--primary-color, #0d6efd) !important;
                    }
                </style>
                
                <div class="custom-blog-sidebar sticky-top" style="top: 100px; z-index: 1;">
                    
                    <!-- Widget: Danh mục bài viết -->
                    <div class="widget widget-categories bg-white rounded-4 p-4 mb-4 border" data-aos="fade-up" data-aos-delay="100">
                        <h4 class="widget-title fs-5 mb-4 fw-bold position-relative pb-2" style="border-bottom: 2px solid #f3f4f6;">
                            <span style="border-bottom: 2px solid var(--primary-color, #0d6efd); padding-bottom: 9px; display: inline-block; margin-bottom: -2px;">Danh mục tin tức</span>
                        </h4>
                        @php $categories = get_all_categories(['status' => \Botble\Base\Enums\BaseStatusEnum::PUBLISHED]); @endphp
                        @if($categories->isNotEmpty())
                            <ul class="list-unstyled mb-0">
                                @foreach($categories as $category)
                                    <li class="mb-3">
                                        <a href="{{ $category->url }}" class="cat-item d-flex justify-content-between align-items-center text-decoration-none py-2 px-3 rounded-3 transition-all" style="background-color: #f8f9fa;">
                                            <span class="fw-medium text-900" style="color: #333;">{{ $category->name }}</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" style="color: #999;" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/></svg>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <!-- Widget: Tin nổi bật -->
                    <div class="widget widget-featured-posts bg-white rounded-4 p-4 border" data-aos="fade-up" data-aos-delay="200">
                        <h4 class="widget-title fs-5 mb-4 fw-bold position-relative pb-2" style="border-bottom: 2px solid #f3f4f6;">
                            <span style="border-bottom: 2px solid var(--primary-color, #0d6efd); padding-bottom: 9px; display: inline-block; margin-bottom: -2px;">Tin nổi bật</span>
                        </h4>
                        @php $featuredPosts = get_featured_posts(5); @endphp
                        @if($featuredPosts->isNotEmpty())
                            <div class="featured-posts-list">
                                @foreach($featuredPosts as $featuredPost)
                                    <div class="featured-item d-flex mb-4 align-items-center {{ $loop->last ? 'mb-0' : '' }}">
                                        <a href="{{ $featuredPost->url }}" class="featured-img-wrap flex-shrink-0 position-relative rounded-3 d-block" style="width: 80px; height: 80px;">
                                            {{ RvMedia::image($featuredPost->image, $featuredPost->name, 'thumb', attributes: ['class' => 'img-fluid w-100 h-100 rounded-3', 'style' => 'object-fit: cover;']) }}
                                        </a>
                                        <div class="ms-3 flex-grow-1">
                                            <h5 class="fs-7 mb-1 lh-base">
                                                <a href="{{ $featuredPost->url }}" class="text-900 text-decoration-none fw-semibold" title="{{ $featuredPost->name }}" style="color: #333;">{{ Str::limit($featuredPost->name, 45) }}</a>
                                            </h5>
                                            <div class="text-muted fs-8 d-flex align-items-center mt-2" style="font-size: 0.85rem;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-clock me-1" viewBox="0 0 16 16"><path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/><path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/></svg>
                                                {{ $featuredPost->created_at->format('d/m/Y') }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    @if ($backgroundImage = $shortcode->background_image)
        <div class="position-absolute top-0 start-50 translate-middle-x z-0">
            {{ RvMedia::image($backgroundImage) }}
        </div>
    @endif

    <div class="bouncing-blobs-container">
        <div class="bouncing-blobs-glass"></div>
        <div class="bouncing-blobs">
            <div class="bouncing-blob bouncing-blob--green"></div>
            <div class="bouncing-blob bouncing-blob--primary"></div>
        </div>
    </div>
</section>
