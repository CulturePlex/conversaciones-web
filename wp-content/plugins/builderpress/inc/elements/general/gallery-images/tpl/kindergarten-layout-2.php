<?php
/**
 * Template for displaying template gallery images element kindergarten layout 2.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/gallery-images/kindergarten-layout-2.php.
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
		<div class="gallery-gird gallery-popup">
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
				<a href="<?php echo esc_url( $full ) ?>" class="gallery-item js-show-gallery">
					<?php
					$size = apply_filters( 'builder-press/gallery-images/kindergarten-layout-2/image-size', '225x225' );
					builder_press_get_attachment_image( $get_lists_photo_ids, $size );
					?>
				</a>
			<?php
			endforeach;
			?>
		</div>
	<?php endif; ?>
</div>
