<?php
/**
 * Template for displaying default template Google Map element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/google-map/google-map.php.
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
if ( ! $params['map_center'] ) {
	return;
}

$map_center  = $params['map_center'];
$api_key     = $params['api_key'];
$zoom        = $params['zoom'];
$scroll_zoom = $params['scroll_zoom'];
$draggable   = $params['draggable'];
$marker_icon = $params['marker_icon'];
$map_cover   = $params['map_cover_image'];
$map_style   = $params['map_style'];
$style_layout = !empty($params['style_layout']) ? $params['style_layout'] : '';
$json_style  = $params['json_style'];
$el_class    = $params['el_class'];
$el_id       = $params['el_id'];
$bp_css     = $params['bp_css'];

$height = ( $params['height'] ? $params['height'] : '480px' ) . 'px';
?>

<!--google map element-->
<div class="bp-element bp-element-google-map <?php echo esc_attr($style_layout); ?> <?php echo is_plugin_active('js_composer/js_composer.php') ? vc_shortcode_custom_css_class( $bp_css ) : '';?> <?php echo esc_attr( $el_class ); ?>" <?php echo $el_id ? "id='" . esc_attr( $el_id ) . "'" : '' ?>
     style="height: <?php echo esc_attr( $height ); ?>" <?php echo $map_cover ? " data-cover='" . $map_cover . "'" : ''; ?>>

	<?php if ( $map_cover ) {
		$cover_attachment = wp_get_attachment_image_src( $map_cover, 'full' );
		$cover            = $cover_attachment ? $cover_attachment[0] : '';
		?>
        <div class="map-cover"
             style="height: <?php echo esc_attr( $height ); ?>; background-image:url('<?php echo $cover; ?>')"></div>
	<?php } ?>

	<?php
	$data = "data-address='$map_center'" . ' ' . " data-zoom='$zoom'" . ' ' .
	        "data-scroll-zoom='$scroll_zoom'" . ' ' . " data-draggable='$draggable'" . ' ' .
	        "data-style='$map_style'" . ' ' . " data-api_key='$api_key'";

	if ( $marker_icon ) {
		$icon_attachment = wp_get_attachment_image_src( $marker_icon, 'full' );
		$icon            = $icon_attachment ? $icon_attachment[0] : '';

		$data .= ' data-marker-icon="' . $icon . '" ';
	}

	if ( $map_style == 'import_json' && $json_style ) {
		$data .= ' data-json="' . esc_attr( $json_style ) . '" ';
	} ?>

    <div class="ob-google-map-canvas"
         id="ob-map-canvas-<?php echo md5( $params['map_center'] ); ?>" <?php echo $data; ?>></div>
</div>
