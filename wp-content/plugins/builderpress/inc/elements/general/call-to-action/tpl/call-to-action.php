<?php
/**
 * Template for displaying global default template Call To Action element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/call-to-action/call-to-action.php.
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
$layout      = isset($params['layout']) ? $params['layout'] : 'layout-1';
$title       = $params['title'];
$description = $params['description'];
$action      = $params['link'];
$style_layout= !empty($params['style_layout']) ? $params['style_layout'] : '';
$el_class    = $params['el_class'];
$el_id       = $params['el_id'];

$bp_css = $params['bp_css'];
$bp_css_tablet = $params['bp_css_tablet'];
$bp_css_mobile = $params['bp_css_mobile'];
$data_tablet = $bp_css_tablet ? 'data-class-tablet="' . bp_custom_css_class_shortcode($bp_css_tablet) . '"' : '';
$data_mobile = $bp_css_mobile ? 'data-class-mobile="' . bp_custom_css_class_shortcode($bp_css_mobile) . '"' : '';
$background_color = (!empty($params['background_color'])) ? $params['background_color']: false ;

// title style
$title_css = '';
$title_css .= $params['color_title'] ? 'color:' . $params['color_title'] . '; ' : '';
$title_css .= $params['title_font_size'] ? 'font-size:' . $params['title_font_size'] . 'px; ' : '';
$title_css .= $params['title_font_weight'] ? 'font-weight:' . $params['title_font_weight'] . '; ' : '';
//$title_css .= $params['title_margin'] ? 'margin:' . $params['title_margin'] . '; ' : '';
$title_css = $title_css ? ' style="' . $title_css . '"' : '';
$title_tag = $params['title_tag'] ? $params['title_tag'] : 'h3';

// description style
$des_css = '';
$des_css .= $params['color_desc'] ? 'color:' . $params['color_desc'] . '; ' : '';
$des_css .= $params['desc_font_weight'] ? 'font-weight:' . $params['desc_font_weight'] . '; ' : '';
$des_css .= $params['desc_font_size'] ? 'font-size:' . $params['desc_font_size'] . 'px; ' : '';
//$des_css .= $params['desc_margin'] ? 'margin:' . $params['desc_margin'] . '; ' : '';
$des_css = $des_css ? ' style="' . $des_css . '"' : '';
?>

<div class="bp-element bp-element-call-to-action <?php echo is_plugin_active('js_composer/js_composer.php') ? vc_shortcode_custom_css_class( $bp_css ) : '';?> <?php echo esc_attr( $layout ); ?> <?php echo esc_attr($style_layout); ?> <?php echo esc_attr( $background_color ); ?> <?php echo esc_attr( $el_class ); ?>" <?php echo $el_id ? "id='" . esc_attr( $el_id ) . "'" : '' ?> <?php echo $data_tablet;?> <?php echo $data_mobile;?>>

	<?php builder_press_get_template( $layout, array(
		'title'         => $title,
		'description'   => $description,
		'action'        => $action,
		'params'        => $params,
        'title_tag'     => $title_tag,
        'title_css'     => $title_css,
        'des_css'       => $des_css,
	), $template_path ); ?>

</div>
