<section {!! $shortcode->htmlAttributes() !!} class="shortcode-pricing-plans shortcode-pricing-plans-style-1 section-pricing-1 position-relative pb-120 @@classList overflow-hidden">
    <div class="container">
        <div class="row pb-9 position-relative z-1">
            <div class="col-lg-auto me-lg-auto">
                <div class="text-start mb-lg-0 mb-5">
                    @if($shortcode->subtitle)
                        <div
                            class="d-flex align-items-center justify-content-center bg-primary-soft border border-2 border-white d-inline-flex rounded-pill px-4 py-2"
                            data-aos="zoom-in"
                            data-aos-delay="50"
                        >
                            <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                            <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                        </div>
                    @endif
                    @if($shortcode->title)
                        <{{ $titleTag = infinia_title_tag($shortcode, 'h3') }} class="ds-3 my-3" data-aos="fade-zoom-in" data-aos-delay="100">{!! infinia_clean_title($shortcode->title) !!}</{{ $titleTag }}>
                    @endif
                    @if($shortcode->description)
                        <p class="fs-5 mb-0" data-aos="fade-zoom-in" data-aos-delay="100">
                            {!! BaseHelper::clean(nl2br($shortcode->description)) !!}
                        </p>
                    @endif
                </div>
            </div>
            <div class="col-lg-auto align-self-end">
                <div class="d-flex justify-content-lg-end">
                    <ul class="list-unstyled d-flex align-items-center change-price-plan bg-white rounded-pill py-1 shadow-2">
                        <li>
                            <a href="#" class="active px-6 py-2 text-900 bg-transparent monthly rounded-pill text-white fs-6 fw-bold z-1" data-type="monthly">{{ __('Monthly') }}</a>
                        </li>
                        <li>
                            <a href="#" class="yearly px-6 py-2 text-900 bg-transparent monthly rounded-pill text-white fs-6 fw-bold z-1" data-type="yearly">{{ __('Yearly') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row backdrop-filter-lg rounded-4 position-relative z-1">
            @foreach($packages as $package)
                <div class="col-lg-3 col-sm-6 px-lg-0 mb-lg-0 mb-4">
                    <div
                        @class([
                            'pricing-plan-item backdrop-filter-md h-100 p-6 position-relative border rounded-4 z-1',
                            'rounded-end-lg-0' => ! $loop->last,
                            'border-start-lg-0' => ! $loop->first,
                            'rounded-start-lg-0' => ! $loop->first || $loop->last,
                        ])>
                        <strong class="d-block fs-6">{{ $package->name }}</strong>
                        <p class="fs-7">{{ $package->description }}</p>
                        <div class="d-flex">
                            <h4 class="text-primary mb-0 text-price-enterprise" data-annual-price="{{ $package->annual_price == 0 ? __('Free') : $package->annual_price }}" data-monthly-price="{{ $package->price == 0 ? __('Free') : $package->price }}">
                                {{ $package->price == 0 ? __('Free') : $package->price }}
                            </h4>
                            @if ($package->price != 0)
                                <span class="fs-5 text-600 ms-1 fw-bold align-self-end text-type-enterprise" data-annual-duration="{{ __('Year') }}" data-monthly-duration="{{ $package->duration->label() }}">
                                    /{{ $package->duration->label() }}
                                </span>
                            @endif
                        </div>
                        @if($package->action_label)
                            <a href="{{ $package->action_url }}" @class(['btn w-100 d-flex justify-content-between my-5', 'btn-outline-secondary hover-up' => ! $package->is_popular, 'btn-gradient' => $package->is_popular])>
                                {{ $package->action_label }}
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path @class(['fill-dark' => ! $package->is_popular, 'fill-white' => $package->is_popular]) d="M17.4177 5.41797L16.3487 6.48705L21.1059 11.2443H0V12.7562H21.1059L16.3487 17.5134L17.4177 18.5825L24 12.0002L17.4177 5.41797Z" fill="#111827" />
                                </svg>
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
    <div class="rotate-center ellipse-rotate-success position-absolute z-0"></div>
    <div class="rotate-center-rev ellipse-rotate-primary position-absolute z-0"></div>
</section>
