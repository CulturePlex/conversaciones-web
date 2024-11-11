(function ($) {
    "use strict";

    $(document).ready(function () {
        bp_product_filter_custom.ready();
    });


    var bp_product_filter_custom = {
        ready: function () {
            bp_product_filter.init();
        },
    };



    var bp_product_filter = window.bp_product_filter = {

        data: {},

        /**
         * Call functions when document ready
         */
        init: function () {
            this.nav_filter_js();
        },


        nav_filter_js: function () {

            var $sc = $('.bp-element-product-filter');

            $sc.on('click', '.nav-filter a', function () {

                $sc = $(this).parents('.bp-element-product-filter');

                var current_cat = $sc.find('.nav-filter .cat-item.current a').attr('data-cat');

                $sc.find('.nav-filter .cat-item').removeClass('current');

                $(this).parents('li').addClass('current');


                var params = $sc.attr('data-params'),
                    category = $(this).attr('data-cat'),
                    sc_id = $sc.attr('id');

                var data = {
                    action  : 'bp_product_filter',
                    category: category,
                    params  : params
                };

                bp_product_filter.data[sc_id + current_cat] = $sc.find('.loop-wrapper').html();

                $sc.find('.sc-loop').removeClass('fadeIn');

                if ( bp_product_filter.data[sc_id + category] ) {
                    setTimeout(function () {
                        $sc.find('.loop-wrapper').html(bp_product_filter.data[sc_id + category]);
                        $sc.find('.sc-loop').addClass('fadeIn');
                    }, 300);

                } else {
                    $.ajax({
                        type      : "POST",
                        url       : ajaxurl,
                        data      : data,
                        beforeSend: function () {
                            $sc.addClass('loading');
                        },
                        success: function (res) {
                            if (res.success) {
                                $sc.find('.loop-wrapper').html(res.data);
                                $sc.find('.sc-loop').addClass('fadeIn');
                            }
                            $sc.removeClass('loading');
                        }
                    });
                }

            });

        },


    };

})(jQuery);
