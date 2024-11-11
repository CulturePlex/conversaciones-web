<?php
/**
 * Template for displaying course content within the loop.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/content-course.php
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 4.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

global $layout_courses;
$layout_courses = get_theme_mod( 'layout_courses', 'default_courses' );
// learpress
$course = learn_press_get_course();
?>

<div id="post-<?php the_ID(); ?>" class="col-md-4 wrapper-item-course">
	<?php
	if ( $layout_courses === "left_courses" && $course ) {
		?>
		<div class="item-course color-2">

			<div class="pic">
				<?php learn_press_get_template( 'loop/course/thumbnail.php' ) ?>
				<div class="price<?php if ( $course->is_free() ) {
					echo ' free';
				} ?>">
					<?php echo esc_html( $course->get_price_html() ); ?>
					<?php if ( $course->has_sale_price() ) { ?>
						<span class="old-price"> <?php echo esc_html( $course->get_origin_price_html() ); ?></span>
					<?php } ?>
				</div>
			</div>
			<div class="text">
				<div class="teacher">
					<div class="ava">
						<?php echo ent2ncr( $course->get_instructor()->get_profile_picture( '', 68 ) ); ?>
					</div>
					<?php echo ent2ncr( $course->get_instructor_html() ); ?>
				</div>
				<h3 class="title-course">
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
				</h3>
				<?php do_action( 'thim-courses-loop-item-info' ); ?>
			</div>
		</div>
	<?php } else { ?>
		<div class="course-item">

			<?php learn_press_get_template( 'loop/course/thumbnail.php' ) ?>

			<div class="content">

				<?php do_action( 'thim-before-courses-loop-item-title' ); ?>

				<?php do_action( 'learn-press/courses-loop-item-title' ); ?>

			</div>

			<?php do_action( 'thim-courses-loop-item-info' ); ?>

		</div>
		<?php
	}
	?>

</div>
