<?php
/**
 * Template for displaying default template Accordion element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/accordion/accordion.php.
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

$template_path = $params['template_path'];
$layout        = isset($params['layout']) ? $params['layout'] : 'layout-1';
$accordion     = isset($params['accordion']) ? $params['accordion'] : 'accordion';
$accordion_tab = isset($params['accordion_tab']) ? $params['accordion_tab'] : '';
$hidden_icon   = isset($params['hidden_icon']) ? $params['hidden_icon'] : false;
$style_layout = !empty($params['style_layout']) ? $params['style_layout'] : '';
$el_class = $params['el_class'];
$el_id    = $params['el_id'];
$bp_css   = $params['bp_css'];
?>

<div class="bp-element bp-element-accordion js-call-accordion <?php echo esc_attr( $layout ); ?> <?php echo esc_attr($style_layout); ?> <?php echo is_plugin_active('js_composer/js_composer.php') ? vc_shortcode_custom_css_class( $bp_css ) : '';?> <?php echo esc_attr( $el_class ); ?>" <?php echo $el_id ? "id='" . esc_attr( $el_id ) . "'" : '' ?>>
    <?php builder_press_get_template( $layout, array(
        'params'        => $params,
        'accordion'     => $accordion,
        'hidden_icon'   => $hidden_icon,
        'accordion_tab' => $accordion_tab,
    ), $template_path ); ?>
</div>