<?php
/**
 * Template for displaying price of single course.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/single-course/price.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$course = learn_press_get_course();
$user   = learn_press_get_current_user();
if ( ! $course || ! $user ) {
	return;
}
$is_buy_through_membership = false;
if ( class_exists( 'LP_Addon_PMPRO' ) ) {
	$is_buy_through_membership = LearnPress::instance()->settings->get( 'buy_through_membership' ) == 'yes' ? true : false;
}
$is_course_in_membership = (bool) get_post_meta( $course->get_id(), '_lp_pmpro_levels', false );

if ( ( $user && $user->has_enrolled_course( $course->get_id() ) ) || ( $is_buy_through_membership && $is_course_in_membership ) ) {
	return;
}

$price = $course->get_price_html();
if ( $price ) {

	$origin_price = $course->get_origin_price_html();

	$free_course = ( $price === 'Free' ) ? ' free' : '';
	echo '<span class="course-price' . $free_course . '">' . $price . '</span>';

	if ( $course->has_sale_price() ) {
		echo '<span class="course-origin-price">' . $origin_price . '</span>';
	}
}
