<?php
/**
 * Template for displaying default template Learnpress List Courses element layout list.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/list-courses/layout-list.php.
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

<div class="list-courses">
	<?php while ( $courses->have_posts() ) : $courses->the_post(); ?>
		<?php $course = learn_press_get_course( get_the_ID() ); ?>

        <div class="item clearfix">
            <div class="thumbnail">
                <a href="<?php the_permalink(); ?>">
					<?php $size = apply_filters( 'builder-press/list-courses/layout-list/image-size', '200x200' );
					builder_press_get_attachment_image( get_post_thumbnail_id( get_the_ID() ), $size ); ?>
                </a>
            </div>
            <div class="content">
                <a class="title" href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
                </a>
                <div class="list-meta course-price">
                <span class="value">
                    <?php echo esc_html( $course->get_price_html() ); ?>
                </span>
                </div>
            </div>
        </div>
	<?php endwhile; ?>
</div>
