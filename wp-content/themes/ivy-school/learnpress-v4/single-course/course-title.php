<?php
/**
 * Template for displaying course info of single course.
 *
 * @author   ThimPress
 * @package  CourseBuilder/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$course_id = get_the_ID();
$course    = learn_press_get_course( $course_id );
?>
<header class="entry-header">
    <h2 class="entry-title">
        <?php echo esc_html($course->get_title());?>
    </h2>
</header>
