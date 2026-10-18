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

<div {!! $shortcode->htmlAttributes() !!} class="shortcode-partners shortcode-partners-style-4 section-logo-cloud container-fluid bg-dark-1 py-86 border-top border-bottom"
    @style($variablesStyle)
>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                @if ($subtitle = $shortcode->subtitle)
                    <div class="border-linear-dark-2 rounded-pill d-inline-block mb-3">
                        <div class="text-primary bg-dark-1 px-4 py-2 rounded-pill">{!! BaseHelper::clean($subtitle) !!}</div>
                    </div>
                @endif

                @if ($title = $shortcode->title)
                    <{{ $titleTag = infinia_title_tag($shortcode, 'h1') }} class="ds-xs-4 fw-regular m-0 text-white">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
                @endif

            </div>
            <div class="col-lg-6">
                @if($rightPartners)
                    <div @if(! $isRtl) dir="rtl" @else dir="ltr" @endif  data-display-item="4"  class="partners-slider-start position-relative z-1 mt-lg-0 mt-8">
                        @foreach($rightPartners as $rightPartner)
                            @continue(! $rightPartnerImage = Arr::get($rightPartner, 'image'))

                            <div class="partner-item me-2 mb-2">
                                @if($rightPartner['url'])
                                    <a href="{{ $rightPartner['url'] }}" target="_blank">
                                        {{ RvMedia::image($rightPartnerImage, $rightPartner['name']) }}
                                    </a>
                                @else
                                    {{ RvMedia::image($rightPartnerImage, $rightPartner['name']) }}
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif

                @if ($leftPartners)
                    <div class="row" @if($isRtl) dir="rtl"  @else dir="ltr" @endif>
                        <div class="partners-slider-end mt-6 position-relative z-1" data-display-item="4">
                            @foreach($leftPartners as $leftPartner)
                                @continue(! $leftPartnerImage = Arr::get($leftPartner, 'image'))

                                <div class="partner-item pme-2 mb-2">
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
                @endif
            </div>
        </div>
    </div>
</div>
