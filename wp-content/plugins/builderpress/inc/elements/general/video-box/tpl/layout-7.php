<?php
/**
 * Template for displaying default template Video Box element layout 7.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/video-box/layout-7.php.
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

$size = apply_filters( 'builder-press/video-box/layout-7/image-size', '1160x292' );
$img = $params['background_img'] ? ' style="background-image: url(' . wp_get_attachment_image_url( $params['background_img'], $size ) . ')"' : '';
?>
<div class="wrap-element" <?php echo ent2ncr($img);?>>
    <div class="overlay"></div>

    <div class="content">
        <a href="<?php echo esc_url( $video_link ); ?>" class="btn-play popup-youtube">
            <i class="ion ion-ios-play"></i>
        </a>

        <h4 class="title">
            <?php echo $title; ?>
        </h4>
    </div>
</div>