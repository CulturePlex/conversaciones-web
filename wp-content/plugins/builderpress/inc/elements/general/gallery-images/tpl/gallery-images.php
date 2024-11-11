<?php
/**
 * Template for displaying default template Gallery-images element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/gallery-images/gallery-images.php.
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

if ( ! $params['photos'] ) {
	return;
}

$template_path = $params['template_path'];
$layout = isset( $params['layout'] ) ? $params['layout'] : 'layout-1';
$title  = ! empty( $params['title'] ) ? $params['title'] : '';
$style_layout = !empty($params['style_layout']) ? $params['style_layout'] : '';
$photos = $params['photos'];
if ( is_array( $photos ) ) {
	$list_ids = array();
	foreach ( $photos as $p ) {
		if ( isset( $p['id'] ) ) {
			$list_ids[] = $p['id'];
		}
	}
	$params['photos'] = $photos = implode( ',', $list_ids );
}
$el_class = $params['el_class'];
$el_id    = $params['el_id'];
?>

<div class="bp-element bp-element-gallery-images <?php echo esc_attr( $layout ); ?> <?php echo esc_attr($style_layout); ?> <?php echo esc_attr( $el_class ); ?>" <?php echo $el_id ? "id='" . esc_attr( $el_id ) . "'" : '' ?>>
	<?php builder_press_get_template( $layout, array(
		'params' => $params,
		'photos' => $photos,
	), $template_path ); ?>
</div>