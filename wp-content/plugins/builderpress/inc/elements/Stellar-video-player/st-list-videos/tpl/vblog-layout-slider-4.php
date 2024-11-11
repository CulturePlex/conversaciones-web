<?php
/**
 * Template for displaying default template St-list-videos element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/st-list-videos/vblog-layout-slider-4.php.
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
    <div class="slide-videos js-call-slick-colss" data-numofshow="1" data-numofscroll="1" data-loopslide="1" data-autoscroll="0" data-speedauto="6000" data-responsive="[1, 1], [1, 1], [1, 1], [1, 1], [1, 1]">
        <div class="slide-slick">
            <?php while ( $query->have_posts() ) : $query->the_post();?>
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
                        <div class="item-video">
                            <?php
                            $size = apply_filters( 'builder-press/Stellar-video-player/vblog-layout-slider-2/image-size', '831x470' );
                            builder_press_get_attachment_image( get_the_ID(), $size, 'post' ); ?>
                            <?php if( get_post_meta(get_the_ID(),'thim_video_meta_player_sc',true) || get_post_meta( get_the_ID(), 'thim_video_meta_player_iframe', true ) ) {?>
                                <a href="#box-video-<?php echo $key;?>" data-id="<?php echo get_the_ID();?>"  class="btn-play"></a>
                            <?php } ?>
                        </div>
                    </div>
            <?php endwhile; ?>
        </div>

        <div class="wrap-dot-slick"></div>
    </div>
</div>