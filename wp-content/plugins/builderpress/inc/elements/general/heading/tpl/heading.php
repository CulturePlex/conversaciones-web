<?php
/**
 * Template for displaying default template Heading element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/heading/heading.php.
 *
 * @author      ThimPress
 * @package     BuilderPress/Templates
 * @version     1.0.0
 * @author      Thimpress, leehld
 */

/**
 * Prevent loading this file directly
 */
defined('ABSPATH') || exit;

/**
 * @var $params array - shortcode params
 */

// global params
$template_path = $params['template_path'];

$layout = isset($params['layout']) ? $params['layout'] : 'layout-1';
$align = $params['align'];
$el_class = $params['el_class'];
$style_layout = !empty($params['style_layout']) ? $params['style_layout'] : '';
$el_id = $params['el_id'];
$bp_css = $params['bp_css'];
$bp_css_tablet = $params['bp_css_tablet'];
$bp_css_mobile = $params['bp_css_mobile'];
$data_tablet = $bp_css_tablet ? ' data-class-tablet="' . bp_custom_css_class_shortcode($bp_css_tablet) . '"' : '';
$data_mobile = $bp_css_mobile ? ' data-class-mobile="' . bp_custom_css_class_shortcode($bp_css_mobile) . '"' : '';

// title style
$title_css = '';
$title_css .= $params['title_max_width'] ? 'max-width:' . $params['title_max_width'] . 'px; ' : '';
$title_css .= $params['title_color'] ? 'color:' . $params['title_color'] . '; ' : '';
$title_css .= $params['title_line_height'] ? 'line-height:' . $params['title_line_height'] . '; ' : '';
$title_css .= $params['title_font_size'] ? 'font-size:' . $params['title_font_size'] . 'px; ' : '';
$title_css .= $params['title_font_weight'] ? 'font-weight:' . $params['title_font_weight'] . '; ' : '';
$title_css .= $params['title_text_transform'] ? 'text-transform:' . $params['title_text_transform'] . '; ' : '';
$title_css .= $params['title_margin'] ? 'margin:' . $params['title_margin'] . '; ' : '';
$title_css = $title_css ? ' style="' . $title_css . '"' : '';
$title_tag = $params['title_tag'] ? $params['title_tag'] : 'h3';

// sub title style
$sub_title_css = '';
$sub_title_css .= $params['title_max_width'] ? 'max-width:' . $params['title_max_width'] . 'px; ' : '';
$sub_title_css .= $params['sub_title_color'] ? 'color:' . $params['sub_title_color'] . '; ' : '';
$sub_title_css .= $params['sub_title_line_height'] ? 'line-height:' . $params['sub_title_line_height'] . '; ' : '';
$sub_title_css .= $params['sub_title_font_size'] ? 'font-size:' . $params['sub_title_font_size'] . 'px; ' : '';
$sub_title_css .= $params['sub_title_font_weight'] ? 'font-weight:' . $params['sub_title_font_weight'] . '; ' : '';
$sub_title_css .= $params['sub_title_text_transform'] ? 'text-transform:' . $params['sub_title_text_transform'] . '; ' : '';
$sub_title_css .= $params['sub_title_margin'] ? 'margin:' . $params['sub_title_margin'] . '; ' : '';
$sub_title_css = $sub_title_css ? ' style="' . $sub_title_css . '"' : '';

// line style
$line_css = '';
$line_css .= $params['line_height'] ? 'height:' . $params['line_height'] . 'px; ' : '';
$line_css .= $params['line_width'] ? 'width:' . $params['line_width'] . 'px; ' : '';
$line_css .= $params['line_color'] ? 'background-color:' . $params['line_color'] . '; ' : ''; //hieu edit
$line_css .= !empty($params['color_line']) ? 'color:' . $params['color_line'] . '; ' : '';
$line_css .= $params['line_margin'] ? 'margin:' . $params['line_margin'] . '; ' : '';
$line_css = $line_css ? ' style="' . $line_css . '"' : '';

// description style
$des_css = '';
$des_css .= $params['desc_color'] ? 'color:' . $params['desc_color'] . '; ' : '';
$des_css .= $params['desc_font_weight'] ? 'font-weight:' . $params['desc_font_weight'] . '; ' : '';
$des_css .= $params['desc_font_size'] ? 'font-size:' . $params['desc_font_size'] . 'px; ' : '';
$des_css .= $params['desc_margin'] ? 'margin:' . $params['desc_margin'] . '; ' : '';
$des_css = $des_css ? ' style="' . $des_css . '"' : '';
?>

<div class="bp-element bp-element-heading <?php echo is_plugin_active('js_composer/js_composer.php') ? vc_shortcode_custom_css_class( $bp_css ) : '';?> <?php echo esc_attr($align); ?> <?php echo esc_attr($layout); ?> <?php echo esc_attr($style_layout); ?> <?php echo esc_attr($el_class); ?>" <?php echo $el_id ? "id='" . esc_attr($el_id) . "'" : '' ?><?php echo $data_tablet;?><?php echo $data_mobile;?>>
    <?php builder_press_get_template($layout,
        array(
            'params' => $params,
            'title_tag' => $title_tag,
            'title_css' => $title_css,
            'sub_title_css' => $sub_title_css,
            'line_css' => $line_css,
            'des_css' => $des_css
        ),
        $template_path);
    ?>
</div>