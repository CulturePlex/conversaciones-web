<?php
/**
 * Template for displaying default template St-list-videos element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/st-list-videos/vblog-layout-2.php.
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
    <div class="row no-gutters">
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

            <div class="col-md-4">
                <div class="video-item">
                    <div id="box-video-<?php echo $key;?>" class="mfp-with-anim mfp-hide frame-video-popup"></div>

                    <?php if ( has_post_thumbnail() ) { ?>
                        <?php
                        $size = apply_filters( 'builder-press/Stellar-video-player/st-list-videos/image-size', '640x560' );
                        builder_press_get_attachment_image( get_the_ID(), $size, 'post' ); ?>
                    <?php } else { ?>
                        <div class="no-thumbnail"></div>
                    <?php } ?>

                    <div class="overlay"></div>

                    <div class="content">
                        <div class="meta-info">
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

                            <?php if( get_post_meta(get_the_ID(),'thim_video_meta_imdb',true) ) {?>
                                <div class="imdb">
                                    <i class="ion ion-android-star"></i>
                                    <?php echo get_post_meta(get_the_ID(),'thim_video_meta_imdb',true);?> / 10
                                </div>
                            <?php }?>
                        </div>

                        <h4 class="title">
                            <a href="<?php the_permalink(); ?>">
                                <?php get_the_title() ? the_title() : the_ID(); ?>
                            </a>
                        </h4>
                    </div>

                    <?php if( get_post_meta(get_the_ID(),'thim_video_meta_player_sc',true) || get_post_meta(get_the_ID(),'thim_video_meta_player_iframe',true) ) {?>
                        <a href="#box-video-<?php echo $key;?>" class="btn-play" data-id="<?php echo get_the_ID();?>" data-effect="mfp-zoom-in"></a>
                    <?php }?>
                </div>
            </div>
        <?php endwhile;?>
    </div>
</div>
