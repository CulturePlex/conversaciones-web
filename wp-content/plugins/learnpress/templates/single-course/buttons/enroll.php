<?php
/**
 * Template for displaying Enroll button in single course.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/single-course/buttons/enroll.php.
 *
 * @author  ThimPress
 * @package  Learnpress/Templates
 * @version  4.0.0
 */

defined('ABSPATH') || exit();

if (! isset($course)) {
    $course = learn_press_get_course();
}
?>

<?php do_action('learn-press/before-enroll-form'); ?>


<?php if (is_user_logged_in()) : ?>
	<!-- Show the enroll form if user is logged in -->
	<form name="enroll-course" class="enroll-course" method="post" enctype="multipart/form-data">

		<?php do_action('learn-press/before-enroll-button'); ?>

		<input type="hidden" name="enroll-course" value="<?php echo esc_attr($course->get_id()); ?>"/>

		<button class="lp-button button button-enroll-course">
			<?php echo esc_html(apply_filters('learn-press/enroll-course-button-text', esc_html__('Start Now', 'learnpress'))); ?>
		</button>

		<?php do_action('learn-press/after-enroll-button'); ?>

	</form>
<?php else : ?>
	<!-- Show login link if user is not logged in -->
	<div class="enroll-login-prompt">
		<p><?php esc_html_e('You need to be logged in to enroll in this course.', 'customtranslations'); ?></p>
		<a href="<?php echo esc_url(wp_login_url(get_permalink())); ?>" class="lp-button button">
			<?php esc_html_e('Login to Enroll', 'customtranslations'); ?>
		</a>
	</div>
<?php endif; ?>

<?php do_action('learn-press/after-enroll-form'); ?>
