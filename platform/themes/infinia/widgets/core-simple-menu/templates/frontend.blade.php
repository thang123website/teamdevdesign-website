@php
    $colClass = 'col-lg-3';
    if ($config['name'] == 'TeamDevDesign' || $config['name'] == 'Menu TeamDevDesign' || str_contains($config['name'], 'Team')) {
        $colClass = 'col-lg-2';
    }
@endphp
<div class="{{ $colClass }} col-md-6 col-12 mb-4 mb-lg-0">
    <h3 class="text-white opacity-50 fs-6 fw-black pb-3 pt-5">{{ $config['name'] }}</h3>
    <div class="d-flex flex-column align-items-start">
        @foreach($items as $item)
            @if (($label = $item->label) && ($url = $item->url))
                <a href="{{ url($url) }}" class="hover-effect text-white mb-2 fw-medium fs-6" {!! $item->attributes ? BaseHelper::clean($item->attributes) : null !!}>
                    {!! BaseHelper::clean($label) !!}
                </a>
            @endif
        @endforeach
    </div>
</div>
