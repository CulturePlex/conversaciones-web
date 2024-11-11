(function ($) {
    "use strict";

    $(document).ready(function () {
        bp_element_search_video.search_ajax();
    });

    var bp_element_search_video = {

        search_ajax: function () {
            var $sc_wrapper = $('.bp-element-st-search-videos .wrap-element');

            $sc_wrapper.on('change', 'select[name="cat_filter"]', function (event) {
                    clearTimeout($.data(this, 'timer'));
                    $(this).data('timer', setTimeout(bp_element_search_video.livesearch($sc_wrapper), 700));
            }),

            $sc_wrapper.on('keyup', '.search-field', function (event) {
            // $('.bp-element-st-search-videos .wrap-element .search-field').keyup(function (event) {
                var selected = $(".ob-selected");

                clearTimeout($.data(this, 'timer'));
                if (event.which === 13) {
                    event.preventDefault();
                    $(this).stop();
                } else if (event.which === 38) {
                    if (navigator.userAgent.indexOf('Chrome') !== -1 && parseFloat(navigator.userAgent.substring(navigator.userAgent.indexOf('Chrome') + 7).split(' ')[0]) >= 15) {
                        if ($sc_wrapper.find(".list-search-videos li").length > 1) {
                            $sc_wrapper.find(".list-search-videos li").removeClass("ob-selected");
                            // if there is no element before the selected one, we select the last one
                            if (selected.prev().length === 0) {
                                selected.siblings().last().addClass("ob-selected");
                            } else { // otherwise we just select the next one
                                selected.prev().addClass("ob-selected");
                            }
                        }
                    }
                } else if (event.which === 40) {
                    if (navigator.userAgent.indexOf('Chrome') !== -1 && parseFloat(navigator.userAgent.substring(navigator.userAgent.indexOf('Chrome') + 7).split(' ')[0]) >= 15) {
                        if ($sc_wrapper.find(".list-search-videos li").length > 1) {
                            $sc_wrapper.find(".list-search-videos li").removeClass("ob-selected");

                            // if there is no element before the selected one, we select the last one
                            if (selected.next().length === 0) {
                                selected.siblings().first().addClass("ob-selected");
                            } else { // otherwise we just select the next one
                                selected.next().addClass("ob-selected");
                            }
                        }
                    }
                } else if (event.which === 27) {
                    $sc_wrapper.find('.list-search-videos').html('');
                    $(this).val('');
                    $(this).stop();
                } else if (event.which === 8) {
                    $sc_wrapper.find('.list-search-videos').html('');
                } else {
                     $(this).data('timer', setTimeout(bp_element_search_video.livesearch($sc_wrapper), 700));
                }
            });
            // $('.bp-element-st-search-videos .wrap-element .search-field').keypress(function (event) {
              $sc_wrapper.on('keypress', '.search-field', function (event) {

                var selected = $(".ob-selected");

                if (event.keyCode === 13) {
                    if (selected.length > 0) {
                        var ob_href = selected.find('a').first().attr('href');
                        window.location.href = ob_href;
                    }
                    event.preventDefault();
                }
                if (event.keyCode === 38) {
                    // if there is no element before the selected one, we select the last one
                    if ($sc_wrapper.find(".list-search-videos li").length > 1) {
                        $sc_wrapper.find(".list-search-videos li").removeClass("ob-selected");
                        if (selected.prev().length === 0) {
                            selected.siblings().last().addClass("ob-selected");
                        } else { // otherwise we just select the next one
                            selected.prev().addClass("ob-selected");
                        }
                    }
                }
                if (event.keyCode === 40) {
                    if ($sc_wrapper.find(".list-search-videos li").length > 1) {
                        $sc_wrapper.find(".list-search-videos li").removeClass("ob-selected");
                        // if there is no element before the selected one, we select the last one
                        if (selected.next().length === 0) {
                            selected.siblings().first().addClass("ob-selected");
                        } else { // otherwise we just select the next one
                            selected.next().addClass("ob-selected");
                        }
                    }
                }
            });

            $sc_wrapper.find('.list-search-videos,.search-field').on('click', function (event) {
                event.stopPropagation();
            });

            $(document).on('click', function () {
                $sc_wrapper.find(".list-search-videos li").remove();
            });
        },

        livesearch: function (element, waitKey) {
            // var keyword = $(element).find('.search-field').val();
            var keyword = $(element).find('.search-field').val();
            var cat_filter = $(element).find('select[name="cat_filter"]').val();
            var $sc_wrapper = $(element);
            console.log($(element));
            console.log(keyword);
            if (keyword) {
                if (!waitKey && keyword.length < 3) {
                    return;
                }
                $sc_wrapper.addClass('loading');
                $.ajax({
                    type: 'POST',
                    data: 'action=builderpress_search_video_ajax&keyword=' + keyword + '&cat_filter=' + cat_filter + 'from=search',
                    url: ajaxurl,
                    success: function (res) {
                        var data_li = '';
                        var items = res.data;
                        if (res.success) {
                            $.each(items, function (index) {
                                if (index === 0) {
                                    data_li += '<li class="ui-menu-item' + this.id + ' ob-selected"><a class="ui-corner-all" href="' + this.guid + '">' + this.title + '</a></li>';
                                } else {
                                    data_li += '<li class="ui-menu-item' + this.id + '"><a class="ui-corner-all" href="' + this.guid + '">' + this.title + '</a></li>';
                                }
                            });
                            $sc_wrapper.find('.list-search-videos').html('').append(data_li);
                        }
                        bp_element_search_video.searchHover();
                        $sc_wrapper.removeClass('loading');
                    },
                });
            }
        },

        searchHover: function () {
            var $sc_wrapper = $('.bp-element-st-search-videos .wrap-element');
            $sc_wrapper.on('hover', '.list-search-videos li', function () {
                $sc_wrapper.find('.list-search-videos li').removeClass('ob-selected');
                $(this).addClass('ob-selected');
            });
        },

        searchFocus: function () {
            var $sc_wrapper = $('.bp-element-st-search-videos .wrap-element');
            $sc_wrapper.each(function (index, form) {
                $(form).on('hover', 'form', function () {
                    $(form).find('.search-field').focus();
                });
            });
        },

    }

})(jQuery);