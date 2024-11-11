<?php
/**
 * Template for displaying default template Posts element marketing layout grid 2.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/posts/marketing-layout-grid-2.php.
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
    <?php
        if($post_link):
    ?>
        <a href="<?php echo esc_url($post_link['url']); ?>" class="link-element">
            <?php echo esc_html($post_link['title']); ?>
        </a>
    <?php
        endif;
    ?>

    <div class="row">
        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <div class="col-md-4">
                <div class="item-post">
                    <a href="<?php the_permalink(); ?>" class="image-post">
                        <?php
                        $size = apply_filters( 'builder-press/posts/marketing-layout-grid-2/image-size', '363x254' );
                        builder_press_get_attachment_image( get_the_ID(), $size, 'post' );
                        ?>

                        <div class="date-post">
                            <span class="number"><?php echo get_the_date('d') ?></span> <?php echo get_the_date('M') ?>
                        </div>
                    </a>

                    <div class="text-post">
                        <h4 class="title-post">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h4>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
