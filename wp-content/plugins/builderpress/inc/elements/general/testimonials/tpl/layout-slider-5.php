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

<div class="slide-testimonial js-call-slick-col" data-numofslide="<?php echo $items_visible;  ?>" data-numofscroll="1" data-loopslide="1" data-autoscroll="<?php echo $auto_slide;?>" data-speedauto="<?php echo $speed_auto;?>" data-customdot="0" data-respon="[<?php echo $items_visible;  ?>, 1], [<?php echo $items_visible;  ?>, 1], [<?php echo $items_visible;  ?>, 1], [<?php echo $items_visible;  ?>, 1], [<?php echo $items_mobile;  ?>, 1]">
    <div class="slide-slick">
        <?php foreach ( $testimonials as $testimonial ) { ?>
        <div class="testimonial-item">
            <div class="pic">
                <?php
                $thumbnail_id = (int) $testimonial['image'];
                $size         = apply_filters( 'builder-press/testimonial/layout-slider-5/image-size', '176x176' );
                builder_press_get_attachment_image( $thumbnail_id, $size );
                ?>

                <span class="color-bg small"></span>
                <span class="color-bg normal"></span>
                <span class="color-bg big"></span>
            </div>

            <div class="text">
                <div class="content">
                    <?php echo esc_html( $testimonial['content'] ) ?>
                </div>

                <div class="author">
                    <?php if ( isset( $testimonial['website'] ) ) { ?>
                        <a href="<?php echo esc_attr( $testimonial['website'] ) ?>"
                           target="_self" class="name"><?php echo esc_html( $testimonial['name'] ); ?></a>
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