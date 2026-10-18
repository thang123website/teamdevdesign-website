{!! apply_filters('ads_render', null, 'post_before', ['class' => 'my-2 text-center']) !!}

<section>
    <div class="container mt-10">
        <div class="row">
            <div class="col-md-8 mx-auto">
                @if($post->categories->isNotEmpty())
                    <div class="d-flex gap-2">
                        @foreach($post->categories as $category)
                            <a href="{{ $category->url }}" class="bg-primary-soft rounded-pill px-3 fw-bold py-2 text-primary fs-7">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                @endif
                <h1 class="ds-5 mt-3 mb-4">{!! BaseHelper::clean($post->name) !!}</h1>
                @if($post->description)
                    <p class="fs-5 text-900 mb-0">
                        {!! BaseHelper::clean($post->description) !!}
                    </p>
                @endif
                <div class="d-flex align-items-center justify-content-between mt-7 py-3 border-top border-bottom">
                    <div class="d-flex align-items-center position-relative z-1">
                        @if($post->author)
                            <div class="icon-shape rounded-circle border border-2 border-white">
                                {{ RvMedia::image($post->author->avatar_url, $post->author->name, attributes: ['class' => 'rounded-circle', 'style' => 'width: 40px; height: 40px;']) }}
                            </div>
                        @endif
                        <div class="ms-3">
                            <h6 class="fs-7 m-0">{{ $post->author->name }}</h6>
                            <p class="mb-0 fs-8">
                                <time datetime="{{ $post->created_at->toIso8601String() }}">{{ $post->created_at->format('d/m/Y') }}</time>
                            </p>
                        </div>
                        <a href="{{ $post->url }}" title="{{ $post->name }}" class="position-absolute bottom-0 start-0 end-0 top-0 z-0"></a>
                    </div>
                    <div class="d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M12 19.25C16.0041 19.25 19.25 16.0041 19.25 12C19.25 7.99594 16.0041 4.75 12 4.75C7.99594 4.75 4.75 7.99594 4.75 12C4.75 16.0041 7.99594 19.25 12 19.25Z" stroke="#111827" stroke-width="1.5" />
                            <path d="M12 8V12L14 14" stroke="#111827" stroke-width="1.5" />
                        </svg>
                        <span class="ms-2 fs-7 text-900">{{ __(':time mins to read', ['time' => $post->time_reading]) }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-10 mx-auto my-7">
                {{ RvMedia::image($post->image, $post->name, attributes: ['class' => 'rounded-4 w-100']) }}
            </div>
            <div class="col-md-12">
                <div class="row justify-content-center position-relative" id="post-content-row">
                    <!-- TOC Desktop -->
                    <div class="col-lg-3 d-none d-lg-block position-relative" id="desktop-toc-container">
                        <div id="desktop-toc-wrapper" style="top: 120px; z-index: 10;">
                            <div class="p-4 bg-white rounded-4 shadow-sm border border-light">
                                <div class="d-flex align-items-center justify-content-between mb-3" id="desktop-toc-toggle" style="cursor: pointer; user-select: none;">
                                    <h5 class="m-0 fs-6 fw-bold text-dark">{{ __('Nội dung') }}</h5>
                                    <div class="rounded-circle text-white d-flex align-items-center justify-content-center" style="width: 26px; height: 26px; transition: transform 0.3s; background: var(--primary-color, #007bff);" id="desktop-toc-icon">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 15l-6-6-6 6"/></svg>
                                    </div>
                                </div>
                                <div id="toc-content-desktop" class="toc-wrapper mt-3"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Content -->
                    <div class="col-lg-8">
                        @php
                            $postContent = infinia_render_post_content(BaseHelper::clean($post->content));
                        @endphp
                        <style>
                            .ck-content .post-table-wrap { margin: 1.5rem 0; border: 1px solid #e5e7eb; border-radius: 12px; }
                            .ck-content .post-table-wrap table { width: 100% !important; margin: 0; border: 0 !important; border-collapse: collapse !important; font-size: 15px; }
                            .ck-content .post-table-wrap th,
                            .ck-content .post-table-wrap td { border: 0; border-bottom: 1px solid #e5e7eb; border-right: 1px solid #e5e7eb; padding: 12px 16px; vertical-align: top; text-align: left; min-width: 140px; }
                            .ck-content .post-table-wrap tr > *:last-child { border-right: 0; }
                            .ck-content .post-table-wrap tbody tr:last-child td { border-bottom: 0; }
                            .ck-content .post-table-wrap thead th { background: rgba(var(--bs-primary-rgb), .08); color: var(--bs-primary); font-weight: 700; white-space: nowrap; }
                            .ck-content .post-table-wrap tbody tr:nth-child(even) { background: #f9fafb; }
                            .ck-content .post-table-wrap tbody tr:hover { background: rgba(var(--bs-primary-rgb), .04); }
                            .ck-content .post-faq-accordion .card-header a { text-decoration: none; }
                            .ck-content .post-faq-accordion .card-body > *:last-child { margin-bottom: 0; }
                            .ck-content .post-faq-accordion .icon-shape { width: 24px; height: 24px; align-items: center; justify-content: center; }
                        </style>
                        <div class="ck-content" id="post-content">
                            {!! $postContent['html'] !!}
                        </div>
                        {!! infinia_post_faq_schema($postContent['faqs']) !!}
                        
                        <div class="mb-5 py-3">
                            @if ($post->tags->isNotEmpty())
                                <div class="d-flex align-items-center mt-5">
                                    <p class="fw-bold text-500 mb-0 me-2">{{ __('Tags:') }}</p>
                                    @foreach($post->tags as $tag)
                                        <a href="{{ $tag->url }}" class="bg-primary-soft rounded-pill px-3 fw-bold py-2 text-primary fs-7 me-1">
                                            {{ $tag->name }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif

                            <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center mt-5">
                                <p class="fw-bold text-500 mb-3 mb-md-0 me-md-4">{{ __('Share this post:') }}</p>
                                {!! Theme::renderSocialSharing($post->url, SeoHelper::getDescription(), $post->image) !!}
                            </div>
                            {!! apply_filters(BASE_FILTER_PUBLIC_COMMENT_AREA, null, $post) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mobile TOC Button -->
<button type="button" class="btn rounded-circle position-fixed d-lg-none d-flex align-items-center justify-content-center text-white" 
        id="mobile-toc-btn"
        style="bottom: 30px; left: 15px; width: 48px; height: 48px; z-index: 1050; padding: 0; border: none; background: var(--primary-color, #007bff); box-shadow: 0 4px 15px rgba(0,0,0,0.2);"
        data-bs-toggle="offcanvas" data-bs-target="#mobileTocOffcanvas">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="15" y2="18"></line></svg>
</button>

<!-- Mobile TOC Offcanvas -->
<div class="offcanvas offcanvas-start border-0 shadow" tabindex="-1" id="mobileTocOffcanvas" aria-labelledby="mobileTocOffcanvasLabel" style="width: 300px; z-index: 1055;">
    <div class="offcanvas-header border-bottom pb-3 pt-4 px-4">
        <h5 class="offcanvas-title fw-bold text-dark d-flex align-items-center" id="mobileTocOffcanvasLabel">
            <svg width="20" height="20" class="me-2" style="color: var(--primary-color, #007bff);" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>
            {{ __('Nội dung') }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-4">
        <div id="toc-content-mobile" class="toc-wrapper"></div>
    </div>
</div>

<style>
    .toc-wrapper { max-height: calc(100vh - 200px); overflow-y: auto; scroll-behavior: smooth; }
    .toc-wrapper::-webkit-scrollbar { width: 4px; }
    .toc-wrapper::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 10px; }
    .toc-wrapper ul { list-style: none; padding-left: 0; margin: 0; }
    .toc-wrapper ul ul { padding-left: 1.25rem; }
    .toc-wrapper li { margin-bottom: 0.8rem; }
    .toc-wrapper a {
        color: #4b5563;
        text-decoration: none;
        font-size: 0.95rem;
        display: block;
        transition: all 0.2s ease;
        line-height: 1.5;
    }
    .toc-wrapper a.active {
        color: var(--primary-color, #007bff);
        font-weight: 700;
        background: rgba(0, 0, 0, 0.04);
        border-left-color: var(--primary-color, #007bff);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const content = document.getElementById('post-content');
        if (!content) return;

        const allowedHeadings = '{!! theme_option('toc_headings', 'h2, h3, h4') !!}';
        const headings = content.querySelectorAll(allowedHeadings);
        
        if (headings.length < 2) {
            const desktopToc = document.getElementById('desktop-toc-container');
            if (desktopToc) desktopToc.style.display = 'none';
            const mobileBtn = document.getElementById('mobile-toc-btn');
            if (mobileBtn) mobileBtn.style.display = 'none';
            return;
        }

        let tocHTML = '<ul>';
        let currentLevel = parseInt(headings[0].tagName.substring(1));

        headings.forEach((heading, index) => {
            if (!heading.id) {
                let slug = heading.textContent.trim().normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase().replace(/đ/g, 'd').replace(/[^a-z0-9\s-]/g, '').replace(/[\s_-]+/g, '-').replace(/^-+|-+$/g, '');
                if(!slug) slug = 'heading';
                heading.id = slug + '-' + index;
            }

            const level = parseInt(heading.tagName.substring(1));
            const text = heading.textContent;
            const id = heading.id;

            if (level > currentLevel) {
                tocHTML += '<ul>'.repeat(level - currentLevel);
            } else if (level < currentLevel) {
                tocHTML += '</ul>'.repeat(currentLevel - level);
            }
            currentLevel = level;

            tocHTML += `<li><a href="#${id}" class="toc-link">${text}</a></li>`;
        });
        
        tocHTML += '</ul>'.repeat(currentLevel - parseInt(headings[0].tagName.substring(1)) + 1);

        const desktopContainer = document.getElementById('toc-content-desktop');
        const mobileContainer = document.getElementById('toc-content-mobile');
        
        if (desktopContainer) desktopContainer.innerHTML = tocHTML;
        if (mobileContainer) mobileContainer.innerHTML = tocHTML;

        const links = document.querySelectorAll('.toc-link');
        
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                const targetEl = document.getElementById(targetId);
                
                if (targetEl) {
                    const mobileOffcanvas = document.getElementById('mobileTocOffcanvas');
                    if (mobileOffcanvas && mobileOffcanvas.classList.contains('show') && typeof bootstrap !== 'undefined') {
                        const bsOffcanvas = bootstrap.Offcanvas.getInstance(mobileOffcanvas) || new bootstrap.Offcanvas(mobileOffcanvas);
                        bsOffcanvas.hide();
                    }
                    
                    const headerOffset = 110; 
                    const elementPosition = targetEl.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Accurate Scroll Tracking for Active State
        function updateActiveTOC() {
            let currentActive = null;
            const headerOffset = 130; // Margin below header to trigger active

            for (let i = 0; i < headings.length; i++) {
                const rect = headings[i].getBoundingClientRect();
                if (rect.top <= headerOffset + 20) {
                    currentActive = headings[i];
                } else {
                    break;
                }
            }

            if (!currentActive && headings.length > 0 && window.scrollY < 100) {
                currentActive = headings[0];
            }

            if (currentActive) {
                const id = currentActive.id;
                
                // Check if the current active heading is already active in the DOM
                let alreadyActive = true;
                const activeLinks = document.querySelectorAll(`.toc-link[href="#${id}"]`);
                activeLinks.forEach(link => {
                    if (!link.classList.contains('active')) alreadyActive = false;
                });
                
                if (!alreadyActive && activeLinks.length > 0) {
                    // Remove active from all links
                    document.querySelectorAll('.toc-link').forEach(l => l.classList.remove('active'));
                    // Add active to the corresponding links (both Desktop and Mobile)
                    activeLinks.forEach(link => {
                        link.classList.add('active');
                        // Auto-scroll the desktop TOC container if needed
                        const container = link.closest('.toc-wrapper');
                        if (container && window.innerWidth >= 992) {
                            const offset = link.offsetTop - container.offsetTop - (container.clientHeight / 2);
                            container.scrollTop = offset;
                        }
                    });
                }
            }
        }

        window.addEventListener('scroll', updateActiveTOC, { passive: true });
        setTimeout(updateActiveTOC, 100);

        // Toggle Desktop TOC
        const tocToggle = document.getElementById('desktop-toc-toggle');
        const tocIcon = document.getElementById('desktop-toc-icon');
        if (tocToggle && desktopContainer) {
            tocToggle.addEventListener('click', function() {
                if (desktopContainer.style.display === 'none') {
                    desktopContainer.style.display = 'block';
                    tocIcon.style.transform = 'rotate(0deg)';
                } else {
                    desktopContainer.style.display = 'none';
                    tocIcon.style.transform = 'rotate(180deg)';
                }
            });
        }

        // Robust Sticky Logic for Desktop TOC
        const tocWrapper = document.getElementById('desktop-toc-wrapper');
        const tocCol = document.getElementById('desktop-toc-container');
        const rowContent = document.getElementById('post-content-row');
        
        if (tocWrapper && tocCol && rowContent) {
            function updateStickyTOC() {
                if (window.innerWidth < 992) {
                    tocWrapper.style.position = '';
                    tocWrapper.style.width = '';
                    tocWrapper.style.top = '';
                    tocWrapper.style.bottom = '';
                    return;
                }
                
                const offsetTop = 120;
                const rowRect = rowContent.getBoundingClientRect();
                const colRect = tocCol.getBoundingClientRect();
                const colStyle = window.getComputedStyle(tocCol);
                const pl = parseFloat(colStyle.paddingLeft || 0);
                const pr = parseFloat(colStyle.paddingRight || 0);
                const correctWidth = colRect.width - pl - pr;
                const wrapperHeight = tocWrapper.offsetHeight;
                
                if (rowRect.top <= offsetTop) {
                    // Row is touching or above the offset
                    if (rowRect.bottom <= offsetTop + wrapperHeight) {
                        // Reached bottom of the row
                        tocWrapper.style.position = 'absolute';
                        tocWrapper.style.top = 'auto';
                        tocWrapper.style.bottom = '0';
                        tocWrapper.style.left = pl + 'px';
                        tocWrapper.style.width = correctWidth + 'px';
                    } else {
                        // Sticking
                        tocWrapper.style.position = 'fixed';
                        tocWrapper.style.top = offsetTop + 'px';
                        tocWrapper.style.bottom = 'auto';
                        tocWrapper.style.left = (colRect.left + pl) + 'px';
                        tocWrapper.style.width = correctWidth + 'px';
                    }
                } else {
                    // Normal static position
                    tocWrapper.style.position = 'relative';
                    tocWrapper.style.top = 'auto';
                    tocWrapper.style.bottom = 'auto';
                    tocWrapper.style.left = 'auto';
                    tocWrapper.style.width = 'auto';
                }
            }
            
            window.addEventListener('scroll', updateStickyTOC, { passive: true });
            window.addEventListener('resize', updateStickyTOC);
            // Initial call
            setTimeout(updateStickyTOC, 100);
        }
    });
</script>

@php
    $relatedPosts = get_related_posts($post->getKey(), 3);
@endphp

@if($relatedPosts->isNotEmpty())
    <section class="section-blog-8 section-padding pb-0 position-relative fix">
        <div class="container position-relative z-1">
            <div class="row text-center">
                <h5 class="ds-5">{{ __('Related Posts') }}</h5>
            </div>
            <div class="row">
                @foreach($relatedPosts as $post)
                    <div class="col-lg-4 text-start">
                        @include(Theme::getThemeNamespace('views.templates.partials.post-item'))
                    </div>
                @endforeach
            </div>
        </div>
        <div class="rotate-center ellipse-rotate-success position-absolute z-0"></div>
        <div class="rotate-center-rev ellipse-rotate-primary position-absolute z-0"></div>
    </section>
@endif

{!! apply_filters('ads_render', null, 'post_after', ['class' => 'my-2 text-center']) !!}
