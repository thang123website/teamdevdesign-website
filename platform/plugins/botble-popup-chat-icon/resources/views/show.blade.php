<style>
    #button-contact-vr {
        --chat-btn-bottom:
            {{ (int) theme_option('chat_btn_bottom', 20) }}
        ;
        --chat-btn-right:
            {{ (int) theme_option('chat_btn_right', 20) }}
        ;
        --chat-primary-color:
            {{ theme_option('primary_color', '#131212ff') }}
        ;
    }
</style>
<div id="button-contact-vr">
    <div id="gom-all-in-one">
        @php
            $chatButtons = theme_option('chat_btn_repeater');
            $chatButtons = json_decode($chatButtons, true) ?: [];
        @endphp

        @foreach($chatButtons as $button)
            @php
                $buttonData = collect($button)->pluck('value', 'key');
                $link = $buttonData->get('link');
                $image = $buttonData->get('image');
                $name = $buttonData->get('name');
                $color = $buttonData->get('color') ?: '#ffffff';
            @endphp
            @if($link)
                <div class="button-contact">
                    <a target="_blank" href="{{ $link }}" title="{{ $name }}">
                        <div class="phone-vr">
                            <div class="phone-vr-circle-fill"></div>
                            <div class="phone-vr-img-circle" style="background-color: {{ $color }} !important;">
                                @if($image)
                                    <img src="{{ RvMedia::getImageUrl($image) }}" alt="{{ $name }}">
                                @else
                                    <span class="text-white">{{ $name }}</span>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
            @endif
        @endforeach

        @if ($hotline = theme_option('hotline'))
            <div id="phone-vr" class="button-contact">
                <a href="tel:{{ $hotline }}">
                    <div class="phone-vr">
                        <div class="phone-vr-circle-fill"></div>
                        <div class="phone-vr-img-circle" style="background-color: #0084ff !important;">
                            <img data-bb-lazy="true" width="200" height="200" loading="lazy"
                                src="/vendor/core/plugins/popup-chat/images/phone.png" alt="{{$hotline}}">
                        </div>
                    </div>
                </a>
            </div>
            <div class="phone-bar phone-bar-n">
                <a href="tel:{{ $hotline }}">
                    <span class="text-phone">{{$hotline}}</span>
                </a>
            </div>
        @endif

    </div>
</div>