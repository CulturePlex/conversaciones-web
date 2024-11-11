<?php
/**
 * Template for displaying content of single course.
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 4.0.0
 */

defined( 'ABSPATH' ) || exit;

get_header();

do_action( 'thim_wrapper_loop_start' );

while ( have_posts() ) {
	the_post();
	learn_press_get_template( 'content-single-course' );
}

/**
 * LP Hook
 */
do_action( 'learn-press/sidebar' );

do_action( 'thim_wrapper_loop_end' );

get_footer();
