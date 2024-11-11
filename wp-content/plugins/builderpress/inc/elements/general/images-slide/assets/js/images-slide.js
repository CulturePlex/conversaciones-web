(function ($) {
    "use strict";

    $(document).ready(function () {
        slide_slick_col();
    });

    $(document).load(function () {
        slide_slick_col();
    });

    /**
     * Slide slick col.
     */
    var slide_slick_col = function() {
        $('.js-call-slick-images').each(function(){
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
                ['numofrows', 'number'],
                ['slidesperrow', 'number'],
                ['speedslide', 'number'],
                ['modecenter', 'bool'],
                ['paddingcenter', 'string']
            ]

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
                rtl: false,
                navfor: '',
                animate: false,
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
                            [Number(strArray[8]), Number(strArray[9])]
                        ]
                    }
                }
            }

            // Init Animate
            if(parameter.animate) {
                $(layerSlick).addClass('animated').css('visibility', 'hidden');

                $(slideSlick).on('init', function(){
                    showLayer(0);
                });
            }

            //Init Show dot process
            if($(wrapSlick).hasClass('dot-has-process')) {
                $(slideSlick).on('init', function(){
                    $(wrapSlick).find('.wrap-dot-slick .dots-slick li').removeClass('process-dot');
                    $(wrapSlick).find('.wrap-dot-slick .dots-slick li.slick-active').addClass('process-dot');
                });
            }

            // Call slick
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

                    if(parameter.customdot) return  portrait + '';

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
                $(slideSlick).on('afterChange breakpoint', function(){
                    $(wrapSlick).find('.wrap-dot-slick .dots-slick li').removeClass('process-dot');
                    $(wrapSlick).find('.wrap-dot-slick .dots-slick li.slick-active').addClass('process-dot');
                });
            }
        });
    };

})(jQuery);