(function ($) {
    "use strict";

    $(document).ready(function () {
        var $carousel = $('.bp-element-product-carousel');

        $carousel.each(function () {
            var items_visible = $(this).data('items-visible'),
                items_tablet = $(this).data('items-tablet'),
                items_mobile = $(this).data('items-mobile'),
                dots = $(this).attr('data-nav'),
                rtl = $('body').hasClass('rtl');

            $(this).find('.owl-carousel').owlCarousel({
                    dots: dots,
                    rtl: rtl,
                    margin: 30,
                    responsive: {
                        0: {
                            items: items_mobile,
                        },
                        768: {
                            items: items_tablet,
                        },
                        1200: {
                            items: items_visible,
                        }
                    },
                }
            )
        });
    });

})(jQuery);