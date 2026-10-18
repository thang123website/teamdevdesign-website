<section {!! $shortcode->htmlAttributes() !!} class="shortcode-features shortcode-features-style-3">
    <div class="container-fluid position-relative bg-neutral-100 section-padding ">
        <div class="container">
            <div class="row align-items-center">
                @if($shortcode->image)
                    <div class="col-lg-6 text-lg-end text-center">
                        <div class="position-relative d-inline-block mb-lg-0 mb-8">
                            {{ RvMedia::image($shortcode->image, infinia_image_alt($shortcode), attributes: ['class' => 'rounded-4', 'data-aos' => 'fade-zoom-in', 'data-aos-delay' => 200]) }}
                            @if($shortcode->floating_card_title || $shortcode->floating_card_image || $shortcode->floating_card_description)
                                <div class="position-absolute bottom-0 start-0 translate-middle-md-x mb-md-8 backdrop-filter rounded-3 p-md-4 p-3 text-center">
                                    @if($shortcode->floating_card_title)
                                        <strong class="d-block fs-6">{{ $shortcode->floating_card_title }}</strong>
                                    @endif
                                    @if($shortcode->floating_card_image)
                                        <div class="d-flex align-items-center justify-content-center py-4">
                                            {{ RvMedia::image($shortcode->floating_card_image, infinia_image_alt($shortcode), attributes: ['style' => 'max-width: 10.5rem']) }}
                                        </div>
                                    @endif
                                    @if($shortcode->floating_card_description)
                                        <p class="pt-2">
                                            {!! BaseHelper::clean(nl2br($shortcode->floating_card_description)) !!}
                                        </p>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
                <div class="col-lg-6">
                    <div class="ps-lg-5">
                        @if($shortcode->subtitle)
                            <strong class="d-block fs-6" data-aos="fade-zoom-in" data-aos-delay="50">{{ $shortcode->subtitle }}</strong>
                        @endif
                        @if($shortcode->title)
                            <{{ $titleTag = infinia_title_tag($shortcode, 'h3') }} class="ds-3 mt-2 mb-5" data-aos="fade-zoom-in" data-aos-delay="100">{!! infinia_clean_title($shortcode->title) !!}</{{ $titleTag }}>
                        @endif
                        @if($shortcode->description)
                            <p class="mb-5" data-aos="fade-zoom-in" data-aos-delay="100">
                                {!! BaseHelper::clean($shortcode->description) !!}
                            </p>
                        @endif
                        @if($shortcode->primary_action_label || $shortcode->secondary_action_label)
                            <div class="d-flex align-items-center pb-7 border-bottom">
                                @if($shortcode->primary_action_label)
                                    <a href="{{ $shortcode->primary_action_url }}" class="btn btn-gradient" data-aos="fade-zoom-in" data-aos-delay="0">
                                        {{ $shortcode->primary_action_label }}
                                        @if($shortcode->primary_action_icon)
                                            <x-core::icon :name="$shortcode->primary_action_icon" class="ms-2" />
                                        @endif
                                    </a>
                                @endif
                                @if($shortcode->secondary_action_label)
                                    <a href="{{ $shortcode->secondary_action_url }}" class="ms-5 text-decoration-underline fw-bold" data-aos="fade-zoom-in" data-aos-delay="100">
                                        {{ $shortcode->secondary_action_label }}
                                        @if($shortcode->secondary_action_icon)
                                            <x-core::icon :name="$shortcode->secondary_action_icon" class="ms-2" />
                                        @endif
                                    </a>
                                @endif
                            </div>
                        @endif
                        @if($features)
                            <div class="row">
                                @foreach($features as $feature)
                                    <div @class(['col-12 col-md-6 d-flex align-items-center justify-content-center mt-5', 'border-end' => ! $loop->last])>
                                        <h2>{{ $feature['title'] }}</h2>
                                        @if($feature['description'])
                                            <p class="ms-3" data-aos="fade-zoom-in" data-aos-delay="{{ $loop->iteration + 1 }}00">
                                                {!! BaseHelper::clean($feature['description']) !!}
                                            </p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
