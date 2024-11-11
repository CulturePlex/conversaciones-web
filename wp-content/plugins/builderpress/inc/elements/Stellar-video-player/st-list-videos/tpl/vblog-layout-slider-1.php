<?php
/**
 * Template for displaying default template St-list-videos element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/st-list-videos/vblog-layout-slider-1.php.
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

$link_all   = $params['link_all'];
$sub_title = $params['sub_title'];
?>
<div class="wrap-element">
    <div class="heading-post">
        <h3 class="title">
            <?php echo $title ? $title : esc_html__( 'Popular Videos', 'builderpress' );?>
        </h3>

        <?php if($sub_title) {?>
        <div class="description">
            <?php echo $sub_title;?>
        </div>
        <?php }?>

        <?php
        if($link_all):
            ?>
            <a href="<?php echo esc_url($link_all['url']) ?>" class="link"><?php echo esc_html($link_all['title']) ?></a>
        <?php
        endif;
        ?>
    </div>

    <div class="list-posts">
        <div class="slide-posts js-call-slick-videos" data-numofshow="4" data-numofscroll="1" data-loopslide="1" data-autoscroll="0" data-speedauto="6000" data-responsive="[4, 1], [4, 1], [3, 1], [2, 1], [1, 1]">
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
                    if( taxonomy_exists('type') ) {
                        $type = wp_get_post_terms(get_the_ID(),'type');
                    }
                    $key = rand(100,999);
                    ?>

                    <div class="item-slick">
                        <div id="box-video-<?php echo $key;?>" class="mfp-with-anim mfp-hide frame-video-popup"></div>
                        <div class="post-item">
                            <div class="pic">
                                <?php if ( has_post_thumbnail() ) { ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php
                                        $size = apply_filters( 'builder-press/Stellar-video-player/st-list-videos/image-size', '270x390' );
                                        builder_press_get_attachment_image( get_the_ID(), $size, 'post' ); ?>
                                    </a>
                                <?php } else { ?>
                                    <div class="no-thumbnail"></div>
                                <?php } ?>

                                <div class="overlay"></div>

                                <div class="meta-info">
                                    <?php if( get_post_meta(get_the_ID(),'thim_video_meta_imdb',true) ) {?>
                                        <div class="imdb">
                                            <span class="value"><?php echo get_post_meta(get_the_ID(),'thim_video_meta_imdb',true);?></span><?php echo esc_html__( 'IMDb', 'builderpress' );?>
                                        </div>
                                    <?php }?>

                                    <?php if( !empty($type) ) {?>
                                        <div class="labels">
                                            <?php foreach ($type as $item) {
                                                if( get_term_meta( $item->term_id, 'thim_type_color', true ) ) :
                                                    $color = get_term_meta( $item->term_id, 'thim_type_color', true );
                                                    ?>
                                                    <div class="label"<?php echo ($color) ? ' style="background-color: '.$color.';"' : ''; ?>>
                                                        <?php echo $item->name;?>
                                                    </div>
                                                <?php endif;?>
                                            <?php }?>
                                        </div>
                                    <?php }?>
                                </div>

                                <div class="meta">
                                    <?php if( get_post_meta(get_the_ID(),'thim_video_meta_like',true) ) {?>
                                        <div class="item item-like">
                                            <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> <?php echo get_post_meta(get_the_ID(),'thim_video_meta_like',true);?>
                                        </div>
                                    <?php }?>
                                    <?php if( get_post_meta(get_the_ID(),'thim_video_meta_comment',true) ) {?>
                                        <div class="item item-comment">
                                            <i class="fa fa-comments" aria-hidden="true"></i> <?php echo get_post_meta(get_the_ID(),'thim_video_meta_comment',true);?>
                                        </div>
                                    <?php }?>
                                </div>

                                <?php if( get_post_meta(get_the_ID(),'thim_video_meta_player_sc',true) || get_post_meta(get_the_ID(),'thim_video_meta_player_iframe',true) ) {?>
                                    <a href="#box-video-<?php echo $key;?>" class="btn-play" data-id="<?php echo get_the_ID();?>" data-effect="mfp-zoom-in"></a>
                                <?php }?>
                            </div>

                            <h4 class="title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php get_the_title() ? the_title() : the_ID(); ?>
                                </a>
                            </h4>

                            <div class="info">
                                <?php echo esc_html($cat);?>
                            </div>
                        </div>
                    </div>
                <?php endwhile;?>
            </div>
        </div>
    </div>
</div>