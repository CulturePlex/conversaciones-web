(function ($) {
    "use strict";

    $(document).ready(function () {
        layout_1();
        kindergarten_coundown();
    });

    var layout_1 = function() {
        let countdown = $('.bp-element-countdown .wrap-countdown');

        for (var i = 0; i < countdown.length; i++) {

            var count = $(countdown[i]).find('.countdown'),
                time = count.data('time'),
                labels = [
                    count.data('text-year') ? count.data('text-year') : 'Year(s)',
                    count.data('text-month') ? count.data('text-month') : 'Month(s)',
                    count.data('text-week') ? count.data('text-week') : 'Week(s)',
                    count.data('text-day') ? count.data('text-day') : 'Day(s)',
                    count.data('text-hour') ? count.data('text-hour') : 'Hour(s)',
                    count.data('text-minute') ? count.data('text-minute') : 'Minutes(s)',
                    count.data('text-second') ? count.data('text-second') : 'Second(s)',
                ];

            time = new Date(time);

            var current_time = new Date(time);

            $(countdown[i]).countdown({
                labels: labels,
                until: current_time
            });
        }
    };

    var kindergarten_coundown = function () {
        var counts = $('.tp_event_counter');
        for (var i = 0; i < counts.length; i++) {
            var time = $(counts[i]).attr('data-time'),
                txt_years = $(counts[i]).attr('data-text-year'),
                txt_month = $(counts[i]).attr('data-text-month'),
                txt_week = $(counts[i]).attr('data-text-week'),
                txt_day = $(counts[i]).attr('data-text-day'),
                txt_minute = $(counts[i]).attr('data-text-minute'),
                txt_second = $(counts[i]).attr('data-text-second'),
                txt_hour = $(counts[i]).attr('data-text-hour');
            time = new Date(time);

            var current_time = new Date(time);

            $(counts[i]).countdown({
                labels    : [txt_years, txt_month, txt_week, txt_day, txt_hour, txt_minute, txt_second],
                labels1   : [txt_years, txt_month, txt_week, txt_day, txt_hour, txt_minute, txt_second],
                until     : current_time,
                serverSync: current_time
            });
        }
    }

})(jQuery);