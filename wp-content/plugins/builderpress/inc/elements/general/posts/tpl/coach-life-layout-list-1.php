<?php
/**
 * Template for displaying default template Posts element layout coach-life-layout-1.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/posts/coach-life-layout-1.php.
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

<div class="wrap-element">
    <?php if( !empty($title) ) {?>
        <h3 class="title-post"><?php echo esc_html( $title ); ?></h3>
    <?php }?>

    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
        <div class="item-post">
            <?php
                if($show_image):
            ?>
                <a href="<?php the_permalink(); ?>" class="image-post">
                    <?php
                        $size = apply_filters( 'builder-press/posts/coach-life-layout-list-1/image-size', '114x114' );
                        builder_press_get_attachment_image( get_the_ID(), $size, 'post' ); ?>
                </a>
            <?php
                endif;
            ?>
            <div class="text-post">
                <ul class="info-post">
                    <li>
                        <?php echo get_the_date("F j, Y"); ?>
                    </li>

                    <li class="highlights">
                        <?php echo esc_html('BY','builderpress') ?> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>"><?php echo get_the_author(); ?></a>
                    </li>
                </ul>

                <h4 class="title-post">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h4>

                <div class="description-post">
                    <?php echo wp_trim_words( get_the_excerpt(), 20, ' '); ?>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>