@php
    $contactInfo = Shortcode::fields()->getTabsData(['title', 'description', 'icon'], $shortcode);
    $showCol = $contactInfo || $shortcode->title || $shortcode->subtitle;
@endphp

<section
    {!! $shortcode->htmlAttributes() !!}
    class="section-contact-1 position-relative section-padding shortcode-contact-form shortcode-contact-form-style-1"
    @style($variablesStyle)
>
    <div class="container position-relative z-1">
        <div class="row">
            @if($showCol)
                <div class="col-lg-6">
                    @if($shortcode->subtitle)
                        <div class="d-flex align-items-center justify-content-center bg-primary-soft-keep border border-2 border-white-keep d-inline-flex rounded-pill px-4 py-2">
                            <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                            <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean(nl2br($shortcode->subtitle)) !!}</span>
                        </div>
                    @endif
                    @if($shortcode->title)
                        <{{ $titleTag = infinia_title_tag($shortcode, 'h5') }} class="ds-5 mt-3 mb-3 text-white">{!! infinia_clean_title($shortcode->title) !!}</{{ $titleTag }}>
                    @endif
                    @if($shortcode->description)
                        <span class="fs-5 fw-medium text-white">
                        {!! BaseHelper::clean(nl2br($shortcode->description)) !!}
                    </span>
                    @endif
                    @foreach($contactInfo as $info)
                        <div class="d-flex pt-6 pb-3 align-items-center">
                            @if($info['icon'])
                                <div class="bg-white-keep icon-flip position-relative icon-shape icon-xxl rounded-3">
                                    <div class="icon">
                                        <x-core::icon :name="$info['icon']" class="text-primary" style="width: 48px; height: 48px; stroke-width: 1;" />
                                    </div>
                                </div>
                            @endif
                            <div class="ps-5">
                                <strong class="d-block fs-6 text-white">{{ $info['title'] }}</strong>
                                @if($info['description'])
                                    <p class="text-white mb-0">
                                        {{ $info['description'] }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            <div @class(['col-lg-6 ps-lg-0 pt-5 pt-lg-0' => $showCol, 'col-lg-12' => ! $showCol])>
                <div class="position-relative">
                    <div class="position-relative z-2 p-3 p-md-5 p-lg-8 rounded-3 bg-primary">
                        @if($shortcode->form_title)
                            <h3 class="text-white">{{ $shortcode->form_title }}</h3>
                        @endif
                        @if($shortcode->form_description)
                            <p class="text-white">{{ $shortcode->form_description }}</p>
                        @endif
                        {!!
                            /** @var \Botble\Contact\Forms\Fronts\ContactForm $form **/
                            $form
                                ->setFormInputWrapperClass('input-group')
                                ->setFormInputClass('form-control ms-0 border rounded-2')
                                ->setFormLabelClass('mb-1 mt-3 text-white')
                                ->modify(
                                    'submit',
                                    'submit',
                                    \Botble\Base\Forms\FieldOptions\ButtonFieldOption::make()
                                        ->cssClass('btn bg-white-keep text-primary hover-up mt-3')
                                        ->label(__('Send Message') . BaseHelper::renderIcon('ti ti-arrow-right', attributes: ['class' => 'ms-2']))
                                )
                                ->renderForm()
                        !!}
                    </div>
                    <div class="z-0 bg-primary-dark rectangle-bg z-1 rounded-3"></div>
                </div>
            </div>
        </div>
    </div>
</section>
