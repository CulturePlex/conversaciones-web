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

$sizes = apply_filters( 'builder-press/grid-images/layout-2/sizes', array(
    '1x1' => '360x249',
    '2x2' => '360x526'
) ); ?>
<div class="wrap-element gallery-popup">
    <div class="row">
        <div class="col-sm-6">
            <div class="gallery-item size_<?php echo $images[0]['size']?>">
                <?php builder_press_get_attachment_image( $images[0]['img'], '360x249' ); ?>
                <?php
                    $url_image = wp_get_attachment_image_src( $images[0]['img'], 'full' ); ?>

                <a href="<?php echo esc_url($url_image[0]); ?>" class="item-overlay js-show-gallery">
                    <i class="ion-android-expand"></i>

                    <span class="inner-info">
                        <?php echo $images[0]['title'] ?>
                    </span>
                </a>
            </div>

            <div class="gallery-item size_<?php echo $images[1]['size']?>">
                <?php builder_press_get_attachment_image( $images[1]['img'], '360x526' ); ?>
                <?php
                    $url_image = wp_get_attachment_image_src( $images[1]['img'], 'full' );
                    ?>
                <a href="<?php echo esc_url($url_image[0]); ?>" class="item-overlay js-show-gallery">
                    <i class="ion-android-expand"></i>

                    <span class="inner-info">
                        <?php echo $images[1]['title'] ?>
                    </span>
                </a>
            </div>
        </div>

        <div class="col-sm-6">
        <div class="gallery-item size_<?php echo $images[2]['size']?>">
            <?php builder_press_get_attachment_image( $images[2]['img'], '360x526' ); ?>
            <?php
            $url_image = wp_get_attachment_image_src( $images[2]['img'], 'full' );
            ?>
            <a href="<?php echo esc_url($url_image[0]); ?>" class="item-overlay js-show-gallery">
                <i class="ion-android-expand"></i>

                <span class="inner-info">
                        <?php echo $images[2]['title'] ?>
                    </span>
            </a>
        </div>

        <div class="gallery-item size_<?php echo $images[3]['size']?>">
            <?php builder_press_get_attachment_image( $images[3]['img'], '360x249' ); ?>
            <?php
                $url_image = wp_get_attachment_image_src( $images[3]['img'], 'full' );
            ?>
            <a href="<?php echo esc_url($url_image[0]); ?>" class="item-overlay js-show-gallery">
                <i class="ion-android-expand"></i>

                <span class="inner-info">
                        <?php echo $images[3]['title'] ?>
                    </span>
            </a>
        </div>
    </div>
    </div>
</div>
