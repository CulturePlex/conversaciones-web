(function ($) {
    "use strict";

    $(document).ready(function () {
        $(document).on('click', '#show_pass', function () {
            var el = $(this),
                thim_pass = el.parents('.login-password').find('>input');
            if (el.hasClass('active')) {
                thim_pass.attr('type', 'password');
            } else {
                thim_pass.attr('type', 'text');
            }
            el.toggleClass('active');
        });
    });

})(jQuery);