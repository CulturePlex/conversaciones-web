jQuery(function ($) {
    $(document).ready(function () {
        thim_custom_admin_select();
        thim_ivy_30_install_demo();
        thim_vc_template_ui.init();
    });

    var thim_vc_template_ui = window.thim_vc_template_ui = { 

        init: function () {
            this.vc_filter_template();
            this.vc_effect_add_template();
        },

        /**
         * Filter category
         */
        vc_filter_template: function () {
            $('.cat-filter').on('click', 'li', function (e) {
                var catslug = $(this).attr('data-filter');
                $('.cat-filter li').removeClass('active');
                $(this).addClass('active');
                $('[data-tab=default_templates]').find('.vc_ui-template').hide();
                console.log(catslug);
                $('[data-tab=default_templates]').find('.' + catslug).show();
            });

        },

        /**
         * Add loading when click on add template button.
         */
        vc_effect_add_template: function () {
            $('.vc_ui-list-bar-item-actions').on('click', function () {
                $(this).addClass('adding');
            });
            $(document).ajaxComplete(function () {
                $('.vc_ui-list-bar-item-actions').removeClass('adding');
            });
        },


    };


    function thim_custom_admin_select() {
        $('#customize-control-thim_page_builder_chosen select').on('change', function () {
            if ($(this).val() == "visual_composer") {
                $('#customize-control-thim_footer_bottom_bg_img').show();
            } else {
                $('#customize-control-thim_footer_bottom_bg_img').hide();
            }
        }).trigger('change');
    }


    function thim_ivy_30_install_demo() {
        if ($('.tc-importer-wrapper').length == 0) {
            return;
        }
        if ($('.tc-importer-wrapper .theme.installed[data-thim-demo^=demo-vc]').length > 0) {
            $('.tc-importer-wrapper').addClass('visual_composer');
        }
        if ($('.tc-importer-wrapper .theme.installed[data-thim-demo^=demo-so]').length > 0) {
            $('.tc-importer-wrapper').addClass('site_origin');
        }
        if ($('.tc-importer-wrapper .theme.installed[data-thim-demo^=demo-elementor]').length > 0) {
            $('.tc-importer-wrapper').addClass('elementor');
        }

        if ($('.tc-importer-wrapper .theme.installed').length > 0) {
            return;
        } else {
            $('.tc-importer-wrapper').addClass('elementor');
        }
        

        var $html = '<div class="thim-choose-page-builder"><h3 class="title">Please select page builder before Import Demo.</h3>';
        $html += '<select id="thim-select-page-builder">';
        $html += '<option value="elementor">Elementor</option>';
        $html += '<option value="visual_composer">Visual Composer</option>';
         $html += '</select></div>';

        $('.tc-importer-wrapper').prepend($html);

        if ($('#thim-select-page-builder').val() === '') {
            $('.tc-importer-wrapper').addClass('overlay');
        }

        $(document).on('change', '#thim-select-page-builder', function () {

            var elem = $(this),
                elem_val = elem.val(),
                elem_parent = elem.parents('.tc-importer-wrapper'),
                data = {
                    action: 'thim_update_theme_mods',
                    thim_key: 'thim_page_builder_chosen',
                    thim_value: elem_val
                };

            if (elem_val !== '') {
                elem_parent.removeClass('visual_composer');
                elem_parent.removeClass('site_origin');
                elem_parent.removeClass('elementor');
                elem_parent.addClass(elem_val);

                elem_parent.removeClass('overlay').addClass('loading');
                $.post(ajaxurl, data, function (response) {
                    console.log(response);
                    elem_parent.removeClass('loading');
                });
            } else {
                elem_parent.addClass('overlay');
            }

        });
    }

    var custom_uploader;
    $(document).on('click', '#image_level', function (e) {
        //e.preventDefault();
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            //return;
        }



        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function () {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            jQuery('#image_level').val(attachment.url);


            //Open the uploader dialog
            custom_uploader.close();
        });
    });
});
