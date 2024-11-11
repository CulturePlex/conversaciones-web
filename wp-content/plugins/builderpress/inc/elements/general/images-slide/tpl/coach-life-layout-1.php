<?php
/**
 * Template for displaying default template Images-slide element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/images-slide/layout-1.php.
 *
 * @author      ThimPress
 * @package     BuilderPress/Templates
 * @version     1.0.0
 * @author      Thimpress, vinhnq
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

?>

<div class="wrap-element">
    <div class="slide-image js-call-slick-images dot-has-process" data-speedslide="900" data-numofshow="1" data-numofscroll="1" data-loopslide="1" data-autoscroll="1" data-speedauto="5000" data-responsive="[1, 1], [1, 1], [1, 1], [1, 1], [1, 1]" data-customdot="1">

        <div class="slide-slick" data-slick='{"pauseOnHover": false}'>
            <?php
            $i=0;
            foreach ( $images as $key => $image ) { $i++;?>
                <div class="item-slick" data-thumb="<?php echo $i;?>">
                    <?php if ( isset( $image['img'] ) ) {
                        $img = wp_get_attachment_image_src( $image['img'], 'full' );
                        if ( $img ) {
                            echo '<img src="' . $img[0] . '" width="' . $img[1] . '" height="' . $img[2] . '" alt="' . esc_attr__( 'Image', 'builderpress' ) . '">';
                        }
                    } ?>
                </div>
            <?php } ?>
        </div>

        <div class="wrap-arrow-slick">
            <div class="arow-slick prev-slick">
                <i class="ion ion-ios-arrow-thin-left"></i>
            </div>

            <div class="arow-slick next-slick">
                <i class="ion ion-ios-arrow-thin-right"></i>
            </div>
        </div>

        <div class="wrap-dot-slick"></div>
    </div>
</div>
