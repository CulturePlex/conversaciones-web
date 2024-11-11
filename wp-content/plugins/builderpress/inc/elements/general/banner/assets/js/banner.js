(function ($) {
    "use strict";

    $(document).ready(function () {
        try {
            $('.popup-youtube').magnificPopup({
                disableOn: 700,
                type: 'iframe',
                mainClass: 'mfp-fade',
                removalDelay: 160,
                preloader: false,

                fixedContentPos: false
            });
        } catch(er) {console.log(er);}

    });

})(jQuery);