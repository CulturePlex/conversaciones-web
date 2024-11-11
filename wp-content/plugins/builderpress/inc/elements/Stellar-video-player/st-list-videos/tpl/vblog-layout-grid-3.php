<?php
/**
 * Template for displaying default template St-list-videos element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/st-list-videos/vblog-layout-grid-3.php.
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
global $i;
$i = 1;
?>
<div class="wrap-element">
    <div class="heading-post">
        <div class="wrap-title">
            <h3 class="title">
                <?php echo $title ? $title : esc_html__( 'Featured Videos', 'builderpress' );?>
            </h3>
        </div>

        <?php if($filter_categories): ?>
            <div class="categories">
            <ul>
                <?php
                foreach ($cats_filter as $cat):
                    ?>
                    <li>
                        <a href="<?php echo esc_url( get_category_link( $cat->term_id ) );?>">
                            <?php echo esc_html( $cat->name );?>
                        </a>
                    </li>
                <?php
                    endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>
    </div>

    <div class="grid-posts">
        <?php
            $i = 0;
            while ( $query->have_posts() ) : $query->the_post(); $i++;?>
            <?php
                $key = rand(100,999);
                if($i==1):
            ?>
            <div id="box-video-<?php echo $key;?>" class="mfp-with-anim mfp-hide frame-video-popup"></div>
            <div class="feature-item">
                <div class="pic">
                    <?php
                    $size = apply_filters( 'builder-press/Stellar-video-player/st-list-videos/vblog-layout-grid-3/image-size', '449x330' );
                    builder_press_get_attachment_image( get_the_ID(), $size, 'post' ); ?>
                    <?php
                    if( get_post_meta(get_the_ID(),'thim_video_meta_time',true) ) :?>
                        <div class="duration">
                            <?php echo get_post_meta(get_the_ID(),'thim_video_meta_time',true); ?>
                        </div>
                    <?php endif; ?>

                    <a href="#box-video-<?php echo $key;?>" data-id="<?php echo get_the_ID();?>"  class="btn-play">
                        <i class="ion ion-ios-play"></i>
                    </a>
                </div>

                <div class="text">
                    <h4 class="title">
                        <a href="<?php the_permalink(); ?>">
                            <?php get_the_title() ? the_title() : the_ID(); ?>
                        </a>
                    </h4>

                    <div class="info">
                        <span class="item-info">
                            <?php echo esc_html__('BY', 'builderpress') ?><a href=""> <?php echo esc_html__( get_the_author() );  ?></a>
                        </span>

                        <span class="item-info">
                            <?php echo get_the_date('M d, Y') ?>
                        </span>

                        <span class="item-info">
                             <?php
                             if ( comments_open() ) {
                                 ?>
                                 <?php comments_popup_link( '0 COMMENTS', '( 1 ) COMMENTS', '( % ) COMMENTS', 'comments-link', 'Comments are off for this post' ); ?>
                                 <?php
                             }
                             ?>
                        </span>
                    </div>
                </div>
            </div>
        <?php endif;
            endwhile; ?>

        <div class="normal-items">
            <?php
                $j = 0;
                while ( $query->have_posts() ) : $query->the_post(); $j++ ?>
                <?php
                    if($j > 1):
                    ?>
                    <div class="item">
                        <div class="pic">
                            <a href="<?php the_permalink(); ?>">
                                <?php
                                $size = apply_filters( 'builder-press/Stellar-video-player/st-list-videos/vblog-layout-grid-3/image-size', '160x121' );
                                builder_press_get_attachment_image( get_the_ID(), $size, 'post' ); ?>
                            </a>

                            <?php
                            if( get_post_meta(get_the_ID(),'thim_video_meta_time',true) ) :?>
                                <div class="duration">
                                    <?php echo get_post_meta(get_the_ID(),'thim_video_meta_time',true); ?>
                                </div>
                            <?php endif; ?>

                        </div>

                        <div class="text">
                            <h4 class="title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php get_the_title() ? the_title() : the_ID(); ?>
                                </a>
                            </h4>

                            <div class="info">
                                <?php echo get_the_date('M d, Y') ?>
                            </div>
                        </div>
                    </div>
                <?php endif;  ?>
            <?php   endwhile; ?>
        </div>
    </div>
</div>
