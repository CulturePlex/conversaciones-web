<?php
/**
 * Template for displaying default template Learnpress Course Reviews element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/course-reviews/course-reviews.php.
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

if ( ! function_exists( 'learn_press_get_course_review' ) ) {
	return;
}

// global params
$template_path = $params['template_path'];

$layout         = isset( $params['layout'] ) ? $params['layout'] : 'layout-list';
$course_id      = $params['course'];
$number_reviews = $params['number_reviews'];
$style_layout = !empty($params['style_layout']) ? $params['style_layout'] : '';
$el_class       = $params['el_class'];
$el_id          = $params['el_id'];
$bp_css         = $params['bp_css'];

if ( $course_id ) {
	$course_review = learn_press_get_course_review( $course_id, 1, $number_reviews );
	$reviews       = $course_review['reviews'];
} else {
    global $wpdb;
	$query = $wpdb->prepare( "
	        SELECT SQL_CALC_FOUND_ROWS u.*, c.comment_ID as comment_id, cm1.meta_value as title, c.comment_content as content, cm2.meta_value as rate
	        FROM {$wpdb->posts} p
	        INNER JOIN {$wpdb->comments} c ON p.ID = c.comment_post_ID
	        INNER JOIN {$wpdb->users} u ON u.ID = c.user_id
	        INNER JOIN {$wpdb->commentmeta} cm1 ON cm1.comment_id = c.comment_ID AND cm1.meta_key = %s
	        INNER JOIN {$wpdb->commentmeta} cm2 ON cm2.comment_id = c.comment_ID AND cm2.meta_key = %s
	        WHERE c.comment_type = %s AND c.comment_approved = %d
	        ORDER BY c.comment_date DESC
	        LIMIT %d, %d
	    ", '_lpr_review_title', '_lpr_rating', 'review', 1, 0, $number_reviews );

	$reviews = $wpdb->get_results( $query );
}

if ( ! $reviews ) {
	return;
} ?>

<div class="bp-element bp-element-course-reviews <?php echo is_plugin_active('js_composer/js_composer.php') ? vc_shortcode_custom_css_class( $bp_css ) : '';?> <?php echo esc_attr( $layout ); ?> <?php echo esc_attr($style_layout); ?> <?php echo esc_attr( $el_class ); ?>" <?php echo $el_id ? "id='" . esc_attr( $el_id ) . "'" : '' ?>>

	<?php builder_press_get_template( $layout, array(
		'reviews' => $reviews,
		'params'  => $params
	), $template_path ); ?>

</div>
