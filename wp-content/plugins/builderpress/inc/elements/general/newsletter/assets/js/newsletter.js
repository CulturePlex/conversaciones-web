(function ($) {
    "use strict";

    $(document).ready(function () {
        popup_form();
    });

    /**
     * Magnic popup
     */
    var popup_form = function () {
        $('.js-popup-form').magnificPopup({
            type: 'inline',
            fixedContentPos: false,
            preloader: false,
            focus: '#name',

            // When elemened is focused, some mobile browsers in some cases zoom in
            // It looks not nice, so we disable it:
            callbacks: {
                beforeOpen: function() {
                    this.st.mainClass = this.st.el.attr('data-effect');

                    if($(window).width() < 700) {
                        this.st.focus = false;
                    } else {
                        this.st.focus = '#name';
                    }
                }
            }
        });
    }

})(jQuery);