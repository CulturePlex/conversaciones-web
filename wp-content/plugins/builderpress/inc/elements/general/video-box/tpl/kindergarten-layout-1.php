<?php
/**
 * Template for displaying default template Video Box element kindergarten-layout-1.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/video-box/kindergarten-layout-1.php.
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

$size = apply_filters( 'builder-press/video-box/kindergarten-layout-1/image-size', '1920x492' );
$img = $params['background_img'] ? ' style="background-image: url(' . wp_get_attachment_image_url( $params['background_img'], $size ) . ')"' : '';

$size_img_overlay = apply_filters( 'builder-press/video-box/kindergarten-layout-1/image-overlay/image-size', '320x275' );
$img_overlay = $params['background_img'] ? ' style="background-image: url(' . wp_get_attachment_image_url( $params['background_img_overlay'], $size ) . ')"' : '';
?>
<div class="wrap-element" <?php echo ent2ncr($img);?>>
    <div class="overlay" <?php echo ent2ncr($img_overlay);?>></div>

    <a href="<?php echo esc_url( $video_link ); ?>" class="video-play popup-youtube">
        <i class="ion ion-ios-play"></i>
    </a>

    <?php if($title): ?>
        <h4 class="title">
            <?php echo $title; ?>
        </h4>
    <?php endif; ?>

    <?php if($sub_title): ?>
        <div class="description">
            <?php echo $sub_title; ?>
        </div>
    <?php endif; ?>
</div>