(function ($) {
    "use strict";

    $(document).ready(function () {

        slick_testimonial();
        slick_testimonial_layout7();
        slick_testimonial_layout8();
        slick_testimonial_vblog_slider_1();

        var $testimonials = $('.bp-element-testimonials.layout-slider-1, .bp-element-testimonials.layout-slider-6');
        $testimonials.each(function () {
            var elem = $(this),
                items_visible = $(elem).data('items-visible'),
                items_tablet = $(elem).data('items-tablet'),
                items_mobile = $(elem).data('items-mobile'),
                slider_for = $(elem).find('.slider-for'),
                slider_nav = $(elem).find('.slider-nav');

            if (typeof items_visible === 'undefined') {
                items_visible = 1;
            }

            slider_nav.slick({
                asNavFor: slider_for,
                centerMode: true,
                focusOnSelect: true,
                centerPadding: '0',
                arrows: false,
                dots: true,
            });
            slider_for.slick({
                slidesToShow: items_visible,
                responsive: [
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: items_tablet
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: items_mobile
                        }
                    }
                ],
                // slidesToScroll: 1,
                arrows: true,
                asNavFor: slider_nav,
                dots: false,
                prevArrow:  '<button type="button" class="slick-prev"><i class="ion-ios-arrow-left"></i></button>',
                nextArrow: ' <button type="button" class="slick-next"><i class="ion-ios-arrow-right"></i></button>',
            });
        });

    });

    /**
     * Slider for vblog
     */
    var slick_testimonial_vblog_slider_1 = function () {
        $('.js-call-slick-col-vblog').each(function(){
            var data =  [
                ['responsive', 'array'],
                ['customdot', 'bool'],
                ['numofshow', 'number'],
                ['numofscroll', 'number'],
                ['fade', 'bool'],
                ['loopslide', 'bool'],
                ['autoscroll', 'bool'],
                ['speedauto', 'number'],
                ['verticalslide', 'bool'],
                ['verticalswipe', 'bool'],
                ['rtl', 'bool'],
                ['navfor', 'string'],
                ['animate', 'bool'],
                ['middlearrow', 'string'],
                ['modecenter', 'bool'],
                ['paddingcenter', 'string'],
                ['speedslide', 'number'],
            ];

            if($(this).data('rtl') == '1') {
                var rightToLeft = true;
            } else {
                var rightToLeft = false;
            }

            var parameter = {
                responsive: [[1, 1], [1, 1], [1, 1], [1, 1], [1, 1]],
                customdot: false,
                numofshow: 1,
                numofscroll: 1,
                fade: false,
                loopslide: false,
                autoscroll: false,
                speedauto: 5000,
                verticalslide: false,
                verticalswipe: false,
                rtl: rightToLeft,
                navfor: '',
                animate: false,
                middlearrow: null,
                modecenter: false,
                paddingcenter: '50px',
                speedslide: 500

            }

            var showDot = false;
            var showArrow = false;
            var wrapSlick = $(this);
            var slideSlick = $(this).find('.slide-slick');
            var itemSlick = $(slideSlick).find('.item-slick');
            var layerSlick = $(slideSlick).find('[data-appear]');
            var actionSlick = [];

            // Check show dot, arrows
            if($(wrapSlick).find('.wrap-dot-slick').length > 0) {
                showDot = true;
            }

            if($(wrapSlick).find('.wrap-arrow-slick').length > 0) {
                showArrow = true;
            }

            // Get data
            for(var i=0; i<data.length; i++) {
                var value = $(this).data(data[i][0]);

                if (value != null) {
                    if(data[i][1] === 'bool') {
                        if(value === '1' || value === 1) {
                            parameter[data[i][0]] = true;
                        } else {
                            parameter[data[i][0]] = false;
                        }
                    }
                    else if(data[i][1] === 'number') {
                        parameter[data[i][0]] = Number(value);
                    }
                    else if(data[i][1] === 'string') {
                        parameter[data[i][0]] = value;
                    }
                    else if(data[i][1] === 'array') {
                        var strArray = value.match(/(\d+)/g);
                        parameter[data[i][0]] = [
                            [Number(strArray[0]), Number(strArray[1])],
                            [Number(strArray[2]), Number(strArray[3])],
                            [Number(strArray[4]), Number(strArray[5])],
                            [Number(strArray[6]), Number(strArray[7])],
                            [Number(strArray[8]), Number(strArray[9])]
                        ]
                    }
                }
            }

            // Call slick
            if(parameter.animate) {
                $(layerSlick).addClass('animated').css('visibility', 'hidden');

                $(slideSlick).on('init', function(){
                    showLayer(0);
                });
            }

            $(slideSlick).slick({
                centerMode: parameter.modecenter,
                centerPadding: parameter.paddingcenter,
                speed: parameter.speedslide,
                asNavFor: parameter.navfor,
                rtl: parameter.rtl,
                vertical: parameter.verticalslide,
                verticalSwiping: parameter.verticalswipe,
                pauseOnFocus: false,
                pauseOnHover: true,
                slidesToShow: parameter.numofshow,
                slidesToScroll: parameter.numofscroll,
                fade: parameter.fade,
                infinite: parameter.loopslide,
                autoplay: parameter.autoscroll,
                autoplaySpeed: parameter.speedauto,
                arrows: showArrow,
                appendArrows: $(wrapSlick).find('.wrap-arrow-slick'),
                prevArrow: $(wrapSlick).find('.prev-slick'),
                nextArrow: $(wrapSlick).find('.next-slick'),
                dots: showDot,
                appendDots: $(wrapSlick).find('.wrap-dot-slick'),
                dotsClass:'dots-slick',
                customPaging: function(slick, index) {
                    var portrait = $(slick.$slides[index]).data('thumb');

                    if(parameter.customdot) return '<img src=" ' + portrait + ' "/>';

                    return '<span></span>'
                },
                responsive: [
                    {
                        breakpoint: 1368,
                        settings: {
                            slidesToShow: parameter.responsive[0][0],
                            slidesToScroll: parameter.responsive[0][1]
                        }
                    },
                    {
                        breakpoint: 1199,
                        settings: {
                            slidesToShow: parameter.responsive[1][0],
                            slidesToScroll: parameter.responsive[1][1]
                        }
                    },
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: parameter.responsive[2][0],
                            slidesToScroll: parameter.responsive[2][1]
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: parameter.responsive[3][0],
                            slidesToScroll: parameter.responsive[3][1]
                        }
                    },
                    {
                        breakpoint: 575,
                        settings: {
                            slidesToShow: parameter.responsive[4][0],
                            slidesToScroll: parameter.responsive[4][1]
                        }
                    }
                ]
            })
                .on('setPosition', function(event, slick){
                    // Equal height
                    if($(this).parent().data('equalheight') === '1' || $(this).parent().data('equalheight') === 1) {
                        var maxHeight = 0;
                        var $items = $(this).find('.item-slick');

                        $items.each(function(){
                            if($(this).outerHeight() > maxHeight) {
                                maxHeight = $(this).outerHeight();
                            }
                        })

                        $items.css('min-height', maxHeight);
                    }

                    // Middle Arrow
                    if(parameter.middlearrow != null) {
                        var $wrapArrows = $(wrapSlick).find('.wrap-arrow-slick');
                        var middleOf = $(wrapSlick).find(parameter.middlearrow).outerHeight();

                        $wrapArrows.css('height', middleOf + 'px');
                    }
                });

            // Animate
            if(parameter.animate) {
                $(slideSlick).on('afterChange', function(event, slick, currentSlide){
                    showLayer(currentSlide);
                });
            }

            function showLayer(currentSlide) {
                var layerCurrentItem = $(itemSlick[currentSlide]).find('[data-appear]');

                for(var i=0; i<actionSlick.length; i++) {
                    clearTimeout(actionSlick[i]);
                }

                $(layerSlick).each(function(){
                    $(this).removeClass($(this).data('appear')).css('visibility', 'hidden');
                })


                for(var i=0; i<layerCurrentItem.length; i++) {
                    actionSlick[i] = setTimeout(function(index) {
                        $(layerCurrentItem[index]).addClass($(layerCurrentItem[index]).data('appear')).css('visibility', 'visible');
                    },$(layerCurrentItem[i]).data('delay'),i);
                }
            };
        });
    };

    /*
    *   layout 7
    * */

    var slick_testimonial_layout7 = function () {
        var $testimonials = $('.bp-element-testimonials.layout-slider-7');
        $testimonials.each(function () {
            var elem = $(this),
                items_visible = $(elem).data('items-visible'),
                items_tablet = $(elem).data('items-tablet'),
                items_mobile = $(elem).data('items-mobile'),
                slider_for = $(elem).find('.slider-for'),
                slider_nav = $(elem).find('.slider-nav');

            if (typeof items_visible === 'undefined') {
                items_visible = 1;
            }

            slider_nav.slick({
                asNavFor: slider_for,
                centerMode: true,
                focusOnSelect: true,
                centerPadding: '0',
                arrows: false,
                dots: true,
            });
            slider_for.slick({
                slidesToShow: items_visible,
                responsive: [
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: items_tablet
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: items_mobile
                        }
                    }
                ],
                // slidesToScroll: 1,
                arrows: true,
                asNavFor: slider_nav,
                dots: false,
                appendArrows: $('.bp-element-testimonials.layout-slider-7').find('.info-wrap'),
                prevArrow:  $('.bp-element-testimonials.layout-slider-7 .infor-left').find('.slick-prev'),
                nextArrow: $('.bp-element-testimonials.layout-slider-7 .info-right').find('.slick-next'),
            });
        });
    }

    /*
    *   layout 8
    * */

    var slick_testimonial_layout8 = function () {
        var $testimonials = $('.bp-element-testimonials.layout-slider-8 > div');
        $testimonials.each(function () {
            var elem = $(this),
                items_visible = $(elem).data('items-visible'),
                items_visible1 = $(this).attr('data-items-visible'),
                items_tablet = $(elem).data('items-tablet'),
                items_mobile = $(elem).data('items-mobile'),
                slider_for = $(elem).find('.slider-for'),
                slider_nav = $(elem).find('.slider-nav');

            if (typeof items_visible === 'undefined') {
                items_visible = 1;
            }
            slider_nav.slick({
                asNavFor: slider_for,
                centerMode: true,
                focusOnSelect: true,
                centerPadding: '0',
                arrows: false,
                dots: false,
            });
            slider_for.slick({
                slidesToShow: items_visible,
                responsive: [
                    {
                        breakpoint: 1025,
                        settings: {
                            slidesToShow: items_tablet
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: items_mobile
                        }
                    }
                ],
                // slidesToScroll: 1,
                arrows: false,
                asNavFor: slider_nav,
                dots: false,
            });
        });
    }

    /**
     * Slick slick_testimonial.
     */
    var slick_testimonial = function() {
        var fadeSlide = false;
        var autoScroll = false;
        var speedAuto = 5000;
        var showArrow = false;

        $('.js-call-slick-testimonial').each(function(){
            var wrapSlick = $(this);
            var slideContent = $(this).find('.slide-content');
            var slideThumb = $(this).find('.slide-thumb');

            // Check show arrow
            if($(this).find('.wrap-arrow-slick').length > 0) {
                showArrow = true;
            }

            // Get data
            speedAuto = Number($(this).data('speedauto'));

            if($(this).data('fadeslide') == '1') {
                fadeSlide = true;
            } else {
                fadeSlide = false;
            }

            if($(this).data('autoscroll') == '1') {
                autoScroll = true;
            } else {
                autoScroll = false;
            }

            var attr = $('html').attr('dir');
            if (typeof attr !== typeof undefined && attr !== false) {
                var righttoleft = true;
            } else{
                righttoleft = false;
            }

            // Call slick
            $($(slideContent).find('.slide-slick')).slick({
                pauseOnFocus: false,
                pauseOnHover: false,
                slidesToShow: 1,
                slidesToScroll: 1,
                asNavFor: '.slide-thumb .slide-slick',
                fade: fadeSlide,
                rtl: righttoleft,
                autoplay: autoScroll,
                autoplaySpeed: speedAuto,
                arrows: showArrow,
                appendArrows: $(wrapSlick).find('.wrap-arrow-slick'),
                prevArrow: $(wrapSlick).find('.prev-slick'),
                nextArrow: $(wrapSlick).find('.next-slick'),
                dots: false

            });

            $($(slideThumb).find('.slide-slick')).slick({
                pauseOnFocus: false,
                pauseOnHover: false,
                slidesToShow: 3,
                rtl: righttoleft,
                slidesToScroll: 1,
                asNavFor: '.slide-content .slide-slick',
                fade: false,
                arrows: false,
                dots: false,
                centerMode: true,
                centerPadding: '5px',
                focusOnSelect: true
            });

        });
    };
})(jQuery);