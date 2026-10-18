@php
    $blogListStyle = request()->input('style') ?: theme_option('blog_list_style', 'style-1');
    $blogListStyle = in_array($blogListStyle, ['style-1', 'style-2']) ? $blogListStyle : 'style-1';

    // SEO: H1 + mô tả riêng cho từng trang danh mục / tag / tìm kiếm, tránh trùng lặp nội dung.
    $loopHeading = 'Blog Công Nghệ & Giải Pháp Số';
    $loopBadge = '🚀 GÓC CHIA SẺ KIẾN THỨC';
    $loopDescription = SeoHelper::getDescription() ?: 'Nơi chúng tôi chia sẻ những kiến thức chuyên sâu về thiết kế website, lập trình Laravel, các chiến lược marketing và xu hướng công nghệ mới nhất. Khám phá các bài viết để nâng tầm dự án của bạn!';

    if (isset($category) && $category) {
        $loopHeading = $category->name;
        $loopBadge = '📂 DANH MỤC';
        $loopDescription = strip_tags((string) $category->description) ?: 'Tổng hợp bài viết về ' . $category->name . ' từ đội ngũ TeamDevDesign.';
    } elseif (isset($tag) && $tag) {
        $loopHeading = 'Bài viết về ' . $tag->name;
        $loopBadge = '🏷️ TAG';
        $loopDescription = strip_tags((string) $tag->description) ?: 'Các bài viết liên quan đến chủ đề ' . $tag->name . '.';
    } elseif (request()->routeIs('public.search')) {
        $keyword = trim((string) (request()->input('q') ?: request()->input('name')));
        $loopHeading = $keyword ? 'Kết quả tìm kiếm: ' . $keyword : 'Tìm kiếm bài viết';
        $loopBadge = '🔍 TÌM KIẾM';
        $loopDescription = $posts->isNotEmpty() ? 'Các bài viết phù hợp với từ khóa của bạn.' : 'Không tìm thấy bài viết phù hợp, hãy thử từ khóa khác.';
    }

    if (method_exists($posts, 'currentPage') && $posts->currentPage() > 1) {
        $loopHeading .= ' - Trang ' . $posts->currentPage();
    }
@endphp

{!! apply_filters('ads_render', null, 'post_list_before', ['class' => 'my-2 text-center']) !!}

<section class="section-blog-main pb-5 pt-5" style="background-color: #fcfcfc;">
    <div class="container">
        <!-- Hero Title Section -->
        <div class="row mb-5">
            <div class="col-lg-8 pe-lg-5">
                <style>
                    .hero-title { font-size: 1.75rem !important; line-height: 1.3 !important; }
                    .hero-desc { font-size: 1rem !important; line-height: 1.6 !important; }
                    .hero-badge { padding: 0.4rem 1rem !important; font-size: 0.75rem !important; }
                    @media (min-width: 768px) {
                        .hero-title { font-size: 3.5rem !important; line-height: 1.2 !important; }
                        .hero-desc { font-size: 1.25rem !important; }
                        .hero-badge { padding: 0.5rem 1.5rem !important; font-size: 0.85rem !important; }
                    }
                </style>
                <div class="d-inline-flex align-items-center justify-content-center bg-primary-soft border border-2 border-white rounded-pill mb-3 shadow-sm hero-badge" data-aos="fade-up">
                    <span class="tag-spacing fw-bold text-linear-2 text-primary">{{ $loopBadge }}</span>
                </div>
                <h1 class="hero-title fw-bold mb-3 text-dark" data-aos="fade-up" data-aos-delay="100">
                    {{ $loopHeading }}
                </h1>
                <p class="hero-desc text-muted fw-medium" data-aos="fade-up" data-aos-delay="200">
                    {{ $loopDescription }}
                </p>
            </div>
        </div>

        <div class="row">
            <!-- Main Content: Posts -->
            <div class="col-lg-9 pe-lg-5" style="border-right: 1px solid #e5e7eb;">
                {!! Theme::partial("blogs.styles.$blogListStyle", compact('posts')) !!}
            </div>

            <!-- Sidebar -->
            <div class="col-lg-3 mt-5 mt-lg-0 ps-lg-5">
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
                    <div class="widget widget-categories bg-white rounded-4 p-3 mb-4 border" data-aos="fade-up" data-aos-delay="100">
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
                    <div class="widget widget-featured-posts bg-white rounded-4 p-3 border" data-aos="fade-up" data-aos-delay="200">
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
</section>

{!! apply_filters('ads_render', null, 'post_list_after', ['class' => 'my-2 text-center']) !!}
