<?php
/**
 * Template for displaying instructor of course within the loop.
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$course = learn_press_get_course();
if ( ! $course  ) {
	return;
}
$course_rate   = learn_press_get_course_rate( $course->get_id() );
$non_star = 5 - intval($course_rate);
?>
<div class="star">
    <?php for ($i=0;$i<intval($course_rate);$i++) {?>
        <i class="fa fa-star"></i>
    <?php }?>
    <?php for ($j=0;$j<intval($non_star);$j++) {?>
        <i class="fa fa-star-o"></i>
    <?php }?>
</div>
