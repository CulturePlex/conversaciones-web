
/* jQuery CountTo */
(function ($) {
    "use strict";

    $(document).ready(function() {
        thim_startertheme.ready();
    });

    $(window).load(function() {
        thim_startertheme.load();
    });

    var thim_startertheme = {
        /**
         * Call functions when document ready
         */
        ready: function() {
            this.bp_popup_gallery();
        },
        /**
         * Call functions when window load.
         */
        load: function() {
            this.bp_grid_isotope();
        },
        bp_grid_isotope: function() {
            if ( $().isotope ) {
                $('.grid').isotope({
                    // set itemSelector so .grid-sizer is not used in layout
                    itemSelector: '.grid-item',
                    percentPosition: true,
                    masonry: {
                        // use element for option
                        columnWidth: '.grid-sizer'
                    }
                })
            }
        },

        /**
         * Magnific-Popup
         */
        bp_popup_gallery: function() {
            try {
                $('.gallery-popup').each(function() {
                    $(this).find('.js-show-gallery').magnificPopup({
                        type: 'image',
                        fixedContentPos: false,
                        gallery: {
                            enabled:true
                        },
                        mainClass: 'mfp-fade'
                    });
                });
            } catch(er) {console.log(er);}
        },
    }

})(jQuery);