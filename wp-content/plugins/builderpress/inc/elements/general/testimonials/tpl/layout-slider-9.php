<?php
/**
 * Template for displaying template Testimonials element layout slider 9.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/testimonials/layout-slider-1.php.
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
$image_rating  = $params['image_rating'];
?>
<div class="wrap-element">
    <div class="slide-testimonial js-call-slick-col" data-numofslide="2" data-numofscroll="2" data-loopslide="1" data-autoscroll="<?php echo $auto_slide;?>" data-speedauto="<?php echo $speed_auto;?>" data-customdot="0" data-respon="[2, 2], [2, 2], [2, 2], [1, 1], [1, 1]">
        <div class="slide-slick">
            <?php foreach ( $testimonials as $testimonial ) { ?>
                <div class="item-slick">
                    <div class="testimonial-item">
                        <div class="testimonial-text">
                            <div class="content">
                                <?php echo esc_html( $testimonial['content'] ) ?>
                            </div>
                            <?php
                                $total_rating = absint($testimonial['rating']);
                                if($total_rating):
                            ?>
                                <div class="icon">
                                    <div class="total-rating">
                                        <?php
                                            for($i = 0; $i < $total_rating; $i++ ) {
                                                if($i == 5 ){
                                                    break;
                                                }
                                                ?>
                                                <span class="dashicons dashicons-star-filled"></span>
                                            <?php
                                            }
                                        ?>
                                    </div>
                                    <div class="image_rating">
                                        <?php
                                            if($image_rating):
                                                $img_rating_id = (int) $image_rating;
                                                $size         = apply_filters( 'builder-press/testimonial-slider-layout-9/image-size-rating', '88x46' );
                                                builder_press_get_attachment_image( $img_rating_id, $size );
                                        ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                        </div>

                        <div class="testimonial-author">
                            <div class="author-image">
                                <?php
                                $thumbnail_id = (int) $testimonial['image'];
                                $size         = apply_filters( 'builder-press/testimonial-slider-layout-9/image-size', '60x60' );
                                builder_press_get_attachment_image( $thumbnail_id, $size );
                                ?>
                            </div>

                            <div class="author-text">
                                <?php if ( isset( $testimonial['website'] ) ) { ?>
                                    <span class="name">
                                        <?php echo esc_html( $testimonial['name'] ); ?>
                                    </span>
                                <?php } else { ?>

                                    <?php echo esc_html( $testimonial['name'] ); ?>
                                <?php } ?>

                                <?php if ( isset( $testimonial['works'] ) ) { ?>
                                        <span class="info">
                                           <?php echo esc_html( $testimonial['works'] ); ?>
                                        </span>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="wrap-dot-slick"></div>
    </div>
</div>
