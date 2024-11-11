<?php
/**
 * Template for displaying default template St-list-videos element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/st-list-videos/vblog-layout-3.php.
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
?>
<div class="wrap-element">
    <?php if($filter_categories) {?>
        <div class="categories">
            <?php foreach ($cats_filter as $cat) {?>
                <a href="<?php echo esc_url( get_category_link( $cat->term_id ) );?>" class="item-cat">
                    <?php echo esc_html( $cat->name );?>
                </a>
            <?php }?>
        </div>
    <?php }?>

    <div class="row">
        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <?php
            $categories = get_the_category();
            $cat = '';
            if ( ! empty( $categories ) ) {
                $cat = $categories[0]->name;
            }
            ?>
            <div class="col-md-4">
                <div class="item-post">
                    <?php if ( has_post_thumbnail() ) { ?>
                        <div class="pic">
                            <a href="<?php the_permalink(); ?>">
                                <?php
                                $size = apply_filters( 'builder-press/Stellar-video-player/st-list-videos/image-size', '360x190' );
                                builder_press_get_attachment_image( get_the_ID(), $size, 'post' ); ?>
                            </a>
                            <div class="duration">9:47</div>
                        </div>
                    <?php }?>

                    <h4 class="title">
                        <a href="<?php the_permalink(); ?>">
                            <?php get_the_title() ? the_title() : the_ID(); ?>
                        </a>
                    </h4>

                    <span class="cat"><?php echo $cat;?></span>
                </div>
            </div>
        <?php endwhile;?>
    </div>

</div>