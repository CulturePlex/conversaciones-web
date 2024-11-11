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

$img = $params['background_img'] ? ' style="background-image: url(' . wp_get_attachment_image_url( $params['background_img'], 'full' ) . ')"' : '';
?>

<div class="video-box" <?php echo ent2ncr($img);?>>

    <div class="overlay"></div>

    <a href="<?php echo esc_url( $video_link ); ?>" class="btn-open-video popup-youtube">
        <i class="ion ion-ios-play-outline"></i>
    </a>

    <h3 class="title">
        <?php echo esc_html( $title );?>
    </h3>

    <div class="sub-title">
        <?php echo $sub_title; ?>
    </div>
</div>