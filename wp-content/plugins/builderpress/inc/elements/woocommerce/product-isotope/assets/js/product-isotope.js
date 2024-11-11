(function ($) {
    "use strict";


    $(document).ready(function () {

        jQuery(document).on('click', '.product-tabs li a', function (e) {
            e.preventDefault();
            var $this = $(this),
            myClass = $this.attr("data-filter");

            $('.bp-element-product-isotope .product-tabs').find("li a").removeClass("active");
            $this.addClass("active");
            $('.bp-element-product-isotope .product-grid').isotope({ filter: myClass });
        });


        var $shortcodes = $('.bp-element-product-isotope .product-grid');

        $('.pagination-loadmore').on('click', function (event) {
            event.preventDefault();


            var $count = $('.type-product').length,
                page = 2,
                params = $('.bp-element-product-isotope').attr('data-params'),
                max_page = parseInt($('.bp-element-product-isotope').attr('data-max-page'));

            if ( page <= 2 && page <= max_page) {

                var button = $(this),
                    data = {
                        action  : 'bp_product_isotope_loadmore',
                        offset  : $count,
                        page    : page,
                        params  : params,
                    };

                $.ajax({
                    url       : ajaxurl, // AJAX handler
                    data      : data,
                    type      : 'POST',
                    beforeSend: function () {
                        button.addClass('loading');
                    },
                    success   : function (res) {
                        if ( res ) {
                            $shortcodes.append(res.data);
                            page = page + 1;
                        } else {
                            button.removeClass('loading');
                        }
                    }
                });
            }

        });

    });

})(jQuery);