<?php
/**
 * Template for displaying course rate.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/addons/course-review/course-rate.php.
 *
 * @author  ThimPress
 * @package LearnPress/Course-Review/Templates
 * version  3.0.2
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! isset( $course_rate_res ) ) {
	return;
}

$rated = $course_rate_res['rated'] ?? 0;
$total = $course_rate_res['total'] ?? 0;
?>
<div class="reviews" id="tab-reviews">
	<div class="average-rating">
		<span class="number-rate"><?php printf( __( ' %1.1f ', 'course-builder' ), $rated ); ?></span>

		<?php LP_Addon_Course_Review_Preload::$addon->get_template( 'rating-stars.php', [ 'rated' => $rated ] );?>

		<p class="review-number">
			<?php do_action( 'learn_press_before_total_review_number' ); ?>
			<?php printf( _n( ' %d rating', '%d rating', $total, 'course-builder' ), $total ); ?>
			<?php do_action( 'learn_press_after_total_review_number' ); ?>
		</p>
	</div>

	<div class="detailed_rating">
		<?php
		if ( isset( $course_rate_res['items'] ) && ! empty( $course_rate_res['items'] ) ):
			foreach ( $course_rate_res['items'] as $item ):
				$percent = round( $item['percent'], 0 );
				?>
				<div class="course-rate">

					<span class="number-star"><?php printf( _n( '%s star', '%s stars', $item['rated'], 'course-builder' ), $item['rated']  ); ?></span>
					<div class="review-bar">
						<div class="rating" style="width:<?php echo esc_attr( $percent ); ?>% "></div>
					</div>
					<span class="percent"><?php echo esc_html( $percent ); ?>%</span>
				</div>
			<?php
			endforeach;
		endif;
		?>
		<?php if ( $total > 0 ) { ?>
			<div class="detail-content">
				<button class="review-details thim-collapse"><i class="fa fa-angle-down"></i></button>
			</div>
		<?php } ?>
	</div>
</div>
