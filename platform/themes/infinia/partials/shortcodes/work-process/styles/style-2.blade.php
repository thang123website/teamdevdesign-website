<section {!! $shortcode->htmlAttributes() !!} class="shortcode-work-process shortcode-work-process-style-2 section-work-process"
    @style($variablesStyle)
>
    <div class="container step-2 pt-120 pb-120">
        <div class="row align-items-center">
            @if ($image = $shortcode->image)
                <div class="col-lg-6">
                    <div class="position-relative d-inline-block mt-lg-0 mt-8">
                        <div class="position-relative z-1 d-inline-block zoom-img rounded-4 border-5 border-white border">
                            {{ RvMedia::image($image, infinia_image_alt($shortcode)) }}
                        </div>
                        <div class="square position-absolute rounded-4 bg-linear-1 w-100 h-100 z-0"></div>
                    </div>
                </div>
            @endif

            <div class="col-lg-6 ps-md-8">
                @if ($no = $shortcode->no)
                    <h3 class="ds-3">{!! Basehelper::clean($no) !!}<span class="text-primary">.</span></h3>
                @endif

                @if ($title = $shortcode->title)
                    <h5 class="ds-5">{!! Basehelper::clean($title) !!}</h5>
                @endif

                @if ($description = $shortcode->description)
                    <p class="fs-5">{!! BaseHelper::clean($description) !!}</p>
                @endif

                @if ($features)
                    <ul class="list-unstyled mt-5">
                        @foreach($features as $feature)
                            @continue(! $featureTitle = Arr::get($feature, 'title'))
                            <li class="d-flex align-items-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.00004 1.00403C11.8654 1.00403 15.0001 4.13873 15.0001 8.00407C15.0001 11.8694 11.8654 15.0041 8.00004 15.0041C4.13471 15.0041 1 11.8694 1 8.00407C1 4.13873 4.13471 1.00403 8.00004 1.00403ZM6.5464 10.2777L4.83261 8.56254C4.54065 8.27039 4.54059 7.79399 4.83261 7.50191C5.1247 7.20988 5.60322 7.21171 5.89319 7.50191L7.1014 8.71106L10.107 5.70545C10.3991 5.41336 10.8756 5.41336 11.1676 5.70545C11.4597 5.99748 11.4593 6.47435 11.1676 6.76603L7.63083 10.3028C7.33916 10.5945 6.86228 10.5949 6.57025 10.3028C6.56205 10.2946 6.55413 10.2862 6.5464 10.2777Z" fill="#6D4DF2" />
                                </svg>
                                <p class="fs-5 text-900 mb-0 ms-2 fw-bold">{!! BaseHelper::clean($featureTitle) !!}</p>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</section>
