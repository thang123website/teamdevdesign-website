@php
    $colClass = 'col-lg-3';
    if (!empty($config['show_logo']) || !empty($config['about'])) {
        $colClass = 'col-lg-4';
    }
@endphp
<div class="{{ $colClass }} col-md-6 col-12 mb-4 mb-lg-0 pe-lg-10">
    @if ($config['show_logo'])
        <a href="{{ BaseHelper::getHomepageUrl() }}">
            {{ Theme::getLogoImage(['class' => 'logo-dark'], 'logo', $config['logo_height'] ?: 35, Arr::get($config, 'logo')) }}
            {{ Theme::getLogoImage(['class' => 'logo-white'], 'logo_dark', $config['logo_height'] ?: 35, Arr::get($config, 'logo_dark')) }}
        </a>
    @endif
    @if($config['about'])
        <p class="text-white fw-medium mt-3 mb-6 opacity-50">{!! BaseHelper::clean(nl2br($config['about'])) !!}</p>
    @endif
    @if(($socials = Theme::getSocialLinks()) && $config['show_social_links'])
        <div class="d-flex social-icons">
            @foreach($socials as $social)
                @continue(! $social->getUrl() || ! $social->getIconHtml())
                <a {!! $social->getAttributes(['class' => 'text-white border border-light border-opacity-10 icon-shape icon-md ' . (! $loop->last ? 'border-end-0' : '')]) !!}>
                    {{ $social->getIconHtml() }}
                </a>
            @endforeach
        </div>
    @endif
</div>
