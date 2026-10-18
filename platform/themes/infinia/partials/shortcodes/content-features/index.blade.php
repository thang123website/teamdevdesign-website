<div {!! $shortcode->htmlAttributes() !!} class="row">
    <div @class(['col-lg-7', 'col-lg-12' => ! $shortcode->image])>
        @foreach($features as $feature)
            <div @class(['d-flex', 'pt-3' => ! $loop->first])>
                @if(! empty($feature['icon_image']))
                    <div class="bg-primary-soft icon-flip position-relative icon-shape icon-xxl rounded-3 mb-4">
                        <div class="icon">
                            <img src="{{ RvMedia::getImageUrl($feature['icon_image']) }}" alt="" aria-hidden="true" class="icon-image">
                        </div>
                    </div>
                @elseif($feature['icon'])
                    <div class="bg-primary-soft icon-flip position-relative icon-shape icon-xxl rounded-3 mb-4">
                        <div class="icon">
                            <x-core::icon :name="$feature['icon']" class="text-primary" style="stroke-width: 1; width: 48px; height: 48px;"/>
                        </div>
                    </div>
                @endif
                <div class="ps-5">
                    @if($feature['title'])
                        <strong class="d-block fs-6">{{ $feature['title'] }}</strong>
                    @endif
                    <p>{!! BaseHelper::clean(nl2br($feature['description'])) !!}</p>
                </div>
            </div>
        @endforeach
    </div>
    @if($shortcode->image)
        <div class="col-lg-5 mt-lg-0 mt-5">
            {{ RvMedia::image($shortcode->image, infinia_image_alt($shortcode), attributes: ['class' => 'rounded-3']) }}
        </div>
    @endif
</div>
