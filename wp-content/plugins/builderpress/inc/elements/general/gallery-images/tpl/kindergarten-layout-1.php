<?php
/**
 * Template for displaying template gallery images element kindergarten layout 1.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/gallery-images/kindergarten-layout-1.php.
 *
 * @author      ThimPress
 * @package     BuilderPress/Templates
 * @version     1.0.0
 * @author      Thimpress, leehld
 */

/**
 * @var $params array - shortcode params
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="wrap-element">
	<?php if ( $params['photos'] ): ?>
		<div class="row no-gutters gallery-gird gallery-popup">
			<?php
			$photo_ids = explode( ',', $params['photos'] );
			foreach ( $photo_ids as $get_lists_photo_ids ):
				$full = wp_get_attachment_image_src( $get_lists_photo_ids, 'full' );
 				if ( isset( $full ) && ! empty( $full ) ) {
					$full = $full[0];
				} else {
					$full = '';
				}
				?>
				<div class="col-6 col-sm-4 col-lg-2">
					<a href="<?php echo esc_url( $full ) ?>" class="gallery-item js-show-gallery">
						<?php
						$size = apply_filters( 'builder-press/gallery-images/kindergarten-layout-1/image-size', '321x266' );
						builder_press_get_attachment_image( $get_lists_photo_ids, $size );
						?>
					</a>
				</div>
			<?php
			endforeach;
			?>
		</div>
	<?php endif; ?>
</div>
