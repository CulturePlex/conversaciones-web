<?php
/**
 * Template for displaying default template Our Team element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/our-team/our-team.php.
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

if ( ! $params['members'] ) {
	return;
}
// global params
$template_path = $params['template_path'];
$layout        = $params['layout'];
$members       = $params['members'];
$items_visible = $params["items_visible"];
$items_tablet  = $params["items_tablet"];
$items_mobile  = $params["items_mobile"];
$el_class      = $params['el_class'];
$el_id         = $params['el_id'];
$bp_css   = $params['bp_css'];
$background_color = (!empty($params['background_color'])) ? $params['background_color']: false;
$style_layout = !empty($params['style_layout']) ? $params['style_layout'] : '';
?>

<div class="bp-element bp-element-our-team <?php echo esc_attr($layout); ?> <?php echo esc_attr($style_layout); ?> <?php echo is_plugin_active('js_composer/js_composer.php') ? vc_shortcode_custom_css_class( $bp_css ) : '';?> <?php echo esc_attr( $el_class ); ?>" <?php echo $el_id ? "id='" . esc_attr( $el_id ) . "'" : '' ?>
     data-items-visible="<?php echo esc_attr( $items_visible ); ?>"
     data-items-tablet="<?php echo esc_attr( $items_tablet ); ?>"
     data-items-mobile="<?php echo esc_attr( $items_mobile ); ?>">

    <?php builder_press_get_template( $layout, array(
        'params'        => $params,
        'members'  => $members,
        'items_visible' => $items_visible,
        'items_tablet'  => $items_tablet,
        'items_mobile'  => $items_mobile,
    ), $template_path ); ?>

</div>
