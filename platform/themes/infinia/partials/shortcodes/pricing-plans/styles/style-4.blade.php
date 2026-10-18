@php
    /*
     * ====== CẤU HÌNH BẢNG GIÁ (sửa giá / tính năng tại đây) ======
     * price: số hiển thị | unit: hậu tố | popular: gói nổi bật
     */
    $contactUrl = '/lien-he';
    $techTabs = [
        'wordpress' => [
            'label' => 'WordPress',
            'icon' => 'bi-wordpress',
            'desc' => 'Nhanh, dễ quản trị, tối ưu SEO – lý tưởng cho website giới thiệu, tin tức và bán hàng.',
            'plans' => [
                [
                    'name' => 'Khởi Đầu',
                    'tagline' => 'Cho cá nhân, startup cần website giới thiệu chuyên nghiệp.',
                    'price' => '5.000.000',
                    'from' => true,
                    'unit' => 'đ',
                    'cta' => 'Yêu Cầu Tư Vấn',
                    'features' => [
                        'Website giới thiệu (tối đa 5 trang)',
                        'Thiết kế theo mẫu giao diện có sẵn',
                        'Responsive mọi thiết bị',
                        'Tối ưu SEO cơ bản',
                        'Trang quản trị dễ sử dụng',
                        'Bàn giao source code',
                    ],
                ],
                [
                    'name' => 'Doanh Nghiệp',
                    'tagline' => 'Website công ty đầy đủ, thiết kế riêng theo thương hiệu.',
                    'price' => '12.000.000',
                    'from' => true,
                    'unit' => 'đ',
                    'popular' => true,
                    'cta' => 'Liên Hệ Báo Giá',
                    'features' => [
                        'Mọi tính năng của gói Khởi Đầu',
                        'Thiết kế UI/UX riêng 100%',
                        'Không giới hạn trang & bài viết',
                        'Chuẩn SEO onpage + tốc độ tải nhanh',
                        'Tích hợp form, chat, Google Analytics',
                        'Bảo hành & hỗ trợ 12 tháng',
                    ],
                ],
                [
                    'name' => 'Thương Mại Điện Tử',
                    'tagline' => 'Bán hàng online với WooCommerce đầy đủ tính năng.',
                    'price' => '25.000.000',
                    'from' => true,
                    'unit' => 'đ',
                    'cta' => 'Yêu Cầu Tư Vấn',
                    'features' => [
                        'Mọi tính năng của gói Doanh Nghiệp',
                        'Giỏ hàng & quản lý đơn hàng',
                        'Thanh toán online & vận chuyển',
                        'Quản lý sản phẩm, tồn kho',
                        'Mã giảm giá, khuyến mãi',
                        'Bảo mật nhiều lớp giao dịch',
                    ],
                ],
            ],
        ],
        'laravel' => [
            'label' => 'Laravel',
            'icon' => 'bi-braces',
            'desc' => 'Hệ thống web app, CRM, quản trị nội bộ, bất động sản – tùy biến sâu, bảo mật cao.',
            'plans' => [
                [
                    'name' => 'Cơ Bản',
                    'tagline' => 'Web app nhỏ, quản trị dữ liệu và quy trình đơn giản.',
                    'price' => '40.000.000',
                    'unit' => 'đ',
                    'cta' => 'Yêu Cầu Tư Vấn',
                    'features' => [
                        'Phân tích & thiết kế chức năng',
                        'Quản trị người dùng, phân quyền',
                        'Dashboard thống kê cơ bản',
                        'Responsive, bảo mật chuẩn',
                        'Bàn giao source + tài liệu',
                    ],
                ],
                [
                    'name' => 'Chuyên Nghiệp',
                    'tagline' => 'Hệ thống nghiệp vụ hoàn chỉnh, tích hợp bên thứ ba.',
                    'price' => '70.000.000',
                    'unit' => 'đ',
                    'popular' => true,
                    'cta' => 'Liên Hệ Báo Giá',
                    'features' => [
                        'Mọi tính năng của gói Cơ Bản',
                        'API & tích hợp thanh toán, SMS, Email',
                        'Báo cáo, xuất Excel/PDF',
                        'Tối ưu hiệu năng, cache, queue',
                        'Kiểm thử & triển khai server',
                        'Bảo hành & bảo trì 12 tháng',
                    ],
                ],
                [
                    'name' => 'Enterprise',
                    'tagline' => 'Giải pháp quy mô lớn, thiết kế kiến trúc riêng.',
                    'price' => 'Liên hệ',
                    'unit' => '',
                    'cta' => 'Nhận Báo Giá',
                    'features' => [
                        'Mọi tính năng của gói Chuyên Nghiệp',
                        'Kiến trúc microservice / đa chi nhánh',
                        'Tích hợp ERP, CRM, hệ thống sẵn có',
                        'Bảo mật nâng cao, audit log',
                        'Đội ngũ hỗ trợ riêng 24/7',
                    ],
                ],
            ],
        ],
        'nextjs' => [
            'label' => 'Next.js',
            'icon' => 'bi-lightning-charge-fill',
            'desc' => 'Tốc độ cực nhanh, SEO mạnh, trải nghiệm mượt như app – cho landing page, SaaS, web hiện đại.',
            'plans' => [
                [
                    'name' => 'Landing Page',
                    'tagline' => 'Trang đích hiệu ứng mượt, tối ưu chuyển đổi.',
                    'price' => '30.000.000',
                    'unit' => 'đ',
                    'cta' => 'Yêu Cầu Tư Vấn',
                    'features' => [
                        'Thiết kế UI/UX riêng, animation mượt',
                        'Điểm Lighthouse 90+',
                        'Chuẩn SEO, SSR/SSG',
                        'Form liên hệ & tracking',
                        'Triển khai Vercel/VPS',
                    ],
                ],
                [
                    'name' => 'Business',
                    'tagline' => 'Website doanh nghiệp tốc độ cao có CMS quản trị.',
                    'price' => '55.000.000',
                    'unit' => 'đ',
                    'popular' => true,
                    'cta' => 'Liên Hệ Báo Giá',
                    'features' => [
                        'Mọi tính năng của gói Landing Page',
                        'Headless CMS dễ quản trị nội dung',
                        'Đa ngôn ngữ, blog, sản phẩm',
                        'Tích hợp API, CRM, thanh toán',
                        'PWA, tối ưu Core Web Vitals',
                        'Bảo hành & hỗ trợ 12 tháng',
                    ],
                ],
                [
                    'name' => 'Premium / SaaS',
                    'tagline' => 'Nền tảng web app, dashboard, hệ thống đăng ký thuê bao.',
                    'price' => 'Liên hệ',
                    'unit' => '',
                    'cta' => 'Nhận Báo Giá',
                    'features' => [
                        'Mọi tính năng của gói Business',
                        'Xác thực, phân quyền, subscription',
                        'Dashboard realtime',
                        'Kiến trúc mở rộng, CI/CD',
                        'Đội ngũ hỗ trợ riêng',
                    ],
                ],
            ],
        ],
    ];
    /*
     * ====== DỮ LIỆU TỪ ADMIN (Portfolio > Packages) ======
     * Đặt tên gói dạng "WordPress | Khởi Đầu" -> tab "WordPress", gói "Khởi Đầu".
     * Nếu không có gói nào chứa dấu "|" thì dùng dữ liệu mẫu ở trên.
     */
    $tabDescriptions = [
        'wordpress' => $techTabs['wordpress']['desc'],
        'laravel' => $techTabs['laravel']['desc'],
        'next.js' => $techTabs['nextjs']['desc'],
        'nextjs' => $techTabs['nextjs']['desc'],
    ];
    $dynamicTabs = [];
    foreach ($packages->sortBy('id') as $package) {
        if (! str_contains($package->name, '|')) {
            continue;
        }
        [$tabLabel, $planName] = array_map('trim', explode('|', $package->name, 2));
        $tabKey = \Illuminate\Support\Str::slug($tabLabel) ?: 'tab';
        $digits = preg_replace('/\D/', '', (string) $package->price);
        $isContact = $digits === '' || (int) $digits === 0;
        $dynamicTabs[$tabKey]['label'] = $tabLabel;
        $dynamicTabs[$tabKey]['desc'] = $tabDescriptions[mb_strtolower($tabLabel)] ?? '';
        $dynamicTabs[$tabKey]['plans'][] = [
            'name' => $planName,
            'tagline' => trim(strip_tags((string) $package->description)),
            'price' => $isContact ? 'Liên hệ' : number_format((int) $digits, 0, ',', '.'),
            'from' => ! $isContact,
            'unit' => $isContact ? '' : 'đ',
            'popular' => (bool) $package->is_popular,
            'cta' => $package->action_label ?: ($package->is_popular ? 'Liên Hệ Báo Giá' : 'Yêu Cầu Tư Vấn'),
            'url' => $package->action_url ?: $contactUrl,
            'features' => collect($package->feature_list)
                ->filter(fn ($f) => ! empty($f['is_available']))
                ->pluck('value')
                ->all(),
        ];
    }
    if ($dynamicTabs) {
        $techTabs = $dynamicTabs;
    }
    $firstTab = reset($techTabs);
    $uid = 'tdd-price-' . uniqid();
