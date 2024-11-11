(function ($) {
    "use strict";

    $(document).ready(function () {
        bp_element_search_courses.search_layout_2();
        bp_element_search_courses.search_courses_ajax();
        bp_element_search_courses.search_courses_popup();
    });

    var bp_element_search_courses = {

        search_layout_2: function () {
            $('.thim-search-box').on('click', '.toggle-form', function (e) {
                e.preventDefault();
                $('body').toggleClass('thim-active-search');
                var $search = $(this).parent();
                $search.find('.search-default').slideDown();
                $search.find('.search-found').slideUp();
                setTimeout(function () {
                    $search.find('.search-field').focus().val('');
                }, 400);
            });

            $(".thim-search-box form").submit(function () {
                var input_search = $(this).find("input.search-field");
                if ($.trim(input_search.val()) === "") {
                    input_search.focus();
                    return false;
                }
            });

            $('#main-content').on('click', function () {
                if ($('body').hasClass('thim-active-search')) {
                    $('body').removeClass('thim-active-search');
                    var $search = $('#masthead .thim-search-box');
                    $search.each(function (index, form) {
                        $(form).find('.search-default').slideDown();
                        $(form).find('.search-found').slideUp();
                    });
                }
            });

            $('.icon-close').on('click', function () {
                if ($('body').hasClass('thim-active-search')) {
                    $('body').removeClass('thim-active-search');
                }
            });

            $(window).scroll(function() {
                $('body').removeClass('thim-active-search');
            });
        },


        search_courses_ajax: function () {
            var $sc_wrapper = $('.bp-element-search-courses .search-form');

            $sc_wrapper.on('keyup', '.search-field', function (event) {

                var selected = $(".ob-selected");

                clearTimeout($.data(this, 'timer'));
                if (event.which === 13) {
                    event.preventDefault();
                    $(this).stop();
                } else if (event.which === 38) {
                    if (navigator.userAgent.indexOf('Chrome') !== -1 && parseFloat(navigator.userAgent.substring(navigator.userAgent.indexOf('Chrome') + 7).split(' ')[0]) >= 15) {
                        if ($sc_wrapper.find(".list-search li").length > 1) {
                            $sc_wrapper.find(".list-search li").removeClass("ob-selected");
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
                        if ($sc_wrapper.find(".list-search li").length > 1) {
                            $sc_wrapper.find(".list-search li").removeClass("ob-selected");

                            // if there is no element before the selected one, we select the last one
                            if (selected.next().length === 0) {
                                selected.siblings().first().addClass("ob-selected");
                            } else { // otherwise we just select the next one
                                selected.next().addClass("ob-selected");
                            }
                        }
                    }
                } else if (event.which === 27) {
                    $sc_wrapper.find('.list-search').html('');
                    $(this).val('');
                    $(this).stop();
                } else if (event.which === 8) {
                    $sc_wrapper.find('.list-search').html('');
                } else {
                    $(this).data('timer', setTimeout(bp_element_search_courses.livesearch(this), 700));
                }
            });

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
                    if ($sc_wrapper.find(".list-search li").length > 1) {
                        $sc_wrapper.find(".list-search li").removeClass("ob-selected");
                        if (selected.prev().length === 0) {
                            selected.siblings().last().addClass("ob-selected");
                        } else { // otherwise we just select the next one
                            selected.prev().addClass("ob-selected");
                        }
                    }
                }
                if (event.keyCode === 40) {
                    if ($sc_wrapper.find(".list-search li").length > 1) {
                        $sc_wrapper.find(".list-search li").removeClass("ob-selected");
                        // if there is no element before the selected one, we select the last one
                        if (selected.next().length === 0) {
                            selected.siblings().first().addClass("ob-selected");
                        } else { // otherwise we just select the next one
                            selected.next().addClass("ob-selected");
                        }
                    }
                }
            });

            $sc_wrapper.find('.list-search,.search-field').on('click', function (event) {
                event.stopPropagation();
            });

            $(document).on('click', function () {
                $sc_wrapper.find(".list-search li").remove();
            });

        },

        livesearch: function (element, waitKey) {
            var keyword = $(element).val();

            var $sc_wrapper = $('.bp-element-search-courses .search-form');
            if (keyword) {
                if (!waitKey && keyword.length < 3) {
                    return;
                }
                $sc_wrapper.addClass('loading');
                $.ajax({
                    type: 'POST',
                    data: 'action=builderpress_search_courses_ajax&keyword=' + keyword + '&from=search',
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

                            $sc_wrapper.find('.list-search').html('').append(data_li);
                        }
                        bp_element_search_courses.searchHover();
                        $sc_wrapper.removeClass('loading');
                    },
                });
            }
        },

        searchHover: function () {
            var $sc_wrapper = $('.bp-element-search-courses .search-form');
            $sc_wrapper.on('hover', '.list-search li', function () {
                $sc_wrapper.find('.list-search li').removeClass('ob-selected');
                $(this).addClass('ob-selected');
            });
        },

        search_courses_popup: function () {
            var $search = $('.bp-element-search-courses'),
                $search_button = $search.find('.search-button'),
                $header = $('#masthead.sticky-header'),
                $searchField = $search.find('.search-field'),
                windoH = $(window).height();
            $('.bp-element-search-courses').find('.search-form').css('height', windoH);
            $search_button.on('click', function (event) {
                $(this).parents('.bp-element-search-courses').find('.search-form').addClass('open');
                setTimeout(function() { $searchField.focus(); }, 800);
                $(document).on('keydown', function (e) {
                    // ESCAPE key pressed
                    if (e.keyCode === 27) {
                        $(this).find('.search-form').removeClass('open');
                    }
                });
            });
            $(document).on('click', '.close-form', function (e) {
                e.stopPropagation();
                $(this).parents('.search-form').removeClass('open');
            });

            $(window).scroll(function () {
                var window2 = windoH;

                if ($header.hasClass('menu-hidden')) {
                    window2 = windoH + $header.height() + 40;
                    $('.bp-element-search-courses.layout-1').find('.search-form').css('height', window2);
                }

            });
        }
    }

})(jQuery);