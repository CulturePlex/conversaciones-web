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

<div class="list-courses-2">
	<?php while ( $courses->have_posts() ) : $courses->the_post(); ?>
		<?php
        $course = learn_press_get_course( get_the_ID() );
        $duraton = get_post_meta( $course->get_id(), '_lp_duration', true );
        $terms = get_the_terms( $course->get_id(), 'course_category' );
        ?>

        <div class="course-item">
            <div class="term">
                <?php if($terms) echo esc_html($terms[0]->name);?>
            </div>

            <div class="pic">
                <a href="<?php the_permalink(); ?>">
                    <?php $size = apply_filters( 'builder-press/list-courses/layout-list/image-size', '270x230' );
                    builder_press_get_attachment_image( get_post_thumbnail_id( get_the_ID() ), $size ); ?>
                </a>
            </div>

            <div class="text">
                <div class="title">
                    <a class="title" href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </div>

                <div class="description">
                    <?php echo esc_html( $duraton );?> <?php echo esc_html__('to complete', 'builderpress') ?>
                </div>

                <div class="content">
                    <?php echo wp_trim_words( get_the_excerpt(), 40 ); ?>
                </div>
            </div>
        </div>
	<?php endwhile; ?>
</div>
