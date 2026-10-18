<section {!! $shortcode->htmlAttributes() !!} class="section-pricing-2 position-relative fix section-padding">
    <div class="container position-relative z-2">
        <div class="text-center mb-8">
            @if ($subtitle = $shortcode->subtitle)
                <div class="d-flex align-items-center position-relative z-2 justify-content-center bg-primary-soft d-inline-flex rounded-pill border border-2 border-white px-3 py-1">
                    <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true" />
                    <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
                </div>
            @endif

            @if ($title = $shortcode->title)
                <{{ $titleTag = infinia_title_tag($shortcode, 'h3') }} class="ds-3 my-3 fw-bold">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
            @endif

            @if ($description = $shortcode->description)
                <p class="fs-5 mb-0">{!! BaseHelper::clean($description) !!}</p>
            @endif

            <div class="d-flex justify-content-center mt-5">
                <ul class="list-unstyled d-flex align-items-center change-price-plan bg-white rounded-pill py-1 shadow-2">
                    <li><a href="#" class="active px-6 py-2 text-900 bg-transparent monthly rounded-pill text-white fs-6 fw-bold z-1" data-type="monthly">{{ __('Monthly') }}</a></li>
                    <li><a href="#" class="yearly px-6 py-2 text-900 bg-transparent monthly rounded-pill text-white fs-6 fw-bold z-1" data-type="yearly">{{ __('Yearly') }}</a></li>
                </ul>
            </div>
        </div>
        <div class="row justify-content-center align-items-center">
            @foreach($packages as $package)
                <div @class(['col-md-12 px-lg-0 mb-lg-0 mb-4', 'col-lg-3' => !$package->is_popular, 'col-lg-4 rounded-4' => $package->is_popular])>
                    <div @class(['pricing-plan-item position-relative border rounded-4 z-1',
                        'rounded-end-lg-0' => ! $loop->last && !$package->is_popular,
                        'border-start-lg-0' => ! $loop->first && !$package->is_popular,
                        'rounded-start-lg-0' => (! $loop->first || $loop->last) && !$package->is_popular,
                        'p-6 bg-white' => ! $package->is_popular,
                        'p-8 bg-linear-2' => $package->is_popular
                    ])>
                        @if($package->is_popular)
                            <div class="position-absolute top-0 end-0 z-0">
                                <img src="{{ Theme::asset()->url('images/shapes/bg-line.png') }}" alt="" aria-hidden="true">
                            </div>

                            <div class="position-relative z-1">
                        @endif

                        <strong @class(['d-block fs-6', 'text-white' => $package->is_popular])>{{ $package->name }}</strong>

                        @if($packageDescription = $package->description)
                            <p @class(['fs-7', 'text-white' => $package->is_popular])>{!! BaseHelper::clean($packageDescription) !!}</p>
                        @endif
                        <div @class(['mt-3 mb-0 d-flex', 'text-primary' => !$package->is_popular, 'text-white' => $package->is_popular])>
                            @if (! $package->is_popular)
                                <h4 class="text-primary mb-0 text-price-enterprise" data-annual-price="{{ $package->annual_price == 0 ? __('Free') : $package->annual_price }}" data-monthly-price="{{ $package->price == 0 ? __('Free') : $package->price }}">
                                    {{ $package->price == 0 ? __('Free') : $package->price }}
                                </h4>
                            @else
                                <h4 class="mb-0 text-price-enterprise text-white" data-annual-price="{{ $package->annual_price == 0 ? __('Free') : $package->annual_price }}" data-monthly-price="{{ $package->price == 0 ? __('Free') : $package->price }}">
                                    {{ $package->price == 0 ? __('Free') : $package->price }}
                                </h4>
                            @endif
                            @if ($package->price != 0)
                                <span @class(['ms-1 fw-bold align-self-end text-type-enterprise', 'text-white fs-5' => $package->is_popular, 'text-600 fs-5' => ! $package->is_popular]) data-annual-duration="{{ __('Year') }}" data-monthly-duration="{{ $package->duration->label() }}">
                                    /{{ $package->duration->label() }}
                                </span>
                            @endif
                        </div>


                        @if (!$package->is_popular && ($actionLabel = $package->action_label) && ($actionUrl = $package->action_url))
                            <a href="{{ $actionUrl }}" class="btn btn-outline-secondary hover-up w-100 d-flex justify-content-between my-5">
                                {!! BaseHelper::clean($actionLabel) !!}
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path class="fill-dark" d="M17.4177 5.41797L16.3487 6.48705L21.1059 11.2443H0V12.7562H21.1059L16.3487 17.5134L17.4177 18.5825L24 12.0002L17.4177 5.41797Z" fill="#111827" />
                                </svg>
                            </a>
                        @endif

                        <ul @class(['list-unstyled mb-0', 'mt-3' => $package->is_popular])>
                            @foreach($package->feature_list as $feature)
                                <li class="d-flex align-items-center mb-4">
                                    @php
                                        $checkIconImage = $package->is_popular ? 'images/icons/check-white.png' : 'images/icons/check-primary.png';
                                    @endphp
                                    <img src="{{ Theme::asset()->url($feature['is_available'] ? $checkIconImage : 'images/icons/check-secondary.png') }}" alt="" aria-hidden="true">
                                    <strong @class(['d-block fs-6 mb-0 ms-2', 'text-white' => $package->is_popular])>{{ $feature['value'] }}</strong>
                                </li>
                            @endforeach
                        </ul>

                        @if ($package->is_popular && ($actionLabel = $package->action_label) && ($actionUrl = $package->action_url))
                            <a href="{{ $actionUrl }}" class="btn bg-white-keep text-primary hover-up w-100 d-flex justify-content-between mt-5">
                                {!! BaseHelper::clean($actionLabel) !!}
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path class="fill-dark" d="M17.4177 5.41797L16.3487 6.48705L21.1059 11.2443H0V12.7562H21.1059L16.3487 17.5134L17.4177 18.5825L24 12.0002L17.4177 5.41797Z" fill="#111827" />
                                </svg>
                            </a>
                        @endif

                        @if($package->is_popular)
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row mt-10">
            @php
                $primaryButtonLabel = $shortcode->primary_action_label;
                $primaryButtonUrl = $shortcode->primary_action_url;

                $secondaryButtonLabel = $shortcode->secondary_action_label;
                $secondaryButtonUrl = $shortcode->secondary_action_url;
            @endphp

            @if(($primaryButtonLabel && $primaryButtonUrl) || ($secondaryButtonUrl && $secondaryButtonLabel))
                <div class="d-flex align-items-center justify-content-lg-cener justify-content-center">
                    @if($primaryButtonLabel && $primaryButtonUrl)
                        <a href="{{ $primaryButtonUrl }}" class="btn btn-gradient">
                            {!! BaseHelper::clean($primaryButtonLabel) !!}
                            @if($shortcode->primary_action_icon)
                                <x-core::icon class="ms-2" :name="$shortcode->primary_action_icon" />
                            @endif
                        </a>
                    @endif
                    @if($secondaryButtonUrl && $secondaryButtonLabel)
                        <a href="{{ $secondaryButtonUrl }}" class="ms-5 text-decoration-underline fw-bold" data-aos="fade-zoom-in" data-aos-delay="100">
                            @if($shortcode->secondary_action_icon)
                                <x-core::icon :name="$shortcode->secondary_action_icon" />
                            @endif
                            {{ $secondaryButtonLabel }}
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>

    @if ($backgroundImage = $shortcode->background_image)
        <div class="position-absolute bottom-0 start-50 translate-middle-x z-0">
            {{ RvMedia::image($backgroundImage, __('Background image')) }}
        </div>
    @endif

    <div class="rotate-center ellipse-rotate-success position-absolute top-50 z-1"></div>
    <div class="rotate-center-rev ellipse-rotate-primary position-absolute top-50 z-1"></div>
</section>
