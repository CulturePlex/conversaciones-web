<?php
/**
 * Template for displaying default template Video Box element marketing-layout-1.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/video-box/marketing-layout-1.php.
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

$size = apply_filters( 'builder-press/video-box/marketing-layout-1/image-size', '454x556' );

?>

<div class="wrap-element">
    <?php builder_press_get_attachment_image( $params['background_img'], $size ); ?>

    <div class="overlay">
        <a href="<?php echo esc_url( $video_link ); ?>" class="btn-play popup-youtube">
            <i class="ion ion-arrow-right-b"></i>
        </a>
    </div>
</div>
