<?php
/**
 * Template for displaying default template Counter Box element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/counter-box/counters.php.
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

$layout      = isset( $params['layout'] ) ? $params['layout'] : 'layout-1';
$counters     = $params['counters'];
$icon_type   = $params['icon_type'];
$align       = $params['align'];
$style_layout = !empty($params['style_layout']) ? $params['style_layout'] : '';
$el_class    = $params['el_class'];
$el_id       = $params['el_id'];
$bp_css      = $params['bp_css'];
$bp_css_tablet = $params['bp_css_tablet'];
$bp_css_mobile = $params['bp_css_mobile'];
$data_tablet = $bp_css_tablet ? 'data-class-tablet="' . bp_custom_css_class_shortcode($bp_css_tablet) . '"' : '';
$data_mobile = $bp_css_mobile ? 'data-class-mobile="' . bp_custom_css_class_shortcode($bp_css_mobile) . '"' : '';
// title style
$title_css = '';
$title_css .= $params['color_title'] ? 'color:' . $params['color_title'] . '; ' : '';
$title_css .= $params['title_font_size'] ? 'font-size:' . $params['title_font_size'] . 'px; ' : '';
$title_css .= $params['title_font_weight'] ? 'font-weight:' . $params['title_font_weight'] . '; ' : '';
$title_css .= $params['title_margin'] ? 'margin:' . $params['title_margin'] . '; ' : '';
$title_css = $title_css ? ' style="' . $title_css . '"' : '';
$title_tag = $params['title_tag'] ? $params['title_tag'] : 'h3';

// number style
$number_css = '';
$number_css .= $params['color_number'] ? 'color:' . $params['color_number'] . '; ' : '';
$number_css .= $params['number_font_size'] ? 'font-size:' . $params['number_font_size'] . 'px; ' : '';
$number_css .= $params['number_font_weight'] ? 'font-weight:' . $params['number_font_weight'] . '; ' : '';
$number_css .= $params['number_margin'] ? 'margin:' . $params['number_margin'] . '; ' : '';
$number_css = $number_css ? ' style="' . $number_css . '"' : '';

// icon style
$icon_css = '';
$icon_css .= $params['color_icon'] ? 'color:' . $params['color_icon'] . '; ' : '';
$icon_css .= $params['icon_font_weight'] ? 'font-weight:' . $params['icon_font_weight'] . '; ' : '';
$icon_css .= $params['icon_font_size'] ? 'font-size:' . $params['icon_font_size'] . 'px; ' : '';
$icon_css .= $params['icon_margin'] ? 'margin:' . $params['icon_margin'] . '; ' : '';
$icon_css = $icon_css ? ' style="' . $icon_css . '"' : '';

// description style
$des_css = '';
$des_css .= $params['desc_color'] ? 'color:' . $params['desc_color'] . '; ' : '';
$des_css .= $params['desc_font_weight'] ? 'font-weight:' . $params['desc_font_weight'] . '; ' : '';
$des_css .= $params['desc_font_size'] ? 'font-size:' . $params['desc_font_size'] . 'px; ' : '';
$des_css .= $params['desc_margin'] ? 'margin:' . $params['desc_margin'] . '; ' : '';
$des_css = $des_css ? ' style="' . $des_css . '"' : '';
?>

<!--counter box element-->
<div class="bp-element bp-element-counters text-<?php echo esc_attr( $align ); ?> <?php echo esc_attr( $el_class ); ?> <?php echo esc_attr( $layout ); ?> <?php echo esc_attr($style_layout); ?> <?php echo is_plugin_active('js_composer/js_composer.php') ? vc_shortcode_custom_css_class( $bp_css ) : '';?>" <?php echo $el_id ? " id='" . esc_attr( $el_id ) . "'" : '' ?> <?php echo $data_tablet;?> <?php echo $data_mobile;?>>
    <div class="counter-boxes">
		<?php builder_press_get_template( $layout,
			array(
                'params'      => $params,
                'counters'     => $counters,
                'icon_type'   => $icon_type,
				'title_tag'   => $title_tag,
				'title_css'   => $title_css,
				'number_css'  => $number_css,
				'des_css'     => $des_css,
				'icon_css'    => $icon_css
			),
			$template_path );
		?>
    </div>
</div>
