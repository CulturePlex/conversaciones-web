(function ($) {
    "use strict";

    $(window).load(function () {
        bp_gallery_images.ready();
    });


    var bp_gallery_images_reload = 0;

    var bp_gallery_images = window.$bp_gallery_images = {

        ready: function () {
            this.layout1();
            this.popup_image();
        },

        layout1: function () {

            var $sc = $('.bp-element-gallery-images.layout-1');

            $sc.each(function () {
                var $this = $(this);
                var $slider = $this.find('.grid-wrapper');
                $slider.isotope({
                    layoutMode     : 'packery',
                    itemSelector   : '.grid-item',
                    columnWidth    : '.grid-item',
                    gutter         : 20,
                    percentPosition: true
                });


                $(window).on("scroll", function () {
                    if (bp_gallery_images_reload <= 5) {
                        $slider.isotope('layout');
                        bp_gallery_images_reload++;
                    }
                });
            });

        },


        popup_image: function () {
            $('.bp-popup-image').magnificPopup({
                type   : 'image',
                fixedContentPos: false,
                gallery: {
                    enabled: true
                }
            });
        },

    };

})(jQuery);