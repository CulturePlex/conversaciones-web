<?php
/**
 * Template for displaying template Testimonials element layout slider 8.
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

<div data-items-visible="<?php echo esc_attr( $items_visible ); ?>"
     data-items-tablet="<?php echo esc_attr( $items_tablet ); ?>"
     data-items-mobile="<?php echo esc_attr( $items_mobile ); ?>">
    <div class="wrapper-testimonials" <?php echo( $background ); ?>>
        <div class="slider slider-for">

            <!--                content-->
            <?php foreach ( $testimonials as $testimonial ) { ?>
                <div class="item">
                    <div class="content"><?php echo esc_html( $testimonial['content'] ) ?></div>

                    <div class="info-wrap">
                        <!--                            image-->
                        <?php if ( isset( $testimonial['image'] ) ) { ?>
                            <div class="image">
                                <?php
                                $thumbnail_id = (int) $testimonial['image'];
                                $size         = apply_filters( 'builder-press/testimonial-slider-layout-8/image-size', '100x100' );
                                builder_press_get_attachment_image( $thumbnail_id, $size );
                                ?>
                            </div>
                        <?php } ?>

                        <!--info-->
                        <div class="info">
                            <div class="detail-info">
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
                            <?php if ( isset( $testimonial['rating'] ) ) { ?>
                                <div class="rating">
                                    <span style="width: <?php echo esc_attr( ( floatval( $testimonial['rating'] ?? 0 ) / 5 ) * 100 ); ?>%"></span>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="slider-image-box">
            <div class="slider slider-nav">
                <?php foreach ( $testimonials as $testimonial ) { ?>
                    <div class="item"></div>
                <?php } ?>
            </div>
        </div>

    </div>
</div>
