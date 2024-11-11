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
?>

<div class="slide-testimonial js-call-slick-col"
     data-numofslide="1" data-numofscroll="1" data-loopslide="0" data-autoscroll="<?php echo $auto_slide;?>" data-speedauto="<?php echo $speed_auto;?>" data-respon="[1, 1], [1, 1], [1, 1], [1, 1], [1, 1]">
    <div class="slide-slick">
        <?php foreach ( $testimonials as $testimonial ) { ?>
            <div class="item-slick item">
                <div class="content"><?php echo esc_html( $testimonial['content'] ) ?></div>
                <div class="info-wrap">
                    <div class="info">
                        <h3 class="title">
                            <?php if ( isset( $testimonial['website'] ) ) { ?>
                                <a href="<?php echo esc_attr( $testimonial['website'] ) ?>"
                                   target="_blank"><?php echo esc_html( $testimonial['name'] ); ?></a>
                            <?php } else { ?>
                                <?php echo esc_html( $testimonial['name'] ); ?>
                            <?php } ?>
                        </h3>

                        <?php if ( isset( $testimonial['works'] ) ) { ?>
                            <div class="works"><?php echo esc_html( $testimonial['works'] ); ?></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="wrap-dot-slick"></div>
</div>