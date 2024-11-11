<?php
/**
 * Template for displaying default template Video Box element layout 2.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/video-box/layout-2.php.
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

$size = apply_filters( 'builder-press/video-box/layout-4/image-size', '960x472' );
$dir = BUILDER_PRESS_URL . 'inc/elements/general/video-box/';
?>

<div class="video-box">
    <?php builder_press_get_attachment_image( $params['background_img'], $size ); ?>

    <div class="overlay">
        <a href="<?php echo esc_url( $video_link ); ?>" class="btn-open-video popup-youtube">
            <i class="ion ion-ios-play-outline"></i>
        </a>
    </div>
</div>