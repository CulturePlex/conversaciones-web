<?php
/**
 * Template for displaying layout 1 content of landing course.
 *
 * @author   ThimPress
 * @package  CourseBuilder/Templates
 * @version  4.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$show_info_sidebar = $thim_cms_show_details = $thim_cms_show_metadata = true;
if ( class_exists( 'LP_Addon_Coming_Soon_Courses' ) ) {
	$instance_addon = LP_Addon_Coming_Soon_Courses::instance();
	if ( $instance_addon->is_coming_soon( get_the_ID() ) && 'no' == get_post_meta( get_the_ID(), '_lp_coming_soon_metadata', true ) ) {
		$thim_cms_show_metadata = false;
	}
	if ( $instance_addon->is_coming_soon( get_the_ID() ) ) {
		$show_info_sidebar = false;
	}
	if ( $instance_addon->is_coming_soon( get_the_ID() ) && 'no' == get_post_meta( get_the_ID(), '_lp_coming_soon_details', true ) ) {
		$thim_cms_show_details = false;
	}
}

?>

<div class="row">
    <div class="col-lg-9 col-xl-9 col-md-12">
        <div class="course-summary wrap-content-single-course">
            <div class="landing-1">

                <?php learn_press_get_template( 'single-course/course-title.php' ); ?>

                <?php
				if ( $thim_cms_show_metadata ) {
					learn_press_get_template( 'single-course/course-info.php' );
				}
				?>

                <?php learn_press_get_template( 'single-course/thumbnail.php' ); ?>
                <?php do_action( 'learn-press/coming-soon-message' ); ?>
                <?php if ( $thim_cms_show_details ) { ?>
                <div class="course-landing-summary">

                    <div class="content-landing-1">
                        <?php
 							do_action( 'learn-press/content-landing' ); ?>

                    </div>

                </div>
                <?php }; ?>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-xl-3 col-md-12 sticky-sidebar">
        <?php do_action( 'thim-info-bar-position' ); ?>
    </div>
</div>