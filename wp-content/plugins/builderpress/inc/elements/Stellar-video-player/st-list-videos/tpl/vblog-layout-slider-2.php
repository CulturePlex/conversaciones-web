<?php
/**
 * Template for displaying default template St-list-videos element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/st-list-videos/vblog-layout-slider-2.php.
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

    <div class="list-posts">
        <div class="slide-videos js-call-slick-videos" data-numofshow="1" data-numofscroll="1" data-loopslide="1" data-autoscroll="0" data-speedauto="6000" data-responsive="[1, 1], [1, 1], [1, 1], [1, 1], [1, 1]">
            <div class="wrap-arrow-slick">
                <div class="arow-slick prev-slick">
                    <i class="ion ion-ios-arrow-left"></i>
                </div>

                <div class="arow-slick next-slick">
                    <i class="ion ion-ios-arrow-right"></i>
                </div>
            </div>

            <div class="slide-slick">
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <?php
                    $categories = get_the_category();
                    $cat = '';
                    if ( ! empty( $categories ) ) {
                        $cat = $categories[0]->name;
                    }
                    $key = rand(100,999);
                    ?>

                    <div class="item-slick">
                        <div id="box-video-<?php echo $key;?>" class="mfp-with-anim mfp-hide frame-video-popup"></div>
                        <div class="video-item">
                            <?php if ( has_post_thumbnail() ) { ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php
                                    $size = apply_filters( 'builder-press/Stellar-video-player/st-list-videos/image-size', '1160x515' );
                                    builder_press_get_attachment_image( get_the_ID(), $size, 'post' ); ?>
                                </a>
                            <?php }  ?>

                            <div class="content">
                                <?php if( get_post_meta(get_the_ID(),'thim_video_meta_player_sc',true) || get_post_meta( get_the_ID(), 'thim_video_meta_player_iframe', true ) ) {?>
                                    <a href="#box-video-<?php echo $key;?>" class="btn-play" data-id="<?php echo get_the_ID();?>" data-effect="mfp-zoom-in"></a>
                                <?php }?>

                                <h4 class="title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php get_the_title() ? the_title() : the_ID(); ?>
                                    </a>
                                </h4>
                            </div>
                        </div>
                    </div>
                <?php endwhile;?>
            </div>
        </div>
    </div>
</div>