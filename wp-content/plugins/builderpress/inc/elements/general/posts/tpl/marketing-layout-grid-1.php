<?php
/**
 * Template for displaying default template Posts element marketing layout grid 1.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/posts/marketing-layout-grid-1.php.
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
    <div class="row">
        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <div class="col-md-4">
                <div class="item-post">
                    <div class="image-post">
                        <?php
                        $size = apply_filters( 'builder-press/posts/marketing-layout-grid-1/image-size', '362x254' );
                        builder_press_get_attachment_image( get_the_ID(), $size, 'post' );
                        ?>
                        <a href="<?php the_permalink(); ?>" class="overlay-post"></a>

                        <div class="date-post">
                            <span class="number"><?php echo get_the_date('d') ?></span> <?php echo get_the_date('M') ?>
                        </div>
                    </div>

                    <div class="text-post">
                        <h4 class="title-post">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h4>

                        <div class="content-post">
                            <?php echo builder_press_excerpt( 17 );  ?>
                        </div>

                        <div class="info-post">
                            <?php  echo esc_html__('by','builderpress');  ?><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ))) ?>"> <?php echo get_the_author(); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
