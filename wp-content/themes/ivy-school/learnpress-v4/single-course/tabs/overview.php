<?php
/**
 * Template for displaying overview tab of single course.
 *
 * @author  ThimPress
 * @package CourseBuilder/Templates
 * @version 4.0.1
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$course = learn_press_get_course();
if ( ! $course ) {
	return;
}

$description_heading = apply_filters( 'learn_press_single_course_description_heading', '', $course );
?>

<?php if ( $description_heading ) { ?>

	<h2 class="course-description-heading" id="learn-press-course-description-heading">
		<?php echo wp_kses_post( $description_heading ); ?>
	</h2>

<?php } ?>

<div class="course-description" id="learn-press-course-description">
	<div id="tab-overview">
		<?php do_action( 'learn_press_begin_single_course_description' ); ?>

		<?php echo apply_filters( 'the_content', $course->get_content( '' ) ); ?>

		<?php do_action( 'learn_press_end_single_course_description' ); ?>
	</div>
</div>
