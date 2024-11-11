<?php
/**
 * Template for displaying template Testimonials element layout slider 10.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/testimonials/layout-slider-10.php.
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
<div class="slide-testimonials js-call-slick-col-vblog" data-numofshow="<?php echo esc_attr( $items_visible ); ?>" data-numofscroll="1" data-loopslide="1" data-autoscroll="<?php echo $auto_slide;?>" data-speedauto="<?php echo $speed_auto;?>" data-responsive="[<?php echo esc_attr( $items_visible ); ?>, 1], [<?php echo esc_attr( $items_visible ); ?>, 1], [<?php echo esc_attr( $items_tablet ); ?>, 1], [<?php echo esc_attr( $items_tablet ); ?>, 1], [<?php echo esc_attr( $items_mobile ); ?>, 1]">
    <div class="wrap-arrow-slick">
        <div class="arow-slick prev-slick">
            <i class="ion ion-ios-arrow-left"></i>
        </div>

        <div class="arow-slick next-slick">
            <i class="ion ion-ios-arrow-right"></i>
        </div>
    </div>

    <div class="slide-slick">
        <?php foreach ( $testimonials as $testimonial ) { ?>
            <div class="item-slick">
                <div class="testimonial-item">
                    <div class="ava">
                        <?php
                        $thumbnail_id = (int) $testimonial['image'];
                        $size         = apply_filters( 'builder-press/testimonial/vblog-layout-slider-1/image-size', '77x77' );
                        builder_press_get_attachment_image( $thumbnail_id, $size );
                        ?>
                    </div>
                    <div class="content"><?php echo esc_html( $testimonial['content'] ) ?></div>
                    <div class="author">
                        <span class="name">_<?php echo esc_html( $testimonial['name'] ); ?>,</span> <?php echo esc_html( $testimonial['works'] ); ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

</div>