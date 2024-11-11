<?php
/**
 * Template for displaying template Testimonials element kindergarten layout slider 2.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/testimonials/kindergarten-layout-slider-2.php.
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
<div class="slide-testimonial js-call-slick-testimonial" data-autoscroll="<?php echo $auto_slide;?>" data-speedauto="<?php echo $speed_auto;?>" data-fadeslide="0">
    <div class="slide-thumb">
        <div class="slide-slick">
            <?php foreach ( $testimonials as $testimonial ) { ?>
                <?php if ( isset( $testimonial['image'] ) ) { ?>
                    <div class="item-slick">
                        <div class="thumb-item">
                            <?php
                            $thumbnail_id = (int) $testimonial['image'];
                            $size         = apply_filters( 'builder-press/testimonial/kindergarten-layout-slider-2/image-size', '120x120' );
                            builder_press_get_attachment_image( $thumbnail_id, $size );
                            ?>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
    <div class="slide-content">
        <div class="wrap-arrow-slick">
            <div class="arow-slick prev-slick">
                <img src="<?php echo plugins_url('assets/images/arrow-prev-color-01.png', dirname(__FILE__))?>" alt="PREV">
            </div>

            <div class="arow-slick next-slick">
                <img src="<?php echo plugins_url('assets/images/arrow-next-color-01.png', dirname(__FILE__))?>" alt="NEXT">
            </div>
        </div>

        <div class="slide-slick">
            <?php foreach ( $testimonials as $testimonial ) { ?>
                <div class="item-slick">
                    <div class="testimonial-content">
                        <div class="content">
                            <?php echo esc_html( $testimonial['content'] ) ?>
                        </div>

                        <div class="author">
                            <span class="name"><?php echo esc_html( $testimonial['name'] ); ?></span> <?php echo esc_html( $testimonial['works'] ); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
