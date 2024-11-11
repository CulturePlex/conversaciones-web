<?php
/**
 * Template for displaying default template Demo element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/demo/demo.php.
 *
 * @author      ThimPress
 * @package     BuilderPress/Templates
 * @version     1.0.0
 * @author      Thimpress, vinhnq
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

// global params
$template_path = $params['template_path'];

$layout      = isset( $params['layout'] ) ? $params['layout'] : 'layout-1';

$el_class    = $params['el_class'];
$el_id       = $params['el_id'];
$bp_css      = $params['bp_css'];
$bp_css_tablet = $params['bp_css_tablet'];
$bp_css_mobile = $params['bp_css_mobile'];
$data_tablet = $bp_css_tablet ? 'data-class-tablet="' . bp_custom_css_class_shortcode($bp_css_tablet) . '"' : '';
$data_mobile = $bp_css_mobile ? 'data-class-mobile="' . bp_custom_css_class_shortcode($bp_css_mobile) . '"' : '';
?>

<div class="bp-element bp-element-demo <?php echo esc_attr( $el_class ); ?> <?php echo esc_attr( $layout ); ?> <?php echo is_plugin_active('js_composer/js_composer.php') ? vc_shortcode_custom_css_class( $bp_css ) : '';?>" <?php echo $el_id ? " id='" . esc_attr( $el_id ) . "'" : '' ?> <?php echo $data_tablet;?> <?php echo $data_mobile;?>>
    <?php builder_press_get_template( $layout,
        array(
            'params'      => $params,
        ),
        $template_path );
    ?>
</div>