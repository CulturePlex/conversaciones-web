<?php
/**
 * Template for displaying default template Banner element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/slide/slide.php.
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
$layout          = isset( $params['layout'] ) ? $params['layout'] : 'coach-life-layout-1';
$main_image      = $params['main_image'];
$background_image= $params['background_image'];
$title           = $params['title'];
$description     = $params['description'];
$link_button     = $params['link_button'];
$link_video_button = $params['link_video_button'];
$style_layout      = !empty($params['style_layout']) ? $params['style_layout'] : '';
$bp_css          = $params['bp_css'];
$el_class        = $params['el_class'];
$el_id           = $params['el_id'];
$bp_css_tablet = $params['bp_css_tablet'];
$bp_css_mobile = $params['bp_css_mobile'];
$data_tablet = $bp_css_tablet ? ' data-class-tablet="' . bp_custom_css_class_shortcode($bp_css_tablet) . '"' : '';
$data_mobile = $bp_css_mobile ? ' data-class-mobile="' . bp_custom_css_class_shortcode($bp_css_mobile) . '"' : '';
$data_tablet = $bp_css_tablet ? ' data-class-tablet="' . bp_custom_css_class_shortcode($bp_css_tablet) . '"' : '';
$data_mobile = $bp_css_mobile ? ' data-class-mobile="' . bp_custom_css_class_shortcode($bp_css_mobile) . '"' : '';

?>

<div class="bp-element bp-element-banner <?php echo esc_attr( $layout ); ?> <?php echo esc_attr($style_layout); ?> <?php echo is_plugin_active('js_composer/js_composer.php') ? vc_shortcode_custom_css_class( $bp_css ) : '';?> <?php echo esc_attr( $el_class ); ?>" <?php echo $el_id ? "id='" . esc_attr( $el_id ) . "'" : '' ?><?php echo $data_tablet;?><?php echo $data_mobile;?>>
    <?php builder_press_get_template( $layout, array(
        'main_image'      => $main_image,
        'background_image'=> $background_image,
        'title'           => $title,
        'description'     => $description,
        'link_button'     => $link_button,
        'link_video_button'=>$link_video_button,
        'params'          => $params
    ), $template_path ); ?>
</div>