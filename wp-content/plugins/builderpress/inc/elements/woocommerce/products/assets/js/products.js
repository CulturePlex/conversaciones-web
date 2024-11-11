(function ($) {
    "use strict";

    $(document).ready(function () {
        slide_slick_col_products();
    });

    $(window).load(function() {

    });

    /**
     * Slide slick col.
     */
    var slide_slick_col_products = function() {
        $('.slide_slick_col_products').each(function(){
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
                ['middlearrow', 'string'],
                ['numofrows', 'number'],
                ['slidesperrow', 'number'],
                ['speedslide', 'number'],
                ['modecenter', 'bool'],
                ['paddingcenter', 'string']
            ]

            var parameter = {
                responsive: [[1, 1], [1, 1], [1, 1], [1, 1], [1, 1], [1, 1]],
                customdot: false,
                numofshow: 1,
                numofscroll: 1,
                fade: false,
                loopslide: false,
                autoscroll: false,
                speedauto: 5000,
                verticalslide: false,
                verticalswipe: false,
                rtl: false,
                navfor: '',
                middlearrow: null,
                numofrows: 1,
                slidesperrow: 1,
                speedslide: 500,
                modecenter: false,
                paddingcenter: '50px'
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
                            [Number(strArray[8]), Number(strArray[9])],
                            [Number(strArray[10]), Number(strArray[11])]
                        ]
                    }
                }
            }

            // Custom rows
            var numOfItem = $(slideSlick).find('.item-slick').length;

            if(numOfItem < parameter.numofshow * 2) {
                parameter.numofrows = 1;
            }

            // Set 50% left/right
            var isMargin = true;
            if($(window).outerWidth() >= 768 && $(window).outerWidth() < 992) {
                if(numOfItem === (parameter.responsive[2][0] + 1)) {
                    parameter.responsive[2][0]++;
                    isMargin = false;
                }
            }
            else if($(window).outerWidth() >= 576 && $(window).outerWidth() < 768) {
                if(numOfItem === (parameter.responsive[3][0] + 1)) {
                    parameter.responsive[3][0]++;
                    isMargin = false;
                }
            }
            else if($(window).outerWidth() >= 480 && $(window).outerWidth() < 576) {
                if(numOfItem === (parameter.responsive[4][0] + 1)) {
                    parameter.responsive[4][0]++;
                    isMargin = false;
                }
            }
            else if($(window).outerWidth() < 480) {
                if(numOfItem === (parameter.responsive[5][0] + 1)) {
                    parameter.responsive[5][0]++;
                    isMargin = false;
                }
            }

            // Call slick
            $(slideSlick).slick({
                centerPadding: "0%",
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
                rows: parameter.numofrows,
                slidesPerRow: parameter.slidesperrow,
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
                            slidesToScroll: parameter.responsive[2][1],
                            rows: 1,
                            initialSlide: 1
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: parameter.responsive[3][0],
                            slidesToScroll: parameter.responsive[3][1],
                            rows: 1,
                            initialSlide: 1
                        }
                    },
                    {
                        breakpoint: 575,
                        settings: {
                            slidesToShow: parameter.responsive[4][0],
                            slidesToScroll: parameter.responsive[4][1],
                            rows: 1,
                            initialSlide: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: parameter.responsive[5][0],
                            slidesToScroll: parameter.responsive[5][1],
                            rows: 1,
                            initialSlide: 1
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

            // Set 50% left/right
            var slickList = $(slideSlick).find('.slick-list');
            if($(window).outerWidth() >= 768 && $(window).outerWidth() < 992 && isMargin) {
                $(slickList).css('overflow', 'visible');
                $(slickList).css('margin-right', 100 / (parameter.responsive[2][0] * 2 + 2) + '%');
                $(slickList).css('margin-left', 100 / (parameter.responsive[2][0] * 2 + 2) + '%');
            }
            else if($(window).outerWidth() >= 576 && $(window).outerWidth() < 768 && isMargin) {
                $(slickList).css('overflow', 'visible');
                $(slickList).css('margin-right', 100 / (parameter.responsive[3][0] * 2 + 2) + '%');
                $(slickList).css('margin-left', 100 / (parameter.responsive[3][0] * 2 + 2) + '%');
            }
            else if($(window).outerWidth() >= 480 && $(window).outerWidth() < 576 && isMargin) {
                $(slickList).css('overflow', 'visible');
                $(slickList).css('margin-right', 100 / (parameter.responsive[4][0] * 2 + 2) + '%');
                $(slickList).css('margin-left', 100 / (parameter.responsive[4][0] * 2 + 2) + '%');
            }
            else if($(window).outerWidth() < 480 && isMargin) {
                $(slickList).css('overflow', 'visible');
                $(slickList).css('margin-right', 100 / (parameter.responsive[5][0] * 2 + 2) + '%');
                $(slickList).css('margin-left', 100 / (parameter.responsive[5][0] * 2 + 2) + '%');
            }
        });
    };

})(jQuery);