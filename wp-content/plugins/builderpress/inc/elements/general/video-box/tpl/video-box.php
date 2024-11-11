<?php
/**
 * Template for displaying default template Video Box element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/video-box/video-box.php.
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

// global params
$template_path = $params['template_path'];

/**
 * @var $params array - shortcode params
 */
$layout         = $params['layout'];
$title          = isset($params['title']) ? $params['title'] : '';
$sub_title      = isset($params['subtitle']) ? $params['subtitle'] : '';
$video_button   = $params['video_button'];
$background_img = $params['background_img'];
$background_img_overlay = !empty($params['background_img_overlay']) ? $params['background_img_overlay'] : '';
$style_layout = !empty($params['style_layout']) ? $params['style_layout'] : '';
$el_class       = $params['el_class'];
$el_id          = $params['el_id'];
$bp_css         = $params['bp_css'];

$background = wp_get_attachment_image_src( $background_img, 'full' );
//$style      = $background ? "style='background-image:' url(" . esc_url( $background[0] ) . ");" : '';
$style      = $background ? 'style="background-image:url('.esc_url( $background[0] ).')"' : '';

$video_link = '';
if ( isset( $video_button['url'] ) ) {
	$video_link = $video_button['url'];
	if ( preg_match( '#src=\\"([^ ]*)\\"#', $video_link, $matches ) === 1 ) {
		$video_embed = $matches[1];
		$video_link  = preg_replace( '/embed\//', 'watch?v=', $video_embed );
	}
}

if ( ! $video_link ) {
	return;
} ?>

<!--video box element-->
<div class="bp-element bp-element-video-box <?php echo is_plugin_active('js_composer/js_composer.php') ? vc_shortcode_custom_css_class( $bp_css ) : '';?> <?php echo esc_attr( $layout ); ?> <?php echo esc_attr($style_layout); ?> <?php echo esc_attr( $el_class ); ?>" <?php echo $el_id ? "id='" . esc_attr( $el_id ) . "'" : '' ?>>

	<?php builder_press_get_template( $layout, array(
		'title'        => $title,
		'sub_title'    => $sub_title,
		'video_button' => $video_button,
		'video_link'   => $video_link,
		'style'        => $style,
		'params'       => $params
	), $template_path ); ?>

</div>
