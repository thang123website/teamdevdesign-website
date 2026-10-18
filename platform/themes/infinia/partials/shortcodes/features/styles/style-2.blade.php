<section {!! $shortcode->htmlAttributes() !!} class="shortcode-features shortcode-features-style-2">
    <div class="container-fluid position-relative bg-primary-light section-padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-6 mb-lg-0 mb-8 position-relative z-2">
                    @if($shortcode->subtitle)
                        <div class="d-flex align-items-center bg-white border border-2 border-white d-inline-flex rounded-pill px-3 py-1">
                            <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                            <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{{ $shortcode->subtitle }}</span>
                        </div>
                    @endif
                    @if($shortcode->title)
                        <{{ $titleTag = infinia_title_tag($shortcode, 'h2') }} class="text-white mt-3 mb-4 fw-medium hover-up">{!! infinia_clean_title($shortcode->title) !!}</{{ $titleTag }}>
                    @endif
                    @if($checklist)
                        <ul class="list-unstyled phase-items">
                            @foreach($checklist as $item)
                                <li class="phase-item d-flex align-items-center mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="24" viewBox="0 0 23 24" fill="none">
                                        <path
                                            d="M22.5 12C22.5 12.96 21.3206 13.7512 21.0844 14.6362C20.8406 15.5512 21.4575 16.8263 20.9944 17.6269C20.5238 18.4406 19.1081 18.5381 18.4481 19.1981C17.7881 19.8581 17.6906 21.2738 16.8769 21.7444C16.0763 22.2075 14.8012 21.5906 13.8862 21.8344C13.0012 22.0706 12.21 23.25 11.25 23.25C10.29 23.25 9.49875 22.0706 8.61375 21.8344C7.69875 21.5906 6.42375 22.2075 5.62313 21.7444C4.80938 21.2738 4.71187 19.8581 4.05188 19.1981C3.39188 18.5381 1.97625 18.4406 1.50563 17.6269C1.0425 16.8263 1.65938 15.5512 1.41563 14.6362C1.17938 13.7512 0 12.96 0 12C0 11.04 1.17938 10.2487 1.41563 9.36375C1.65938 8.44875 1.0425 7.17375 1.50563 6.37313C1.97625 5.55938 3.39188 5.46187 4.05188 4.80188C4.71187 4.14188 4.80938 2.72625 5.62313 2.25563C6.42375 1.7925 7.69875 2.40938 8.61375 2.16563C9.49875 1.92938 10.29 0.75 11.25 0.75C12.21 0.75 13.0012 1.92938 13.8862 2.16563C14.8012 2.40938 16.0763 1.7925 16.8769 2.25563C17.6906 2.72625 17.7881 4.14188 18.4481 4.80188C19.1081 5.46187 20.5238 5.55938 20.9944 6.37313C21.4575 7.17375 20.8406 8.44875 21.0844 9.36375C21.3206 10.2487 22.5 11.04 22.5 12Z"
                                            fill="white"
                                        />
                                        <path
                                            d="M14.5013 8.64754L10.2188 12.93L7.99875 10.7119C7.51688 10.23 6.735 10.23 6.25313 10.7119C5.77125 11.1938 5.77125 11.9757 6.25313 12.4575L9.36751 15.5719C9.83626 16.0407 10.5975 16.0407 11.0663 15.5719L16.245 10.3932C16.7269 9.91129 16.7269 9.12941 16.245 8.64754C15.7631 8.16566 14.9831 8.16566 14.5013 8.64754Z"
                                            fill="#A38CFF"
                                        />
                                    </svg>
                                    <p class="text-white mb-0 ms-3">{!! BaseHelper::clean($item) !!}</p>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                @if($shortcode->floating_card_image)
                    <div class="col-lg-4 col-md-6 mb-lg-0 mb-8">
                        <div class="position-relative d-inline-block z-2 hover-up">
                            {{ RvMedia::image($shortcode->floating_card_image, $shortcode->floating_card_title, attributes: ['class' => 'rounded-3 border border-3 border-white']) }}
                            <div class="position-absolute bottom-0 start-0 end-0 mb-3 mx-3 backdrop-filter rounded-3 text-start p-3">
                                @if($shortcode->floating_card_button_label)
                                    @php
                                        $tag = $shortcode->floating_card_button_url ? 'a' : 'div';
                                    @endphp
                                    <{{ $tag }}
                                        @if($tag === 'a') href="{{ $shortcode->floating_card_button_url }}" @endif
                                        class="d-flex align-items-center bg-white-keep d-inline-flex rounded-pill px-2 py-1"
                                    >
                                        <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                                        <span class="fs-7 fw-medium text-primary mx-2">{{ $shortcode->floating_card_button_label }}</span>
                                    </{{ $tag }}>
                                @endif
                                @if($shortcode->floating_card_title)
                                    <strong class="d-block fs-6 mt-3">
                                        {!! BaseHelper::clean(nl2br($shortcode->floating_card_title)) !!}
                                    </strong>
                                @endif
                                @if($shortcode->floating_card_description)
                                    <p class="fs-7 text-700">{!! BaseHelper::clean($shortcode->floating_card_description) !!}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
                @if($features)
                    <div class="col-lg-4 mb-lg-0 mb-8">
                        <div class="px-lg-8">
                            @foreach($features as $feature)
                                <div data-aos="fade-zoom-in" data-aos-delay="{{ $loop->iteration }}00">
                                    @if(! empty($feature['icon_image']))
                                        <div class="icon">
                                            <img src="{{ RvMedia::getImageUrl($feature['icon_image']) }}" alt="" aria-hidden="true" class="icon-image" style="max-width: 150px;">
                                        </div>
                                    @elseif($feature['icon'])
                                        <x-core::icon :name="$feature['icon']" class="hover-up" style="width: 48px; height: 48px; stroke-width: 1" />
                                    @endif
                                    @if($feature['title'])
                                        <strong class="d-block fs-5 text-white my-3">{{ $feature['title'] }}</strong>
                                    @endif
                                    @if($feature['description'])
                                        <p @class(['text-white', 'border-bottom pb-3' => ! $loop->last])>
                                            {!! BaseHelper::clean($feature['description']) !!}
                                        </p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
        @if($shortcode->image)
            <div class="position-absolute bg-rotate z-0">
                {{ RvMedia::image($shortcode->image, infinia_image_alt($shortcode), attributes: ['class' => 'rotate-center']) }}
            </div>
        @endif
        <div class="position-absolute top-0 end-0 z-1 p-8">
            <div class="bloom"></div>
        </div>
    </div>
</section>
