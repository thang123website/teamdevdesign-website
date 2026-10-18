@php
    $columns = $shortcode->columns ?? '3';
    $showFilter = $shortcode->show_filter !== 'no';
    $showSearch = $shortcode->show_search !== 'no';
    $showSort = $shortcode->show_sort !== 'no';
    $cardStyle = $shortcode->card_style ?? 'default';
@endphp

<div class="pf-projects-list-wrapper">
    <div class="pf-projects-container" style="display: flex; gap: 24px; align-items: flex-start;">

        {{-- Sidebar filter --}}
        @if($showFilter && $categories->count() > 0)
            <div class="pf-projects-sidebar" style="min-width:260px; max-width:280px; flex-shrink:0;">
                <div class="pf-filter-box"
                    style="background:#fff; border-radius:12px; box-shadow:0 2px 12px rgba(0,0,0,0.08); padding:24px; margin-bottom:20px;">
                    <div class="pf-filter-label"
                        style="font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:#888; margin-bottom:8px;">
                        {{ __('Bộ lọc danh mục') }}
                    </div>
                    <h3 style="font-size:18px; font-weight:700; color:#1a1a2e; margin:0 0 16px;">
                        {{ __('Duyệt theo ngành nghề') }}
                    </h3>

                    <div class="pf-category-list">
                        <a href="{{ request()->fullUrlWithoutQuery(['category', 'page']) }}"
                            class="pf-cat-item {{ !request('category') ? 'active' : '' }}"
                            style="display:flex; align-items:center; justify-content:space-between; padding:10px 14px; border-radius:8px; text-decoration:none; margin-bottom:6px; font-weight:500; transition:all .2s;
                                                       {{ !request('category') ? 'background:#1d72d6; color:#fff;' : 'background:#f5f7fa; color:#333;' }}">
                            <span>{{ __('Tất cả mẫu website') }}</span>
                            <span
                                style="font-size:13px; font-weight:600; opacity:.85;">{{ number_format($totalProjects) }}</span>
                        </a>

                        @foreach($categories as $cat)
                            <a href="{{ request()->fullUrlWithQuery(['category' => $cat->id, 'page' => 1]) }}"
                                class="pf-cat-item {{ request('category') == $cat->id ? 'active' : '' }}"
                                style="display:flex; align-items:center; justify-content:space-between; padding:10px 14px; border-radius:8px; text-decoration:none; margin-bottom:6px; font-weight:500; transition:all .2s;
                                                                                       {{ request('category') == $cat->id ? 'background:#1d72d6; color:#fff;' : 'background:#f5f7fa; color:#333;' }}">
                                <span>{{ $cat->name }}</span>
                                <span
                                    style="font-size:13px; font-weight:600; opacity:.85;">{{ number_format($cat->projects_count) }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- CTA Box --}}
                <div class="pf-sidebar-cta"
                    style="background:linear-gradient(135deg,#1a1a6e 0%,#3a3aaa 100%); border-radius:12px; padding:24px; color:#fff;">
                    <div
                        style="font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:1.5px; color:rgba(255,255,255,.7); margin-bottom:8px;">
                        {{ __('Cần chốt nhanh?') }}
                    </div>
                    <h4 style="font-size:20px; font-weight:800; line-height:1.35; margin:0 0 12px;">
                        {{ __('Gửi ngành nghề và phong cách bạn muốn.') }}
                    </h4>
                    <p style="font-size:13px; line-height:1.6; opacity:.85; margin-bottom:18px;">
                        {{ __('Chúng tôi sẽ lọc mẫu phù hợp hơn thay vì phải xem toàn bộ danh sách.') }}
                    </p>
                    <a href="/lien-he"
                        style="display:inline-block; background:#3ebae8; color:#fff; border-radius:8px; padding:11px 22px; font-size:14px; font-weight:700; text-decoration:none;">
                        {{ __('Liên hệ tư vấn') }}
                    </a>
                </div>
            </div>
        @endif

        {{-- Main content --}}
        <div class="pf-projects-main" style="flex:1; min-width:0;">
            {{-- Top bar --}}
            <div class="pf-topbar"
                style="display:flex; align-items:center; gap:12px; flex-wrap:wrap; margin-bottom:20px; background:#fff; border-radius:12px; padding:14px 18px; box-shadow:0 2px 10px rgba(0,0,0,0.07);">
                @if($showSearch)
                    <form method="GET" action="" style="flex:1; display:flex; gap:8px; min-width:220px;">
                        @foreach(request()->except(['search', 'page']) as $key => $val)
                            <input type="hidden" name="{{ $key }}" value="{{ $val }}">
                        @endforeach
                        <input type="text" name="search" value="{{ $search }}"
                            placeholder="{{ __('Tìm theo tên mẫu giao diện') }}"
                            style="flex:1; border:1.5px solid #e0e4ea; border-radius:8px; padding:10px 16px; font-size:14px; outline:none;">
                        <button type="submit"
                            style="background:#1d72d6; color:#fff; border:none; border-radius:8px; padding:10px 20px; font-weight:700; cursor:pointer; white-space:nowrap;">
                            {{ __('Tìm mẫu') }}
                        </button>
                    </form>
                @endif

                @if($showSort)
                    <form method="GET" action="" id="sort-form" style="min-width:180px;">
                        @foreach(request()->except(['sort_by', 'page']) as $key => $val)
                            <input type="hidden" name="{{ $key }}" value="{{ $val }}">
                        @endforeach
                        <select name="sort_by" onchange="document.getElementById('sort-form').submit()"
                            style="border:1.5px solid #e0e4ea; border-radius:8px; padding:10px 14px; font-size:14px; width:100%; background:#fff; cursor:pointer; outline:none;">
                            <option value="latest" {{ $sortBy == 'latest' ? 'selected' : '' }}>{{ __('Thứ tự mặc định') }}
                            </option>
                            <option value="oldest" {{ $sortBy == 'oldest' ? 'selected' : '' }}>{{ __('Cũ nhất') }}</option>
                            <option value="name_asc" {{ $sortBy == 'name_asc' ? 'selected' : '' }}>{{ __('Tên A-Z') }}
                            </option>
                            <option value="name_desc" {{ $sortBy == 'name_desc' ? 'selected' : '' }}>{{ __('Tên Z-A') }}
                            </option>
                            <option value="featured" {{ $sortBy == 'featured' ? 'selected' : '' }}>{{ __('Nổi bật trước') }}
                            </option>
                        </select>
                    </form>
                @endif
            </div>

            {{-- Projects Grid --}}
            @if($projects->count() > 0)
                <div class="pf-grid" style="display:grid; grid-template-columns:repeat({{ $columns }}, 1fr); gap:20px;">
                    @foreach($projects as $project)
                        <div class="pf-card"
                            style="background:#fff; border-radius:12px; overflow:hidden; box-shadow:0 2px 12px rgba(0,0,0,0.08); transition:transform .25s, box-shadow .25s;"
                            onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 28px rgba(0,0,0,0.14)';"
                            onmouseout="this.style.transform=''; this.style.boxShadow='0 2px 12px rgba(0,0,0,0.08)';">
                            {{-- Thumbnail --}}
                            <div class="pf-card-thumb" style="position:relative; overflow:hidden; aspect-ratio:4/3;">
                                @if($project->image)
                                    <img src="{{ RvMedia::getImageUrl($project->image, 'medium', false, RvMedia::getDefaultImage()) }}"
                                        alt="{{ $project->name }}"
                                        style="width:100%; height:100%; object-fit:cover; transition:transform .4s;"
                                        onmouseover="this.style.transform='scale(1.05)'"
                                        onmouseout="this.style.transform='scale(1)'">
                                @else
                                    <div
                                        style="width:100%; height:100%; background:linear-gradient(135deg,#e0e7ff,#c7d2fe); display:flex; align-items:center; justify-content:center;">
                                        <span style="font-size:40px;">🎨</span>
                                    </div>
                                @endif
                                @if($project->is_featured)
                                    <span
                                        style="position:absolute; top:10px; left:10px; background:#f59e0b; color:#fff; font-size:11px; font-weight:700; padding:3px 10px; border-radius:20px;">
                                        {{ __('Nổi bật') }}
                                    </span>
                                @endif
                                @if($project->category)
                                    <span
                                        style="position:absolute; top:10px; right:10px; background:rgba(29,114,214,0.9); color:#fff; font-size:11px; font-weight:600; padding:3px 10px; border-radius:20px;">
                                        {{ $project->category->name }}
                                    </span>
                                @endif
                            </div>

                            {{-- Card body --}}
                            <div class="pf-card-body" style="padding:16px;">
                                <h3 style="font-size:15px; font-weight:700; color:#1a1a2e; margin:0 0 8px; line-height:1.4;">
                                    {{ $project->name }}
                                </h3>
                                @if($project->description)
                                    <p
                                        style="font-size:13px; color:#666; margin:0 0 14px; line-height:1.55; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">
                                        {{ $project->description }}
                                    </p>
                                @endif
                                <div style="display:flex; gap:8px; flex-wrap:wrap;">
                                    <a href="{{ $project->url }}"
                                        style="display:inline-flex; align-items:center; gap:6px; background:#1d72d6; color:#fff; border-radius:7px; padding:9px 16px; font-size:13px; font-weight:700; text-decoration:none; transition:background .2s;"
                                        onmouseover="this.style.background='#1558b0'"
                                        onmouseout="this.style.background='#1d72d6'">
                                        {{ __('Xem chi tiết') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if($projects->hasPages())
                    <div style="margin-top:32px; display:flex; justify-content:center;">
                        <div class="pf-pagination" style="display:flex; gap:6px; align-items:center; flex-wrap:wrap;">
                            {{-- Previous --}}
                            @if($projects->onFirstPage())
                                <span
                                    style="padding:8px 14px; border-radius:8px; background:#f5f7fa; color:#ccc; font-weight:600; cursor:not-allowed;">‹</span>
                            @else
                                <a href="{{ $projects->previousPageUrl() }}"
                                    style="padding:8px 14px; border-radius:8px; background:#f5f7fa; color:#333; font-weight:600; text-decoration:none; transition:background .2s;"
                                    onmouseover="this.style.background='#e0e7ff'" onmouseout="this.style.background='#f5f7fa'">‹</a>
                            @endif

                            {{-- Pages --}}
                            @foreach($projects->getUrlRange(max(1, $projects->currentPage() - 2), min($projects->lastPage(), $projects->currentPage() + 2)) as $page => $url)
                                @if($page == $projects->currentPage())
                                    <span
                                        style="padding:8px 14px; border-radius:8px; background:#1d72d6; color:#fff; font-weight:700; min-width:38px; text-align:center;">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}"
                                        style="padding:8px 14px; border-radius:8px; background:#f5f7fa; color:#333; font-weight:600; text-decoration:none; min-width:38px; text-align:center; transition:background .2s;"
                                        onmouseover="this.style.background='#e0e7ff'"
                                        onmouseout="this.style.background='#f5f7fa'">{{ $page }}</a>
                                @endif
                            @endforeach

                            {{-- Next --}}
                            @if($projects->hasMorePages())
                                <a href="{{ $projects->nextPageUrl() }}"
                                    style="padding:8px 14px; border-radius:8px; background:#f5f7fa; color:#333; font-weight:600; text-decoration:none; transition:background .2s;"
                                    onmouseover="this.style.background='#e0e7ff'" onmouseout="this.style.background='#f5f7fa'">›</a>
                            @else
                                <span
                                    style="padding:8px 14px; border-radius:8px; background:#f5f7fa; color:#ccc; font-weight:600; cursor:not-allowed;">›</span>
                            @endif
                        </div>
                    </div>
                @endif

            @else
                <div
                    style="text-align:center; padding:60px 20px; background:#fff; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,0.07);">
                    <div style="font-size:48px; margin-bottom:16px;">🔍</div>
                    <h3 style="font-size:18px; color:#555; font-weight:600;">{{ __('Không tìm thấy dự án nào.') }}</h3>
                    <p style="color:#888; margin-top:8px;">{{ __('Thử thay đổi bộ lọc hoặc từ khóa tìm kiếm.') }}</p>
                    <a href="{{ request()->url() }}"
                        style="display:inline-block; margin-top:16px; background:#1d72d6; color:#fff; border-radius:8px; padding:10px 22px; text-decoration:none; font-weight:700;">
                        {{ __('Xem tất cả') }}
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    @media (max-width: 900px) {
        .pf-projects-container {
            flex-direction: column !important;
        }

        .pf-projects-sidebar {
            min-width: 100% !important;
            max-width: 100% !important;
        }

        .pf-grid {
            grid-template-columns: repeat(2, 1fr) !important;
        }
    }

    @media (max-width: 600px) {
        .pf-grid {
            grid-template-columns: 1fr !important;
        }

        .pf-topbar {
            flex-direction: column !important;
            align-items: stretch !important;
        }
    }

    .pf-cat-item:hover {
        opacity: .9;
    }
</style>