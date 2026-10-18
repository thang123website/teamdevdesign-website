@php
    $faqsChunk = $faqs->chunk(ceil($faqs->count() / 2));
    $keyId = 'faq-' . uniqid();
@endphp

<section {!! $shortcode->htmlAttributes() !!} class="shortcode-faqs shortcode-faqs-style-3 section-faqs-2 section-padding bg-4 position-relative">
    <div class="container position-relative z-2">
        <div class="text-center mb-8">
            @if ($subtitle = $shortcode->subtitle)
                <div class="d-flex align-items-center position-relative z-2 justify-content-center bg-primary-soft d-inline-flex rounded-pill border border-2 border-white px-3 py-1">
                    <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                    <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
                </div>
            @endif

            @if ($title = $shortcode->title)
                <{{ $titleTag = infinia_title_tag($shortcode, 'h3') }} class="ds-3 my-3 fw-bold">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
            @endif

            @if ($description = $shortcode->description)
                <p class="fs-5 mb-0">{!! BaseHelper::clean($description) !!}</p>
            @endif

        </div>
        <div class="row align-items-center position-relative z-1">
            @foreach($faqsChunk as $faqs)
                <div @class(['col-lg-6', 'mt-lg-0 mt-2' => $loop->last])>
                    <div class="accordion">
                        @foreach($faqs as $faq)
                            <div class="mb-3 card p-3 border bg-white rounded-3">
                                <div class="px-0 card-header border-0 bg-gradient-1">
                                    <a class="collapsed text-900 fw-bold d-flex align-items-center" data-bs-toggle="collapse" href="#{{ $keyId }}-{{ $faq->getKey() }}">
                                        <strong class="d-block fs-6 m-0">{!! BaseHelper::clean($faq->question) !!}</strong>
                                        <span class="ms-auto arrow me-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="8" viewBox="0 0 13 8" fill="none">
                                                <path class="stroke-dark" d="M11.5 1L6.25 6.5L1 1" stroke="#111827" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                    </a>
                                </div>
                                <div id="{{ $keyId }}-{{ $faq->getKey() }}" @class(['collapse', 'show' => $loop->parent->first && $loop->first]) data-bs-parent=".accordion">
                                    <p class="ps-0 card-body">
                                        {!! BaseHelper::clean($faq->answer) !!}
                                    </p>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            @endforeach
        </div>
        <div class="ellipse-center position-absolute top-50 start-50 translate-middle z-0"></div>
    </div>
</section>
