<?php
/**
 * Template default for displaying content of archive courses page.
 * If you want to override layout default, please override via hook 'learn-press/list-courses/layout', or another hook inside.
 * Override file is will be soon not support on the feature. Because it is many risks.
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 4.0.2
 */

defined( 'ABSPATH' ) || exit;

/**
 * @since 4.0.0
 *
 * @see LP_Template_General::template_header()
 */
if ( ! wp_is_block_theme() ) {
	do_action( 'learn-press/template-header' );
}


do_action( 'thim_wrapper_loop_start' );

/**
 * LP Hook
 */
do_action( 'learn-press/before-main-content' );

do_action( 'lp/template/archive-course/description' );

?>


<?php

LearnPress::instance()->template( 'course' )->begin_courses_loop();

if ( LP_Settings_Courses::is_ajax_load_courses() && ! LP_Settings_Courses::is_no_load_ajax_first_courses() ) {
	echo '<div class="lp-archive-course-skeleton" style="width:100%">';
	echo '</div>';
} else {
	if ( have_posts() ) {
		while ( have_posts() ) :
			the_post();

			learn_press_get_template_part( 'content', 'course' );

		endwhile;
	} else {
		LearnPress::instance()->template( 'course' )->no_courses_found();
	}

	if ( LP_Settings_Courses::is_ajax_load_courses() ) {
		echo '<div class="lp-archive-course-skeleton no-first-load-ajax" style="width:100%; display: none">';
		echo '</div>';
	}
}

LearnPress::instance()->template( 'course' )->end_courses_loop();

?>

<?php


/**
* LP Hook
*
* @since 4.0.0
*/
do_action( 'learn-press/sidebar' );

do_action( 'thim_wrapper_loop_end' );

/**
 * @since 4.0.0
 *
 * @see   LP_Template_General::template_footer()
 */
if ( ! wp_is_block_theme() ) {
	do_action( 'learn-press/template-footer' );
}
