<?php

/**
 * Tăng cường nội dung bài viết blog (TeamDevDesign).
 *
 * - FAQ: tự động chuyển khối "Câu hỏi thường gặp" thành accordion giống trang dịch vụ.
 *   Nhận diện:
 *     1) <div class="faq-accordion"> <h3>Câu hỏi</h3> <p>Trả lời</p> ... </div>
 *     2) Hoặc H2 chứa "Câu hỏi thường gặp" / "FAQ" → các cặp H3 + đoạn trả lời phía sau
 *        (đến <hr> hoặc H2 kế tiếp).
 * - Bảng: bọc <table> trong .table-responsive để cuộn ngang trên mobile.
 * - Trả về danh sách FAQ để in schema FAQPage (JSON-LD).
 *
 * Nội dung đầu vào PHẢI là HTML đã qua BaseHelper::clean().
 */

if (! function_exists('infinia_render_post_content')) {
    function infinia_render_post_content(?string $html): array
    {
        $html = (string) $html;
        $faqs = [];

        $buildAccordion = function (string $inner) use (&$faqs): ?string {
            $parts = preg_split('/(<h3\b[^>]*>.*?<\/h3>)/isu', $inner, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
            if (! $parts) {
                return null;
            }

            $intro = '';
            $items = [];
            $current = null;

            foreach ($parts as $part) {
                if (preg_match('/^<h3\b[^>]*>(.*?)<\/h3>$/isu', trim($part), $m)) {
                    if ($current) {
                        $items[] = $current;
                    }
                    $question = trim(html_entity_decode(strip_tags($m[1]), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
                    $current = ['q' => $question, 'a' => ''];
                } elseif ($current) {
                    $current['a'] .= $part;
                } else {
                    $intro .= $part;
                }
            }

            if ($current) {
                $items[] = $current;
            }

            $items = array_values(array_filter($items, fn ($i) => $i['q'] !== '' && trim(strip_tags($i['a'])) !== ''));

            if (! $items) {
                return null;
            }

            $id = 'post-faq-' . substr(md5($inner), 0, 8);
            $arrow = '<svg xmlns="http://www.w3.org/2000/svg" width="13" height="8" viewBox="0 0 13 8" fill="none"><path class="stroke-dark" d="M11.5 1L6.25 6.5L1 1" stroke="#111827" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>';

            $out = trim($intro) . '<div class="accordion post-faq-accordion mb-4" id="' . $id . '">';

            foreach ($items as $index => $item) {
                $n = $index + 1;
                $first = $index === 0;
                $out .= '<div class="px-0 card p-3 border-0 border-bottom bg-transparent rounded-0">'
                    . '<div class="px-0 card-header border-0 bg-gradient-1">'
                    . '<a class="' . ($first ? '' : 'collapsed ') . 'text-900 fw-bold d-flex align-items-center" data-bs-toggle="collapse" href="#' . $id . '-' . $n . '" role="button" aria-expanded="' . ($first ? 'true' : 'false') . '" aria-controls="' . $id . '-' . $n . '">'
                    . '<span class="icon-shape icon-xs fs-7 rounded-circle d-none d-md-flex me-3 bg-primary text-white flex-shrink-0">' . $n . '</span>'
                    . '<strong class="d-block fs-6 m-0">' . e($item['q']) . '</strong>'
                    . '<span class="ms-auto arrow me-2 ps-3">' . $arrow . '</span>'
                    . '</a></div>'
                    . '<div id="' . $id . '-' . $n . '" class="collapse' . ($first ? ' show' : '') . '" data-bs-parent="#' . $id . '">'
                    . '<div class="px-0 card-body fs-6 text-600">' . trim($item['a']) . '</div>'
                    . '</div></div>';

                $faqs[] = [
                    'question' => $item['q'],
                    'answer' => trim(preg_replace('/\s+/u', ' ', html_entity_decode(strip_tags($item['a']), ENT_QUOTES | ENT_HTML5, 'UTF-8'))),
                ];
            }

            return $out . '</div>';
        };

        // 1) Khối đánh dấu tường minh <div class="faq-accordion">…</div>
        $html = preg_replace_callback(
            '/<div\b[^>]*class="[^"]*\bfaq-accordion\b[^"]*"[^>]*>(.*?)<\/div>/isu',
            fn ($m) => $buildAccordion($m[1]) ?? $m[0],
            $html
        );

        // 2) Tự nhận diện H2 "Câu hỏi thường gặp" / "FAQ"
        if (! $faqs) {
            $html = preg_replace_callback(
                '/(<h2\b[^>]*>(?:(?!<\/h2>).)*?(?:Câu hỏi thường gặp|\bFAQs?\b)(?:(?!<\/h2>).)*?<\/h2>)(.*?)(?=<hr\b[^>]*>|<h2\b|$)/isu',
                fn ($m) => ($acc = $buildAccordion($m[2])) ? $m[1] . $acc : $m[0],
                $html,
                1
            );
        }

        // 3) Bảng responsive
        $html = preg_replace('/(<table\b[^>]*>.*?<\/table>)/isu', '<div class="table-responsive post-table-wrap">$1</div>', $html);

        return ['html' => $html, 'faqs' => $faqs];
    }
}

if (! function_exists('infinia_post_faq_schema')) {
    function infinia_post_faq_schema(array $faqs): string
    {
        if (! $faqs) {
            return '';
        }

        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => array_map(fn ($faq) => [
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['answer']],
            ], $faqs),
        ];

        return '<script type="application/ld+json">'
            . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG)
            . '</script>';
    }
}
