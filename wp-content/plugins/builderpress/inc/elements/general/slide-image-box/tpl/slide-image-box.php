<?php
/**
 * Template for displaying default template Slide Image Box element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/slide-image-box/slide-image-box.php.
 *
 * @author      ThimPress
 * @package     BuilderPress/Templates
 * @version     1.0.0
 * @author      Thimpress, leehld
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;
// global params
$template_path   = $params['template_path'];
$layout          = isset( $params['layout'] ) ? $params['layout'] : 'default';
$slide_image_box = $params['slide_image_box'];
$image_box_link  = !empty($params['image_box_link']) ? $params['image_box_link'] : '';
$style           = !empty($params['style']) ? $params['style'] : '';
$style_layout = !empty($params['style_layout']) ? $params['style_layout'] : '';
$link_title      = $params['linktype_title'] ?? '';
$el_class        = $params['el_class'];
$el_id           = $params['el_id'];
$bp_css          = $params['bp_css'];
?>

<div class="bp-element bp-element-slide-image-box <?php echo esc_attr( $layout ); ?> <?php echo esc_attr($style_layout); ?> <?php echo esc_html( $style ); ?> <?php echo is_plugin_active('js_composer/js_composer.php') ? vc_shortcode_custom_css_class( $bp_css ) : '';?> <?php echo esc_attr( $el_class ); ?>" <?php echo $el_id ? "id='" . esc_attr( $el_id ) . "'" : '' ?>>
    <?php builder_press_get_template( $layout, array(
        'slide_image_box' => $slide_image_box,
        'image_box_link'  => $image_box_link,
        'params'          => $params,
        'link_title'      => $link_title,
    ), $template_path ); ?>
</div>
