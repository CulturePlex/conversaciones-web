(function($) {
    'use strict';
    $(document).ready(function() {
        bp_starter.ready();
    });

    $(window).load(function() {
        bp_starter.load();
    });

    var bp_starter = {

        /**
         * Call functions when document ready
         */
        ready: function() {
            this.slide_slick_col();
            this.bp_hover_element();
            this.element_responsive();
        },

        /**
         * Call functions when window load.
         */
        load: function() {

        },

        /**
         * Slide slick col.
         */
        slide_slick_col: function() {
            var verticalSlide = false;
            var verticalSwipe = false;
            var customdot = false;
            var numOfSlide = 4;
            var numOfScroll = 4;
            var loopSlide = false;
            var autoScroll = false;
            var speedAuto = 5000;
            var respon = [[4, 4], [3, 3], [2, 2], [1, 1], [1, 1]]

            $('.js-call-slick-col').each(function(){
                var wrapSlick = $(this);
                var slideSlick = $(this).find('.slide-slick');

                // Check show dot, arrows
                var showDot = false;
                if($(wrapSlick).find('.wrap-dot-slick').length > 0) {
                    showDot = true;
                }

                var showArrow = false;
                if($(wrapSlick).find('.wrap-arrow-slick').length > 0) {
                    showArrow = true;
                }

                // Get data
                numOfSlide = Number($(this).data('numofslide'));
                numOfScroll = Number($(this).data('numofscroll'));
                speedAuto = Number($(this).data('speedauto'));

                if($(this).data('loopslide') == '1') {
                    loopSlide = true;
                } else {
                    loopSlide = false;
                }

                if($(this).data('autoscroll') == '1') {
                    autoScroll = true;
                } else {
                    autoScroll = false;
                }

                if($(this).data('customdot') == '1') {
                    customdot = true;
                } else {
                    customdot = false;
                }

                if($(this).data('verticalslide') == '1') {
                    verticalSlide = true;
                } else {
                    verticalSlide = false;
                }

                if($(this).data('verticalswipe') == '1') {
                    verticalSwipe = true;
                } else {
                    verticalSwipe = false;
                }

                var str = $(this).data('respon') //'[4, 4], [3, 3], [2, 2], [1, 1], [1, 1]';
                var strArray = str.match(/(\d+)/g);
                respon =    [
                    [Number(strArray[0]), Number(strArray[1])],
                    [Number(strArray[2]), Number(strArray[3])],
                    [Number(strArray[4]), Number(strArray[5])],
                    [Number(strArray[6]), Number(strArray[7])],
                    [Number(strArray[8]), Number(strArray[9])]
                ]

                var attr = $('html').attr('dir');
                if (typeof attr !== typeof undefined && attr !== false) {
                    var rightToLeft = true;
                } else{
                    rightToLeft = false;
                }



                // Call slick
                $(slideSlick).slick({
                    rtl: rightToLeft,
                    vertical: verticalSlide,
                    verticalSwiping: verticalSwipe,
                    pauseOnFocus: false,
                    pauseOnHover: true,
                    slidesToShow: numOfSlide,
                    slidesToScroll: numOfScroll,
                    fade: false,
                    infinite: loopSlide,
                    autoplay: autoScroll,
                    autoplaySpeed: speedAuto,
                    arrows: showArrow,
                    appendArrows: $(wrapSlick).find('.wrap-arrow-slick'),
                    prevArrow: $(wrapSlick).find('.prev-slick'),
                    nextArrow: $(wrapSlick).find('.next-slick'),
                    dots: showDot,
                    appendDots: $(wrapSlick).find('.wrap-dot-slick'),
                    dotsClass:'dots-slick',
                    customPaging: function(slick, index) {
                        var portrait = $(slick.$slides[index]).data('thumb');

                        if(customdot) return '<img src=" ' + portrait + ' "/>';

                        return '<span></span>'
                    },
                    responsive: [
                        {
                            breakpoint: 1368,
                            settings: {
                                slidesToShow: respon[0][0],
                                slidesToScroll: respon[0][1]
                            }
                        },
                        {
                            breakpoint: 1199,
                            settings: {
                                slidesToShow: respon[1][0],
                                slidesToScroll: respon[1][1]
                            }
                        },
                        {
                            breakpoint: 991,
                            settings: {
                                slidesToShow: respon[2][0],
                                slidesToScroll: respon[2][1]
                            }
                        },
                        {
                            breakpoint: 767,
                            settings: {
                                slidesToShow: respon[3][0],
                                slidesToScroll: respon[3][1]
                            }
                        },
                        {
                            breakpoint: 575,
                            settings: {
                                slidesToShow: respon[4][0],
                                slidesToScroll: respon[4][1]
                            }
                        }
                    ]
                })
                    .on('setPosition', function(event, slick){
                        if($(this).parent().data('equalheight') == '1') {
                            var maxHeight = 0;
                            var $items = $(this).find('.item-slick');

                            $items.each(function(){
                                if($(this).outerHeight() > maxHeight) {
                                    maxHeight = $(this).outerHeight();
                                }
                            })

                            $items.css('min-height', maxHeight);
                            //console.log(maxHeight);
                        }

                        // Middle Arrow
                        if($(wrapSlick).data('middlearrow') != null) {
                            var $wrapArrows = $(wrapSlick).find('.wrap-arrow-slick');
                            var middleOf = $(wrapSlick).find($(wrapSlick).data('middlearrow')).outerHeight();

                            $wrapArrows.css('height', middleOf + 'px');
                        }
                    });

                //Show dot number
                if($(wrapSlick).hasClass('show-dot-number')) {
                    var $wrapDotNumber = $(wrapSlick).find('.wrap-dot-slick');
                    var $dotItem = $wrapDotNumber.find('.dots-slick > li');

                    $wrapDotNumber.append('<span class="num-active">0</span><span class="div-num">/</span><span class="num-total">0</span>');

                    var $numActive = $wrapDotNumber.find('.num-active');
                    var $numTotal = $wrapDotNumber.find('.num-total');

                    $(slideSlick).on('setPosition', function(event, slick, currentSlide){
                        $dotItem = $wrapDotNumber.find('.dots-slick > li');
                        $dotItem.length < 10 ? $numTotal.html('0' + $dotItem.length + '') : $numTotal.html($dotItem.length + '');
                    });

                    $(slideSlick).on('afterChange setPosition', function(event, slick, currentSlide){
                        for(var i=0; i<$dotItem.length; i++) {
                            if($($dotItem[i]).hasClass('slick-active')) {
                                (i + 1) < 10 ? $numActive.html('0' + (i + 1) + '') : $numActive.html(i + 1 + '');
                                break;
                            }
                        }
                    });
                }

                //Show dot process
                if($(wrapSlick).hasClass('dot-has-process')) {
                    $(slideSlick).on('afterChange breakpoint', function () {
                        $(wrapSlick).find('.wrap-dot-slick .dots-slick li').removeClass('process-dot');
                        $(wrapSlick).find('.wrap-dot-slick .dots-slick li.slick-active').addClass('process-dot');
                    });
                }
            });
        },

        /**
         * Element hover
         */
        bp_hover_element: function () {
            $('.bp-element-hover').each(function () {
                var elem = $(this),
                    old_style = elem.attr('style')
                if(elem.data('hover')) {
                    var hover_style = old_style + elem.data('hover');
                    elem.on({
                        'mouseenter': function () {
                            elem.attr('style', hover_style);
                        },
                        'mouseleave': function () {
                            elem.attr('style', old_style);
                        }
                    })
                }
            });
        },

        /**
         * Row, Column Responsive
         */
        element_responsive: function() {
            $(window).on('load resize', function() {
                var mode = 'desktop';

                if ( matchMedia( 'only screen and (max-width: 1024px) and (min-width: 768px)' ).matches )
                    mode = 'tablet';
                else if ( matchMedia( 'only screen and (max-width: 767px)' ).matches )
                    mode = 'mobile';

                $('.vc_row, .vc_row-inner, .wpb_column, .vc_column-inner, .bp-element').each(function(){
                    if ( mode == 'tablet' ) {
                        if($(this).data('class-tablet')) {
                            $(this).addClass($(this).data('class-tablet'));
                        }
                    }
                    if ( mode == 'mobile' ) {
                        if($(this).data('class-mobile')) {
                            $(this).addClass($(this).data('class-mobile'));
                        }
                    }
                });
            });
        },
    }
})(jQuery);