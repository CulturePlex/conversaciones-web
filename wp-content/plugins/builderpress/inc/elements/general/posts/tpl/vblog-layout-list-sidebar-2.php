<?php
/**
 * Template for displaying default template Posts element layout list sidebar 2
 *
 * This template can be overridden by copying it to yourtheme/builderpress/posts/vblog-layout-list-sidebar-2.php.
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

?>

<div class="wrap-element">
    <?php if( isset($title) ) {?>
        <h3 class="title-post"><?php echo esc_html( $title ); ?></h3>
    <?php }?>

    <div class="list-posts">
        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <div class="post-item">
                <a href="<?php the_permalink() ?>" class="pic">
                    <?php
                    $size = apply_filters( 'builder-press/posts/image-size', '93x90' );
                    builder_press_get_attachment_image( get_the_ID(), $size, 'post' ); ?>
                </a>

                <div class="text">
                    <h4 class="title">
                        <a href="<?php the_permalink(); ?>">
                            <?php get_the_title() ? the_title() : the_ID(); ?>
                        </a>
                    </h4>

                    <?php if ( $show_date ) { ?>
                        <div class="info">
                            <?php echo get_the_date(); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>