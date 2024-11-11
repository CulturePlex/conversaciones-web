<?php
/**
 * Template for displaying infobar of landing course.
 *
 * @author   ThimPress
 * @package  CourseBuilder/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

?>

<?php
$course_info_button = get_post_meta( get_the_ID(), 'thim_course_info_button', true );
$course_includes    = get_post_meta( get_the_ID(), 'thim_course_includes', true );
$course             = learn_press_get_course();
if( ! $course){
	return;
}
$course_id     = $course->get_id();
$check_courses = 'yes';
if ( class_exists( 'LP_Addon_Coming_Soon_Courses' ) ) {
	$instance_addon = LP_Addon_Coming_Soon_Courses::instance();
	if ( $instance_addon->is_coming_soon( get_the_ID() ) ) {
		$check_courses = 'no';
	}
}
?>

<aside class="info-bar sidebar sticky-sidebar">

	<?php if ( $course->get_course_price_html() ) { ?>
		<div class="price-box">
			<span><?php echo esc_html__( 'Price', 'ivy-school' ); ?></span>
			<?php echo wp_kses_post( $course->get_course_price_html() ); ?>
		</div>
	<?php } ?>

	<div class="inner-content">
		<div class="button-box">
			<?php
			if ( $check_courses == 'yes' ) {
				learn_press_get_template( 'single-course/buttons.php' );
			}
			?>
			<?php if ( ! empty( $course_info_button ) ) { ?>
				<p class="intro"><?php echo ent2ncr( $course_info_button ); ?></p>
			<?php } ?>
		</div>

		<?php if ( ! empty( $course_includes ) ) { ?>
			<div class="info-course">
				<?php echo ent2ncr( $course_includes ); ?>
			</div>
		<?php } ?>

		<?php if ( get_theme_mod( 'learnpress_show_sharing' ) == true ) : ?>
			<div class="social-link">
				<?php thim_social_share( 'learnpress_single_' ); ?>
			</div>
		<?php endif; ?>


	</div>

	<?php
	$tags = get_the_terms( get_the_ID(), 'course_tag' );
	if ( $tags ) {
		?>
		<div class="tags">
			<h3><?php echo esc_html__( 'Tags', 'ivy-school' ); ?>:</h3>
			<div class="list-tags">
				<?php foreach ( $tags as $tag ) { ?>
					<a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>"><?php echo esc_html( $tag->name ); ?></a>
				<?php } ?>
			</div>
		</div>
	<?php } ?>

</aside>
