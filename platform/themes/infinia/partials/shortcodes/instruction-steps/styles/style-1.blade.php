<section {!! $shortcode->htmlAttributes() !!} class="shortcode-instruction-steps shortcode-instruction-steps-style-1 howitwork-1 section-padding position-relative fix">
    <div class="container position-relative z-1">
        <div class="text-center mb-8">
            @if ($subtitle = $shortcode->subtitle)
                <div class="d-flex align-items-center position-relative z-2 justify-content-center bg-primary-soft d-inline-flex rounded-pill border border-2 border-white px-3 py-1" data-aos="zoom-in" data-aos-delay="100">
                    <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                    <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
                </div>
            @endif

            @if ($title = $shortcode->title)
                <{{ $titleTag = infinia_title_tag($shortcode, 'h3') }} class="ds-3 my-3 fw-regular" data-aos="fade-zoom-in" data-aos-delay="50">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
            @endif

            @if ($description = $shortcode->description)
                <p class="fs-5 mb-0" data-aos="fade-zoom-in" data-aos-delay="100">
                    {!! BaseHelper::clean($description) !!}
                </p>
            @endif
        </div>
    </div>
    @if ($bgImage = $shortcode->background_image)
        <div class="position-absolute top-0 start-50 translate-middle-x z-0">
            {{ RvMedia::image($bgImage) }}
        </div>
    @endif

    <div class="container position-relative z-1">
        <div class="position-relative">
            @if (count($tabs))
                <div class="position-lg-absolute top-0 start-0 bottom-0 w-lg-50 d-flex flex-column justify-content-between m-lg-10 pb-lg-0 pb-5 z-1">
                    @foreach($tabs as $tab)
                        @continue(! $tabTitle = Arr::get($tab, 'title'))

                        @php
                            $iconImage = Arr::get($tab, 'icon_image');
                            $icon = Arr::get($tab, 'icon');
                        @endphp
                        <div @class(['d-flex feature-item', 'position-relative z-1' => ! $loop->last && ! $loop->first])>
                            @if($iconImage || $icon)
                                <div class="bg-primary-soft-keep icon-flip position-relative icon-shape icon-xxl rounded-3 me-5">
                                    <div class="icon">
                                        @if ($iconImage)
                                            {{ RvMedia::image($iconImage) }}
                                        @else
                                            <x-core::icon :name="$icon" />
                                        @endif
                                    </div>
                                </div>
                            @endif
                            <div data-aos="fade-zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                                <h5 class="text-lg-white text-900">{{ $loop->index }}. {!! BaseHelper::clean($tabTitle) !!}</h5>

                                @if ($tabDescription = Arr::get($tab, 'description'))
                                    <p class="text-lg-white text-900 opacity-75">{!! BaseHelper::clean($tabDescription) !!}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    @foreach($tabs as $tab)
                        @continue(! Arr::get($tab, 'title') || $loop->first)
                        <div class="dashed-line-{{ $loop->index }} d-none d-lg-block"></div>
                    @endforeach
                </div>
            @endif
            <div class="position-relative d-inline-block">
                @if ($image = $shortcode->image)
                    {{ RvMedia::image($image, $title, attributes: ['class' => 'rounded-3 w-100 img-fluid']) }}
                @endif
                <div class="bg-linear-primary rounded-3 position-absolute top-0 start-0 w-75 h-100"></div>

                @php
                    $primaryButtonLabel = $shortcode->primary_action_label;
                    $primaryButtonUrl = $shortcode->primary_action_url;

                    $secondaryButtonLabel = $shortcode->secondary_action_label;
                    $secondaryButtonUrl = $shortcode->secondary_action_url;
                @endphp

                @if(($primaryButtonLabel && $primaryButtonUrl) || ($secondaryButtonUrl && $secondaryButtonLabel))
                    <div class="position-absolute bottom-0 end-0 m-md-8 m-4">
                        <div class="d-flex align-items-center justify-content-center">
                            @if ($secondaryButtonUrl && $secondaryButtonLabel)
                                <a href="{{ $secondaryButtonUrl }}" class="mb-md-0 mb-3 d-inline-flex align-items-center rounded-4 text-nowrap backdrop-filter px-3 py-2 align-self-stretch popup-video hover-up me-3">
                                    @if ($icon = $shortcode->secondary_action_icon)
                                        <span class="backdrop-filter me-2 icon-shape icon-md rounded-circle">
                                            <x-core::icon :name="$icon" />
                                        </span>
                                    @endif

                                    <span class="fw-bold fs-7 text-900">{!! BaseHelper::clean($secondaryButtonLabel) !!}</span>
                                </a>
                            @endif

                            @if ($primaryButtonLabel && $primaryButtonUrl)
                                <a href="{{ $primaryButtonUrl }}" class="btn btn-gradient d-none d-md-block rounded-4">
                                    {!! BaseHelper::clean($primaryButtonLabel) !!}

                                    @if ($icon = $shortcode->primary_action_icon)
                                        <x-core::icon class="ms-2" :name="$icon" />
                                    @endif
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="rotate-center ellipse-rotate-success position-absolute z-0"></div>
    <div class="rotate-center-rev ellipse-rotate-primary position-absolute z-0"></div>
</section>
