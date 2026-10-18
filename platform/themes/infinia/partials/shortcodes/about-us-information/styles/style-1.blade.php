<section {!! $shortcode->htmlAttributes() !!}  class="shortcode-about-us-information shortcode-about-us-information-style-1 section-cta-10 position-relative section-padding fix">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 ps-lg-0 pe-lg-8">
                @if ($subtitle = $shortcode->subtitle)
                    <div class="d-flex align-items-center justify-content-center bg-primary-soft border border-2 border-white d-inline-flex rounded-pill px-4 py-2" data-aos="zoom-in" data-aos-delay="50">
                        <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                        <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
                    </div>
                @endif

                @if ($title = $shortcode->title)
                    <{{ $titleTag = infinia_title_tag($shortcode, 'h5') }} class="ds-5 my-3">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
                @endif

                @if ($description = $shortcode->description)
                    <p class="fs-5 text-500">{!! BaseHelper::clean($description) !!}</p>
                @endif

                @if(count($features) > 0)
                    <div class="d-md-flex align-items-center mt-4 mb-5">
                        @foreach(array_chunk($features, 2) as $items)
                            <ul @class(['list-unstyled phase-items mb-0', 'ms-md-5' => ! $loop->first])>
                                @foreach($items as $item)
                                    @continue(! $itemTitle = Arr::get($item, 'title'))

                                    <li class="d-flex align-items-center mt-3">
                                        <img src="{{ Theme::asset()->url('images/icons/check.png') }}" alt="check icon">
                                        <span class="ms-2 text-900 fw-medium fs-6">{!! BaseHelper::clean($itemTitle) !!}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endforeach
                    </div>
                @endif
            </div>

            @if ($image = $shortcode->image)
                <div class="col-lg-5 offset-lg-1">
                    <div class="text-center position-relative">
                        {{ RvMedia::image($image, $title, attributes: ['class' => 'rounded-4 border border-2 bg-white shadow-2 hover-up mt-5 p-6 position-relative z-1']) }}
                        <div class="bg-linear-1 rounded-4 position-absolute top-0 start-0 bottom-0 end-0 h-75 z-0"></div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
