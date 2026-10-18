@php
    $bgColor = $shortcode->background_color;

    $variablesStyle = [
        "--shortcode-background-color: $bgColor !important;" => $bgColor,
    ];

    $tabsCounter = [];
    $tabsContent = [];

    foreach ($tabs as $tab) {
        $tabTitle = Arr::get($tab, 'title');

        if (! $tabTitle) {
            continue;
        }

        if ($tabCountData = Arr::get($tab, 'data')) {
            $tabsCounter[] = [
                'data' => $tabCountData,
                'unit' => Arr::get($tab, 'unit'),
                'title' => $tabTitle,
            ];
        } else {
            $tabsContent[] = $tab;
        }
    }

    $tabsContentChunks = array_chunk($tabsContent, ceil(count($tabsContent) / 2));
@endphp

<section {!! $shortcode->htmlAttributes() !!} class="shortcode-information-block"
    @style($variablesStyle)
>
    <div class="container-fluid position-relative section-padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-6 mb-lg-0 mb-8 pe-5 pe-lg-10 position-relative z-1">
                    @if ($image = $shortcode->image)
                        {{ RvMedia::image($image, infinia_image_alt($shortcode)) }}
                    @endif

                    @if ($title = $shortcode->title)
                        <{{ $titleTag = infinia_title_tag($shortcode, 'h2') }} class="text-white mt-3 mb-4 fw-black">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
                    @endif

                    @if ($description = $shortcode->description)
                        <p class="text-white">{!! BaseHelper::clean($description) !!}</p>
                    @endif

                    @foreach($tabsCounter as $tabCounter)
                        @php
                            $tabCounterTitle = Arr::get($tabCounter, 'title');
                            $tabCounterData = Arr::get($tabCounter, 'data');
                        @endphp

                        @continue(! $tabCounterTitle || ! $tabCounterData)

                        <div class="col d-flex align-items-center mt-5 min-w-">
                            <span class="h2 count fw-black text-white min-w-70"><span class="odometer" data-count="{{ $tabCounterData }}"></span></span>
                            @if ($tabCounterUnit = Arr::get($tabCounter, 'unit'))
                                <span class="fw-medium text-white fs-4 align-self-start">{!! BaseHelper::clean($tabCounterUnit) !!}</span>
                            @endif

                            <p class="ms-3 text-white">
                                {!! BaseHelper::clean($tabCounterTitle) !!}
                            </p>
                        </div>
                    @endforeach

                </div>
                @foreach($tabsContentChunks as $tabsContent)
                    <div @class(['col-lg-4 mb-lg-0 mb-8 pe-lg-8', 'col-md-6' => $loop->first])>
                        <ul class="list-unstyled ">
                            @foreach($tabsContent as  $tabContent)
                                @continue(! $tabContentTitle = Arr::get($tabContent, 'title'))

                                <li>
                                    <a href="{{ Arr::get($tabContent, 'url') }}" class="d-flex align-items-start mb-6">
                                        @if ($tabContentIconImage = Arr::get($tabContent, 'icon_image'))
                                            {{ RvMedia::image($tabContentIconImage, infinia_image_alt($shortcode), attributes: ['class' => 'mt-2']) }}
                                        @elseif ($tabContentIcon = Arr::get($tabContent, 'icon'))
                                            <x-core::icon :name="$tabContentIcon"/>
                                        @endif

                                        <div class="ms-3 pb-4 border-bottom">
                                            <h5 class="text-white mb-2">{!! BaseHelper::clean($tabContentTitle) !!}</h5>
                                            @if ($tabContentDescription = Arr::get($tabContent, 'description'))
                                                <p class="text-white mb-0">{!! BaseHelper::clean($tabContentDescription) !!}</p>
                                            @endif
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="position-absolute bottom-0 start-0 bg-rotate z-0">
            <img src="{{ Theme::asset()->url('images/shapes/swing.png') }}" class="rotate-center" alt="swing">
        </div>
        <div class="position-absolute top-0 end-0 z-1 p-8">
            <div class="bloom"></div>
        </div>
    </div>
</section>
