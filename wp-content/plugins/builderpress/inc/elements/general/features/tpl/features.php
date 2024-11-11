<?php
/**
 * Template for displaying global default template Features element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/features/features.php.
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
if ( ! isset($params['features']) && ! $params['features'] ) {
	return;
}

// global params
$template_path = $params['template_path'];

$layout   = $params['layout'];
$title    = !empty($params['title']) ?  $params['title'] : '';
$features = $params['features'];
$style_layout = !empty($params['style_layout']) ? $params['style_layout'] : '';
$el_class = $params['el_class'];
$el_id    = $params['el_id'];
$bp_css   = $params['bp_css'];
$bp_css_tablet = $params['bp_css_tablet'];
$bp_css_mobile = $params['bp_css_mobile'];
$data_tablet = $bp_css_tablet ? ' data-class-tablet="' . bp_custom_css_class_shortcode($bp_css_tablet) . '"' : '';
$data_mobile = $bp_css_mobile ? ' data-class-mobile="' . bp_custom_css_class_shortcode($bp_css_mobile) . '"' : '';

// title style
$title_css = '';
$title_css .= $params['title_font_size'] ? 'font-size:' . $params['title_font_size'] . 'px; ' : '';
$title_css .= $params['title_font_weight'] ? 'font-weight:' . $params['title_font_weight'] . '; ' : '';
$title_css .= $params['title_color'] ? 'color:' . $params['title_color'] . '; ' : '';
$title_css = $title_css ? ' style="' . $title_css . '"' : '';
$title_tag = $params['title_tag'] ? $params['title_tag'] : 'h3';

// description style
$des_css = '';
$des_css .= $params['desc_color'] ? 'color:' . $params['desc_color'] . '; ' : '';
$des_css .= $params['desc_font_weight'] ? 'font-weight:' . $params['desc_font_weight'] . '; ' : '';
$des_css .= $params['desc_font_size'] ? 'font-size:' . $params['desc_font_size'] . 'px; ' : '';
$des_css = $des_css ? ' style="' . $des_css . '"' : '';

// icon style
$icon_css = '';
$icon_css .= !empty($params['icon_font_size']) ? 'font-size:' . $params['icon_font_size'] . 'px; ' : '';
$icon_css .= $params['icon_color'] ? 'color:' . $params['icon_color'] . '; ' : '';
$icon_css .= $params['icon_border_color'] ? 'border-color:' . $params['icon_border_color'] . '; ' : '';
$icon_css .= $params['icon_background_color'] ? 'background-color:' . $params['icon_background_color'] . '; ' : '';
$icon_css   = $icon_css ? ' style="' . $icon_css . '"' : '';
?>

<div class="bp-element bp-element-features <?php echo is_plugin_active('js_composer/js_composer.php') ? vc_shortcode_custom_css_class( $bp_css ) : '';?> <?php echo esc_attr( $layout ); ?> <?php echo esc_attr($style_layout); ?> <?php echo esc_attr( $el_class ); ?>" <?php echo $el_id ? "id='" . esc_attr( $el_id ) . "'" : '' ?> <?php echo $data_tablet;?><?php echo $data_mobile;?>>

	<?php builder_press_get_template( $layout, array(
	    'title'    => $title,
		'features' => $features,
		'title_tag'=> $title_tag,
		'title_css'=> $title_css,
		'des_css'  => $des_css,
		'icon_css' => $icon_css,
		'params'   => $params
	), $template_path ); ?>

</div>
