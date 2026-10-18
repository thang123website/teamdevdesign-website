<section {!! $shortcode->htmlAttributes() !!} class="shortcode-feature-tabs section-services-4 position-relative fix section-padding">
    <div class="container position-relative z-2">
        <div class="text-center">
            @if ($subtitle = $shortcode->subtitle)
                <div class="d-flex align-items-center justify-content-center bg-primary-soft border border-2 border-white d-inline-flex rounded-pill px-4 py-2" data-aos="zoom-in" data-aos-delay="50">
                    <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                    <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
                </div>
            @endif

            @if ($title = $shortcode->title)
                <{{ $titleTag = infinia_title_tag($shortcode, 'h3') }} class="ds-3 my-3 fw-regular">
                    {!! infinia_clean_title($title) !!}
                </{{ $titleTag }}>
            @endif
        </div>

        @if(count($tabs))
            <div class="row pt-8">
                <div class="col-lg-4">
                    <div class="d-flex align-items-start">
                        <div class="nav w-100 flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            @foreach($tabs as $tab)
                                @php
                                    $tabTitle = Arr::get($tab, 'tab_name');
                                @endphp

                                @continue(! $tabTitle)

                                <button @class(['nav-link pe-5 justify-content-between d-flex', 'active' => $loop->first]) id="{{ Str::slug($tabTitle) }}-tab" data-bs-toggle="pill" data-bs-target="#{{ Str::slug($tabTitle) }}" type="button" role="tab" aria-controls="{{ Str::slug($tabTitle) }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                    {!! BaseHelper::clean($tabTitle) !!}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path class="fill-white" d="M17.4177 5.41772L16.3487 6.48681L21.1059 11.244H0V12.756H21.1059L16.3487 17.5132L17.4177 18.5822L24 12L17.4177 5.41772Z" fill="white" />
                                    </svg>
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="tab-content" id="v-pills-tabContent">
                        @foreach($tabs as $tab)
                            @php
                                $tabTitle = Arr::get($tab, 'tab_name');
                            @endphp

                            @continue(! $tabTitle)

                            <div @class(['tab-pane fade', 'show active' => $loop->first]) id="{{ Str::slug($tabTitle) }}" role="tabpanel" aria-labelledby="{{ Str::slug($tabTitle) }}-tab" tabindex="0">
                                <div class="row align-items-center rounded-3 bg-white p-5">
                                    @if ($tabImage = Arr::get($tab, 'image'))
                                        <div class="col-lg-5 mb-lg-0 mb-5">
                                            {{ RvMedia::image($tabImage, infinia_image_alt($shortcode), attributes: ['class' => 'rounded-3']) }}
                                        </div>
                                    @endif

                                    <div class="col-lg-7">
                                        <div class="p-lg-3">
                                            @if ($tabContentTitle = Arr::get($tab, 'title'))
                                                <h4 class="fw-regular">{!! BaseHelper::clean($tabContentTitle) !!}</h4>
                                            @endif

                                            @if ($tabDescription = Arr::get($tab, 'description'))
                                                <p>{!! BaseHelper::clean($tabDescription) !!}</p>
                                            @endif

                                            @foreach(range(1, 5) as $index)
                                                @php
                                                    $featureTitle = Arr::get($tab, "feature_item_title_{$index}");
                                                    $featureDescription = Arr::get($tab, "feature_item_description_{$index}");
                                                    $featureIcon = Arr::get($tab, "feature_item_icon_{$index}");
                                                    $featureIconImage = Arr::get($tab, "feature_item_icon_image_{$index}");
                                                @endphp

                                                @continue(! $featureTitle)

                                                <div @class(['d-flex', 'pt-5' => $loop->first])>
                                                    <div class="bg-primary-soft icon-flip position-relative icon-shape icon-xxl rounded-3 mb-4">
                                                        @if(! empty($featureIconImage))
                                                            <div class="icon">
                                                                <img src="{{ RvMedia::getImageUrl($featureIconImage) }}" alt="" aria-hidden="true" class="icon-image" style="max-width: 150px;">
                                                            </div>
                                                        @elseif($featureIcon)
                                                            <x-core::icon :name="$featureIcon" class="hover-up" style="width: 48px; height: 48px; stroke-width: 1" />
                                                        @endif
                                                    </div>
                                                    <div class="ps-5">
                                                        <strong class="d-block fs-6">{!! BaseHelper::clean($featureTitle) !!}</strong>

                                                        @if ($featureDescription)
                                                            <p>{!! BaseHelper::clean($featureDescription) !!}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @php
            $primaryButtonLabel = $shortcode->primary_action_label;
            $primaryButtonUrl = $shortcode->primary_action_url;

            $secondaryButtonLabel = $shortcode->secondary_action_label;
            $secondaryButtonUrl = $shortcode->secondary_action_url;
        @endphp

        @if(($secondaryButtonUrl && $secondaryButtonLabel) || ($primaryButtonLabel && $primaryButtonUrl))
            <div class="text-center mt-6">
                @if ($primaryButtonLabel && $primaryButtonUrl)
                    <a href="{{ $primaryButtonUrl }}" class="btn btn-gradient">
                        {!! BaseHelper::clean($primaryButtonLabel) !!}

                        @if($shortcode->primary_action_icon)
                            <x-core::icon class="ms-2" :name="$shortcode->primary_action_icon" />
                        @endif
                    </a>
                @endif

                @if($secondaryButtonUrl && $secondaryButtonLabel)
                    <a href="{{ $secondaryButtonUrl }}" class="ms-md-3 mt-md-0 mt-3 btn btn-outline-secondary hover-up">
                        @if($shortcode->secondary_action_icon)
                            <x-core::icon :name="$shortcode->secondary_action_icon" />
                        @endif

                        {!! BaseHelper::clean($secondaryButtonLabel) !!}
                    </a>
                @endif
            </div>
        @endif
    </div>

    @if ($backgroundImage = $shortcode->background_image)
        <div class="position-absolute top-0 start-50 translate-middle-x z-0">
            {{ RvMedia::image($backgroundImage, __('Background image')) }}
        </div>
    @endif

    <div class="bouncing-blobs-container">
        <div class="bouncing-blobs-glass"></div>
        <div class="bouncing-blobs">
            <div class="bouncing-blob bouncing-blob--green"></div>
            <div class="bouncing-blob bouncing-blob--primary"></div>
        </div>
    </div>
</section>
