<section {!! $shortcode->htmlAttributes() !!}  class="section-contact-6 section-padding fix shortcode-contact-form shortcode-contact-form-style-3"
    @style($variablesStyle)
>
    <div class="container">
        <div class="text-center">
            @if ($subtitle = $shortcode->subtitle)
                <div class="d-flex align-items-center justify-content-center bg-primary-soft border border-2 border-white d-inline-flex rounded-pill px-4 py-2" data-aos="zoom-in" data-aos-delay="50">
                    <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                    <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
                </div>
            @endif

            @if ($title = $shortcode->title)
                <{{ $titleTag = infinia_title_tag($shortcode, 'h3') }} class="ds-3 mt-3 mb-3">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
            @endif

            @if ($description = $shortcode->description)
                <p class="fs-5">{!! BaseHelper::clean($description) !!}</p>
            @endif

        </div>
        <div class="row mt-8">
            <div class="col-lg-10 mx-lg-auto">
                <div class="row">
                    <div class="col-lg-6 ps-lg-0 pb-5 pb-lg-0">
                        <div class="border rounded-4 shadow-1 p-5">
                            @if ($formTitle = $shortcode->form_title)
                                <h4 class="mb-5">{!! BaseHelper::clean($formTitle) !!}</h4>
                            @endif

                                {!!
                                /** @var \Botble\Contact\Forms\Fronts\ContactForm $form **/
                                $form
                                    ->setFormInputWrapperClass('input-group d-flex mt-4')
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
                    </div>

                    @if ($tabs)
                        <div class="col-lg-6 align-self-stretch">
                            <div class="ms-lg-6 p-5 border rounded-4 h-100">
                                @if ($formDescription = $shortcode->form_description)
                                    <h4 class="mb-5">{!! BaseHelper::clean($formDescription) !!}</h4>
                                @endif

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
</section>
