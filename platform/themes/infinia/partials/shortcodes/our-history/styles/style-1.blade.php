<section {!! $shortcode->htmlAttributes() !!} class="shortcode-our-history shortcode-our-history-style-1 section-cta-12 bg-3 position-relative section-padding fix">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
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
                    <p class="fs-5 text-500 mb-8">{!! BaseHelper::clean($description) !!}</p>
                @endif

                @php
                    $primaryButtonLabel = $shortcode->primary_action_label;
                    $primaryButtonUrl = $shortcode->primary_action_url;

                    $secondaryButtonLabel = $shortcode->secondary_action_label;
                    $secondaryButtonUrl = $shortcode->secondary_action_url;
                @endphp

                @if(($primaryButtonLabel && $primaryButtonUrl) || ($secondaryButtonLabel && $secondaryButtonUrl))
                    <div class="d-flex align-items-center mt-5">
                        @if ($primaryButtonLabel && $primaryButtonUrl)
                            <a href="{{ $primaryButtonUrl }}" class="btn btn-primary">
                                {!! BaseHelper::clean($primaryButtonLabel) !!}

                                @if($shortcode->primary_action_icon)
                                    <x-core::icon class="ms-2" :name="$shortcode->primary_action_icon" />
                                @endif
                            </a>
                        @endif

                        @if($secondaryButtonLabel && $secondaryButtonUrl)
                            <a href="{{ $secondaryButtonUrl }}" class="ms-5 fw-bold">
                                {!! BaseHelper::clean($secondaryButtonLabel) !!}

                                @if($shortcode->secondary_action_icon)
                                    <x-core::icon class="ms-2" :name="$shortcode->secondary_action_icon" />
                                @endif
                            </a>
                        @endif

                    </div>
                @endif
            </div>
            <div class="col-lg-6 offset-lg-1 mt-lg-0 mt-8">
                @if ($content = $shortcode->main_content)
                    <p class="fs-5 text-900 mb-5">{!! BaseHelper::clean($content) !!}</p>
                @endif

                @php
                    $authorName = $shortcode->author_name;
                    $authorAvatar = $shortcode->author_avatar;
                @endphp

                @if($authorName && $authorAvatar)
                    <div class="d-flex">
                        {{ RvMedia::image($authorAvatar, $authorName, attributes: ['class' => 'rounded-circle border border-5 border-primary-light']) }}

                        <div class="ms-2">
                            @if($authorSignature = $shortcode->author_signature)
                                {{ RvMedia::image($authorSignature, $authorName, attributes: ['class' => 'filter-invert']) }}
                            @endif

                            <strong class="d-block fs-6 mt-1 mb-0">{!! BaseHelper::clean($authorName) !!}
                                @if($authorTitle = $shortcode->author_title)
                                    <span class="text-500 fs-6">, {!! BaseHelper::clean($authorTitle) !!}</span>
                                @endif
                            </strong>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
