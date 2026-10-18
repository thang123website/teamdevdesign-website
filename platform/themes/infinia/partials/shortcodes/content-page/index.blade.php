<section {!! $shortcode->htmlAttributes() !!} class="section-privacy-policy">
    <div class="container">
        <div class="text-center">
            @if ($subtitle = $shortcode->subtitle)
                <div class="d-flex align-items-center justify-content-center bg-primary-soft border border-2 border-white d-inline-flex rounded-pill px-4 py-2" data-aos="zoom-in" data-aos-delay="50">
                    <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                    <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
                </div>
            @endif

            @if ($title = $shortcode->title)
                <{{ $titleTag = infinia_title_tag($shortcode, 'h3') }} class="ds-3 my-3">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
            @endif

            @if ($description = $shortcode->description)
                <p class="fs-5">{!! BaseHelper::clean($description) !!}</p>
            @endif
        </div>
        <div class="row pt-110">
            <div class="col-lg-8 col-md-10 mx-md-auto">
                {!! BaseHelper::clean($shortcode->main_content) !!}

                @if ($contactTitle = $shortcode->contact_section_title)
                    <h4 class="text-primary">{!! BaseHelper::clean($contactTitle) !!}</h4>
                @endif

                @if ($contactDescription = $shortcode->contact_section_description)
                    <p>{!! BaseHelper::clean($contactDescription) !!}</p>
                @endif

                <div class="row">
                    <div class="col">
                        @if ($contactSubtitle = $shortcode->contact_section_subtitle)
                            <strong class="d-block fs-6">{!! BaseHelper::clean($contactSubtitle) !!}</strong>
                        @endif

                        @if ($contactSubDescription = $shortcode->contact_section_sub_description)
                            <p class="text-500">{!! BaseHelper::clean($contactSubDescription) !!}</p>
                        @endif

                        @if ($tabs)
                            <div class="row">
                                @foreach($tabs as $tab)
                                    @php
                                        $actionLabel = Arr::get($tab, 'action_label');
                                        $actionLink = Arr::get($tab, 'action_url');
                                    @endphp

                                    <div class="col-lg-6">
                                        <div class="d-flex mb-2">
                                            @if ($icon = Arr::get($tab, 'action_icon'))
                                                <x-core::icon :name="$icon"/>
                                            @endif
                                            <a class="ms-2 text-decoration-underline text-900 fs-7" href="{{ $actionLink }}">{!! BaseHelper::clean($actionLabel) !!}</a>
                                        </div>
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
