<section {!! $shortcode->htmlAttributes() !!}  class="shortcode-about-us-information shortcode-about-us-information-style-2 section-testimonial-13 position-relative pt-120 pb-80 fix">
    <div class="container position-relative z-1">
        <div class="row pb-9">
            <div class="col-lg-10 mx-lg-auto">
                <div class="text-center mb-lg-0 mb-5">
                    @if ($subtitle = $shortcode->subtitle)
                        <div class="d-flex align-items-center position-relative z-2 justify-content-center bg-primary-soft d-inline-flex rounded-pill border border-2 border-white px-3 py-1">
                            <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                            <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
                        </div>
                    @endif

                    @if ($title = $shortcode->title)
                        <{{ $titleTag = infinia_title_tag($shortcode, 'h3') }} class="ds-3 my-3 fw-regular">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
                    @endif
                </div>
            </div>
        </div>
        <img src="{{ Theme::asset()->url('images/icons/star-2.png') }}" class="position-absolute z-2 top-0 end-0 pe-10 pe-lg-10" alt="star">

        <img src="{{ Theme::asset()->url('images/icons/star-1.png') }}" class="position-absolute z-2 bottom-0 start-0 ps-10 ms-10" alt="star">
    </div>

    <div class="container-fluid">
        @if ($image = $shortcode->image)
            <div class="d-flex align-items-center justify-content-center position-relative">
                <div class="pe-3 position-relative z-1 d-none d-md-block">
                    {{ RvMedia::image($image, $title, attributes: ['class' => 'rounded-3 border border-3 border-white']) }}
                </div>
            </div>
        @endif

        @if (($socials = Theme::getSocialLinks()) && $shortcode->display_social_links)
            <div class="text-center mt-5">
            <div class="z-1 socials bg-white px-3 shadow-1 py-2 border rounded-pill d-inline-flex d-flex align-items-center justify-content-center">
                @if($socialLinkTitle = $shortcode->social_links_box_title)
                    <p class="text-900 mb-0">{!! BaseHelper::clean($socialLinkTitle) !!}</p>
                @endif

                <ul class="list-unstyled d-flex mb-0">
                    @foreach($socials as $social)
                        @continue(! $social->getUrl() || ! $social->getIconHtml())
                        <li class="ms-3">
                            <a href="{{ $social->getUrl() }}" target="_blank">
                                {{ $social->getIconHtml() }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
        <div class="rotate-center ellipse-rotate-success position-absolute z-0"></div>
        <div class="rotate-center-rev ellipse-rotate-primary position-absolute z-0"></div>
    </div>
</section>
