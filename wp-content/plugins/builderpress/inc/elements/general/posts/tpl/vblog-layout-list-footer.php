<?php
/**
 * Template for displaying default template Posts element layout vblog-layout-list-footer.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/posts/vblog-layout-list-footer.
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

/**
 * @var $query
 * @var $title
 * @var $show_date
 * @var $show_author
 * @var $show_number_comments
 */
?>
<?php if( isset($title) ) {?>
    <h3 class="title"><?php echo esc_html( $title ); ?></h3>
<?php }?>
<div class="wrap-element">
    <div class="list-posts">
        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <div class="item">
                <?php if ( has_post_thumbnail() ) { ?>
                    <div class="pic">
                        <?php
                        $size = apply_filters( 'builder-press/posts/image-size', '100x70' );
                        builder_press_get_attachment_image( get_the_ID(), $size, 'post' ); ?>
                    </div>
                <?php } else { ?>
                    <div class="no-thumbnail"></div>
                <?php } ?>
                <div class="text">
                    <h4 class="title">
                        <a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
                    </h4>
                    <span class="date"><?php echo get_the_date(); ?></span>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>