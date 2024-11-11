<?php
/**
 * Template for displaying default template Posts element layout grid 1.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/posts/vblog-layout-grid-1.php.
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
 * @var $show_excerpt
 * @var $show_readmore
 * @var $show_number_favorite
 */
?>
<div class="wrap-element">
    <div class="row">
        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <div class="col-md-6 col-lg-4">
                <div class="item-post">
                    <div class="image-post">
                        <a href="<?php the_permalink(); ?>">
                            <?php
                                $size = apply_filters( 'builder-press/posts/tutorx-layout-grid-1/image-size', '360x258' );
                                builder_press_get_attachment_image( get_the_ID(), $size, 'post' );
                            ?>
                        </a>
                    </div>

                    <div class="text-post">
                        <h4 class="title-post">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h4>

                        <ul class="info-post">
                            <li class="hight-light">
                                <?php echo esc_html('By','builderpress') ?> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>"><?php echo get_the_author(); ?></a>
                            </li>

                            <li>
                                <?php echo get_the_date('F j, Y'); ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
