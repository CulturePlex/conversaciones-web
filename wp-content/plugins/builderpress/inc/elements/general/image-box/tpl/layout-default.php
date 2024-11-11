<?php
/**
 * Template for displaying default template Image Box element layout-gradient.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/image-box/layout-gradient.php.
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

/**
 * @var $params array - shortcode params
 */
$url_image = wp_get_attachment_image_src( $params['img'], 'full' );
?>
<div class="pic">
    <div class="wrap-img">
        <div class="main-img">
            <?php if( $params['box_link'] ) {?>
            <a href="<?php echo esc_url( $params['box_link']['url'] ); ?>" class="link">
                <?php echo $params['box_link']['title'] ? $params['box_link']['title'] : __( 'Read More', 'builderpress' );?>
                <i class="ion ion-ios-arrow-thin-right"></i>
            </a>
            <?php }?>

            <?php $size = apply_filters( 'builder-press/image-box/layout-default/image-size', '426x426' );
            builder_press_get_attachment_image( $params['img'], $size ); ?>
        </div>

        <div class="background">
            <span class="grey-bg small"></span>
            <span class="grey-bg big"></span>

            <span class="color-bg small"></span>
            <span class="color-bg normal"></span>
            <span class="color-bg big"></span>
        </div>

        <div class="symbol">
            <?php echo wp_get_attachment_image( $params['img-icon'], 'full' );?>
        </div>
    </div>
</div>

<div class="text">
    <div class="wrap-content">
        <h3 class="title">
            <?php echo esc_html( $params['title'] );?>
        </h3>

        <div class="content">
            <?php echo esc_html( $params['description'] );?>
        </div>
    </div>
</div>