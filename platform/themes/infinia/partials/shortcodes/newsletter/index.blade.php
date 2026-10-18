<section {!! $shortcode->htmlAttributes() !!} class="shortcode-newsletter section-comming-soon section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="text-start mb-lg-0 mb-5">
                    @if ($subtitle = $shortcode->subtitle)
                        <div class="d-flex align-items-center justify-content-center bg-primary-soft border border-2 border-white d-inline-flex rounded-pill px-4 py-2" data-aos="zoom-in" data-aos-delay="50">
                            <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                            <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
                        </div>
                    @endif

                    @if ($title = $shortcode->title)
                        <h3 class="ds-3 my-3">{!! Basehelper::clean($title) !!}</h3>
                    @endif

                    @if ($description = $shortcode->description)
                        <p class="fs-5 mb-0">{!! BaseHelper::clean($description) !!}</p>
                    @endif

                    {!! $form
                        ->setFormInputWrapperClass('input-group mb-3 mt-4 position-relative')
                        ->setFormInputClass('ps-5 py-3 form-control bg-neutral-100 rounded-start-pill border-2 border-end-0 border-white custom-input')
                        ->setFormLabelClass('d-none')
                        ->modify(
                            'submit',
                            'submit',
                            \Botble\Base\Forms\FieldOptions\ButtonFieldOption::make()
                                ->cssClass('btn btn-gradient px-3 py-3 m-3 fs-7 fw-bold border-0 rounded-pill')
                                ->label($shortcode->button_label ?: __('Join now'))
                        )
                        ->renderForm() !!}
                </div>
            </div>

            @if ($image = $shortcode->image)
                <div class="col-lg-6 text-lg-end text-center">
                    <img src="{{ RvMedia::getImageUrl($image) }}" alt="{{ $title }}">
                </div>

            @endif
        </div>
    </div>
</section>
