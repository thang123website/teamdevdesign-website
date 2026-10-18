<section {!! $shortcode->htmlAttributes() !!} class="shortcode-testimonials shortcode-testimonials-style-2 section-testimonial-2 position-relative bg-white section-padding">
    <div class="container position-relative z-1">
        @if($shortcode->subtitle || $shortcode->title || $shortcode->description)
            <div class="row pb-9">
                <div class="col-lg-7 mx-lg-auto">
                    <div class="text-center mb-lg-0 mb-5">
                        @if($shortcode->subtitle)
                            <div class="d-flex align-items-center justify-content-center bg-primary-soft border border-2 border-white d-inline-flex rounded-pill px-4 py-2" data-aos="zoom-in" data-aos-delay="50">
                                <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                                <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                            </div>
                        @endif
                        @if($shortcode->title)
                            <{{ $titleTag = infinia_title_tag($shortcode, 'h4') }} class="ds-4 my-3">
                                {!! infinia_clean_title($shortcode->title) !!}
                            </{{ $titleTag }}>
                        @endif
                        @if($shortcode->description)
                            <p class="fs-5 mb-0">{!! BaseHelper::clean(nl2br($shortcode->description)) !!}</p>
                        @endif
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            @foreach($testimonials->split(3) as $chunk)
                <div class="col-lg-4">
                    @foreach($chunk as $testimonial)
                        <div @class(['bg-neutral-100 p-5 rounded-3', 'mt-5' => $loop->last || ! ($chunk->count() === 1 && $loop->first)]) data-aos="fade-zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                            <p class="text-900">
                                {!! BaseHelper::clean(nl2br($testimonial->content)) !!}
                            </p>
                            <div class="d-flex align-items-center mt-5">
                                {{ RvMedia::image($testimonial->image, $testimonial->name, attributes: ['class' => 'avatar-lg rounded-circle', 'width' => 64]) }}
                                <div class="d-flex flex-column">
                                    <strong class="d-block ms-3 fs-6 mb-0">{{ $testimonial->name }}</strong>
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
    @if($shortcode->primary_action_label || $shortcode->secondary_action_label)
        <div class="text-center mt-8 position-relative z-3">
            @if($shortcode->primary_action_label)
                <a href="{{ $shortcode->primary_action_url }}" class="btn btn-dark hover-up d-inline-flex gap-2 align-items-center">
                    {{ $shortcode->primary_action_label }}
                    @if($shortcode->primary_action_icon)
                        <x-core::icon :name="$shortcode->primary_action_icon" />
                    @endif
                </a>
            @endif
            @if($shortcode->secondary_action_label)
                <a href="{{ $shortcode->secondary_action_url }}" class="ms-5 ms-md-5 mt-5 mt-md-0 fw-bold">
                    {{ $shortcode->secondary_action_label }}
                    @if($shortcode->secondary_action_icon)
                        <x-core::icon :name="$shortcode->secondary_action_icon" class="ms-2" />
                    @endif
                </a>
            @endif
        </div>
    @endif
    <div class="mask-image-2 position-absolute top-50 bottom-0 start-0 end-0 z-1"></div>
</section>
