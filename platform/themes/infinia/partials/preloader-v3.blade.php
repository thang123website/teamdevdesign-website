<style>
    #preloader {
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: #111827; /* Infinia dark theme background */
        z-index: 9999999;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .tdd-loader-text {
        font-family: 'Courier New', Courier, monospace;
        font-size: 2.5rem;
        font-weight: 900;
        white-space: nowrap;
        overflow: hidden;
        border-right: 4px solid #15B8C5; /* Cursor */
        width: 15ch;
        animation: tdd-typing 1.2s steps(15) forwards, tdd-blink 0.7s step-end infinite;
    }
    .tdd-color-prompt { color: #ffffff; opacity: 0.5; }
    .tdd-color-team { color: #15B8C5; } /* Cyan */
    .tdd-color-dev { color: #B42D63; } /* Magenta/Plum */
    .tdd-color-design { color: #F4B234; } /* Golden Yellow */

    @keyframes tdd-typing {
        0% { width: 0; }
        100% { width: 15ch; }
    }
    @keyframes tdd-blink {
        from, to { border-color: transparent; }
        50% { border-color: #15B8C5; }
    }
    @media (max-width: 768px) {
        .tdd-loader-text { font-size: 1.5rem; border-right-width: 2px;}
    }

    /* Hiệu năng: tự ẩn bằng CSS, không đợi JS tải xong (trước đây che màn hình tới khi ~25 file JS chạy xong => LCP 9s+) */
    #preloader { animation: tdd-preloader-out .25s ease .6s forwards; }
    @keyframes tdd-preloader-out { to { opacity: 0; visibility: hidden; pointer-events: none; } }
    @media (prefers-reduced-motion: reduce) { #preloader { display: none !important; } }
</style>

<div id="preloader">
    <div class="tdd-loader-text"><span class="tdd-color-prompt">> </span><span class="tdd-color-team">Team</span><span class="tdd-color-dev">Dev</span><span class="tdd-color-design">Design</span></div>
</div>
