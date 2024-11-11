<?php
/**
 * Template for displaying default template Services element layout grid.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/services/layout-grid.php.
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
$services       = $params['services'];
$number_columns = $params['number_columns'];
$button         = $params['view_all'];
$style_layout = !empty($params['style_layout']) ? $params['style_layout'] : '';
$el_class       = $params['el_class'];
$el_id          = $params['el_id'];
$bp_css         = $params['bp_css'];
?>

<div class="bp-element bp-element-services <?php echo esc_attr($style_layout); ?> <?php echo is_plugin_active('js_composer/js_composer.php') ? vc_shortcode_custom_css_class( $bp_css ) : '';?> <?php echo esc_attr( $el_class ); ?> number-columns-<?php echo esc_attr( $number_columns ); ?> layout-grid" <?php echo $el_id ? "id='" . esc_attr( $el_id ) . "'" : '' ?>>

	<div class="grid">
		<?php foreach ( $services as $service ) { ?>
			<?php $thumbnail_id = isset( $service['thumbnail'] ) ? (int) $service['thumbnail'] : ''; ?>

			<div class="item">
				<div class="item-inner">
					<?php if ( $thumbnail_id ) { ?>
						<div class="item-thumbnail">
							<?php $image = wp_get_attachment_image_src( $thumbnail_id, 'full' ); ?>

							<img alt="" src="<?php echo esc_attr( $image[0] ); ?>"
							     width="<?php echo esc_attr( $image[1] ); ?>"
							     height="<?php echo esc_attr( $image[2] ); ?>">
						</div>
					<?php } ?>

					<?php if ( ! empty( $service['title'] ) ) { ?>
						<h3 class="item-title">
							<a href="<?php echo esc_attr( $service['link'] ); ?>"><?php echo esc_html( $service['title'] ); ?></a>
						</h3>
					<?php } ?>

					<?php if ( ! empty( $service['description'] ) ) { ?>
						<p class="item-description"><?php echo esc_html( $service['description'] ); ?></p>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
	</div>

	<?php if ( $button ) { ?>
		<div class="view-all">
			<a href="<?php echo esc_url( $button['url'] ); ?>"
				<?php echo bp_template_build_link( $button ); ?>><?php echo esc_html( $button['title'] ); ?></a>
		</div>
	<?php } ?>
</div>