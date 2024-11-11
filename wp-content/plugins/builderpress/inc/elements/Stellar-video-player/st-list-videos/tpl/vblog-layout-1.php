<?php
/**
 * Template for displaying default template St-list-videos element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/st-list-videos/vblog-layout-1.php.
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
    <?php if($title) {?>
    <div class="heading-post">
        <h3 class="title">
            <?php echo $title;?>
        </h3>
    </div>
    <?php }?>
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

        <div id="box-video-<?php echo $key;?>" class="mfp-with-anim mfp-hide frame-video-popup"></div>

        <div class="feature-item">
            <div class="row">
                <div class="col-lg-9">
                    <div class="video">
                        <?php if ( has_post_thumbnail() ) { ?>
                            <div class="thumbnail">
                                <?php
                                $size = apply_filters( 'builder-press/Stellar-video-player/st-list-videos/image-size', '870x417' );
                                builder_press_get_attachment_image( get_the_ID(), $size, 'post' ); ?>
                            </div>
                        <?php } else { ?>
                            <div class="no-thumbnail"></div>
                        <?php } ?>

                        <a href="<?php the_permalink(); ?>" class="overlay"></a>

                        <div class="meta-info">
                            <?php if( get_post_meta(get_the_ID(),'thim_video_meta_imdb',true) ) {?>
                                <div class="imdb">
                                    <span class="value"><?php echo get_post_meta(get_the_ID(),'thim_video_meta_imdb',true);?></span><?php echo esc_html__( 'IMDb', 'builderpress' );?>
                                </div>
                            <?php }?>
                            <?php if( !empty($type) ) {?>
                                <div class="labels">
                                    <?php foreach ($type as $item) {
                                        $color = get_term_meta( $item->term_id, 'thim_type_color', true );
                                        ?>
                                        <div class="label"<?php echo ($color) ? ' style="background-color: '.$color.';"' : ''; ?>>
                                            <?php echo $item->name;?>
                                        </div>
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

                        <?php
                        if( get_post_meta(get_the_ID(),'thim_video_meta_time',true) ) :?>
                            <span class="time-info">
                                <?php echo get_post_meta(get_the_ID(),'thim_video_meta_time',true); ?>
                            </span>
                        <?php endif; ?>

                        <?php if( get_post_meta(get_the_ID(),'thim_video_meta_player_sc',true) || get_post_meta(get_the_ID(),'thim_video_meta_player_iframe',true) ) {?>
                            <a href="#box-video-<?php echo $key;?>" class="btn-play" data-id="<?php echo get_the_ID();?>" data-effect="mfp-zoom-in"></a>
                        <?php }?>

                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="text">
                        <h4 class="title">
                            <a class="title"
                               href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?>
                            </a>
                        </h4>

                        <div class="info">
                            <span class="item-info"><?php echo get_the_date(); ?></span>
                            <span class="item-info"><?php echo esc_html($cat);?></span>
                        </div>

                        <?php if( get_the_content() ) {?>
                            <div class="description">
                                <?php echo builder_press_excerpt( 15 ); ?>
                            </div>
                        <?php }?>

                        <a href="<?php the_permalink(); ?>" class="btn-readmore btn-normal shape-round">
                            <?php echo esc_html__('Read More', 'builderpress');?>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    <?php endwhile;?>
</div>
