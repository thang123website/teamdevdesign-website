<div {!! $shortcode->htmlAttributes() !!}  class="d-md-flex align-items-center mt-3 mb-3">
    @foreach($checklist as $row)
        <ul @class(['list-unstyled phase-items mb-0', 'ms-md-6' => ! $loop->first])>
            @foreach($row as $item)
                <li class="d-flex align-items-center mt-3">
                    <img src="{{ Theme::asset()->url('images/icons/check.png') }}" alt="" aria-hidden="true">
                    <span class="ms-2 text-900 fw-medium fs-6">{!! BaseHelper::clean(nl2br($item)) !!}</span>
                </li>
            @endforeach
        </ul>
    @endforeach
</div>
