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
            this.calendar_jqueryui();
        },

        /**
         * Call functions when window load.
         */
        load: function() {

        },

        /**
         * calendar_jqueryui
         */
        calendar_jqueryui : function() {
            try {
                $( ".js-call-calendar" ).each(function(){
                    var arrayDays = [''];
                    var arrayLinks = [''];

                    if ($(this).data('days') != null) {
                        arrayDays = $(this).data('days');
                    }
                    if ($(this).data('link') != null) {
                        arrayLinks = $(this).data('link');
                    }

                    $(this).datepicker({
                        firstDay: 1,
                        dateFormat: 'yy-m-d',

                        onSelect: function(dateSelected, obj) {
                            if(typeof arrayDays === 'object'){
                                for(var te in arrayDays ){
                                    if(arrayDays[te] == dateSelected) {
                                        window.open(arrayLinks[te]);
                                        break;
                                    }
                                }
                            }
                        },

                        beforeShowDay: function(d) {
                            var date = d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate();

                            if(typeof arrayDays === 'object'){
                                for(var te in arrayDays ){
                                    if(arrayDays[te] == date) {
                                        return [true, "have-event", ""];
                                        break;
                                    }
                                }
                            }

                            return [true];
                        }

                    });
                });
            } catch(er) {console.log(er);}
        },

    };

})(jQuery);