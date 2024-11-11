/**
 * Script custom for shortcode
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        bp_startertheme.ready();
    });

    $(window).load(function() {
        bp_startertheme.load();
    });

    var bp_startertheme = {

        /**
         * Call functions when document ready
         */
        ready: function() {
            this.accordion();
        },

        /**
         * Call functions when window load.
         */
        load: function() {

        },

        /**
         * accordion
         */
        accordion: function() {
            try {
                $('.js-call-accordion').each(function(){
                    var wraper = $(this);
                    var items = $(this).find('.js-dropdown');

                    $(items).each(function(){
                        var item = $(this);

                        if($(item).hasClass('active-dropdown')) {
                            $(item).find('.js-dropdown-content').show();
                        }
                        else {
                            $(item).find('.js-dropdown-content').hide();
                        }

                        $(item).find('.js-toggle-dropdown').on('click', function(){
                            if(!$(item).hasClass('active-dropdown')) {
                                $(items).removeClass('active-dropdown');
                                $(items).find('.js-dropdown-content').slideUp();

                                $(item).toggleClass('active-dropdown');
                                $(item).find('.js-dropdown-content').slideDown();
                            }
                            else {
                                $(items).removeClass('active-dropdown');
                                $(items).find('.js-dropdown-content').slideUp();
                            }
                        });
                    })

                });
            } catch(er) {console.log(er);}
        },
    };

})(jQuery);