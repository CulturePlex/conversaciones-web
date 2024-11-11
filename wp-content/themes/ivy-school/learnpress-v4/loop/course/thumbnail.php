<?php
/**
 * Template for displaying thumbnail of course within the loop.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/loop/course/thumbnail.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$course = learn_press_get_course();
if ( ! $course ) {
	return;
}
?>

<div class="image">
	<a href="<?php the_permalink(); ?>">
		<?php
		echo thim_feature_image( get_post_thumbnail_id( $course->get_id() ), 412, 288, false );
		?>
	</a>
	<?php do_action( 'thim-lp-course-btn_add_to_cart' ); ?>
</div>
