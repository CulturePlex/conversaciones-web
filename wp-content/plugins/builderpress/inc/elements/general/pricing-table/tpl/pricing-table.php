<?php
/**
 * Template for displaying default template Pricing Table element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/pricing-table/pricing-table.php.
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
if ( ! $params['packages'] ) {
	return;
}
$template_path  = $params['template_path'];
$layout         = !empty($params['layout']) ? $params['layout'] : 'layout-1';
$packages       = $params['packages'];
$number_columns = $params['number_columns'];
$style_layout = !empty($params['style_layout']) ? $params['style_layout'] : '';
$el_class       = $params['el_class'];
$el_id          = $params['el_id'];
$bp_css         = $params['bp_css'];
//$show_icon_features = (!empty($params['show_icon_features'])) ? true : false;
$background_color = (!empty($params['background_color'])) ? $params['background_color']: false ;
?>

<div class="bp-element bp-element-pricing-table <?php echo esc_attr($layout); ?> <?php echo esc_attr($style_layout); ?> <?php echo is_plugin_active('js_composer/js_composer.php') ? vc_shortcode_custom_css_class( $bp_css ) : '';?> <?php echo esc_attr( $el_class ); ?> <?php echo 'number-columns-' . esc_attr( $number_columns ); ?>"> <?php echo $el_id ? "id='" . esc_attr( $el_id ) . "'" : '' ?>
    <?php builder_press_get_template( $layout, array(
        'params'        => $params,
        'packages'      => $packages,
        'number_columns'=> $number_columns,
        'background_color'=> $background_color,
        //'show_icon_features'=> $show_icon_features,
    ), $template_path ); ?>
</div>
