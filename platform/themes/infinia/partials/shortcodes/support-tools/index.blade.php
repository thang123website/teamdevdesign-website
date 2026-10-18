<section {!! $shortcode->htmlAttributes() !!} class="shortcode-support-tools section-integrate section-padding">
    <div class="container">
        <div class="text-center mb-8">
            @if ($subtitle = $shortcode->subtitle)
                <div class="d-flex align-items-center position-relative z-2 justify-content-center bg-primary-soft d-inline-flex rounded-pill border border-2 border-white px-3 py-1">
                    <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                    <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
                </div>
            @endif

            @if ($title = $shortcode->title)
                <{{ $titleTag = infinia_title_tag($shortcode, 'h3') }} class="ds-3 my-3">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
            @endif
        </div>

        @if ($tools)
            <div class="row">
                @foreach($tools as $tool)
                    @php
                        $toolName = Arr::get($tool, 'name');
                        $toolLogo = Arr::get($tool, 'logo');
                        $actionLabel = Arr::get($tool, 'action_label');
                        $actionUrl = Arr::get($tool, 'action_url');
                        $toolDescription = Arr::get($tool, 'description');
                    @endphp

                    @continue(! $toolName)

                    <div class="col-lg-4 col-md-6">
                        <div class="border rounded-4 p-2 mb-4">
                            <div class="p-6 rounded-3 border">
                                @if ($toolLogo)
                                    {{ RvMedia::image($toolLogo, $toolName, attributes: ['class' => 'filter-invert']) }}
                                @endif

                                @if($toolDescription)
                                    <p class="pt-4 mt-4 mb-4 border-top">{!! BaseHelper::clean($toolDescription) !!}</p>
                                @endif

                                @if ($actionLabel && $actionUrl)
                                    <a href="{{ $actionUrl }}">
                                        <span class="fw-bold text-primary">{!! BaseHelper::clean($actionLabel) !!}</span>
                                        <svg class="ms-2" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                            <path class="fill-dark" d="M13.0633 4.06329L12.2615 4.86511L15.8294 8.43303H0V9.56698H15.8294L12.2615 13.1349L13.0633 13.9367L18 8.99997L13.0633 4.06329Z" fill="#111827" />
                                        </svg>
                                    </a>
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
