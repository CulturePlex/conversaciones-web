
(function ($) {
    "use strict";

    $(document).ready(function () {

        let our_team = $('.bp-element-our-team:not(.layout-4)');

        our_team.each(function () {
            let items_visible = $(this).attr('data-items-visible'),
                items_tablet = $(this).attr('data-items-tablet'),
                items_mobile = $(this).attr('data-items-mobile'),
                rtlval = $('body').hasClass('rtl');

            $(this).find('.our-team').each(function () {
                $(this).owlCarousel({
                    loop: false,
                    nav: false,
                    autoplay: false,
                    autoPlaySpeed: 5000,
                    rtl: rtlval,
                    navText: [
                        "<i class=\'fa fa-angle-left\'></i>",
                        "<i class=\'fa fa-angle-right\'></i>"
                    ],
                    responsiveClass: true,
                    responsive: {
                        0: {
                            items: items_mobile,
                        },
                        768: {
                            items: items_tablet,
                        },
                        1280: {
                            items: items_visible,
                        }
                    }
                });
            });
        })

    });

})(jQuery);

