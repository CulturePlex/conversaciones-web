<?php
/**
 * Template for displaying default template St-list-videos element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/st-list-videos/vblog-layout-slider-3.php.
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
    <div class="heading-post">
        <div class="text">
            <h3 class="title">
                <?php echo esc_html($title); ?>
            </h3>
        </div>

        <div class="line"></div>
    </div>

    <div class="list-posts">
        <div class="slide-posts js-call-slick-colss" data-numofshow="4" data-numofscroll="1" data-loopslide="1" data-autoscroll="0" data-speedauto="6000" data-responsive="[4, 1], [4, 1], [3, 1], [2, 1], [1, 1]" data-middlearrow=".pic">
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
                            <div class="post-item">
                                <div class="pic">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php
                                        $size = apply_filters( 'builder-press/Stellar-video-player/st-list-videos/vblog-layout-slider-3/image-size', '260x240' );
                                        builder_press_get_attachment_image( get_the_ID(), $size, 'post' ); ?>

                                    </a>

                                    <div class="meta-info">
                                        <span class="item-info">
                                            <i class="ion ion-ios-chatboxes"></i>
                                            <?php
                                                if ( comments_open() ) {
                                                    ?>
                                                    <?php comments_popup_link( '0', '1', '%', 'comments-link', 'Comments are off for this post' ); ?>
                                                    <?php
                                                }
                                            ?>
                                        </span>

                                        <?php
                                            if( get_post_meta(get_the_ID(),'thim_video_meta_time',true) ) :?>
                                            <span class="item-info">
                                                <?php echo get_post_meta(get_the_ID(),'thim_video_meta_time',true); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="text">
                                    <h4 class="title">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php get_the_title() ? the_title() : the_ID(); ?>
                                        </a>
                                    </h4>

                                    <div class="date">
                                        <?php echo get_the_date('M d, Y') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php endwhile;?>
            </div>
        </div>
    </div>
</div>
