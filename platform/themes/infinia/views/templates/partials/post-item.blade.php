@php
    $cardWrapperClass = $cardWrapperClass ?? 'card-body p-0 bg-white';
@endphp

<div class="card border-0 rounded-3 mt-8 position-relative d-inline-flex" data-aos="fade-zoom-in" data-aos-delay="{{ $loop->iteration }}00">
    {{ RvMedia::image($post->image, $post->name, 'horizontal_thumb', attributes: ['class' => 'rounded-3 w-100 object-fit-cover']) }}
    <div @class([$cardWrapperClass])>
        @if($post->firstCategory)
            <a href="{{ $post->firstCategory->url }}" class="bg-primary-soft position-relative z-1 d-inline-flex rounded-pill px-3 py-2 mt-3">
                <span class="tag-spacing fs-7 fw-bold text-linear-2">{{ $post->firstCategory->name }}</span>
            </a>
        @endif

        <strong class="d-block fs-6 my-3">{!! BaseHelper::clean($post->name) !!}</strong>
        <p>{!! Str::limit(BaseHelper::clean($post->description)) !!}</p>
    </div>
    <a href="{{ $post->url }}" title="{{ $post->name }}" class="position-absolute bottom-0 start-0 end-0 top-0 z-0"></a>
    <div class="clearfix"></div>
</div>
