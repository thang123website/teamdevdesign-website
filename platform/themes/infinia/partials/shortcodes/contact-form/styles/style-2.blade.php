<section {!! $shortcode->htmlAttributes() !!}  class="section-contact-2 position-relative section-padding bg-5 shortcode-contact-form shortcode-contact-form-style-2"
    @style($variablesStyle)
>
    <div class="container position-relative z-1">
        <div class="text-center">
            @if ($title = $shortcode->title)
                <{{ $titleTag = infinia_title_tag($shortcode, 'h5') }} class="ds-5 mt-3 mb-3">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
            @endif

            @if ($description = $shortcode->description)
                <span class="fs-5 fw-medium">{!! BaseHelper::clean($description) !!}</span>
            @endif

        </div>
        <div class="row mt-8">
            <div class="col-lg-10 mx-lg-auto">
                <div class="row">
                    <div class="col-lg-6 ps-lg-0 pb-5 pb-lg-0">
                        @if ($formTitle = $shortcode->form_title)
                            <h4 class="mb-3">{!! BaseHelper::clean($formTitle) !!}</h4>
                        @endif

                        {!!
                            /** @var \Botble\Contact\Forms\Fronts\ContactForm $form **/
                            $form
                                ->setFormInputWrapperClass('input-group')
                                ->setFormInputClass('form-control ms-0 border rounded-2')
                                ->setFormLabelClass('d-none')
                                ->modify(
                                    'submit',
                                    'submit',
                                    \Botble\Base\Forms\FieldOptions\ButtonFieldOption::make()
                                        ->cssClass('btn btn-primary hover-up mt-4')
                                        ->label(__('Send Message') . BaseHelper::renderIcon('ti ti-arrow-right', attributes: ['class' => 'ms-2']))
                                )
                                ->renderForm()
                        !!}
                    </div>

                    @if (count($tabs))
                        <div class="col-lg-6">
                            <div class="ps-lg-6">
                                @foreach($tabs as $tab)
                                    @if ($tabTitle = Arr::get($tab, 'title'))
                                        <strong class="d-block fs-6">{!! BaseHelper::clean($tabTitle) !!}</strong>
                                    @endif

                                    @if ($tabDescription = Arr::get($tab, 'description'))
                                        <p class="text-500">{!! BaseHelper::clean($tabDescription) !!}</p>
                                    @endif

                                    @foreach(range(1, 3) as $index)
                                        @php
                                            $buttonLabel = Arr::get($tab, "button_label_{$index}");
                                            $buttonUrl = Arr::get($tab, "button_url_{$index}");
                                            $buttonIcon = Arr::get($tab, "button_icon_{$index}");
                                        @endphp

                                        <div @class(['d-flex mb-2', 'mb-5' => $loop->last])>
                                            @if ($buttonLabel && $buttonUrl)
                                                @if ($buttonIcon)
                                                    <x-core::icon :name="$buttonIcon"/>
                                                @endif

                                                <a class="ms-2 text-decoration-underline text-900 fs-7" href="{{ $buttonUrl }}">
                                                    {!! BaseHelper::clean($buttonLabel) !!}
                                                </a>
                                            @endif
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="rotate-center ellipse-rotate-success position-absolute z-0"></div>
    <div class="rotate-center-rev ellipse-rotate-primary position-absolute z-0"></div>
    <div class="rotate-center-rev ellipse-rotate-info position-absolute z-0"></div>
</section>
