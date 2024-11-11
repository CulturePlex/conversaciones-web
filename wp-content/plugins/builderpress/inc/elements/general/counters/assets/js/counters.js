/* jQuery CountTo */
(function ($) {
    "use strict";

    $(document).ready(function () {
        bp_element_counter_box.init();
    });

    var bp_element_counter_box = {
        init: function () {
            var waypoint = void 0 !== $.fn.waypoint;

            bp_element_counter_box.counter();

            var counter = $('.bp-element-counters .number_counter');

            counter.waypoint(function () {
                var $this = $(this);
                if (!$this.hasClass('animated')) {
                    var number = $this.data('number'),
                        unit = $this.data('unit'),
                        separator = $this.data('separator') ? $this.data('separator') : '';
                    $this.countTo({
                        from: 0,
                        to: number,
                        refreshInterval: 40,
                        speed: 1000,
                        formatter: function (value, options) {
                            value = value.toFixed();

                            return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, separator) + unit;
                        }
                    });

                    $this.addClass('animated');
                }
            }, {
                offset: $(window).height()
            });
        },


        counter: function () {
            var a = $;
            a.fn.countTo = function (g) {
                g = g || {};
                return a(this).each(function () {
                    function e(a) {
                        a = b.formatter.call(h, a, b);
                        f.html(a);
                    }

                    var b = a.extend({}, a.fn.countTo.defaults, {
                            from: a(this).data("from"),
                            to: a(this).data("to"),
                            speed: a(this).data("speed"),
                            refreshInterval: a(this).data("refresh-interval"),
                            decimals: a(this).data("decimals")
                        }, g), j = Math.ceil(b.speed / b.refreshInterval), l = (b.to - b.from) / j, h = this, f = a(this),
                        k = 0, c = b.from, d = f.data("countTo") || {};
                    f.data("countTo", d);
                    d.interval && clearInterval(d.interval);
                    d.interval =
                        setInterval(function () {
                            c += l;
                            k++;
                            e(c);
                            "function" === typeof b.onUpdate && b.onUpdate.call(h, c);
                            k >= j && (f.removeData("countTo"), clearInterval(d.interval), c = b.to, "function" === typeof b.onComplete && b.onComplete.call(h, c));
                        }, b.refreshInterval);
                    e(c);
                });
            };
            a.fn.countTo.defaults = {
                from: 0, to: 0, speed: 1E3, refreshInterval: 100, decimals: 0, formatter: function (a, e) {
                    a = a.toFixed(e.decimals);
                    return a;
                }, onUpdate: null, onComplete: null
            };
        },
    }
})(jQuery);
