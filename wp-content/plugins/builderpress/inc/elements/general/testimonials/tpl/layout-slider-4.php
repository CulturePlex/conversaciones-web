<?php
/**
 * Template for displaying template Testimonials element layout slider 1.
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
$img = !empty($params['background']) ? wp_get_attachment_image_url( $params['background'], 'full' ) : '';
?>

<div class="row">
    <?php if($img) {?>
        <div class="col-md-5">
            <div class="img-testimonial">
                <img src="<?php echo esc_url($img);?>" alt="">
            </div>
        </div>
    <?php }?>
    <div class="col-md-7">
        <div class="slide-testimonial js-call-slick-col" data-numofslide="1" data-numofscroll="1" data-loopslide="1" data-autoscroll="<?php echo $auto_slide;?>" data-speedauto="<?php echo $speed_auto;?>" data-customdot="0" data-respon="[1, 1], [1, 1], [1, 1], [1, 1], [1, 1]">
            <div class="slide-slick">
                <?php foreach ( $testimonials as $testimonial ) { ?>
                    <div class="testimonial-item">
                        <div class="content">
                            <?php echo esc_html( $testimonial['content'] ) ?>
                        </div>

                        <div class="author">
                            <div class="ava">
                                <?php
                                $thumbnail_id = (int) $testimonial['image'];
                                $size         = apply_filters( 'builder-press/testimonial/layout-slider-4/image-size', '40x40' );
                                builder_press_get_attachment_image( $thumbnail_id, $size );
                                ?>
                            </div>

                            <div class="info">
                                <?php if ( isset( $testimonial['website'] ) ) { ?>
                                    <a href="<?php echo esc_attr( $testimonial['website'] ) ?>"
                                       target="_blank" class="name"><?php echo esc_html( $testimonial['name'] ); ?></a>
                                <?php } else { ?>
                                    <?php echo esc_html( $testimonial['name'] ); ?>
                                <?php } ?>

                                <?php if ( isset( $testimonial['works'] ) ) { ?>
                                    <span class="description"><?php echo esc_html( $testimonial['works'] ); ?></span>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="wrap-dot-slick"></div>
        </div>
    </div>
</div>