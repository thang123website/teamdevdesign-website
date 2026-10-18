<section {!! $shortcode->htmlAttributes() !!} class="shortcode-our-mission shortcode-our-mission-style-2 section-testimonial-13 position-relative section-padding fix">
    <div class="container position-relative z-1">
        <div class="row pb-9">
            <div class="col-lg-7 mx-lg-auto">
                <div class="text-center mb-lg-0 mb-5">
                    @if ($subtitle = $shortcode->subtitle)
                        <div class="d-flex align-items-center position-relative z-2 justify-content-center bg-primary-soft d-inline-flex rounded-pill border border-2 border-white px-3 py-1">
                            <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                            <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
                        </div>
                    @endif

                    @if ($title = $shortcode->title)
                        <{{ $titleTag = infinia_title_tag($shortcode, 'h1') }} class="ds-5 my-3 fw-regular">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
                    @endif

                    @if ($description = $shortcode->description)
                        <p class="fs-5 mb-0 text-500">{!! BaseHelper::clean($description) !!}</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="position-relative mb-lg-0 mb-8 fix">
                    @if($image = $shortcode->image)
                        <div class="zoom-img rounded-4 fix">
                            {{ RvMedia::image($image, infinia_image_alt($shortcode)) }}
                        </div>
                    @endif

                    @if (is_plugin_active('testimonial') && $testimonials->isNotEmpty())
                        <div class="position-absolute alltuchtopdown bottom-0 start-0 m-md-5 backdrop-filter rounded-4 px-7 py-4 text-center z-1">
                                @if($testimonialBoxTitle = $shortcode->testimonial_box_title)
                                    <p class="pt-2">{!! BaseHelper::clean($testimonialBoxTitle) !!}</p>
                                @endif

                                <div class="d-flex align-items-center justify-content-center py-4">
                                    @foreach($testimonials as $testimonial)
                                        {{ RvMedia::image($testimonial->image, $testimonial->name, attributes: ['class' => 'rounded-circle', 'width' => 48]) }}
                                    @endforeach
                                </div>

                                <div class="d-flex align-items-center justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
                                        <path d="M10.8881 5.26869C11.4269 3.61033 13.7731 3.61033 14.3119 5.26869L15.0248 7.46262C15.2657 8.20426 15.9568 8.70639 16.7367 8.70639H19.0435C20.7872 8.70639 21.5122 10.9377 20.1015 11.9626L18.2352 13.3185C17.6044 13.7769 17.3404 14.5894 17.5813 15.331L18.2942 17.5249C18.833 19.1833 16.935 20.5623 15.5243 19.5374L13.658 18.1815C13.0271 17.7231 12.1729 17.7231 11.542 18.1815L9.67572 19.5374C8.26504 20.5623 6.36697 19.1833 6.90581 17.5249L7.61866 15.331C7.85963 14.5894 7.59565 13.7769 6.96477 13.3185L5.0985 11.9626C3.68782 10.9377 4.41282 8.70639 6.15652 8.70639H8.46335C9.24316 8.70639 9.93428 8.20426 10.1752 7.46262L10.8881 5.26869Z" fill="#F28833" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
                                        <path d="M10.8881 5.26869C11.4269 3.61033 13.7731 3.61033 14.3119 5.26869L15.0248 7.46262C15.2657 8.20426 15.9568 8.70639 16.7367 8.70639H19.0435C20.7872 8.70639 21.5122 10.9377 20.1015 11.9626L18.2352 13.3185C17.6044 13.7769 17.3404 14.5894 17.5813 15.331L18.2942 17.5249C18.833 19.1833 16.935 20.5623 15.5243 19.5374L13.658 18.1815C13.0271 17.7231 12.1729 17.7231 11.542 18.1815L9.67572 19.5374C8.26504 20.5623 6.36697 19.1833 6.90581 17.5249L7.61866 15.331C7.85963 14.5894 7.59565 13.7769 6.96477 13.3185L5.0985 11.9626C3.68782 10.9377 4.41282 8.70639 6.15652 8.70639H8.46335C9.24316 8.70639 9.93428 8.20426 10.1752 7.46262L10.8881 5.26869Z" fill="#F28833" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
                                        <path d="M10.8881 5.26869C11.4269 3.61033 13.7731 3.61033 14.3119 5.26869L15.0248 7.46262C15.2657 8.20426 15.9568 8.70639 16.7367 8.70639H19.0435C20.7872 8.70639 21.5122 10.9377 20.1015 11.9626L18.2352 13.3185C17.6044 13.7769 17.3404 14.5894 17.5813 15.331L18.2942 17.5249C18.833 19.1833 16.935 20.5623 15.5243 19.5374L13.658 18.1815C13.0271 17.7231 12.1729 17.7231 11.542 18.1815L9.67572 19.5374C8.26504 20.5623 6.36697 19.1833 6.90581 17.5249L7.61866 15.331C7.85963 14.5894 7.59565 13.7769 6.96477 13.3185L5.0985 11.9626C3.68782 10.9377 4.41282 8.70639 6.15652 8.70639H8.46335C9.24316 8.70639 9.93428 8.20426 10.1752 7.46262L10.8881 5.26869Z" fill="#F28833" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
                                        <path d="M10.8881 5.26869C11.4269 3.61033 13.7731 3.61033 14.3119 5.26869L15.0248 7.46262C15.2657 8.20426 15.9568 8.70639 16.7367 8.70639H19.0435C20.7872 8.70639 21.5122 10.9377 20.1015 11.9626L18.2352 13.3185C17.6044 13.7769 17.3404 14.5894 17.5813 15.331L18.2942 17.5249C18.833 19.1833 16.935 20.5623 15.5243 19.5374L13.658 18.1815C13.0271 17.7231 12.1729 17.7231 11.542 18.1815L9.67572 19.5374C8.26504 20.5623 6.36697 19.1833 6.90581 17.5249L7.61866 15.331C7.85963 14.5894 7.59565 13.7769 6.96477 13.3185L5.0985 11.9626C3.68782 10.9377 4.41282 8.70639 6.15652 8.70639H8.46335C9.24316 8.70639 9.93428 8.20426 10.1752 7.46262L10.8881 5.26869Z" fill="#F28833" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
                                        <path d="M10.8881 5.26869C11.4269 3.61033 13.7731 3.61033 14.3119 5.26869L15.0248 7.46262C15.2657 8.20426 15.9568 8.70639 16.7367 8.70639H19.0435C20.7872 8.70639 21.5122 10.9377 20.1015 11.9626L18.2352 13.3185C17.6044 13.7769 17.3404 14.5894 17.5813 15.331L18.2942 17.5249C18.833 19.1833 16.935 20.5623 15.5243 19.5374L13.658 18.1815C13.0271 17.7231 12.1729 17.7231 11.542 18.1815L9.67572 19.5374C8.26504 20.5623 6.36697 19.1833 6.90581 17.5249L7.61866 15.331C7.85963 14.5894 7.59565 13.7769 6.96477 13.3185L5.0985 11.9626C3.68782 10.9377 4.41282 8.70639 6.15652 8.70639H8.46335C9.24316 8.70639 9.93428 8.20426 10.1752 7.46262L10.8881 5.26869Z" fill="#F28833" />
                                    </svg>
                                </div>
                            </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="row flex-lg-column">
                    @if (count($tabs) > 0)
                        <div class="col-md-6 col-lg-12">
                            <div class="backdrop-filter bg-linear-2 rounded-4 px-6 py-4 z-1">
                                <div class="d-flex align-items-center justify-content-between">
                                    @php
                                        $tabsChunk = array_chunk($tabs, 2);
                                    @endphp
                                    @foreach($tabsChunk as $items)
                                        <div class="my-lg-3 text-center">
                                            @foreach($items as $item)
                                                @php
                                                    $itemTitle = Arr::get($item, 'title');
                                                    $itemData = Arr::get($item, 'data');
                                                @endphp

                                                @continue(! $itemTitle || ! $itemData)

                                                <span class="h2 count fw-black mb-0 lh-1 text-white text-nowrap"><span class="odometer" data-count="{{ $itemData }}"></span>{{ Arr::get($item, 'unit') }}</span>
                                                <p @class(['text-white text-nowrap border-opacity-50 border-white', 'pb-3 mb-3' => $loop->first, 'mb-0' => $loop->last])>
                                                    {!! BaseHelper::clean($itemTitle) !!}
                                                </p>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($image1 = $shortcode->image_1)
                        <div class="col-md-6 col-lg-12">
                            <div class="zoom-img rounded-4 fix d-inline-block mt-4 mt-lg-4 mt-md-0 h-100">
                                {{ RvMedia::image($image1, infinia_image_alt($shortcode), attributes: ['class' => 'h-100']) }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if ($backgroundImage = $shortcode->background_image)
        <div class="position-absolute top-0 start-50 translate-middle-x z-0">
            {{ RvMedia::image($backgroundImage, infinia_image_alt($shortcode)) }}
        </div>
    @endif
    <div class="rotate-center ellipse-rotate-success position-absolute z-0"></div>
    <div class="rotate-center-rev ellipse-rotate-primary position-absolute z-1"></div>
</section>
