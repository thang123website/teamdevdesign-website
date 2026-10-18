<section {!! $shortcode->htmlAttributes() !!}  class="shortcode-about-us-information-tabs">
    <div class="container-fluid position-relative section-padding">
        <div class="container">
            <div class="row">
                @if ($title = $shortcode->title)
                    <div class="col-lg-6">
                        <{{ $titleTag = infinia_title_tag($shortcode, 'h5') }} class="fw-regular ds-5">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
                    </div>
                @endif

                <div class="row align-items-center">
                    <div class="col-lg-6 text-lg-start text-center">
                        <div class="position-relative z-1 d-inline-block mb-lg-0 mb-8">
                            @if ($image = $shortcode->image)
                                {{ RvMedia::image($image, infinia_image_alt($shortcode), attributes: ['class' => 'rounded-4 position-relative z-1']) }}
                            @endif

                            @if ($counters)
                                <div class="alltuchtopdown position-absolute top-50 start-50 ms-md-10 mt-md-10 backdrop-filter bg-primary rounded-4 px-6 py-4 text-center z-1">
                                    @foreach($counters as $counter)
                                        @php
                                            $counterTitle = Arr::get($counter, 'data_counter_title');
                                            $counterData = Arr::get($counter, 'data_counter');
                                        @endphp

                                        @continue(! $counterTitle = Arr::get($counter, 'data_counter_title'))
                                        <span class="h2 count fw-black mb-0 lh-1 text-white text-nowrap">
                                            <span class="odometer" data-count="{{ $counterData }}">
                                            @if($counterUnit = Arr::get($counter, 'data_counter_unit')) </span>{!! BaseHelper::clean($counterUnit) !!}</span> @endif
                                        <p @class(['text-white text-nowrap pb-3 mb-3', 'border-bottom border-opacity-50 border-white' => ! $loop->last])>
                                            {!! BaseHelper::clean($counterTitle) !!}
                                        </p>
                                    @endforeach

                                </div>
                            @endif
                        </div>
                    </div>

                    @if ($tabs)
                        <div class="col-lg-6 mt-lg-0 mt-5 position-relative z-2">
                            <nav>
                                <div class="nav nav-tabs bg-neutral-100 justify-content-evenly border-bottom-0 mb-5" id="nav-tab" role="tablist">
                                    @foreach($tabs as $tab)
                                        @continue(! $tabTitle = Arr::get($tab, 'title'))
                                        <button @class(['nav-link position-relative', 'active' => $loop->first]) id="{{ Str::slug($tabTitle) }}-tab" data-bs-toggle="tab" data-bs-target="#{{ Str::slug($tabTitle) }}" type="button" role="tab" aria-controls="{{ Str::slug($tabTitle) }}" aria-selected="true">
                                            {!! BaseHelper::clean($tabTitle) !!}
                                            <span class="underline bg-primary"></span>
                                        </button>
                                    @endforeach
                                </div>
                            </nav>

                            <div class="tab-content" id="nav-tabContent">
                                @foreach($tabs as $tab)
                                    @php
                                        $tabTitle = Arr::get($tab, 'title');
                                    @endphp

                                    @continue(! $tabTitle)

                                    <div @class(['tab-pane fade', 'show active' => $loop->first]) id="{{ Str::slug($tabTitle) }}" role="tabpanel" aria-labelledby="{{ Str::slug($tabTitle) }}-tab" tabindex="0">
                                        @if ($description = Arr::get($tab, 'description'))
                                            <p class="text-900 mb-3">{!! BaseHelper::clean($description) !!}</p>
                                        @endif

                                        <div class="row">
                                            <div class="col-12 col-md-6 mb-3 mb-md-0">
                                                @if ($tabContent = Arr::get($tab, 'content'))
                                                    <p class="text-900">{!! BaseHelper::clean($tabContent) !!}</p>
                                                @endif


                                                @if ($loop->first && $features)
                                                    <ul class="list-unstyled phase-items mb-0">
                                                        @foreach($features as $feature)
                                                            @continue(! $feature)
                                                            <li class="d-flex align-items-center mt-3">
                                                                <img src="{{ Theme::asset()->url('images/icons/check.png') }}" alt="" aria-hidden="true">
                                                                <p class="ms-2 mb-0 text-900 fs-6">{!! BaseHelper::clean($feature) !!}</p>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>
                                            <div class="col-12 col-md-6 position-relative text-center">
                                                @if($image = Arr::get($tab, 'image'))
                                                    {{ RvMedia::image($image, infinia_image_alt($shortcode), attributes: ['class' => 'rounded-3']) }}
                                                @endif

                                                @php
                                                    $authorName = $shortcode->author_name;
                                                    $authorTitle = $shortcode->author_title;
                                                    $authorAvatar = $shortcode->author_avatar;
                                                    $authorSignature = $shortcode->author_signature;
                                                @endphp

                                                @if ($loop->first && $authorName && $authorAvatar)
                                                    <a href="#" class="position-md-absolute d-block translate-middle-md  w-50 start-0 ms-md-0 ms-10 mt-3 mt-md-0 p-3 rounded-3 bg-linear-1">
                                                        <span class="rounded-circle">
                                                            {{ RvMedia::image($authorAvatar, $authorName, attributes: ['class' => 'rounded-circle border border-5 border-primary-light']) }}
                                                        </span>
                                                        <strong class="d-block fs-6 mt-1"> {!! BaseHelper::clean($authorName) !!}
                                                            @if ($authorTitle)
                                                                <span class="text-500 fs-6">, {!! BaseHelper::clean($authorTitle) !!}</span>
                                                            @endif
                                                        </strong>
                                                    </a>

                                                    @if ($authorSignature)
                                                        <div class="position-md-absolute bottom-0 start-50 mt-3 mt-md-0 translate-middle-md-x">
                                                            {{ RvMedia::image($authorSignature, $authorName, attributes: ['class' => 'rounded-3']) }}
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="border-top pt-6 mt-md-8 mt-6">
                                @if (($primaryActionLabel = $shortcode->primary_action_label) && ($primaryActionUrl = $shortcode->primary_action_url))
                                    <a href="{{ $primaryActionUrl }}" class="fw-bold btn btn-gradient d-inline-flex align-items-center hover-up">
                                        <span class="me-10">{!! BaseHelper::clean($primaryActionLabel) !!}</span>

                                        @if ($primaryActionIcon = $shortcode->primary_action_icon)
                                            <x-core::icon :name="$primaryActionIcon" />
                                        @endif
                                    </a>
                                @endif

                                @if ($bottomDescription = $shortcode->bottom_description)
                                    <p class="fs-7 text-500 mt-3">{!! BaseHelper::clean($bottomDescription) !!}</p>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="position-absolute top-0 end-0 z-1 flickering p-10 m-10 d-none d-lg-block">
                <img src="{{ Theme::asset()->url('images/shapes/shine-effect.png') }}" alt="" aria-hidden="true">
            </div>
        </div>
    </div>
</section>
