(function($) {
    'use strict';

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
            this.thim_tabs();
            this.thim_tabs_slide();
        },

        /**
         * Call functions when window load.
         */
        load: function() {

        },

        /**
         * thim-tabs
         */
        thim_tabs: function() {
            try {
                $('.js-call-tabs').each(function(){
                    var navTabs = $(this).find('.thim-nav-tabs');
                    var contentTabs = $(this).find('.thim-content-tabs');

                    $(contentTabs).find('.tab-panel').hide();

                    var getPanelActive = $(navTabs).find('.item-nav.active').data('panel');

                    $(contentTabs).find(".tab-panel[data-nav='" + getPanelActive + "']").show();
                    $(contentTabs).find(".tab-panel[data-nav='" + getPanelActive + "']").addClass('active');

                    $(navTabs).find('.item-nav').each(function(){
                        $(this).on('click', function(){
                            var getPanel = $(this).data('panel');

                            $(contentTabs).find('.tab-panel').hide();
                            $(contentTabs).find('.tab-panel').removeClass('active');
                            $(navTabs).find('.item-nav').removeClass('active');

                            $(contentTabs).find(".tab-panel[data-nav='" + getPanel + "']").show();
                            $(contentTabs).find(".tab-panel[data-nav='" + getPanel + "']").addClass('active');
                            $(this).addClass('active');
                        });
                    });

                });
            } catch(er) {console.log(er);}
        },



        thim_tabs_slide: function() {
            try {
                $('.js-call-tabs-slide').each(function(){
                    var navTabs = $(this).find('.thim-nav-tabs');
                    var contentTabs = $(this).find('.thim-content-tabs');
                    var nextArrow = $(this).find('.next-arrow');
                    var prevArrow = $(this).find('.prev-arrow');
                    var itemNav = $(navTabs).find('.item-nav');

                    $(contentTabs).find('.tab-panel').hide();

                    var getPanelActive = $(navTabs).find('.item-nav.active').data('panel');

                    $(contentTabs).find(".tab-panel[data-nav='" + getPanelActive + "']").show();
                    $(contentTabs).find(".tab-panel[data-nav='" + getPanelActive + "']").addClass('active');


                    $(itemNav).each(function(){
                        $(this).on('click', function(){
                            openTab(this);

                            var curentItemNav = Number($(this).data('step'));
                            for(var i=1; i<curentItemNav; i++) {
                                $(navTabs).find(".item-nav[data-step='" + i + "']").addClass('active');
                            }
                        });
                    });

                    $(nextArrow).on('click', function(e) {
                        e.preventDefault();

                        for(var i=0; i<itemNav.length; i++) {
                            if($(itemNav[i]).hasClass('active')) {
                                if (i + 1 >= itemNav.length) {
                                    openTab(itemNav[0]);
                                }
                                else {
                                    openTab(itemNav[i+1]);
                                }
                                break;
                            }
                        }
                    });

                    $(prevArrow).on('click', function(e) {
                        e.preventDefault();

                        for(var i=0; i<itemNav.length; i++) {
                            if($(itemNav[i]).hasClass('active')) {
                                if (i - 1 < 0) {
                                    openTab(itemNav[itemNav.length - 1]);
                                }
                                else {
                                    openTab(itemNav[i-1]);
                                }
                                break;
                            }
                        }
                    });

                    function openTab(thisTab) {
                        var getPanel = $(thisTab).data('panel');

                        $(contentTabs).find('.tab-panel').hide();
                        $(contentTabs).find('.tab-panel').removeClass('active');
                        $(itemNav).removeClass('active');

                        $(contentTabs).find(".tab-panel[data-nav='" + getPanel + "']").show();
                        $(contentTabs).find(".tab-panel[data-nav='" + getPanel + "']").addClass('active');
                        $(thisTab).addClass('active');
                    }
                });
            } catch(er) {console.log(er);}
        },

    };

})(jQuery);