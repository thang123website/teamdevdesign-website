@php
    $chunks = array_chunk($partners, ceil(count($partners) / 2));
    $leftPartners = $chunks[1] ?? [];
    $rightPartners = $chunks[0] ?? [];

    $isRtl = false;

    if (is_plugin_active('language')) {
        $supportedLocales = Language::getSupportedLocales();
        $isRtl = $supportedLocales[Language::getCurrentLocale()]['lang_is_rtl'];
    }
@endphp

<div {!! $shortcode->htmlAttributes() !!} class="shortcode-partners shortcode-partners-style-3 section-logo-cloud container-fluid pt-110 pb-110 mt-lg-0 border-top border-bottom"
    @style($variablesStyle)
>
    <div class="container">
        @if ($title = $shortcode->title)
            <{{ $titleTag = infinia_title_tag($shortcode, 'h5') }} class="text-500 mb-5 text-center">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
        @endif

        @if($rightPartners)
            <div @if(! $isRtl) dir="rtl" @else dir="ltr" @endif  class="partners-slider-start position-relative z-1 mt-lg-0 mt-8">
                @foreach($rightPartners as $rightPartner)
                    @continue(! $rightPartnerImage = Arr::get($rightPartner, 'image'))

                    <div class="partner-item bg-white py-3 px-4 shadow-1 rounded-2 align-self-center icon-height icon-shape hover-up me-2 mb-2">
                        @if($rightPartner['url'])
                            <a href="{{ $rightPartner['url'] }}" target="_blank">
                                {{ RvMedia::image($rightPartnerImage, $rightPartner['name'], attributes: ['class' => 'filter-invert']) }}
                            </a>
                        @else
                            {{ RvMedia::image($rightPartnerImage, $rightPartner['name'], attributes: ['class' => 'filter-invert']) }}
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

        @if ($leftPartners)
            <div class="row" @if($isRtl) dir="rtl"  @else dir="ltr" @endif>
                <div class="col-lg-10 mx-lg-auto">
                    <div class="partners-slider-end">
                        @foreach($leftPartners as $leftPartner)
                            @continue(! $leftPartnerImage = Arr::get($leftPartner, 'image'))

                            <div class="partner-item bg-white py-3 px-4 shadow-1 rounded-2 align-self-center icon-height icon-shape hover-up me-2 mb-2">
                                @if($leftPartner['url'])
                                    <a href="{{ $leftPartner['url'] }}" target="_blank">
                                        {{ RvMedia::image($leftPartnerImage, $leftPartner['name'], attributes: ['class' => 'filter-invert']) }}
                                    </a>
                                @else
                                    {{ RvMedia::image($leftPartnerImage, $leftPartner['name'], attributes: ['class' => 'filter-invert']) }}
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
