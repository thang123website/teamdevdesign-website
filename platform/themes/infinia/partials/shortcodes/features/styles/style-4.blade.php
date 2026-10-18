<section {!! $shortcode->htmlAttributes() !!} class="shortcode-features shortcode-features-style-4 section-feature-11 border-bottom">
    <div class="container-fluid position-relative section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 position-relative">
                    @if ($subtitle = $shortcode->subtitle)
                        <div class="d-flex align-items-center justify-content-center bg-primary-soft border border-2 border-white d-inline-flex rounded-pill px-4 py-2" data-aos="zoom-in" data-aos-delay="50">
                            <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                            <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
                        </div>
                    @endif

                    @if ($title = $shortcode->title)
                        <{{ $titleTag = infinia_title_tag($shortcode, 'h2') }} class="ds-5 mt-2">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
                    @endif

                    @foreach($features as $feature)
                        @php
                            $icon = Arr::get($feature, 'icon');
                            $iconImage = Arr::get($feature, 'icon_image');
                        @endphp
                        @continue(! $featureTitle = Arr::get($feature, 'title'))
                        <div class="d-flex pt-3 align-items-center">
                            @if ($icon || $iconImage)
                                <div class="bg-primary-soft icon-flip position-relative icon-shape icon-xxl rounded-3 mb-4">
                                    <div class="icon">
                                        @if($iconImage)
                                            {{ RvMedia::image($iconImage, $featureTitle) }}
                                        @else
                                            <x-core::icon :name="$icon" />
                                        @endif
                                    </div>
                                </div>
                            @endif
                            <div class="ps-5">
                                <strong class="d-block fs-6">{!! BaseHelper::clean($featureTitle) !!}</strong>
                                @if ($featureDescription = Arr::get($feature, 'description'))
                                    <p>{!! BaseHelper::clean($featureDescription) !!}</p>
                                @endif

                            </div>
                        </div>
                    @endforeach

                    <div class="position-absolute flickering top-0 end-0 mt-5 me-10 d-none d-md-block">
                        <img src="{{ Theme::asset()->url('images/shapes/shine-effect.png') }}" alt="" aria-hidden="true">
                    </div>
                </div>

                <div class="col-lg-7 text-center mt-lg-0 mt-8 d-flex">
                    @if ($image = $shortcode->image)
                        <div class="zoom-img rounded-3 mt-8 me-3">
                            {{ RvMedia::image($image, infinia_image_alt($shortcode)) }}
                        </div>
                    @endif

                    @if ($image1 = $shortcode->image_1)
                        <div class="zoom-img rounded-3">
                            {{ RvMedia::image($image1, infinia_image_alt($shortcode), attributes: ['class' => 'rounded-3']) }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
