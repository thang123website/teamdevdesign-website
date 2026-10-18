<section {!! $shortcode->htmlAttributes() !!} class="shortcode-site-statistics shortcode-site-statistics-style-2 section-static-1 position-relative bg-primary fix z-0 section-padding"
    @style($variablesStyle)
>
    <div class="container position-relative z-3">
        <div class="row border-bottom border-primary-light pb-8">
            @if ($title = $shortcode->title)
                <div class="col-lg-6 me-lg-auto">
                    <{{ $titleTag = infinia_title_tag($shortcode, 'h5') }} class="ds-5 text-100 m-0">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
                </div>
            @endif

            @php
                $primaryButtonLabel = $shortcode->primary_action_label;
                $primaryButtonUrl = $shortcode->primary_action_url;
            @endphp

            @if ($primaryButtonLabel && $primaryButtonUrl)
                <div class="col-auto align-self-end mt-lg-0 mt-5">
                    <a href="{{ $primaryButtonUrl }}" class="btn btn-outline-secondary hover-up bg-transparent text-100">
                        {!! BaseHelper::clean($primaryButtonLabel) !!}

                        @if($shortcode->primary_action_icon)
                            <x-core::icon class="ms-2" :name="$shortcode->primary_action_icon" />
                        @endif
                    </a>
                </div>
            @endif
        </div>
    </div>
    <div class="container mt-8">
        <div class="inner">
            <div class="row justify-content-center">
                @foreach($tabs as $item)
                    @php
                        $itemTitle = Arr::get($item, 'title');
                        $itemData = Arr::get($item, 'data');
                    @endphp

                    @continue(! $itemTitle || ! $itemData)

                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="counter-item-cover counter-item">
                            <div class="content text-center mx-auto">
                                <span class="fw-bold lh-sm count ds-2 text-100"><span class="visually-hidden">{{ $itemData }}</span><span class="odometer" data-count="{{ $itemData }}" aria-hidden="true"></span>
                                    @if($itemUnit = Arr::get($item, 'unit'))
                                        <span>{!! BaseHelper::clean($itemUnit) !!}</span>
                                    @endif
                                </span>
                                <p class="fs-5 text-100">{!! BaseHelper::clean($itemTitle) !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @if ($backgroundImage = $shortcode->background_image)
        <div class="img-decorate position-absolute top-0 start-0">
            {{ RvMedia::image($backgroundImage, __('Background image')) }}
        </div>
    @endif

    <div class="bouncing-blobs-container">
        <div class="bouncing-blobs-glass bg-transparent"></div>
        <div class="bouncing-blobs">
            <div class="bouncing-blob bouncing-blob--white"></div>
        </div>
    </div>
</section>
