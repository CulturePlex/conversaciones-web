(function ($) {
    "use strict";

    $(document).ready(function () {
        button_scroll();
    });

    /**
     * menu_scroll
     */
    var button_scroll = function() {
        try {
            $('.js-call-menu-scroll').on('click', function(event){
                event.preventDefault();
                $('html, body').animate({scrollTop: $($(this).attr('href')).offset().top}, 500);
            });

        } catch(er) {console.log(er);}
    }


})(jQuery);