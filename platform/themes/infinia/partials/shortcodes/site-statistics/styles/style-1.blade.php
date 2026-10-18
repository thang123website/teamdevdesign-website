<section {!! $shortcode->htmlAttributes() !!} class="shortcode-site-statistics shortcode-site-statistics-style-1 section-static-1 position-relative fix z-0 py-8">
    <div class="container">
        <div class="inner">
            <div class="row align-items-center justify-content-between">
                @if ($title = $shortcode->title)
                    <div class="col-lg-auto col-md-12 text-center text-lg-start mb-5 mb-lg-0">
                        <{{ $titleTag = infinia_title_tag($shortcode, 'h4') }} class="mb-0">
                            {!! infinia_clean_title($title) !!}
                        </{{ $titleTag }}>
                    </div>
                @endif

                @foreach($tabs as $item)
                    @php
                        $itemTitle = Arr::get($item, 'title');
                        $itemData = Arr::get($item, 'data');
                    @endphp

                    @continue(! $itemTitle || ! $itemData)

                    <div class="col-lg-auto col-md-6">
                        <div class="counter-item-cover counter-item">
                            <div class="content text-center mx-auto">
                                    <span class="h1 count fw-black text-primary my-0"><span class="visually-hidden">{{ $itemData }}</span><span class="odometer" data-count="{{ $itemData }}" aria-hidden="true"></span>
                                        @if($itemUnit = Arr::get($item, 'unit'))
                                            <span>{!! BaseHelper::clean($itemUnit) !!}</span>
                                        @endif
                                    </span>
                                <p>{!! BaseHelper::clean($itemTitle) !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="bouncing-blobs-container">
        <div class="bouncing-blobs-glass fix"></div>
        <div class="bouncing-blobs">
            <div class="bouncing-blob bouncing-blob--green"></div>
            <div class="bouncing-blob bouncing-blob--primary"></div>
            <div class="bouncing-blob bouncing-blob--infor bouncing-blob--infor-2"></div>
        </div>
    </div>
</section>
