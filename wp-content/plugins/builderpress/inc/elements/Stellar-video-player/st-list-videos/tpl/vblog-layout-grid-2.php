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
$i=0;
$link_all   = $params['link_all'];
?>
<div class="wrap-element">
    <div class="heading-post">
        <div class="wrap-title">
            <h3 class="title">
                <?php echo $title ? $title : esc_html__( 'Popular Videos', 'builderpress' );?>
            </h3>
            <?php
            if($link_all):
                ?>
                <a href="<?php echo esc_url($link_all['url']) ?>" class="link"><?php echo esc_html($link_all['title']) ?></a>
            <?php
            endif;
            ?>
        </div>
        <?php if($filter_categories) {?>
        <div class="categories">
            <ul>
                <?php foreach ($cats_filter as $cat) {?>
                <li>
                    <a href="<?php echo esc_url( get_category_link( $cat->term_id ) );?>">
                        <?php echo esc_html( $cat->name );?>
                    </a>
                </li>
                <?php }?>
            </ul>
        </div>
        <?php }?>
    </div>

    <div class="grid-posts grid-isotope">
        <div class="grid-sizer"></div>
        <?php while ( $query->have_posts() ) : $query->the_post(); $i++; ?>
        <?php
            $size = '223x296';
            if( taxonomy_exists('type') ) {
                $type = wp_get_post_terms(get_the_ID(),'type');
            }
            ?>
        <div class="grid-item">
            <div class="post-item">
                <div class="pic">
                    <?php if ( has_post_thumbnail() ) { ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php
                            $size = apply_filters( 'builder-press/Stellar-video-player/st-list-videos/image-size', $size );
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
                                    $color = get_term_meta( $item->term_id, 'thim_type_color', true );
                                    ?>
                                    <div class="label"<?php echo ($color) ? ' style="background-color: '.$color.';"' : ''; ?>>
                                        <?php echo $item->name;?>
                                    </div>
                                <?php }?>
                            </div>
                        <?php }?>
                    </div>
                </div>

                <div class="content">
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