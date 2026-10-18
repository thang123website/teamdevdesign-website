<section {!! $shortcode->htmlAttributes() !!} class="shortcode-pricing-plans shortcode-pricing-plans-style-2 section-pricing-2 position-relative section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 position-relative pe-8">
                <div class="text-start mb-lg-0 mb-5">
                    @if ($subtitle = $shortcode->subtitle)
                        <div class="d-flex align-items-center justify-content-center bg-primary-soft border border-2 border-white d-inline-flex rounded-pill px-4 py-2" data-aos="zoom-in" data-aos-delay="50">
                            <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                            <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
                        </div>
                    @endif

                    @if ($title = $shortcode->title)
                        <{{ $titleTag = infinia_title_tag($shortcode, 'h3') }} class="ds-3 my-3" data-aos="fade-zoom-in" data-aos-delay="0">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
                    @endif

                    @if ($description = $shortcode->description)
                        <p class="fs-6 mb-0" data-aos="fade-zoom-in" data-aos-delay="100">{!! BaseHelper::clean($description) !!}</p>
                    @endif

                    @if ($features)
                        <div class="d-md-flex align-items-center mt-4">
                            @php
                                $chunkFeatures = array_chunk($features, ceil(count($features) / 2));
                            @endphp

                            @foreach($chunkFeatures as $features)
                                <ul @class(['list-unstyled phase-items mb-0', 'ms-md-5' => $loop->last])>
                                    @foreach($features as $feature)
                                        @continue(! $feature)
                                        <li class="d-flex align-items-center mt-2">
                                            <img src="{{ Theme::asset()->url('images/icons/check.png') }}" alt="" aria-hidden="true">
                                            <span class="ms-2">{!! BaseHelper::clean($feature) !!}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endforeach
                        </div>
                    @endif
                    <div class="mt-lg-10 pt-5 pe-lg-10 me-lg-10">
                        @if ($bottomTitle = $shortcode->bottom_title)
                            <p>{!! BaseHelper::clean($bottomTitle) !!}</p>
                        @endif

                        @if ($paymentGateways)
                            <div class="partners-slider position-relative z-1" data-display-item="3">
                                @foreach($paymentGateways as $paymentGateway)
                                    @continue(! $paymentGatewayLogo = Arr::get($paymentGateway, 'image'))
                                    <div class="m-0">
                                        <a href="{{ Arr::get($paymentGateway, 'url') }}" target="_blank">
                                            {{ RvMedia::image($paymentGatewayLogo, Arr::get($paymentGateway, 'name'), attributes: ['class' => 'rounded-4']) }}
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                <div class="position-absolute top-0 end-0 translate-middle-y mt-3 me-8">
                    <img src="{{ Theme::asset()->url('images/icons/star-4.png') }}" alt="star">
                </div>
            </div>

            @php
                $packagesChunk = $packages->chunk(2);
            @endphp

            @foreach($packagesChunk as $packages)
                <div class="col-lg-6">
                    <div class="row mt-lg-0 mt-5">
                        @foreach($packages as $package)
                            <div class="col-lg-6 col-sm-6 mb-lg-0 mb-4">
                                <div @class(['pricing-plan-item p-6 bg-white position-relative border rounded-4 z-1', 'bg-primary-soft' => $package->is_popular])>
                                    <strong class="d-block fs-6">{{ $package->name }}</strong>

                                    @if($packageDescription = $package->description)
                                        <p class="fs-7">{!! BaseHelper::clean($packageDescription) !!}</p>
                                    @endif

                                    <div class="text-primary mt-3 mb-0 d-flex">
                                        <h4 class="text-primary mb-0 text-price-enterprise" data-annual-price="{{ $package->annual_price == 0 ? __('Free') : $package->annual_price }}" data-monthly-price="{{ $package->price == 0 ? __('Free') : $package->price }}">
                                            {{ $package->price == 0 ? __('Free') : $package->price }}
                                        </h4>
                                        @if($package->price != 0)
                                            <span class="fs-5 text-600 ms-1 fw-bold align-self-end text-type-enterprise" data-annual-duration="{{ __('Year') }}" data-monthly-duration="{{ $package->duration->label() }}">
                                                /{{ $package->duration->label() }}
                                            </span>
                                        @endif
                                    </div>

                                    @if (($actionLabel = $package->action_label) && ($actionUrl = $package->action_url))
                                        <a href="{{ $actionUrl }}" @class(['btn hover-up w-100 d-flex justify-content-between my-5', 'btn-gradient' => $package->is_popular, 'btn-outline-secondary' => ! $package->is_popular])>
                                            {!! BaseHelper::clean($actionLabel) !!}

                                            @if ($package->is_popular)
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path class="fill-white" d="M17.4177 5.41797L16.3487 6.48705L21.1059 11.2443H0V12.7562H21.1059L16.3487 17.5134L17.4177 18.5825L24 12.0002L17.4177 5.41797Z" fill="white"></path>
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path class="fill-dark" d="M17.4177 5.41797L16.3487 6.48705L21.1059 11.2443H0V12.7562H21.1059L16.3487 17.5134L17.4177 18.5825L24 12.0002L17.4177 5.41797Z" fill="#111827" />
                                                </svg>
                                            @endif
                                        </a>
                                    @endif

                                    <ul class="list-unstyled mb-0">
                                        @foreach($package->feature_list as $feature)
                                            <li class="d-flex align-items-center mb-4">
                                                <img src="{{ Theme::asset()->url($feature['is_available'] ? 'images/icons/check-primary.png' : 'images/icons/check-secondary.png') }}" alt="" aria-hidden="true">
                                                <strong class="d-block fs-6 mb-0 ms-2">{{ $feature['value'] }}</strong>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
