<?php
/**
 * Template for displaying default template Grid Images element layout 1.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/grid-images/layout-1.php.
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

$sizes = apply_filters( 'builder-press/grid-images/layout-1/sizes', array(
    '1x1' => '212x206',
    '2x2' => '433x421',
    '3x2' => '655x422'
) ); ?>

<div class="grid gallery-popup">
    <div class="grid-sizer"></div>
	<?php foreach ( $images as $image ) { ?>
		<?php
		$ratio = $image['size'];
		$title = $image['title'];
		$size  = apply_filters( 'builder-press/grid-images/layout-1/default-size', '211x204' );
		if ( array_key_exists( $ratio, $sizes ) ) {
			$size = $sizes[ $ratio ];
		}
		$url_image = wp_get_attachment_image_src( $image['img'], 'full' ); ?>

        <div class="grid-item size_<?php echo esc_attr( $ratio ); ?>">
            <div class="wrap-item">
                <div class="item-gallery">
                    <a href="<?php echo esc_url( $url_image[0] ); ?>" class="item js-show-gallery">
                        <i class="ion-qr-scanner"></i>
                        <span class="inner-info"><?php echo esc_html( $title ); ?></span>
                    </a>
					<?php builder_press_get_attachment_image( $image['img'], $size ); ?>
                </div>
            </div>
        </div>
	<?php } ?>
</div>