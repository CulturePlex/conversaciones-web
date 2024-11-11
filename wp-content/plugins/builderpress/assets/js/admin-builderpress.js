(function ($) {

    $(document).ready(function () {

        $('#bp-admin-page .tabs a').click(function(e){
            e.preventDefault();
            var $this = $(this),
                content = '#'+$this.parents('.tabs').data('content'),
                others = $this.closest('li').siblings().children('a'),
                target = $this.attr('href');

            others.removeClass('active');
            $this.addClass('active');
            $(content).children('div').hide();
            $(target).show();
        })

    });

})(jQuery);