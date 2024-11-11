<?php
/**
 * Template for displaying default template Baner element coach-life-layout-3.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/banner/coach-life-layout-3.php.
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
?>
<div class="wrap-element">
    <div class="image-banner">
        <?php
            $thumbnail_id = (int) $main_image;
            $size         = apply_filters( 'builder-press/banner/coach-life-layout-3/image-size', '1920x1115' );
            builder_press_get_attachment_image( $thumbnail_id, $size );
        ?>
    </div>

    <div class="inner-banner">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <?php
                        if($title):
                    ?>
                        <h2 class="title-banner">
                            <span class="inner-title"><?php echo $title; ?></span>
                            <span class="shadow-title"><?php echo $title; ?></span>
                        </h2>
                    <?php
                        endif;
                    ?>

                    <div class="wrap-btn-banner">
                        <?php
                            if(!empty($link_button['url'])):
                                $title = $link_button['title'] ? $link_button['title'] : __( 'Get Courses', 'builderpress' );
                                if ( isset ( $params['linktype_title'] ) && !empty($params['linktype_title']) ) {
                                    $title = $params['linktype_title'];
                                }
                        ?>
                                <a href="<?php echo esc_url($link_button['url']) ?>" class="btn-banner">
                                    <?php echo ent2ncr($title) ?>
                                </a>
                        <?php
                        endif;
                        ?>

                        <?php
                            if(!empty($link_video_button['url'])):
                                $title_video = $link_video_button['title'] ? $link_video_button['title'] : __( 'Watch video', 'builderpress' );
                                if ( isset ( $params['linktype_title_video'] ) && !empty($params['linktype_title_video']) ) {
                                    $title_video = $params['linktype_title_video'];
                                }
                        ?>
                            <a href="<?php echo esc_url($link_video_button['url']) ?>" class="btn-banner popup-youtube">
                                <i class="ion ion-arrow-right-b"></i>  <?php echo ent2ncr($title_video) ?>
                            </a>
                        <?php
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
