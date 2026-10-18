<section {!! $shortcode->htmlAttributes() !!} class="shortcode-testimonials shortcode-testimonials-style-1 section-testimonial-1 pb-120 position-relative">
    <div class="container position-relative z-1">
        <div class="row">
            <div class="col-lg-4">
                <div class="pe-8 mt-10">
                    @if($shortcode->subtitle)
                        <div class="d-flex align-items-center justify-content-center bg-primary-soft border border-2 border-white d-inline-flex rounded-pill px-4 py-2" data-aos="zoom-in" data-aos-delay="50">
                            <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                            <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                        </div>
                    @endif
                    @if($shortcode->title)
                        <{{ $titleTag = infinia_title_tag($shortcode, 'h3') }} class="ds-3 my-3" data-aos="fade-zoom-in" data-aos-delay="50">{!! infinia_clean_title($shortcode->title) !!}</{{ $titleTag }}>
                    @endif
                    @if($shortcode->description)
                        <span class="fs-5 fw-medium" data-aos="fade-zoom-in" data-aos-delay="100">
                            {!! BaseHelper::clean(nl2br($shortcode->description)) !!}
                        </span>
                    @endif
                    @if($shortcode->primary_action_label || $shortcode->secondary_action_label)
                        <div class="d-flex flex-wrap align-items-center mt-8">
                            @if($shortcode->primary_action_label)
                                <a href="{{ $shortcode->primary_action_url }}" class="btn btn-outline-secondary hover-up" data-aos="fade-zoom-in" data-aos-delay="50">
                                    @if($shortcode->primary_action_icon)
                                        <x-core::icon :name="$shortcode->primary_action_icon" />
                                    @endif
                                    {{ $shortcode->primary_action_label }}
                                </a>
                            @endif
                            @if($shortcode->secondary_action_label)
                                <a href="{{ $shortcode->secondary_action_url }}" class="ms-5 ms-md-5 mt-5 mt-md-0 fw-bold" data-aos="fade-zoom-in" data-aos-delay="100">
                                    {{ $shortcode->secondary_action_label }}
                                    @if($shortcode->secondary_action_icon)
                                        <x-core::icon :name="$shortcode->secondary_action_icon" />
                                    @endif
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            @foreach($testimonials->split(2) as $row)
                <div class="col-lg-4">
                    @foreach($row as $testimonial)
                        <div
                            @class(['bg-neutral-100 p-5 rounded-3 position-relative', 'mt-8' => $loop->first && $loop->parent->first, 'mt-5' => $loop->last || $loop->parent->last])
                            data-aos="fade-zoom-in"
                            data-aos-delay="{{ $loop->iteration }}00"
                        >
                            <p class="text-900">
                                {!! BaseHelper::clean(nl2br($testimonial->content)) !!}
                            </p>
                            <div class="d-flex align-items-center mt-5">
                                {{ RvMedia::image($testimonial->image, $testimonial->name, attributes: ['class' => 'avatar-lg rounded-circle', 'width' => 64]) }}
                                <div class="d-flex flex-column">
                                    <strong class="d-block fs-6 ms-3 fs-6 mb-0">{{ $testimonial->name }}</strong>
                                    @if($testimonial->company)
                                        <div class="flag ms-3">
                                            <span class="fs-8">{{ $testimonial->company }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
    @if($shortcode->background_image)
        <div class="position-absolute top-0 start-0 z-0">
            {{ RvMedia::image($shortcode->background_image, infinia_image_alt($shortcode)) }}
        </div>
    @endif
</section>
