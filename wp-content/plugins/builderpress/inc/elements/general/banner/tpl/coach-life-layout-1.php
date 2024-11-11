<?php
/**
 * Template for displaying default template Baner element coach-life-layout-1.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/banner/coach-life-layout-1.php.
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

$size = apply_filters( 'builder-press/banner/coach-life-layout-1/image-size', '1920x727' );
$img_background = $background_image ? ' style="background-image: url(' . wp_get_attachment_image_url( $background_image, $size ) . ')"' : '';

?>

<div class="wrap-element">
    <div class="image-banner">
        <?php
            $thumbnail_id = (int) $main_image;
            $size         = apply_filters( 'builder-press/banner/image-size', '1030x698' );
            builder_press_get_attachment_image( $thumbnail_id, $size );
        ?>
    </div>

    <div class="inner-banner" <?php echo $img_background; ?>>
        <div class="container text-center text-lg-left">
            <div class="row">
                <div class="col-lg-6 col-xl-6">
                    <?php
                        if($title):
                    ?>
                        <h2 class="title-banner">
                            <?php echo esc_html($title); ?>
                        </h2>
                    <?php
                        endif;
                    ?>

                    <?php
                        if($description):
                    ?>
                        <div class="description-banner">
                            <?php echo esc_html($description); ?>
                        </div>
                    <?php
                        endif;
                    ?>

                    <?php
                        if(!empty($link_button['url'])):
                            $title = $link_button['title'] ? $link_button['title'] : __( 'Get Courses', 'builderpress' );
                            if ( isset ( $params['linktype_title'] ) && !empty($params['linktype_title'])) {
                                $title = $params['linktype_title'];
                            }
                    ?>
                        <div class="wrap-btn-banner">
                            <a href="<?php echo esc_url($link_button['url']) ?>" class="btn-banner">
                                <?php echo ent2ncr($title) ?>
                            </a>
                        </div>
                    <?php
                        endif;
                    ?>
                </div>
            </div>

            <?php
                if(!empty($link_video_button['url'])):
            ?>
                    <a href="<?php echo esc_url($link_video_button['url']) ?>" class="btn-play popup-youtube">
                        <i class="ion ion-arrow-right-b"></i>
                    </a>
            <?php
                endif;
            ?>
        </div>
    </div>
</div>