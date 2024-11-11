<?php
/**
 * Template for displaying default template Tabs element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/tabs/tabs.php.
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

if ( ! $params['tabs'] ) {
	return;
}

// global params
$template_path = $params['template_path'];

/**
 * @var $params array - shortcode params
 */
$layout   = $params['layout'];
$tabs     = $params['tabs'];
$el_class = $params['el_class'];
$el_id    = $params['el_id'];
$bp_css   = $params['bp_css'];
$style_layout = !empty($params['style_layout']) ? $params['style_layout'] : '';
?>

<div class="bp-element bp-element-tabs <?php echo is_plugin_active('js_composer/js_composer.php') ? vc_shortcode_custom_css_class( $bp_css ) : '';?> <?php echo esc_attr( $layout ); ?> <?php echo esc_attr($style_layout); ?> <?php echo esc_attr( $el_class ); ?>" <?php echo $el_id ? "id='" . esc_attr( $el_id ) . "'" : '' ?>>

	<?php builder_press_get_template( $layout, array(
		'tabs'   => $tabs,
		'params' => $params
	), $template_path ); ?>

</div>