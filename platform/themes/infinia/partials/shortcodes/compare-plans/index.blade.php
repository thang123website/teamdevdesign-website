<section {!! $shortcode->htmlAttributes() !!}  class="shortcode-compare-features section-compare position-relative section-padding">
    <div class="container position-relative z-1">
        <div class="text-center mb-10">
            @if ($subtitle = $shortcode->subtitle)
                <div class="d-flex align-items-center position-relative z-2 justify-content-center bg-primary-soft d-inline-flex rounded-pill border border-2 border-white px-3 py-1">
                    <img src="{{ Theme::asset()->url('images/icons/dots.png') }}" alt="" aria-hidden="true">
                    <span class="tag-spacing fs-7 fw-bold text-linear-2 ms-2 text-primary">{!! BaseHelper::clean($subtitle) !!}</span>
                </div>
            @endif

            @if ($title = $shortcode->title)
                <{{ $titleTag = infinia_title_tag($shortcode, 'h3') }} class="ds-3 my-3 fw-black">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
            @endif

            @if ($description = $shortcode->description)
                <p class="fs-5 mb-0">{!! BaseHelper::clean($description) !!}</p>
            @endif
        </div>
        <div class="row">
            <div class="table-responsive wow img-custom-anim-top">
                <table class="table table-borderless align-middle table-white">
                    @if ($packages)
                        <thead>
                        <tr>
                            <th scope="col">
                            </th>
                            @foreach($packages as $package)
                                @continue(! $packageName = Arr::get($package, 'package_name'))
                                <th scope="col">
                                    <span class="h4">{!! BaseHelper::clean($packageName) !!}</span>

                                    @if ($packageDescription = Arr::get($package, 'package_description'))
                                        <p class="text-500 text-nowrap">{!! BaseHelper::clean($packageDescription) !!}</p>

                                    @endif
                                </th>
                            @endforeach
                        </tr>
                        </thead>
                    @endif

                    @if($tabs)
                        <tbody class="table-group-divider mt-5">
                            @foreach($tabs as $tab)
                                @php
                                    $criteria = Arr::get($tab, 'criteria');
                                @endphp

                                @continue(! $criteria)

                                <tr class="border-bottom">
                                    <th scope="row">
                                        <span class="h6 mt-2">{!! BaseHelper::clean($criteria) !!}</span>
                                        @if ($tabDescription = Arr::get($tab, 'description'))
                                            <p class="mb-2 text-500 text-nowrap">{!! BaseHelper::clean($tabDescription) !!}</p>
                                        @endif
                                    </th>

                                    @foreach(range(1, 3) as $i)
                                        @php
                                            $value = Arr::get($tab, "value_$i");
                                        @endphp

                                        <td @class(['text-start' => ! in_array($value, ['yes', 'no'])])>
                                            @if ($value === 'yes')
                                                <svg class="text-primary" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.004 1.38049C16.3188 1.38049 20.629 5.69071 20.629 11.0056C20.629 16.3204 16.3188 20.6306 11.004 20.6306C5.68913 20.6306 1.37891 16.3204 1.37891 11.0056C1.37891 5.69071 5.68913 1.38049 11.004 1.38049ZM9.0052 14.1318L6.64875 11.7734C6.24729 11.3717 6.24721 10.7167 6.64875 10.3151C7.05037 9.91354 7.70834 9.91605 8.10704 10.3151L9.76833 11.9777L13.901 7.84495C14.3027 7.44333 14.9578 7.44333 15.3593 7.84495C15.761 8.24649 15.7604 8.90218 15.3593 9.30324L10.4963 14.1663C10.0952 14.5673 9.43954 14.5679 9.038 14.1663C9.02672 14.155 9.01584 14.1435 9.0052 14.1318Z" fill="currentColor" />
                                                </svg>
                                            @elseif ($value === 'no')
                                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                                    <g clip-path="url(#clip0_592_34276)">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0 10.9999C0 4.92484 4.92484 0 10.9999 0C17.0751 0 21.9999 4.92484 21.9999 10.9999C21.9999 17.0751 17.0751 21.9999 10.9999 21.9999C4.92484 21.9999 0 17.0751 0 10.9999Z" fill="#E5E7EB" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.16487 14.0646C6.95068 14.2789 6.95071 14.6261 7.16493 14.8403C7.37916 15.0545 7.72645 15.0545 7.94064 14.8403L11.0042 11.7762L14.0679 14.84C14.2821 15.0542 14.6295 15.0542 14.8436 14.84C15.0578 14.6258 15.0578 14.2785 14.8436 14.0643L11.7798 11.0005L14.8434 7.93632C15.0576 7.7221 15.0576 7.37481 14.8433 7.16062C14.6291 6.94643 14.2818 6.94646 14.0676 7.16069L11.0041 10.2248L7.94026 7.16095C7.72606 6.94675 7.37876 6.94675 7.16456 7.16095C6.95035 7.37516 6.95035 7.72245 7.16456 7.93666L10.2285 11.0005L7.16487 14.0646Z" fill="#111827" />
                                                    </g>
                                                    <defs>
                                                        <clipPath>
                                                            <rect width="22" height="22" fill="white" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            @else
                                                <p class="text-500 fw-bold">{!! BaseHelper::clean($value) !!}</p>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    @endif
                </table>
            </div>
        </div>
        <div class="text-center mt-5">
            @if ($bottomDescription = $shortcode->bottom_description)
                <p class="fs-5 text-900 mb-5">{!! BaseHelper::clean($bottomDescription) !!}</p>
            @endif

            @php
                $primaryButtonLabel = $shortcode->primary_action_label;
                $primaryButtonUrl = $shortcode->primary_action_url;

                $secondaryButtonLabel = $shortcode->secondary_action_label;
                $secondaryButtonUrl = $shortcode->secondary_action_url;
            @endphp

            @if($primaryButtonLabel && $primaryButtonUrl)
                <a href="{{ $primaryButtonUrl }}" class="btn btn-gradient">
                    {!! BaseHelper::clean($primaryButtonLabel) !!}

                    @if($shortcode->primary_action_icon)
                        <x-core::icon class="ms-2" :name="$shortcode->primary_action_icon" />
                    @endif
                </a>
            @endif

            @if($secondaryButtonLabel && $secondaryButtonUrl)
                <a href="{{ $secondaryButtonUrl }}" class="ms-md-3 mt-md-0 mt-3 btn btn-outline-secondary hover-up">
                    @if($shortcode->secondary_action_icon)
                        <x-core::icon :name="$shortcode->secondary_action_icon" />
                    @endif

                    {!! BaseHelper::clean($secondaryButtonLabel) !!}
                </a>
            @endif
        </div>
    </div>
</section>
