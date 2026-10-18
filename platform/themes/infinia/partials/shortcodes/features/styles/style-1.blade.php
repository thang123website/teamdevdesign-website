<section {!! $shortcode->htmlAttributes() !!} class="features-1 section-padding shortcode-features shortcode-features-style-1">
    @if($shortcode->title || $shortcode->subtitle)
        <div class="container">
            <div class="row">
                <div @class(['col-lg-4' => $shortcode->image, 'col-lg-12' => ! $shortcode->image])>
                    @if($shortcode->subtitle)
                        <div class="d-flex align-items-center bg-primary-soft border border-2 border-white d-inline-flex rounded-pill px-3 py-1">
                            <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                            <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{{ $shortcode->subtitle }}</span>
                        </div>
                    @endif
                    @if($shortcode->title)
                        <{{ $titleTag = infinia_title_tag($shortcode, 'h2') }} class="fw-medium mt-4 lh-sm">
                            {!! infinia_clean_title($shortcode->title) !!}
                        </{{ $titleTag }}>
                    @endif
                </div>
                @if($shortcode->image)
                    <div class="col-lg-8">
                        <div class="d-flex flex-md-row flex-column align-items-center position-relative ps-lg-8 pt-lg-0 pt-10">
                            {{ RvMedia::image($shortcode->image, infinia_image_alt($shortcode), attributes: ['class' => 'position-absolute top-50 start-0 translate-middle-y z-0']) }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif
    <div class="container">
        <div @class(['row', 'mt-10' => $shortcode->title || $shortcode->subtitle])>
            @foreach($features as $feature)
                <div class="col-lg-3 col-md-6 z-1" data-aos="fade-zoom-in" data-aos-delay="{{ $loop->iteration }}00">
                    <div class="feature-item mb-5 mb-lg-0">
                        <div class="bg-primary-soft icon-flip position-relative icon-shape icon-xxl rounded-3 mb-4">
                            @if(! empty($feature['icon_image']))
                                <div class="icon">
                                    <img src="{{ RvMedia::getImageUrl($feature['icon_image']) }}" alt="" aria-hidden="true" class="icon-image">
                                </div>
                            @elseif($feature['icon'])
                                <div class="icon">
                                    <x-core::icon :name="$feature['icon']" />
                                </div>
                            @endif
                        </div>
                        @if($feature['title'])
                            <strong class="d-block fs-6">{{ $feature['title'] }}</strong>
                        @endif
                        @if($feature['description'])
                            <p>{!! BaseHelper::clean(nl2br($feature['description'])) !!}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
