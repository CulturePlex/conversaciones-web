(function ($) {
    "use strict";

    $(document).ready(function () {

        var services = $('.bp-element-services');

        services.each(function () {
            var el = $(this),
                slider_for = $(el).find('.slider'),
                items_visible = $(this).attr('data-items-visible'),
                items_tablet = $(this).attr('data-items-tablet'),
                items_mobile = $(this).attr('data-items-mobile');

            slider_for.slick({
                slidesToShow: items_visible,
                focusOnSelect: true,
                prevArrow: '<button type="button" class="slick-prev"></button>',
                nextArrow: '<button type="button" class="slick-next"></button>',
                responsive: [
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: items_mobile,
                        }
                    },
                    {
                        breakpoint: 900,
                        settings: {
                            slidesToShow: items_tablet,
                        }
                    }
                ]
            });
        });

    });

})(jQuery);