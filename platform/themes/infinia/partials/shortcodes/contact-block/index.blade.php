@php
    $backgroundImage = $shortcode->background_image;
    $backgroundImage = $backgroundImage ? RvMedia::getImageUrl($backgroundImage) : null;

    $variablesStyle = [
        "--shortcode-background-image: url($backgroundImage) !important;" => $backgroundImage,
    ];
@endphp

<section {!! $shortcode->htmlAttributes() !!}  class="shortcode-contact-block section-cta-3 position-relative py-150 section-padding fix"
    @style($variablesStyle)
>
    <div class="container">
        <div class="row">
            <div class="col-auto ms-auto">
                <div class="bg-primary rounded-4">
                    <div class="p-7">
                        @if ($title = $shortcode->title)
                            <{{ $titleTag = infinia_title_tag($shortcode, 'h3') }} class="text-white">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
                        @endif

                        @php
                            $contactLabel = $shortcode->contact_label;
                            $contactTitle = $shortcode->contact_title;
                        @endphp

                        @if ($contactLabel && $contactTitle)
                            <a href="{{ $shortcode->contact_url }}" class="d-flex align-items-center mt-8 mb-9">
                                @if ($contactIcon = $shortcode->contact_icon)
                                    {{ RvMedia::image($contactIcon) }}
                                @endif

                                <span class="ms-3">
                                    <span class="text-white mb-0 fs-4">{!! BaseHelper::clean($contactTitle) !!}</span>
                                    <span class="text-white fs-4 d-block">{!! BaseHelper::clean($contactLabel) !!}</span>
                                </span>
                            </a>
                        @endif

                        @if (($buttonLabel = $shortcode->primary_action_label) && ($buttonUrl = $shortcode->primary_action_url))
                            <a href="{{ $buttonUrl }}" class="fw-bold btn text-start bg-white-keep d-flex align-items-center justify-content-between text-primary hover-up w-100">
                                <span>{!! BaseHelper::clean($buttonLabel) !!}</span>
                                @if($shortcode->primary_action_icon)
                                    <x-core::icon :name="$shortcode->primary_action_icon" />
                                @endif
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
