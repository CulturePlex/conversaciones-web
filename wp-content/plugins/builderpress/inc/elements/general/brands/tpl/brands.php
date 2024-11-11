<?php
/**
 * Template for displaying default template Brands element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/brands/brands.php.
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

$layout        = isset( $params['layout'] ) ? $params['layout'] : 'layout-1';
$brands        = isset( $params['items'] ) ? $params['items'] : '';
$brands_title  = isset( $params['items_title'] ) ? $params['items_title'] : '';
$items_visible = $params['items_visible'];
$items_tablet  = $params['items_tablet'];
$items_mobile  = $params['items_mobile'];
$pagination    = $params['pagination'];
$style_layout  = !empty($params['style_layout']) ? $params['style_layout'] : '';
$el_class      = $params['el_class'];
$el_id         = $params['el_id'];
$bp_css        = $params['bp_css'];
?>

<div class="bp-element bp-element-brands <?php echo esc_attr($style_layout); ?> <?php echo is_plugin_active('js_composer/js_composer.php') ? vc_shortcode_custom_css_class( $bp_css ) : '';?> <?php echo esc_attr( $layout ); ?> <?php echo esc_attr( $el_class ); ?>" <?php echo $el_id ? "id='" . esc_attr( $el_id ) . "'" : '' ?>>

	<?php builder_press_get_template( $layout, array(
		'brands'        => $brands,
		'items_title'   => $brands_title,
		'params'        => $params,
		'items_tablet'  => $items_tablet,
		'items_visible' => $items_visible,
		'items_mobile'  => $items_mobile
	), $template_path ); ?>

</div>