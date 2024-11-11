<?php
/**
 * Template for displaying progress of single course.
 *
 * @author   ThimPress
 * @package  CourseBuilder/Templates
 * @version  3.0.1
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$user   = learn_press_get_current_user();
$course = learn_press_get_course();

if ( ! $course || ! $user ) {
	return;
}

// get course id
$course_id = $course->get_id();

if ( ! $user->has_enrolled_course( $course_id ) ) {
	return;
}

// user course data
$course_data     = $user->get_course_data( $course_id );
$completed_items = 0;
$result          = 0;
if ( $course_data ) {
	$course_results  = $course_data->get_result();
	$result          = round( $course_results['result'], 2 );
	$completed_items = $course_results['completed_items'];
}
$passing_condition = $course->get_passing_condition();
$course_items      = $course->count_items();
?>

<div class="learn-press-course-results-progress">

    <div class="items-progress">
        <div class="lp-course-status">
            <span
                class="number"><?php printf( esc_html__( '%1$d of %2$d items', 'ivy-school' ), $completed_items, $course_items ); ?></span>
            <span class="extra-text"><?php esc_html_e( ' completed', 'ivy-school' ); ?></span>
        </div>
    </div>

    <div class="course-progress">
        <div class="lp-course-status">
            <span class="number"><?php echo esc_html( $result ); ?><span class="percentage-sign">%</span></span>
            <span class="lp-label grade in-progress"><?php esc_html_e( 'In Progress', 'ivy-school' ); ?></span>
        </div>
        <div class="lp-course-progress <?php echo esc_attr( $course_data->is_passed() ? ' passed' : '' ); ?>"
            data-value="<?php echo esc_attr( $result ); ?>"
            data-passing-condition="<?php echo esc_attr( $passing_condition ); ?>"
            style="--passing-condition:<?php echo esc_attr( $passing_condition ); ?>%">
            <div class="lp-progress-bar progress-bg">
                <div class="lp-progress-value progress-active" style="left: <?php echo esc_attr( $result ); ?>%;"></div>
            </div>
            <div class="lp-passing-conditional"
                data-content="<?php printf( esc_html__( 'Passing condition: %s%%', 'ivy-school' ), $passing_condition ); ?>"
                style="left: <?php echo esc_attr( $passing_condition ); ?>%;">
            </div>
        </div>
    </div>
</div>
