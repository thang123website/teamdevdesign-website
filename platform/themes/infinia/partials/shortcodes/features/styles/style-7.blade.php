<section {!! $shortcode->htmlAttributes() !!} class="section-cta-6 position-relative section-padding fix shortcode-features shortcode-features-style-7">
    <div class="container">
        <div class="row">
            @if ($image = $shortcode->image)
                <div class="col-lg-6 pe-lg-0">
                    <div class="zoom-img rounded-end-lg-0 rounded-4">
                        {{ RvMedia::image($image, infinia_image_alt($shortcode), attributes: ['class' => 'rounded-end-lg-0 rounded-4']) }}
                    </div>
                </div>
            @endif

            <div class="col-12 col-lg-6 ps-lg-0 align-self-stretch">
                <div class="bg-white p-md-8 p-5 rounded-start-lg-0 h-100 rounded-4 mt-lg-0 mt-5 border border-start-lg-0 shadow-1">
                    @if ($subtitle = $shortcode->subtitle)
                        <div class="d-flex align-items-center justify-content-center bg-primary-soft border border-2 border-white d-inline-flex rounded-pill mb-2 px-4 py-2">
                            <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                            <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
                        </div>
                    @endif

                    @if ($title = $shortcode->title)
                        <{{ $titleTag = infinia_title_tag($shortcode, 'h1') }} class="fs-1">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
                    @endif

                    @if ($description = $shortcode->description)
                        <p class="mb-9">{!! BaseHelper::clean($description) !!}</p>
                    @endif

                    @php
                        $primaryButtonLabel = $shortcode->primary_action_label;
                        $primaryButtonUrl = $shortcode->primary_action_url;

                        $secondaryButtonLabel = $shortcode->secondary_action_label;
                        $secondaryButtonUrl = $shortcode->secondary_action_url;
                    @endphp

                    @if(($primaryButtonLabel && $primaryButtonUrl) || ($secondaryButtonUrl && $secondaryButtonLabel))
                        <div class="d-flex flex-md-row flex-column align-items-center justify-content-start">
                            @if($primaryButtonLabel && $primaryButtonUrl)
                                <a href="{{ $primaryButtonUrl }}" class="btn btn-gradient">
                                    {!! BaseHelper::clean($primaryButtonLabel) !!}
                                    @if($shortcode->primary_action_icon)
                                        <x-core::icon class="ms-2" :name="$shortcode->primary_action_icon" />
                                    @endif
                                </a>
                            @endif

                            @if($secondaryButtonUrl && $secondaryButtonLabel)
                                <a href="{{ $secondaryButtonUrl }}" class="ms-md-5 mt-md-0 mt-5 text-decoration-underline fw-bold">
                                    @if($shortcode->secondary_action_icon)
                                        <x-core::icon :name="$shortcode->secondary_action_icon" />
                                    @endif

                                    {!! BaseHelper::clean($secondaryButtonLabel) !!}
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
