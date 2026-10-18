@if (theme_option('display_header_top', true))
    {!! Theme::partial('header-top') !!}
@endif

<header>
    @php
        $headerSidebar = dynamic_sidebar('header_sidebar');
        $headerLayout = theme_option('header_layout', 'container');
        $headerLayout = in_array($headerLayout, ['container', 'full-width']) ? $headerLayout : 'container';
    @endphp

    @if($headerSidebar)
        <nav @class(['navbar navbar-expand-lg navbar-light w-100 z-999', 'navbar-sticky' => theme_option('sticky_header_enabled', true)])>
            <div @class(['container' => $headerLayout == 'container', 'container-fluid px-md-8 px-2' => $headerLayout == 'full-width'])>
                {!! $headerSidebar !!}
            </div>
        </nav>

        @if (is_plugin_active('blog'))
            <div class="offcanvas offcanvas-top offcanvasTop h-50" tabindex="-1">
                <div class="offcanvas-header">
                    <button class="btn-close" data-bs-dismiss="offcanvas" aria-label="{{ __('Close') }}"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="container">
                        <div class="row py-md-5 py-2">
                            <form action="{{ $searchPostUrl = route('public.search') }}" method="GET" class="col-12 col-lg-8 mx-auto">
                                <div class="h4 mb-2 fs-sm-5">{{ __('What are you looking for?') }}</div>
                                <p class="text-500 fs-6 mb-5">{{ __('Explore our services and discover how we can help you achieve your goals') }}</p>
                                <div class="input-group" data-aos="zoom-in">
                                    <input type="text" class="form-control ps-5 rounded-start-pill" name="name" placeholder="{{ __('Nhập từ khóa tìm kiếm') }}" aria-label="{{ __('Nhập từ khóa tìm kiếm') }}" />
                                    <button type="submit" class="btn btn-primary rounded-end-pill" aria-label="{{ __('Search') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M19.25 19.25L15.5 15.5M4.75 11C4.75 7.54822 7.54822 4.75 11 4.75C14.4518 4.75 17.25 7.54822 17.25 11C17.25 14.4518 14.4518 17.25 11 17.25C7.54822 17.25 4.75 14.4518 4.75 11Z"
                                                stroke="white"
                                                stroke-width="1.5"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            />
                                        </svg>
                                    </button>
                                </div>
                                @php
                                    $suggestKeywords = theme_option('suggest_keywords');
                                    $suggestKeywords = $suggestKeywords ? explode(',', $suggestKeywords) : '';
                                @endphp

                                @if($suggestKeywords)
                                    <div class="d-flex flex-column flex-lg-row mt-5">
                                        <strong class="d-inline fs-6 me-2">{{ __('Suggest:') }}</strong>
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach($suggestKeywords as $keyword)
                                                <a href="{{ $searchPostUrl . '?q=' . urlencode(trim($keyword)) }}">{!! BaseHelper::clean($keyword) !!}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif

    <div class="mobile-header-active mobile-header-wrapper-style perfect-scrollbar button-bg-2">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-logo">
                <a class="navbar-brand d-flex main-logo align-items-center" href="{{ BaseHelper::getHomepageUrl() }}">
                    {{ Theme::getLogoImage(['class' => 'logo-dark'], 'logo_dark', 37) }}
                    {{ Theme::getLogoImage(['class' => 'logo-white'], 'logo', 37) }}
                </a>
                <div class="burger-icon burger-icon-white border rounded-3">
                    <span class="burger-icon-top"></span>
                    <span class="burger-icon-mid"></span>
                    <span class="burger-icon-bottom"></span>
                </div>
            </div>

            <div class="mobile-header-content-area">
                <div class="perfect-scroll">
                    <div class="mobile-menu-wrap mobile-header-border">
                        <nav>
                            {!! Menu::renderMenuLocation('main-menu', [
                                'view' => 'mobile-menu',
                                'options' => ['class' => 'mobile-menu font-heading ps-0'],
                            ]) !!}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
