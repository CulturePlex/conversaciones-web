(function ($) {
    "use strict";

    $(document).ready(function () {
        bp_element_our_works.init();
    });

    var bp_element_our_works = {

        data: {},
        init: function () {
            this.slick();
            this.nav_filter();
        },

        slick: function () {
            var $shortcodes = $('.bp-element-our-works');

            $shortcodes.each(function () {

                $(this).find('.slider-for').slick({
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    loop:false,
                    prevArrow : '<i class="fa fa-angle-left slider-left" aria-hidden="true"></i>',
                    nextArrow : '<i class="fa fa-angle-right slider-right" aria-hidden="true"></i>',
                    responsive: [
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 3,
                                infinite: true,
                                dots: false
                            }
                        },
                        {
                            breakpoint: 800,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2,
                                dots: false
                            }
                        },
                        {
                            breakpoint: 500,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                dots: false
                            }
                        }
                    ]
                });

                var filtered = false;

                $('.cat-list .cat-item').on('click', function(){
                    if (filtered === false) {
                        $('.slider-for').slick('slickFilter',':even');
                        filtered = true;
                    } else {
                        $('.slider-for').slick('slickUnfilter');
                        filtered = false;
                    }
                });
            });
        },

        /**
         * Filter by category
         */
        nav_filter: function () {
            var $sc = $('.bp-element-our-works');

            $sc.imagesLoaded(function () {
                var $grid = $('.bp-element-our-works .loop-wrapper').isotope({
                    itemSelector: '.item',
                    masonry: {
                        columnWidth: '.item',
                        gutter: 0
                    }
                });


                $(window).on("scroll", function () {
                    $grid.isotope('layout');
                });

                $sc.on('click', '.nav-filter a', function () {

                    $sc = $(this).parents('.bp-element-our-works');

                    var current_cat = $sc.find('.nav-filter .cat-item.current a').attr('data-cat'),
                        current_down = $sc.find('.cat-dropdown');

                    $sc.find('.nav-filter .cat-item').removeClass('current');

                    $(this).parents('li').addClass('current');

                    if (current_down.find('.pulldown-list .cat-item').hasClass('current')) {
                        current_down.find('.cat-more').addClass('current');
                    } else {
                        current_down.find('.cat-more').removeClass('current');
                    }

                    var filterValue = $sc.find('.nav-filter .cat-item.current a').attr('data-filter');
                    $grid.isotope({filter: filterValue});

                });

                var filter_value = bp_element_our_works.nav_filter_value();
                $(window).resize(function () {
                    bp_element_our_works.nav_filter_resize(filter_value);
                });
            });

        },

        /**
         * Responsive filter
         */
        nav_filter_value: function () {
            var $sc = $('.bp-element-our-works');

            var $filter = $sc.find('.nav-filter');
            var filter_value = [];
            $filter.each(function (index, element) {
                var list = $(this).find('.cat-list').html();
                var pulldown = $(this).find('.pulldown-list').html();
                var filter = {
                    'list': list,
                    'pulldown': pulldown
                };
                filter_value.push(filter);
            });

            return filter_value;
        },

        /**
         * Resize windown
         * @param filter_value
         */
        nav_filter_resize: function (filter_value) {
            var $sc = $('.bp-element-our-works');
            var windowW = $(window).width();

            var $filter = $sc.find('.nav-filter');

            $filter.each(function (index, element) {
                if (windowW <= 768) {
                    $(this).find('.pulldown-list').html(filter_value[index].list + filter_value[index].pulldown);
                    $(this).find('.cat-list').empty();
                } else {
                    $(this).find('.pulldown-list').html(filter_value[index].pulldown);
                    $(this).find('.cat-list').html(filter_value[index].list);
                }
            });
        },

    };

})(jQuery);