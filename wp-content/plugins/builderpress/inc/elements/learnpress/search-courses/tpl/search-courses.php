<?php
/**
 * Template for displaying default template Search Posts element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/search-posts/search-categories.php.
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

/**
 * @var $params array - shortcode params
 */
// global params
$template_path = $params['template_path'];

// element params
$layout      = isset($params['layout'])? $params['layout'] : 'layout-1' ;
$title       = $params['title'];
$style_layout = !empty($params['style_layout']) ? $params['style_layout'] : '';
$el_class    = $params['el_class'];
$el_id       = $params['el_id'];
$bp_css      = $params['bp_css'];
?>

<div class="bp-element bp-element-search-courses <?php echo is_plugin_active('js_composer/js_composer.php') ? vc_shortcode_custom_css_class( $bp_css ) : '';?> <?php echo esc_attr( $layout ); ?> <?php echo esc_attr($style_layout); ?> <?php echo esc_attr( $el_class ); ?>" <?php echo $el_id ? "id='" . esc_attr( $el_id ) . "'" : '' ?>>

    <?php builder_press_get_template( $layout, array(
        'title'       => $title,
        'params'      => $params
    ), $template_path ); ?>

</div>