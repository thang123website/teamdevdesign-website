@php
    $columns = $shortcode->columns ?? '3';
    $showFilter = ($shortcode->show_filter ?? 'yes') != 'no';
    $showSearch = ($shortcode->show_search ?? 'yes') != 'no';
    $showSort = ($shortcode->show_sort ?? 'yes') != 'no';
    $colClass = match ((int) $columns) {
        2 => 'col-6 col-lg-6 col-md-6',
        4 => 'col-6 col-lg-3 col-md-4',
        6 => 'col-6 col-lg-2 col-md-4',
        default => 'col-6 col-lg-4 col-md-6',
    };
    $mainColClass = $showFilter ? 'col-lg-9' : 'col-lg-12';
@endphp

<section {!! $shortcode->htmlAttributes() !!} class="shortcode-projects-list section-padding position-relative">
    {{-- Skeleton Template (Hidden) --}}
    <template id="pf-skeleton-template">
        @for($i = 0; $i < 6; $i++)
            <div class="{{ $colClass }} pf-skeleton-item">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100" style="height: 420px !important;">
                    <div class="w-100 pf-skeleton-loading" style="height: 100%;"></div>
                    <div class="card-body p-3 position-absolute bottom-0 start-0 w-100">
                        <div class="pf-skeleton-loading mb-2" style="height: 15px; width: 40%;"></div>
                        <div class="pf-skeleton-loading mb-1" style="height: 20px; width: 80%;"></div>
                        <div class="pf-skeleton-loading" style="height: 15px; width: 60%;"></div>
                    </div>
                </div>
            </div>
        @endfor
    </template>

    <div class="container">
        {{-- Header Section --}}
        @if($shortcode->title || $shortcode->subtitle || $shortcode->description)
            <div class="row section-header mb-5">
                <div class="col-12 col-lg-8">
                    @if($shortcode->subtitle)
                        <div
                            class="subtitle-badge mb-3 d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-primary-soft shadow-sm border border-primary-light">
                            <span class="d-flex gap-1">
                                <span class="dot-pink"></span><span class="dot-pink opacity-50"></span>
                            </span>
                            <span
                                class="fs-8 fw-extrabold text-uppercase text-primary letter-spacing-1">{{ $shortcode->subtitle }}</span>
                        </div>
                    @endif

                    @if($shortcode->title)
                        <style>
                            .projects-hero-title {
                                font-size: 1.75rem !important;
                                font-weight: 300 !important;
                                line-height: 1.3 !important;
                            }
                            @media (min-width: 768px) {
                                .projects-hero-title {
                                    font-size: 3rem !important;
                                    line-height: 1.2 !important;
                                }
                            }
                        </style>
                        <h1 class="projects-hero-title text-900 mb-3">
                            {!! \Botble\Base\Facades\BaseHelper::clean($shortcode->title) !!}
                        </h1>
                    @endif

                    @if($shortcode->description)
                        <div class="d-flex align-items-start gap-2">
                            <span class="text-primary mt-1"><i class="ti ti-bolt text-warning fs-5"></i></span>
                            <p class="text-600 fs-6 mb-0 lh-base max-width-600">
                                {!! \Botble\Base\Facades\BaseHelper::clean($shortcode->description) !!}
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <div class="row g-4">

            {{-- Sidebar Filter --}}
            @if($showFilter && $categories->count() > 0)
                <div class="col-lg-3 d-none d-lg-block">
                    {{-- Category Filter Box --}}
                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                        <p class="text-uppercase fs-7 fw-bold text-primary letter-spacing-2 mb-1">
                            {{ __('Bộ lọc danh mục') }}
                        </p>
                        <h5 class="fw-bold text-900 mb-4">{{ __('Duyệt theo ngành nghề') }}</h5>

                        <div class="d-flex flex-column gap-2">
                            {{-- All --}}
                            <a href="{{ request()->fullUrlWithoutQuery(['category', 'page']) }}"
                                class="d-flex align-items-center justify-content-between px-3 py-2 rounded-3 text-decoration-none fw-500 transition-all {{ !request('category') ? 'bg-primary text-white' : 'bg-light text-900 hover-bg-primary-soft' }}">
                                <span>{{ __('Tất cả mẫu website') }}</span>
                                <span
                                    class="badge {{ !request('category') ? 'bg-white text-primary' : 'bg-primary-soft text-primary' }} rounded-pill">{{ number_format($totalProjects) }}</span>
                            </a>

                            @foreach($categories as $cat)
                                <a href="{{ request()->fullUrlWithQuery(['category' => $cat->id, 'page' => 1]) }}"
                                    class="d-flex align-items-center justify-content-between px-3 py-2 rounded-3 text-decoration-none fw-500 transition-all {{ request('category') == $cat->id ? 'bg-primary text-white' : 'bg-light text-900' }}">
                                    <span>{{ $cat->name }}</span>
                                    <span
                                        class="badge {{ request('category') == $cat->id ? 'bg-white text-primary' : 'bg-primary-soft text-primary' }} rounded-pill">{{ number_format($cat->projects_count) }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- CTA Box --}}
                    <div class="card border-0 rounded-4 p-4 text-white shadow-lg"
                        style="background: linear-gradient(135deg, var(--primary-color) 0%, rgba(0,0,0,0.1) 100%), var(--primary-color);">
                        <p class="text-uppercase fs-8 fw-bold letter-spacing-2 mb-1" style="color: rgba(255,255,255,0.8);">
                            {{ __('Cần chốt nhanh?') }}
                        </p>
                        <h5 class="fw-extrabold text-white mb-3" style="line-height:1.35;">
                            {{ __('Gửi ngành nghề và phong cách bạn muốn.') }}
                        </h5>
                        <p class="mb-4" style="font-size:13px; color: rgba(255,255,255,0.9); line-height:1.6;">
                            {{ __('Chúng tôi sẽ lọc mẫu phù hợp hơn thay vì phải xem toàn bộ danh sách.') }}
                        </p>
                        <div class="mt-auto">
                            <a href="/lien-he"
                                class="btn bg-white text-primary border-0 btn-sm fw-bold rounded-pill px-4 py-2 transition-all shadow-sm"
                                style="color: var(--primary-color) !important;">
                                {{ __('Liên hệ tư vấn') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Main Content area --}}
            <div class="{{ $mainColClass }}">
                {{-- Top Filter Bar --}}
                @if($showSearch || $showSort)
                    <div class="card border-0 shadow-sm rounded-4 p-3 mb-4 pf-topbar">
                        <div class="row align-items-center g-3">
                            <div class="col-12 col-lg-auto">
                                <div class="d-flex align-items-center gap-2 pf-topbar-info">
                                    <span class="text-500 fs-7 me-auto">
                                        {{ __('Hiện có :count mẫu web', ['count' => number_format($projects->total())]) }}
                                    </span>
                                </div>
                            </div>

                            @if($showSearch)
                                <div class="col-12 col-lg px-2 flex-grow-1">
                                    <form action="{{ request()->url() }}" method="GET"
                                        class="d-flex gap-2 pf-ajax-form pf-search-form">
                                        @foreach(request()->except(['search', 'page']) as $key => $val)
                                            <input type="hidden" name="{{ $key }}" value="{{ $val }}">
                                        @endforeach
                                        <div class="position-relative flex-grow-1">
                                            <i
                                                class="ti ti-search position-absolute top-50 start-0 translate-middle-y ms-3 text-500 fs-5 z-2"></i>
                                            <input type="text" name="search" value="{{ request('search') }}"
                                                placeholder="{{ __('Tìm tên dự án, lĩnh vực...') }}"
                                                class="form-control rounded-pill border-2 fs-7 py-2 px-3 ps-5"
                                                style="height: 42px;">
                                        </div>
                                        <button type="submit"
                                            class="btn btn-primary rounded-pill px-3 py-2 fw-bold text-nowrap fs-7 shadow-sm flex-shrink-0"
                                            style="height: 42px;">
                                            {{ __('Tìm') }}
                                        </button>
                                    </form>
                                </div>
                            @endif

                            <div class="col-12 col-lg-auto d-flex flex-wrap gap-1 gap-lg-2 w-100-mobile pf-filter-controls">
                                {{-- Mobile Category Dropdown --}}
                                @if($showFilter && $categories->count() > 0)
                                    <div class="d-lg-none flex-fill" style="min-width: 110px;">
                                        <select class="form-select rounded-pill border-2 fs-7 py-2 px-3 pf-cat-select"
                                            style="height: 42px;">
                                            <option value="{{ request()->fullUrlWithoutQuery(['category', 'page']) }}">
                                                {{ __('Tất cả ngành') }}
                                            </option>
                                            @foreach($categories as $cat)
                                                <option
                                                    value="{{ request()->fullUrlWithQuery(['category' => $cat->id, 'page' => 1]) }}"
                                                    {{ request('category') == $cat->id ? 'selected' : '' }}>
                                                    {{ $cat->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                @if(!empty($programmingLanguages))
                                    <div class="flex-fill" style="min-width: 110px;">
                                        <form action="{{ request()->url() }}" method="GET" class="pf-ajax-form">
                                            @foreach(request()->except(['programming_language', 'page']) as $key => $val)
                                                <input type="hidden" name="{{ $key }}" value="{{ $val }}">
                                            @endforeach
                                            <select name="programming_language"
                                                class="form-select rounded-pill border-2 fs-7 py-2 px-3" style="height: 42px;">
                                                <option value="">{{ __('Ngôn ngữ') }}</option>
                                                @foreach($programmingLanguages as $lang)
                                                    <option value="{{ $lang }}" {{ request('programming_language') == $lang ? 'selected' : '' }}>
                                                        {{ $lang }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </div>
                                @endif

                                @if($showSort)
                                    <div class="flex-fill" style="min-width: 110px;">
                                        <form action="{{ request()->url() }}" method="GET" id="pf-sort-form"
                                            class="pf-ajax-form pf-sort-form">
                                            @foreach(request()->except(['sort_by', 'page']) as $key => $val)
                                                <input type="hidden" name="{{ $key }}" value="{{ $val }}">
                                            @endforeach
                                            <select name="sort_by" class="form-select rounded-pill border-2 fs-7 py-2 px-3"
                                                style="height: 42px;">
                                                <option value="latest" {{ $sortBy == 'latest' ? 'selected' : '' }}>
                                                    {{ __('Thứ tự mặc định') }}
                                                </option>
                                                <option value="oldest" {{ $sortBy == 'oldest' ? 'selected' : '' }}>
                                                    {{ __('Cũ nhất') }}
                                                </option>
                                                <option value="name_asc" {{ $sortBy == 'name_asc' ? 'selected' : '' }}>
                                                    {{ __('Tên A-Z') }}
                                                </option>
                                                <option value="name_desc" {{ $sortBy == 'name_desc' ? 'selected' : '' }}>
                                                    {{ __('Tên Z-A') }}
                                                </option>
                                                <option value="featured" {{ $sortBy == 'featured' ? 'selected' : '' }}>
                                                    {{ __('Nổi bật trước') }}
                                                </option>
                                            </select>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Projects Grid Area --}}
                <div id="pf-ajax-results" class="position-relative">
                    @if($projects->count() > 0)
                        <div class="row g-2 g-lg-4 pf-results-grid">
                            @foreach($projects as $project)
                                <div class="{{ $colClass }}">
                                    <div
                                        class="card border-0 shadow-sm rounded-4 overflow-hidden position-relative pf-project-card-hover h-100">
                                        {{-- Thumbnail --}}
                                        <div class="w-100 h-100">
                                            @if($project->image)
                                                <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-light">
                                                    <img src="{{ \Botble\Media\Facades\RvMedia::url($project->image) }}"
                                                        alt="{{ $project->name }}"
                                                        class="mw-100 mh-100 object-fit-contain pf-card-img">
                                                </div>
                                            @else
                                                <div
                                                    class="w-100 h-100 d-flex align-items-center justify-content-center bg-primary-soft">
                                                    <i class="ti ti-photo fs-1 text-primary opacity-50"></i>
                                                </div>
                                            @endif
                                        </div>

                                        {{-- Badges (Fixed Top) --}}
                                        <div class="position-absolute top-0 start-0 p-3 d-flex flex-column gap-2 z-2 pf-fixed-badges" style="max-width: 100%;">
                                            <div class="d-flex flex-wrap gap-1 gap-lg-2 overflow-hidden" style="max-height: 64px;">
                                                @if($project->is_featured)
                                                    <span class="badge bg-warning text-white rounded-pill px-3 shadow-sm mb-1" style="font-size: 12px;">
                                                        {{ __('Nổi bật') }}
                                                    </span>
                                                @endif
                                                @foreach($project->categories as $category)
                                                    <span class="badge bg-primary text-white rounded-pill px-3 shadow-sm opacity-90 mb-1" style="font-size: 12px;">
                                                        {{ $category->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                            
                                            @if($project->programming_languages)
                                                <div class="d-flex flex-wrap gap-1">
                                                    @foreach(explode(',', $project->programming_languages) as $lang)
                                                        @if(trim($lang))
                                                            <span class="badge bg-dark text-white rounded-pill px-2 py-1 shadow-sm opacity-80" style="font-size: 12px;">
                                                                {{ trim($lang) }}
                                                            </span>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>

                                        {{-- Card Overlay Content (Visible on Hover) --}}
                                        <a href="{{ $project->url }}"
                                            class="pf-card-overlay d-flex flex-column justify-content-end p-3 text-decoration-none">
                                            <div class="pf-glass-content rounded-4 p-3 shadow-lg mb-0 text-start">
                                                <div class="pf-view-badge mb-2">
                                                    <span class="bg-white text-dark rounded-pill px-2 py-1 fw-bold border"
                                                        style="font-size: 10px;">
                                                        <span class="pf-dot me-1"></span>{{ __('Xem') }} &nbsp;
                                                        <b>{{ __('Dự án') }}</b>
                                                    </span>
                                                </div>
                                                <h6 class="fw-bold text-900 mb-1 lh-base fs-6 pf-title"
                                                    style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                                    {{ $project->name }}
                                                </h6>
                                                @if($project->description)
                                                    <p class="text-600 mb-0 pf-desc"
                                                        style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; line-height: 1.4; font-size: 12px;">
                                                        {{ $project->description }}
                                                    </p>
                                                @endif
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Pagination --}}
                        @if($projects->hasPages())
                            <div class="row pt-5">
                                <div class="d-flex justify-content-center align-items-center">
                                    {{ $projects->links(\Botble\Theme\Facades\Theme::getThemeNamespace('partials.pagination')) }}
                                </div>
                            </div>
                        @endif

                    @else
                        {{-- Empty state --}}
                        <div class="card border-0 shadow-sm rounded-4 p-5 text-center">
                            <i class="ti ti-search-off fs-1 text-primary opacity-50 mb-3"></i>
                            <h5 class="fw-bold text-900">{{ __('Không tìm thấy dự án nào.') }}</h5>
                            <p class="text-500 mb-4">{{ __('Thử thay đổi bộ lọc hoặc từ khóa tìm kiếm.') }}</p>
                            <div>
                                <a href="{{ request()->url() }}" class="btn btn-primary rounded-pill px-5 fw-bold">
                                    {{ __('Xem tất cả') }}
                                </a>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Mobile CTA Box (Bottom) --}}
                <div class="d-lg-none mt-4 mb-2">
                    <div class="card border-0 rounded-4 p-4 text-white shadow-lg"
                        style="background: linear-gradient(135deg, var(--primary-color) 0%, rgba(0,0,0,0.1) 100%), var(--primary-color);">
                        <p class="text-uppercase fs-8 fw-bold letter-spacing-2 mb-1"
                            style="color: rgba(255,255,255,0.8);">
                            {{ __('Cần chốt nhanh?') }}
                        </p>
                        <h5 class="fw-extrabold text-white mb-3" style="line-height:1.35;">
                            {{ __('Gửi ngành nghề và phong cách bạn muốn.') }}
                        </h5>
                        <p class="mb-4" style="font-size:13px; color: rgba(255,255,255,0.9); line-height:1.6;">
                            {{ __('Chúng tôi sẽ lọc mẫu phù hợp hơn thay vì phải xem toàn bộ danh sách.') }}
                        </p>
                        <div class="mt-auto">
                            <a href="/lien-he"
                                class="btn bg-white text-primary border-0 btn-sm fw-bold rounded-pill px-4 py-2 transition-all shadow-sm w-100"
                                style="color: var(--primary-color) !important;">
                                {{ __('Liên hệ tư vấn') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div> {{-- end main --}}
        </div> {{-- end row --}}
    </div> {{-- end container --}}
</section>

<style>
    /* Card Hover Styles */
    .pf-project-card-hover {
        transition: transform 0.4s ease, box-shadow 0.4s ease;
        text-align: left !important;
        height: 420px !important;
    }

    .pf-card-img {
        transition: transform 0.8s ease;
    }

    .pf-project-card-hover:hover .pf-card-img {
        transform: scale(1.1);
    }

    /* Fixed Badges (Visible Always) */
    .pf-fixed-badges span {
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
    }

    /* Overlay Layer */
    .pf-card-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 20%, rgba(0, 0, 0, 0.6) 100%);
        opacity: 0;
        z-index: 5;
        transition: opacity 0.4s ease;
    }

    .pf-project-card-hover:hover .pf-card-overlay {
        opacity: 1;
    }

    /* Glass Content Box */
    .pf-glass-content {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        transform: translateY(40px);
        transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .pf-project-card-hover:hover .pf-glass-content {
        transform: translateY(0);
    }

    /* Red Dot Pulse Animation */
    .pf-dot {
        height: 8px;
        width: 8px;
        background-color: #ff3b3b;
        border-radius: 50%;
        display: inline-block;
        margin-bottom: 1px;
        animation: pf-pulse 1.5s infinite;
    }

    @keyframes pf-pulse {
        0% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(255, 59, 59, 0.7);
        }

        70% {
            transform: scale(1);
            box-shadow: 0 0 0 5px rgba(255, 59, 59, 0);
        }

        100% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(255, 59, 59, 0);
        }
    }

    /* Titles & Texts */
    .pf-title {
        color: #1a1a2e;
        margin-top: 0;
        transition: color 0.3s;
    }

    .pf-desc {
        opacity: 0.85;
    }

    /* Section Header Styles */
    .dot-pink {
        width: 6px;
        height: 6px;
        background-color: var(--primary-color);
        border-radius: 50%;
        display: inline-block;
    }

    .max-width-600 {
        max-width: 600px;
    }

    .bg-primary-soft {
        background-color: rgba(var(--primary-color-rgb, 128, 0, 128), 0.08) !important;
    }

    .border-primary-light {
        border-color: rgba(var(--primary-color-rgb, 128, 0, 128), 0.15) !important;
    }

    /* Mobile handling: Show content by default but shorter height */
    @media (max-width: 768px) {
        .pf-project-card-hover {
            height: 270px !important;
        }

        .pf-glass-content {
            padding: 0.65rem !important;
            transform: translateY(0);
            margin-bottom: 0 !important;
        }

        .pf-card-overlay {
            opacity: 1;
            padding: 0.5rem !important;
        }

        .pf-desc {
            -webkit-line-clamp: 2 !important;
            font-size: 11px !important;
        }

        .pf-title {
            font-size: 0.85rem !important;
            margin-bottom: 2px !important;
        }

        .pf-view-badge {
            margin-bottom: 4px !important;
        }

        .pf-view-badge span {
            font-size: 9px !important;
            padding: 2px 4px !important;
            white-space: nowrap !important;
            display: inline-flex !important;
            align-items: center !important;
        }

        /* Style adjustments for Badges on mobile */
        .pf-fixed-badges {
            padding: 0.5rem !important;
            gap: 0.25rem !important;
        }

        .pf-fixed-badges span {
            font-size: 9px !important;
            padding: 2px 8px !important;
        }

        /* Filter improvements for Mobile */
        .pf-topbar {
            padding: 0.5rem !important;
        }

        .pf-topbar .row {
            margin-left: -5px !important;
            margin-right: -5px !important;
        }

        .pf-topbar .px-1 {
            padding-left: 5px !important;
            padding-right: 5px !important;
        }

        .pf-topbar .form-control,
        .pf-topbar .form-select,
        .pf-cat-select {
            font-size: 11px !important;
            padding: 0.35rem 0.5rem !important;
            height: 42px !important;
            border-radius: 8px !important;
            /* Save space on select */
        }

        .pf-topbar .btn {
            font-size: 11px !important;
            padding: 0.35rem 0.65rem !important;
            border-radius: 8px !important;
            height: 42px !important;
            display: flex;
            align-items: center;
        }

        .pf-topbar-info {
            font-size: 11px !important;
            margin-bottom: 0.25rem !important;
        }

        .w-100-mobile {
            width: 100% !important;
        }

        .pf-topbar .form-select {
            padding-right: 25px !important;
            background-position: right 8px center !important;
            background-size: 12px !important;
        }

        .pf-filter-controls>div {
            flex: 1 1 auto;
        }
    }


    /* AJAX Styles */
    .shortcode-projects-list.pf-is-loading {
        pointer-events: none;
    }

    .pf-ajax-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.6);
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(2px);
    }

    /* Skeleton Loading Styles */
    .pf-skeleton-item {
        opacity: 0.6;
    }

    .pf-skeleton-loading {
        background: #eee;
        background: linear-gradient(110deg, #ececec 8%, #f5f5f5 18%, #ececec 33%);
        background-size: 200% 100%;
        animation: 1.5s pf-skeleton-shine linear infinite;
        border-radius: 8px;
    }

    @keyframes pf-skeleton-shine {
        to {
            background-position-x: -200%;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.querySelector('.shortcode-projects-list');
        if (!container) return;

        const resultsArea = container.querySelector('#pf-ajax-results');
        const loadingOverlay = container.querySelector('#pf-ajax-loading');
        const skeletonTemplate = container.querySelector('#pf-skeleton-template');

        function updateContent(url, pushState = true) {
            // Show skeleton
            const grid = resultsArea.querySelector('.pf-results-grid');
            if (grid && skeletonTemplate) {
                grid.innerHTML = skeletonTemplate.innerHTML;
                resultsArea.querySelector('.pt-5')?.remove(); // Hide pagination
            }
            container.classList.add('pf-is-loading');

            fetch(url, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newResults = doc.querySelector('#pf-ajax-results');
                    const newTopbarInfo = doc.querySelector('.text-500.fs-7.me-auto');

                    if (newResults) {
                        resultsArea.innerHTML = newResults.innerHTML;

                        // Update result count
                        const currentInfo = container.querySelector('.text-500.fs-7.me-auto');
                        if (currentInfo && newTopbarInfo) currentInfo.innerHTML = newTopbarInfo.innerHTML;

                        // Sync search input
                        const searchInput = container.querySelector('input[name="search"]');
                        const newSearchInput = doc.querySelector('input[name="search"]');
                        if (searchInput && newSearchInput) searchInput.value = newSearchInput.value;

                        // Update Sidebar Links active state manually
                        const sidebarLinks = container.querySelectorAll('.d-flex.flex-column.gap-2 a');
                        const newSidebarLinks = doc.querySelectorAll('.d-flex.flex-column.gap-2 a');

                        sidebarLinks.forEach((link, idx) => {
                            if (newSidebarLinks[idx]) {
                                link.className = newSidebarLinks[idx].className;
                                // Also handle the badge colors inside links
                                const badge = link.querySelector('.badge');
                                const newBadge = newSidebarLinks[idx].querySelector('.badge');
                                if (badge && newBadge) badge.className = newBadge.className;
                            }
                        });

                        // Update Filter Controls (URLs and active states)
                        const filterControls = container.querySelector('.pf-filter-controls');
                        const newFilterControls = doc.querySelector('.pf-filter-controls');
                        if (filterControls && newFilterControls) {
                            filterControls.innerHTML = newFilterControls.innerHTML;
                        }

                        if (pushState) history.pushState(null, '', url);

                        if (window.innerWidth < 992) {
                            resultsArea.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        }
                    }
                })
                .catch(err => console.error('AJAX Error:', err))
                .finally(() => {
                    container.classList.remove('pf-is-loading');
                });
        }

        // Catch clicks on Category links & Pagination
        container.addEventListener('click', function (e) {
            const link = e.target.closest('a');
            if (!link) return;

            const url = new URL(link.href, window.location.origin);
            // Chỉ bắt link cùng trang hoặc link có query params lọc
            if (url.origin === window.location.origin && (url.search.includes('category') || url.search.includes('page') || url.search.includes('search') || url.search.includes('sort_by'))) {
                e.preventDefault();
                updateContent(link.href);
            }
        });

        // Catch Search Form
        container.addEventListener('submit', function (e) {
            if (e.target.tagName === 'FORM') {
                e.preventDefault();
                const formData = new FormData(e.target);
                const params = new URLSearchParams(formData);
                const baseUrl = window.location.pathname;
                updateContent(`${baseUrl}?${params.toString()}`);
            }
        });

        // Catch Select changes (Sort & Mobile Category & Programming Language)
        container.addEventListener('change', function (e) {
            if (e.target.tagName === 'SELECT') {
                e.preventDefault();
                if (e.target.name === 'sort_by' || e.target.name === 'programming_language') {
                    // It's in a form, trigger submit
                    e.target.form.dispatchEvent(new Event('submit', { cancelable: true, bubbles: true }));
                } else if (e.target.classList.contains('form-select')) {
                    // Likely the mobile category select or other
                    const val = e.target.value;
                    if (val.startsWith('http') || val.startsWith('/')) {
                        updateContent(val);
                    }
                }
            }
        });

        // Handle Back button
        window.addEventListener('popstate', function () {
            updateContent(window.location.href, false);
        });
    });
</script>

@if(request()->path() == 'du-an')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "CollectionPage",
  "name": "Kho 100+ Mẫu Website Chuyên Nghiệp, Chuẩn SEO 2026",
  "description": "Khám phá ngay kho giao diện mẫu website chuyên nghiệp đa ngành: Bán hàng, Bất động sản, Landing Page. Tối ưu UX/UI, chuẩn SEO, tốc độ cao.",
  "url": "https://teamdevdesign.net/du-an",
  "publisher": {
    "@type": "Organization",
    "name": "TeamDevDesign"
  }
}
</script>
@endif