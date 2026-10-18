<section {!! $shortcode->htmlAttributes() !!} class="shortcode-faqs shortcode-faqs-style-2 section-faqs-1 section-padding position-relative">
    <div class="container position-relative z-2">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="text-start position-relative d-inline-block mb-lg-0 mb-5">
                    @if ($image = $shortcode->image)
                        {{ RvMedia::image($image, infinia_image_alt($shortcode), attributes: ['class' => 'rounded-4']) }}
                    @endif

                    @if ($tabs)
                        <div class="card-team rounded-4 position-absolute bottom-0 start-0 end-0 z-1 backdrop-filter w-auto px-5 py-8 m-5">
                            @foreach($tabs as $tab)
                                @continue( ! $tabTitle = Arr::get($tab, 'title'))

                                @php
                                    $iconImage = Arr::get($tab, 'icon_image');
                                    $icon = Arr::get($tab, 'icon');
                                @endphp
                                <div class="d-flex flex-column flex-md-row align-items-start gap-3 mb-4" data-aos="fade-zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                                    @if ($iconImage)
                                        {{ RvMedia::image($iconImage) }}
                                    @else
                                        <x-core::icon :name="$icon"/>
                                    @endif

                                    <div>
                                        <strong class="d-block fs-6 m-0">{!! BaseHelper::clean($tabTitle) !!}</strong>

                                        @if ($description = Arr::get($tab, 'description'))
                                            <p class="m-0">{!! BaseHelper::clean($description) !!}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 mt-lg-0 mt-5">
                @if ($title = $shortcode->title)
                    <{{ $titleTag = infinia_title_tag($shortcode, 'h3') }} class="ds-3" data-aos="fade-up" data-aos-delay="0">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
                @endif

                @if ($description = $shortcode->description)
                    <p class="fs-5 my-4" data-aos="fade-up" data-aos-delay="0">{!! BaseHelper::clean($description) !!}</p>
                @endif

                @include(Theme::getThemeNamespace("partials.shortcodes.faqs.styles.style-1"))
            </div>
        </div>
    </div>
    @if ($backgroundImage = $shortcode->background_image)
        {{ RvMedia::image($backgroundImage, attributes: ['class' => 'position-absolute top-0 start-0 z-0']) }}
    @endif
</section>
