<?php
/**
 * Template for displaying default template Grid Images element layout 1.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/grid-images/layout-images-slider.php.
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
?>

<div class="slide-image js-call-slick-col" data-numofslide="3" data-numofscroll="1" data-loopslide="1"
     data-autoscroll="0" data-speedauto="6000" data-respon="[3, 1], [3, 1], [2, 1], [1, 1], [1, 1]">
    <div class="slide-slick">
		<?php foreach ( $images as $image ) { ?>
			<?php $size = apply_filters( 'builder-press/grid-images/layout-images-slider/default-size', '352x252' ); ?>
            <div class="item-slick">
				<?php builder_press_get_attachment_image( $image['img'], $size ); ?>
            </div>
		<?php } ?>
    </div>

    <div class="wrap-arrow-slick">
        <div class="arow-slick prev-slick">
            <i class="ion ion-ios-arrow-left"></i>
        </div>

        <div class="arow-slick next-slick">
            <i class="ion ion-ios-arrow-right"></i>
        </div>
    </div>
</div>
