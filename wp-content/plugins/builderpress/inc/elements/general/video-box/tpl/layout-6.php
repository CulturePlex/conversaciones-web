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

$size = apply_filters( 'builder-press/video-box/layout-6/image-size', '698x712' );
?>
<div class="wrap-element">
    <div class="video-image">
        <?php builder_press_get_attachment_image( $params['background_img'], $size ); ?>
    </div>

    <a href="<?php echo esc_url( $video_link ); ?>" class="video-play popup-youtube">
        <i class="ion-play"></i>
    </a>
</div>
