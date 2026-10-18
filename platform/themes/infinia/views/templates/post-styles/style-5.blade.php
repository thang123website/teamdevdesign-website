@php
    $postsChunk = $posts->chunk(4);
@endphp

<section class="shortcode-blog-posts shortcode-blog-posts-style-5 section-blog-1 section-padding position-relative border-top border-bottom"
    @style($variablesStyle)
>
    <div class="container position-relative z-2">
        <div class="row align-items-end">
            <div class="col-lg-7 me-auto">
                @if ($subtitle = $shortcode->subtitle)
                    <div class="d-flex align-items-center justify-content-center bg-primary-soft border border-2 border-white d-inline-flex rounded-pill px-4 py-2" data-aos="zoom-in" data-aos-delay="50">
                        <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                        <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
                    </div>
                @endif

                @if ($title = $shortcode->title)
                    <h3 class="ds-3 mt-3 mb-3">{!! BaseHelper::clean($title) !!}</h3>
                @endif

                @if ($description = $shortcode->description)
                    <span class="fs-5 fw-medium text-900">{!! BaseHelper::clean($description) !!}</span>
                @endif
            </div>

            @if (($actionLabel = $shortcode->action_label) && ($actionUrl = $shortcode->action_url))
                <div class="col-lg-auto">
                    <a href="{{ $actionUrl }}" class="fw-bold text-primary btn bg-white hover-up shadow-2 mt-lg-0 mt-5 ms-lg-auto">{!! BaseHelper::clean($actionLabel) !!}
                        <svg class="ms-2" xmlns="http://www.w3.org/2000/svg" width="24" height="14" viewBox="0 0 24 14" fill="none">
                            <path class="fill-dark" d="M17.4177 0.417969L16.3487 1.48705L21.1059 6.24429H0V7.75621H21.1059L16.3487 12.5134L17.4177 13.5825L24 7.0002L17.4177 0.417969Z" fill="black" />
                        </svg>
                    </a>
                </div>
            @endif
        </div>

        @foreach($postsChunk as $posts)
            <div class="row mt-8 align-items-center">
                @php
                    $firstPost = $posts->first();
                @endphp
                <div class="col-lg-7">
                    <div class="card-team position-relative d-flex flex-lg-row flex-column align-items-center rounded-3 border  card-hover shadow-2 mb-lg-0 mb-8">

                        {{ RvMedia::image($firstPost->image, $firstPost->name, 'vertical_thumb', attributes: ['class' => 'rounded rounded-bottom-0 rounded-start-lg rounded-end-lg-0 w-100 w-lg-auto']) }}
                        <div class="bg-white align-self-stretch rounded rounded-start-lg-0 p-5">
                            @if ($category = $firstPost->firstCategory)
                                <a href="{{ $category->url }}" class="z-1 position-relative bg-primary-soft border border-2 border-white d-inline-flex rounded-pill px-3 py-1 mb-2">
                                    <span class="tag-spacing fs-7 fw-bold text-linear-2">{{ $category->name }}</span>
                                </a>
                            @endif

                            <strong class="d-block fs-6 mb-3">{{ $firstPost->name }}</strong>

                            @if ($firstPostDescription = $firstPost->description)
                                <p class="truncate-3-custom">{!! BaseHelper::clean($firstPostDescription) !!}</p>
                            @endif
                            <div class="d-flex align-items-center justify-content-between mt-5 pt-5 border-top">
                                @if ($author = $firstPost->author)
                                    <div class="d-flex align-items-center position-relative z-1">
                                        <div class="icon-shape rounded-circle border border-2 border-white">
                                            {{ RvMedia::image($author->avatar_url, $author->name, attributes: ['class' => 'rounded-circle', 'width' => 40]) }}
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="fs-7 m-0 mb-1">{{ $author->name }}</h6>
                                            <p class="mb-0 fs-8">{{ $firstPost->created_at->format('d F Y') }}</p>
                                        </div>
                                        <a href="{{ $firstPost->url }}" title="{{ $firstPost->name }}" class="position-absolute bottom-0 start-0 end-0 top-0 z-0"></a>
                                    </div>
                                @endif

                                <div class="arrow-icon icon-shape icon-md bg-white rounded-circle border">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                        <path d="M17.25 15.5322V7.03223H8.75" stroke="#6D4DF2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M17 7.28223L6.75 17.5322" stroke="#6D4DF2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                            <a href="{{ $firstPost->url }}" title="{{ $firstPost->name }}" class="position-absolute bottom-0 start-0 end-0 top-0 z-0"></a>
                        </div>
                    </div>
                </div>
                @if ($posts->count() > 1)
                    <div class="col-lg-5">
                        <div>
                            @foreach($posts->skip(1) as $post)
                                <a href="{{ $post->url }}" @class(['d-flex flex-column flex-md-row align-items-center hover-up', 'mt-7' => ! $loop->first])>
                                    {{ RvMedia::image($post->image, $post->name, 'thumb', attributes: ['class' => 'rounded-3 w-100 w-md-auto']) }}
                                    <div class="content ms-5 mt-4 mt-md-0">
                                        <h6 class="mb-2">{{ $post->name }}</h6>

                                        @if ($postDescription = $post->description)
                                            <p class="mb-0 truncate-3-custom">{!! BaseHelper::clean($postDescription) !!}</p>
                                        @endif
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        @endforeach

    </div>
    <div class="bouncing-blobs-container">
        <div class="bouncing-blobs-glass"></div>
        <div class="bouncing-blobs">
            <div class="bouncing-blob bouncing-blob--infor bouncing-blob--infor-2"></div>
        </div>
    </div>
</section>
