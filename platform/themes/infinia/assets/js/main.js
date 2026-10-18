(function ($) {
    'use strict';
    /*=============================================
	=              Preloader       =
    =============================================*/
    function preloader() {
        $('#preloader').delay(0).fadeOut();
    }

    function isRTL() {
        return $('body').attr('dir') === 'rtl';
    }
    /*=============================================
    =     Offcanvas Menu      =
    =============================================*/
    function offcanvasMenu() {
        $('.menu-tigger').on('click', function () {
            $('.offCanvas__info, .offCanvas__overly').addClass('active');
            return false;
        });
        $('.menu-close, .offCanvas__overly').on('click', function () {
            $('.offCanvas__info, .offCanvas__overly').removeClass('active');
        });
    }
    /*=============================================
	=          Data Background      =
    =============================================*/
    function dataBackground() {
        $('[data-background]').each(function () {
            $(this).css('background-image', 'url(' + $(this).attr('data-background') + ')');
        });
    }
    /*=============================================
	=           Go to top       =
    =============================================*/
    function progressPageLoad() {
        var progressWrap = document.querySelector('.btn-scroll-top');
        if (progressWrap != null) {
            var progressPath = document.querySelector('.btn-scroll-top path');
            var pathLength = progressPath.getTotalLength();
            var offset = 50;
            progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
            progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
            progressPath.style.strokeDashoffset = pathLength;
            progressPath.getBoundingClientRect();
            progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';
            window.addEventListener('scroll', function (event) {
                var scroll = document.body.scrollTop || document.documentElement.scrollTop;
                var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                var progress = pathLength - (scroll * pathLength) / height;
                progressPath.style.strokeDashoffset = progress;
                var scrollElementPos = document.body.scrollTop || document.documentElement.scrollTop;
                if (scrollElementPos >= offset) {
                    progressWrap.classList.add('active-progress');
                } else {
                    progressWrap.classList.remove('active-progress');
                }
            });
            progressWrap.addEventListener('click', function (e) {
                e.preventDefault();
                window.scroll({
                    top: 0,
                    left: 0,
                    behavior: 'smooth',
                });
            });
        }
    }
    /*=============================================
	=           Aos Active       =
    =============================================*/
    function aosAnimation() {
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 1000,
                mirror: true,
                once: true,
                disable: 'mobile',
            });
        }
    }
    /*=============================================
	=           counterState       =
    =============================================*/
    function counterState() {
        var counters = document.querySelectorAll('.counter');
        counters.forEach(function (counter) {
            var countTo = counter.getAttribute('data-count');
            var countNum = parseInt(counter.textContent);
            var duration = 4000;
            var stepDuration = duration / Math.abs(countTo - countNum);
            var increment = countTo > countNum ? 1 : -1;
            var timer = setInterval(function () {
                countNum += increment;
                counter.textContent = countNum;
                if (countNum == countTo) {
                    clearInterval(timer);
                    //alert('finished');
                }
            }, stepDuration);
        });
    }
    /*=============================================
	=    		Magnific Popup		      =
    =============================================*/
    function magnificPopup() {
        $('.popup-image').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true,
            },
        });
        /* magnificPopup video view */
        $('.popup-video').magnificPopup({
            type: 'iframe',
        });
    }
    /*=============================================
	=    		 Wow Active  	         =
    =============================================*/
    function wowAnimation() {
        if (typeof WOW !== 'undefined') {
            var wow = new WOW({
                boxClass: 'wow',
                animateClass: 'animated',
                offset: 0,
                mobile: false,
                live: true,
            });
            wow.init();
        }
    }
    /*=============================================
	=           Masonary Active       =
    =============================================*/
    function masonryFillter() {
        $('.masonary-active').imagesLoaded(function () {
            var $filter = '.masonary-active',
                $filterItem = '.filter-item',
                $filterMenu = '.filter-menu-active';
            if ($($filter).length > 0) {
                var $grid = $($filter).isotope({
                    itemSelector: $filterItem,
                    filter: '*',
                    masonry: {
                        // use outer width of grid-sizer for columnWidth
                        // columnWidth: 1,
                        columnWidth: '.grid-sizer',
                    },
                });
                // filter items on button click
                $($filterMenu).on('click', 'button', function () {
                    var filterValue = $(this).attr('data-filter');
                    $grid.isotope({
                        filter: filterValue,
                    });
                });
                // Menu Active Class
                $($filterMenu).on('click', 'button', function (event) {
                    event.preventDefault();
                    $(this).addClass('active');
                    $(this).siblings('.active').removeClass('active');
                });
            }
        });
    }

    const initSwiperSlider = (element, options) => {
        const $element = $(element)

        if (! $element.length) {
            return
        }

        options = options || {}
        options.rtl = isRTL

        if ($element.data('autoplay')) {
            options.autoplay = {
                delay: $element.data('autoplay-speed') || 5000,
            }
        } else {
            options.autoplay = false
        }

        if ($element.data('loop')) {
            options.loop = $element.data('loop')
        } else {
            options.loop = false
        }

        if ($element.data('items')) {
            options.slidesPerView = $element.data('items')
        }

        new Swiper(element, options)
    }

    function customSwiper() {
        initSwiperSlider('.slider-one', {
            slidesPerView: 2,
            spaceBetween: 20,
            slidesPerGroup: 1,
            centeredSlides: false,
            loop: true,
            autoplay: {
                delay: 4000,
            },
            breakpoints: {
                1200: {
                    slidesPerView: 2,
                },
                992: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 2,
                },
                576: {
                    slidesPerView: 1,
                },
                0: {
                    slidesPerView: 1,
                },
            },
        });

        initSwiperSlider('.slider-two', {
            slidesPerView: 1,
            // spaceBetween: 20,
            slidesPerGroup: 1,
            centeredSlides: false,
            loop: true,
            autoplay: {
                delay: 4000,
            },
            pagination: {
                el: '.slider-two .swiper-pagination',
            },
            navigation: {
                nextEl: '.slider-two .swiper-button-next',
                prevEl: '.slider-two .swiper-button-prev',
            },
        });

        initSwiperSlider('.slider-1', {
            slidesPerView: 3,
            spaceBetween: 20,
            slidesPerGroup: 1,
            centeredSlides: false,
            loop: true,
            autoplay: {
                delay: 4000,
            },
            breakpoints: {
                1200: {
                    slidesPerView: 3,
                },
                992: {
                    slidesPerView: 3,
                },
                768: {
                    slidesPerView: 2,
                },
                576: {
                    slidesPerView: 1,
                },
                0: {
                    slidesPerView: 1,
                },
            },
            navigation: {
                nextEl: '.slider-1 .swiper-button-next',
                prevEl: '.slider-1 .swiper-button-prev',
            },
            pagination: {
                el: '.slider-1 .swiper-pagination',
            },
        });

        initSwiperSlider('.slider-2', {
            slidesPerView: 4,
            spaceBetween: 30,
            slidesPerGroup: 1,
            centeredSlides: false,
            loop: true,
            autoplay: {
                delay: 4000,
            },
            breakpoints: {
                1200: {
                    slidesPerView: 4,
                },
                992: {
                    slidesPerView: 3,
                },
                768: {
                    slidesPerView: 2,
                },
                576: {
                    slidesPerView: 1,
                },
                0: {
                    slidesPerView: 1,
                },
            },
            navigation: {
                nextEl: '.slider-2 .swiper-button-next',
                prevEl: '.slider-2 .swiper-button-prev',
            },
            on: {
                afterInit: function () {
                    // set padding left slide
                    var leftPadding = 0;
                    var swipperRoot = $('.swipper-root');
                    if (swipperRoot.length > 0) {
                        leftPadding = swipperRoot.offset().left;
                    }
                    if ($('.box-swiper-padding').length > 0) {
                        $('.box-swiper-padding').css('padding-left', leftPadding + 'px');
                    }
                },
            },
        });
    }

    function odometerCounter() {
        if ($('.odometer').length > 0) {
            $('.odometer').appear(function (e) {
                var odo = $('.odometer');
                odo.each(function () {
                    var countNumber = $(this).attr('data-count');
                    $(this).html(countNumber);
                });
            });
        }
    }

    function initSlick() {
        $('.partners-slider').each(function() {
            $(this).slick({
                slidesToShow: $(this).attr('data-display-item') ?? 5,
                slidesToScroll: 1,
                infinite: true,
                autoplay: true,
                autoplaySpeed: 0,
                speed: 5000,
                cssEase: 'linear',
                pauseOnFocus: true,
                pauseOnHover: true,
                draggable: true,
                arrows: false,
                dots: false,
                loop: true,
                rtl: isRTL(),
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 4
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2
                        }
                    }
                ]
            });
        })

        $('.partners-slider-start').each(function() {
            $(this).slick({
                slidesToShow: $(this).attr('data-display-item') ?? 5,
                slidesToScroll: 1,
                infinite: true,
                autoplay: true,
                autoplaySpeed: 0,
                speed: 5000,
                cssEase: 'linear',
                pauseOnFocus: true,
                pauseOnHover: true,
                draggable: true,
                arrows: false,
                dots: false,
                loop: true,
                rtl: ! isRTL(),
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 4
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2
                        }
                    }
                ]
            })
        })

        $('.partners-slider-end').each(function() {
            $(this).slick({
                slidesToShow: $(this).attr('data-display-item') ?? 5,
                slidesToScroll: 1,
                infinite: true,
                autoplay: true,
                autoplaySpeed: 0,
                speed: 5000,
                cssEase: 'linear',
                pauseOnFocus: true,
                pauseOnHover: true,
                draggable: true,
                arrows: false,
                dots: false,
                loop: true,
                rtl: isRTL(),
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 4
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2
                        }
                    }
                ]
            });
        })
    }

    function inputFocus() {
        $('input')
            .focus(function () {
                $(this).closest('div.input-group').addClass('focus');
            })
            .blur(function () {
                $(this).closest('div.input-group').removeClass('focus');
            });
        $('textarea')
            .focus(function () {
                $(this).closest('div.input-group').addClass('focus');
            })
            .blur(function () {
                $(this).closest('div.input-group').removeClass('focus');
            });
        $('select')
            .focus(function () {
                $(this).closest('div.input-group').addClass('focus');
            })
            .blur(function () {
                $(this).closest('div.input-group').removeClass('focus');
            });
    }

    function mobileHeaderActive() {
        var navbarTrigger = $(".burger-icon"),
            navCanvas = $(".burger-icon-2"),
            closeCanvas = $(".close-canvas"),
            endTrigger = $(".mobile-menu-close"),
            container = $(".mobile-header-active"),
            containerCanvas = $(".sidebar-canvas-wrapper"),
            wrapper4 = $("body");
        wrapper4.prepend('<div class="body-overlay-1"></div>');
        navbarTrigger.on("click", function (e) {
            navbarTrigger.toggleClass("burger-close");
            e.preventDefault();
            container.toggleClass("sidebar-visible");
            wrapper4.toggleClass("mobile-menu-active");
        });

        endTrigger.on("click", function () {
            container.removeClass("sidebar-visible");
            wrapper4.removeClass("mobile-menu-active");
        });

        var $offCanvasNav = $(".mobile-menu"),
        $offCanvasNavSubMenu = $offCanvasNav.find(".sub-menu");
        /*Add Toggle Button With Off Canvas Sub Menu*/
        $offCanvasNavSubMenu.parent().prepend('<span class="menu-expand"><i class="bi-chevron-down"></i></span>');
        /*Close Off Canvas Sub Menu*/
        $offCanvasNavSubMenu.slideUp();
        /*Category Sub Menu Toggle*/
        $offCanvasNav.on("click", "li a, li .menu-expand", function (e) {
            var $this = $(this);
            if (
                $this
                    .parent()
                    .attr("class")
                    .match(/\b(menu-item-has-children|has-children|has-sub-menu)\b/) &&
                ($this.attr("href") === "#" || $this.hasClass("menu-expand"))
            ) {
                e.preventDefault();
                if ($this.siblings("ul:visible").length) {
                    $this.parent("li").removeClass("active");
                    $this.siblings("ul").slideUp();
                } else {
                    $this.parent("li").addClass("active");
                    $this.closest("li").siblings("li").removeClass("active").find("li").removeClass("active");
                    $this.closest("li").siblings("li").find("ul:visible").slideUp();
                    $this.siblings("ul").slideDown();
                }
            }
        });
    }

    function sliderImageByResolution($el) {
        const windowWidth = $(window).width()

        if (windowWidth >= 1200) {
            if ($el.data('original-image')) {
                $el.css({ 'background-image': 'url("' + encodeURI($el.data('original-image')) + '")' })
            }
        } else if (windowWidth > 768) {
            if ($el.data('tablet-image')) {
                $el.css({ 'background-image': 'url("' + encodeURI($el.data('tablet-image')) + '")' })
            }
        } else if (windowWidth <= 768) {
            if ($el.data('mobile-image')) {
                $el.css({ 'background-image': 'url("' + encodeURI($el.data('mobile-image')) + '")' })
            }
        }
    }

    /*=============================================
	=           Page Load       =
    =============================================*/
    $(document).ready(function () {
        preloader();
        progressPageLoad();
        offcanvasMenu();
        $('.swiper.slider-two .img-pull').each(function(index, element) {
            sliderImageByResolution($(element))
        })
        dataBackground();
        aosAnimation();
        counterState();
        customSwiper();
        magnificPopup();
        wowAnimation();
        odometerCounter();
        masonryFillter();
        inputFocus();
        mobileHeaderActive();
        initSlick();
    });
})(jQuery);