@endphp

<section {!! $shortcode->htmlAttributes() !!} id="{{ $uid }}" class="tdd-pricing section-padding position-relative fix">
    <style>
        #{{ $uid }}{--c1:#15B8C5;--c2:#B42D63;--c3:#F4B234;background:#0a0d1a;color:#c9cfe0;overflow:hidden}
        #{{ $uid }}:before,#{{ $uid }}:after{content:"";position:absolute;width:520px;height:520px;border-radius:50%;filter:blur(120px);opacity:.28;pointer-events:none}
        #{{ $uid }}:before{background:var(--c1);top:-160px;left:-120px}
        #{{ $uid }}:after{background:var(--c2);bottom:-180px;right:-120px}
        #{{ $uid }} .tdd-head{text-align:center;margin-bottom:36px;position:relative;z-index:2}
        #{{ $uid }} .tdd-badge{display:inline-block;padding:6px 16px;border-radius:50px;font-size:13px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:var(--c1);background:rgba(21,184,197,.1);border:1px solid rgba(21,184,197,.35)}
        #{{ $uid }} .tdd-title{color:#fff;font-weight:800;margin:16px 0 12px;font-size:clamp(28px,4vw,46px)}
        #{{ $uid }} .tdd-title span{background:linear-gradient(90deg,var(--c1),var(--c3),var(--c2));-webkit-background-clip:text;background-clip:text;color:transparent}
        #{{ $uid }} .tdd-desc{max-width:760px;margin:0 auto;color:#9aa3bd;font-size:17px}
        #{{ $uid }} .tdd-tabs{display:flex;justify-content:center;gap:6px;flex-wrap:wrap;padding:6px;margin:30px auto 0;width:fit-content;max-width:100%;border-radius:60px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);backdrop-filter:blur(10px)}
        #{{ $uid }} .tdd-tab{border:0;background:transparent;color:#aab2c8;font-weight:700;font-size:15px;padding:11px 24px;border-radius:50px;cursor:pointer;display:flex;align-items:center;gap:8px;transition:.3s}
        #{{ $uid }} .tdd-tab:hover{color:#fff}
        #{{ $uid }} .tdd-tab.active{color:#fff;background:linear-gradient(135deg,var(--c1),var(--c2));box-shadow:0 6px 22px rgba(180,45,99,.4)}
        #{{ $uid }} .tdd-tdesc{text-align:center;color:#8d96b2;margin:18px auto 0;max-width:640px;min-height:48px;font-size:15px}
        #{{ $uid }} .tdd-panel{display:none;position:relative;z-index:2}
        #{{ $uid }} .tdd-panel.active{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;align-items:stretch;margin-top:44px;animation:tddIn .5s ease}
        @keyframes tddIn{from{opacity:0;transform:translateY(18px)}to{opacity:1;transform:none}}
        #{{ $uid }} .tdd-card{position:relative;display:flex;flex-direction:column;padding:32px 28px;border-radius:22px;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.09);backdrop-filter:blur(12px);transition:transform .35s,border-color .35s,box-shadow .35s}
        #{{ $uid }} .tdd-card:hover{transform:translateY(-8px);border-color:rgba(21,184,197,.5);box-shadow:0 22px 50px rgba(0,0,0,.45)}
        #{{ $uid }} .tdd-card.popular{background:linear-gradient(160deg,rgba(180,45,99,.28),rgba(21,184,197,.14));border:1px solid transparent;background-clip:padding-box;transform:scale(1.04);box-shadow:0 0 0 1.5px var(--c2),0 25px 60px rgba(180,45,99,.35)}
        #{{ $uid }} .tdd-card.popular:hover{transform:scale(1.04) translateY(-8px)}
        #{{ $uid }} .tdd-pop{position:absolute;top:-14px;left:50%;transform:translateX(-50%);white-space:nowrap;padding:5px 16px;border-radius:50px;font-size:12px;font-weight:800;color:#1a1200;background:linear-gradient(90deg,var(--c3),#ffd27a)}
        #{{ $uid }} .tdd-name{color:#fff;font-size:20px;font-weight:800;margin:0 0 6px}
        #{{ $uid }} .tdd-tag{font-size:14px;color:#98a1bb;min-height:42px;margin:0 0 14px}
        #{{ $uid }} .tdd-price{display:flex;align-items:baseline;gap:4px;color:#fff;margin-bottom:20px}
        #{{ $uid }} .tdd-price b{font-size:clamp(28px,3vw,38px);font-weight:800;background:linear-gradient(90deg,#fff,var(--c1));-webkit-background-clip:text;background-clip:text;color:transparent}
        #{{ $uid }} .tdd-card.popular .tdd-price b{background:linear-gradient(90deg,#fff,var(--c3));-webkit-background-clip:text;background-clip:text}
        #{{ $uid }} .tdd-price em{font-style:normal;font-size:15px;color:#aab2c8;font-weight:600;margin-right:4px}
        #{{ $uid }} .tdd-price small{font-size:18px;color:#aab2c8;font-weight:700}
        #{{ $uid }} .tdd-btn{display:flex;justify-content:space-between;align-items:center;padding:13px 20px;border-radius:12px;font-weight:700;text-decoration:none;color:#fff;border:1px solid rgba(255,255,255,.25);transition:.3s;margin-bottom:22px}
        #{{ $uid }} .tdd-btn:hover{background:var(--c1);border-color:var(--c1);color:#06141a}
        #{{ $uid }} .tdd-btn svg{transition:transform .3s}
        #{{ $uid }} .tdd-btn:hover svg{transform:translateX(5px)}
        #{{ $uid }} .tdd-card.popular .tdd-btn{background:linear-gradient(135deg,var(--c2),#d13b78);border-color:transparent;box-shadow:0 8px 24px rgba(180,45,99,.45)}
        #{{ $uid }} .tdd-card.popular .tdd-btn:hover{filter:brightness(1.12);color:#fff}
        #{{ $uid }} .tdd-list{list-style:none;margin:0;padding:22px 0 0;border-top:1px solid rgba(255,255,255,.09)}
        #{{ $uid }} .tdd-list li{display:flex;gap:10px;margin-bottom:13px;font-size:15px;color:#d5daea;line-height:1.45}
        #{{ $uid }} .tdd-list li:before{content:"";flex:0 0 18px;height:18px;margin-top:2px;border-radius:50%;background:var(--c1) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cpath fill='none' stroke='%23071016' stroke-width='2.4' stroke-linecap='round' stroke-linejoin='round' d='M4 8.5l2.5 2.5L12 5.5'/%3E%3C/svg%3E") center/12px no-repeat}
        #{{ $uid }} .tdd-card.popular .tdd-list li:before{background-color:var(--c3)}
        #{{ $uid }} .tdd-note{text-align:center;color:#7f88a5;font-size:14px;margin-top:34px;position:relative;z-index:2}
        @media(max-width:991px){
            #{{ $uid }} .tdd-panel.active{grid-template-columns:1fr;max-width:480px;margin-left:auto;margin-right:auto;gap:30px}
            #{{ $uid }} .tdd-card.popular,#{{ $uid }} .tdd-card.popular:hover{transform:none}
            #{{ $uid }} .tdd-tag{min-height:0}
        }
        @media(max-width:575px){
            #{{ $uid }} .tdd-tabs{width:100%;border-radius:20px}
            #{{ $uid }} .tdd-tab{flex:1;justify-content:center;padding:10px 8px;font-size:14px}
        }
        @media(prefers-reduced-motion:reduce){#{{ $uid }} *{animation:none!important;transition:none!important}}

        /* ===== LIGHT MODE (theo nút đổi giao diện của site) ===== */
        html:not([data-bs-theme="dark"]) #{{ $uid }}{background:linear-gradient(180deg,#f7f9fd,#eef2f9);color:#4b5568}
        html:not([data-bs-theme="dark"]) #{{ $uid }}:before,html:not([data-bs-theme="dark"]) #{{ $uid }}:after{opacity:.16}
        html:not([data-bs-theme="dark"]) #{{ $uid }} .tdd-badge{background:rgba(21,184,197,.12);color:#0e8f9a;border-color:rgba(21,184,197,.4)}
        html:not([data-bs-theme="dark"]) #{{ $uid }} .tdd-title{color:#111827}
        html:not([data-bs-theme="dark"]) #{{ $uid }} .tdd-desc,html:not([data-bs-theme="dark"]) #{{ $uid }} .tdd-tdesc{color:#5b6478}
        html:not([data-bs-theme="dark"]) #{{ $uid }} .tdd-tabs{background:#fff;border-color:rgba(17,24,39,.1);box-shadow:0 6px 24px rgba(17,24,39,.06)}
        html:not([data-bs-theme="dark"]) #{{ $uid }} .tdd-tab{color:#5b6478}
        html:not([data-bs-theme="dark"]) #{{ $uid }} .tdd-tab:hover{color:#111827}
        html:not([data-bs-theme="dark"]) #{{ $uid }} .tdd-tab.active{color:#fff}
        html:not([data-bs-theme="dark"]) #{{ $uid }} .tdd-card{background:#fff;border-color:rgba(17,24,39,.09);box-shadow:0 10px 30px rgba(17,24,39,.06)}
        html:not([data-bs-theme="dark"]) #{{ $uid }} .tdd-card:hover{border-color:rgba(21,184,197,.55);box-shadow:0 22px 50px rgba(17,24,39,.14)}
        html:not([data-bs-theme="dark"]) #{{ $uid }} .tdd-name,html:not([data-bs-theme="dark"]) #{{ $uid }} .tdd-price{color:#111827}
        html:not([data-bs-theme="dark"]) #{{ $uid }} .tdd-tag{color:#6b7488}
        html:not([data-bs-theme="dark"]) #{{ $uid }} .tdd-price b{background:linear-gradient(90deg,#111827,#0e8f9a);-webkit-background-clip:text;background-clip:text}
        html:not([data-bs-theme="dark"]) #{{ $uid }} .tdd-price em,html:not([data-bs-theme="dark"]) #{{ $uid }} .tdd-price small{color:#6b7488}
        html:not([data-bs-theme="dark"]) #{{ $uid }} .tdd-btn{color:#111827;border-color:rgba(17,24,39,.22)}
        html:not([data-bs-theme="dark"]) #{{ $uid }} .tdd-btn:hover{color:#fff;background:var(--c1);border-color:var(--c1)}
        html:not([data-bs-theme="dark"]) #{{ $uid }} .tdd-list{border-top-color:rgba(17,24,39,.09)}
        html:not([data-bs-theme="dark"]) #{{ $uid }} .tdd-list li{color:#374151}
        html:not([data-bs-theme="dark"]) #{{ $uid }} .tdd-note{color:#7a8398}
        /* gói nổi bật: nền magenta, chữ trắng */
        html:not([data-bs-theme="dark"]) #{{ $uid }} .tdd-card.popular{background:linear-gradient(160deg,#c23372,#8e2250);box-shadow:0 0 0 1.5px #d6407f,0 25px 60px rgba(180,45,99,.35)}
        html:not([data-bs-theme="dark"]) #{{ $uid }} .tdd-card.popular .tdd-name,html:not([data-bs-theme="dark"]) #{{ $uid }} .tdd-card.popular .tdd-price,html:not([data-bs-theme="dark"]) #{{ $uid }} .tdd-card.popular .tdd-list li{color:#fff}
        html:not([data-bs-theme="dark"]) #{{ $uid }} .tdd-card.popular .tdd-tag,html:not([data-bs-theme="dark"]) #{{ $uid }} .tdd-card.popular .tdd-price em,html:not([data-bs-theme="dark"]) #{{ $uid }} .tdd-card.popular .tdd-price small{color:rgba(255,255,255,.8)}
        html:not([data-bs-theme="dark"]) #{{ $uid }} .tdd-card.popular .tdd-list{border-top-color:rgba(255,255,255,.22)}
        html:not([data-bs-theme="dark"]) #{{ $uid }} .tdd-card.popular .tdd-btn{background:#fff;color:#b42d63;box-shadow:0 8px 24px rgba(0,0,0,.2)}
        html:not([data-bs-theme="dark"]) #{{ $uid }} .tdd-card.popular .tdd-btn:hover{background:var(--c3);color:#1a1200;filter:none}
    </style>

    <div class="container position-relative">
        <div class="tdd-head">
            @if ($subtitle = $shortcode->subtitle)
                <span class="tdd-badge">{!! BaseHelper::clean($subtitle) !!}</span>
            @endif
            @if ($title = $shortcode->title)
                <{{ $titleTag = infinia_title_tag($shortcode, 'h2') }} class="tdd-title">{!! infinia_clean_title($title) !!}</{{ $titleTag }}>
            @endif
            @if ($description = $shortcode->description)
                <p class="tdd-desc">{!! BaseHelper::clean($description) !!}</p>
            @endif

            <div class="tdd-tabs" role="tablist">
                @foreach ($techTabs as $key => $tab)
                    <button type="button" role="tab" class="tdd-tab {{ $loop->first ? 'active' : '' }}" data-tab="{{ $key }}">
                        {{ $tab['label'] }}
                    </button>
                @endforeach
            </div>
            <p class="tdd-tdesc" data-desc>{{ $firstTab['desc'] }}</p>
        </div>

        @foreach ($techTabs as $key => $tab)
            <div class="tdd-panel {{ $loop->first ? 'active' : '' }}" data-panel="{{ $key }}" data-desc-text="{{ $tab['desc'] }}">
                @foreach ($tab['plans'] as $plan)
                    <div class="tdd-card {{ ! empty($plan['popular']) ? 'popular' : '' }}">
                        @if (! empty($plan['popular']))
                            <span class="tdd-pop">★ Được chọn nhiều nhất</span>
                        @endif
                        <h3 class="tdd-name">{{ $plan['name'] }}</h3>
                        <p class="tdd-tag">{{ $plan['tagline'] }}</p>
                        <div class="tdd-price">
                            @if (! empty($plan['from']))<em>Từ</em>@endif
                            <b>{{ $plan['price'] }}</b>
                            @if ($plan['unit'])<small>{{ $plan['unit'] }}</small>@endif
                        </div>
                        <a href="{{ $plan['url'] ?? $contactUrl }}" class="tdd-btn">
                            {{ $plan['cta'] }}
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path fill="currentColor" d="M17.42 5.42l-1.07 1.07 4.76 4.76H0v1.51h21.11l-4.76 4.76 1.07 1.07L24 12z"/></svg>
                        </a>
                        <ul class="tdd-list">
                            @foreach ($plan['features'] as $feature)
                                <li>{{ $feature }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        @endforeach

        <p class="tdd-note">* Giá tham khảo, chưa bao gồm VAT. Báo giá chính xác tùy theo yêu cầu thực tế của dự án.</p>
    </div>

    <script>
        (function () {
            var root = document.getElementById('{{ $uid }}');
            if (!root) return;
            var tabs = root.querySelectorAll('.tdd-tab'),
                panels = root.querySelectorAll('.tdd-panel'),
                desc = root.querySelector('[data-desc]');
            tabs.forEach(function (t) {
                t.addEventListener('click', function () {
                    tabs.forEach(function (x) { x.classList.toggle('active', x === t); });
                    panels.forEach(function (p) {
                        var on = p.getAttribute('data-panel') === t.getAttribute('data-tab');
                        p.classList.toggle('active', on);
                        if (on) desc.textContent = p.getAttribute('data-desc-text');
                    });
                });
            });
        })();
    </script>
</section>
