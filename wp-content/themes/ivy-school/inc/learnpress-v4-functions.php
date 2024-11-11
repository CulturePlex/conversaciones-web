<?php
if ( ! function_exists( 'thim_add_course_collection_meta' ) ) {
	function thim_add_course_collection_meta() {
		lp_meta_box_text_input_field(
			array(
				'id'            => '_thim_course_collection_sub_title',
				'label'         => esc_html__( 'Sub Title', 'ivy-school' ),
				'description'   => esc_html__( 'Add sub title for Collection', 'ivy-school' ),
				'type'          => 'text',
				'type_input'  => 'text',
			)
		);
	}
}
add_action('learnpress/collections-settings/after', 'thim_add_course_collection_meta');

if ( ! function_exists( 'thim_save_course_collection_meta' ) ) {
	$post_id          = LP_Request::get_int( 'post' );
	function thim_save_course_collection_meta($post_id)
	{
		$course_pp = isset( $_POST['_thim_course_collection_sub_title'] ) ?  wp_unslash( $_POST['_thim_course_collection_sub_title']  ) : "";
		update_post_meta( $post_id, '_thim_course_collection_sub_title', $course_pp );
	}
}
add_action( 'learnpress_save_lp_collection_metabox', 'thim_save_course_collection_meta' );

// Enable override templates
add_filter( 'learn-press/override-templates', '__return_true' );
add_filter( 'lp/template-course/course_curriculum/skeleton', '__return_true' );

// Remove Breadcrumb on Page
LearnPress::instance()->template( 'general' )->remove( 'learn-press/before-main-content', array( '<div class="lp-archive-courses">', 'lp-archive-courses-open' ), -100 );
remove_action( 'learn-press/before-main-content', LearnPress::instance()->template( 'general' )->func( 'breadcrumb' ) );

/**
 * Check new version of addons LearnPress Woo Payment
 *
 * @return mixed
 */
function thim_is_version_addons_woo_payment( $version ) {
	if ( defined( 'LP_ADDON_WOO_PAYMENT_VER' ) ) {
		return ( version_compare( LP_ADDON_WOO_PAYMENT_VER, $version, '>=' ) );
	}

	return false;
}

if ( ! function_exists( 'thim_remove_learnpress_hooks' ) ) {
	function thim_remove_learnpress_hooks() {

        add_action(
			'init', function () {
			if ( class_exists( 'LP_Addon_Coming_Soon_Courses' ) ) {
				$instance_addon = LP_Addon_Coming_Soon_Courses::instance();
				remove_action( 'learn-press/course-content-summary', array( $instance_addon, 'coming_soon_message' ), 10 );
				remove_action( 'learn-press/course-content-summary', array( $instance_addon, 'coming_soon_countdown' ), 10 );
				add_action( 'learn-press/coming-soon-message', array( $instance_addon, 'coming_soon_message' ), 5 );
				add_action( 'learn-press/coming-soon-countdown', array( $instance_addon, 'coming_soon_countdown' ), 5 );

			}
			if ( class_exists( 'LP_WC_Hooks' ) && thim_is_version_addons_woo_payment( '4.0.3' ) ) {
				$lp_woo_hoocks = LP_WC_Hooks::instance();
 				add_action( 'thim-lp-course-btn_add_to_cart', array( $lp_woo_hoocks, 'btn_add_to_cart'  ) );
 			}
		}, 99
		);

	    LearnPress::instance()->template( 'course' )->remove( 'learn-press/single-button-toggle-sidebar', array( '<input type="checkbox" id="sidebar-toggle" />', 'single-button-toggle-sidebar' ), 5 );
 		remove_action( 'learn-press/user-profile-account', LearnPress::instance()->template( 'profile' )->func( 'socials' ), 10 );
		add_filter('learn-press/profile/header/sections', function (){
			return array(
				'profile/header/user-name.php',
				'profile/socials.php',
				'profile/header/user-bio.php',
			);
		});
	}
}
add_action( 'after_setup_theme', 'thim_remove_learnpress_hooks', 15 );

add_action( 'learn-press/before-main-content' , 'lp_archive_courses_open' , 10 );
if ( !function_exists( 'lp_archive_courses_open' ) ) {
    function lp_archive_courses_open() {
    	$courses_page_id = learn_press_get_page_id('courses');
		$courses_page_url = $courses_page_id ? get_page_link($courses_page_id): learn_press_get_current_url();
		if ( is_post_type_archive( LP_COURSE_CPT ) || is_page( learn_press_get_page_id( 'courses' ) ) ) {
			?>
<div id="lp-archive-courses" class="lp-archive-courses lp-4">
    <?php
        }
        elseif ( is_singular( LP_COURSE_CPT ) ) {
			?>
    <div id="lp-single-course" class="entry-content lp-single-course lp-4">
        <?php
		}
    }
}

add_action('theme_course_extra_boxes', LearnPress::instance()->template( 'course' )->func( 'course_extra_boxes' ), 5);

// filter archive course loop
add_filter( 'learn_press_course_loop_begin','learn_press_courses_loop_begin');
add_filter( 'learn_press_course_loop_end', 'learn_press_courses_loop_end');

if(! function_exists('learn_press_courses_loop_begin')){
	function learn_press_courses_loop_begin(){
		return '<div class="learn-press-courses grid-courses archive-page row ">';
	}
}
if(! function_exists('learn_press_courses_loop_end')){
	function learn_press_courses_loop_end(){
		return '</div>';
	}
}

// add action show loop instructor
add_action( 'thim-before-courses-loop-item-title', 'learn_press_courses_loop_item_instructor', 5 );
if ( ! function_exists( 'learn_press_courses_loop_item_instructor' ) ) {
	function learn_press_courses_loop_item_instructor() {
		learn_press_get_template( 'loop/course/instructor.php' );
	}
}


add_action( 'learn-press/content-landing', 'thim_course_content_tab_listing', 60);

function thim_course_content_tab_listing() {
	learn_press_get_template( 'single-course/tabs/tabs-listing.php' );
}

//Custom duration lesson, quiz
remove_action( 'learn-press/course-section-item/before-lp_quiz-meta', LearnPress::instance()->template( 'course' )->func( 'item_meta_duration' ), 20 );
remove_action( 'learn-press/course-section-item/before-lp_lesson-meta', LearnPress::instance()->template( 'course' )->func( 'item_meta_duration' ), 10 );


/** BEGIN: Checkout page */
remove_action('learn-press/after-checkout-form',LearnPress::instance()->template( 'checkout' )->func( 'account_logged_in' ),20);
remove_action( 'learn-press/after-checkout-form', LearnPress::instance()->template( 'checkout' )->func( 'order_comment' ), 60 );
add_action('learn-press/before-checkout-form',LearnPress::instance()->template( 'checkout' )->func( 'account_logged_in' ),9);
add_action('learn-press/before-checkout-form',LearnPress::instance()->template( 'checkout' )->func( 'order_comment' ),11);

// Add class for list course in profile page
add_filter( 'lp_item_course_class', 'add_item_course_class' );
if(!function_exists('add_item_course_class')){
    function add_item_course_class( $classes){
        $classes = array_merge(
            $classes,
            array( 'grid-courses', 'row')
        );
        return $classes;
    }
}

// add edit link in content course item
 add_action( 'learn-press/after-course-item-content', 'thim_content_item_edit_link', 3 );

// Add media for only Lesson
add_action( 'learn-press/before-course-item-content', 'thim_add_media_lesson_content', 5 );

/**
 * Add custom JS
 */
if ( ! function_exists( 'thim_add_custom_js' ) ) {
	function thim_add_custom_js() {
		//Add code js to open login-popup if not logged in.
		if ( thim_plugin_active( 'learnpress' ) ) {
  			if ( is_singular( 'lp_course' ) ) {
  				?>
        <script data-cfasync="true" type="text/javascript">
        (function($) {
            "use strict";
            $(document).on('click touch',
                'body:not(".logged-in") .enroll-course .button-enroll-course, body:not(".logged-in") form.purchase-course:not(".allow_guest_checkout") .btn-buy-course',
                function(e) {
                    e.preventDefault();
                    if ($('body').is(':not(.logged-in)')) {
                        $('.bp-element-login-popup .login').trigger('click');
                    } else {
                        window.location.href = $(this).parent().find('input[name=redirect_to]').val();
                    }
                });
        })(jQuery);
        </script>
        <?php
			}
		}
	}
}
add_action( 'wp_footer', 'thim_add_custom_js', 10000 );

function ivy_school_add_video_lesson() {
	lp_meta_box_textarea_field(
		array(
			'id'          => '_lp_lesson_video_intro',
			'label'       => esc_html__( 'Media', 'ivy-school' ),
			'description' => esc_html__( 'Add an embed link like video, PDF, slider...', 'ivy-school' ),
			'default'     => '',
		)
	);
}

add_action( 'learnpress/lesson-settings/after', 'ivy_school_add_video_lesson' );

add_action( 'learnpress_save_lp_lesson_metabox', function ( $post_id ) {
	$video = ! empty( $_POST['_lp_lesson_video_intro'] ) ? $_POST['_lp_lesson_video_intro'] : '';

	update_post_meta( $post_id, '_lp_lesson_video_intro', $video );
	}
);
// add cusom field for course
if ( ! function_exists( 'ivy_school_add_custom_field_course' ) ) {
	function ivy_school_add_custom_field_course() {
		lp_meta_box_text_input_field(
			array(
				'id'          => 'thim_course_media',
				'label'       => esc_html__( 'Media UR', 'ivy-school' ),
				'description' => esc_html__( 'Supports 3 types of video urls: Direct video link, Youtube link, Vimeo link.', 'ivy-school' ),
				'default'     => ''
			)
		);
		 lp_meta_box_text_input_field(
			array(
				'id'          => 'thim_course_info_button',
				'label'       => esc_html__( 'Info Button Box', 'ivy-school' ),
				'description' => esc_html__( 'Add text info button', 'ivy-school' ),
				'default'     => ''
			)
		);

		 lp_meta_box_textarea_field(
			array(
				'id'          => 'thim_course_includes',
				'label'       => esc_html__( 'Includes', 'ivy-school' ),
				'description' => esc_html__( 'Includes infomation of Courses', 'ivy-school' ),
				'default'     => ''
			)
		);
		 lp_meta_box_text_input_field(
			array(
				'id'          => 'thim_course_time',
				'label'       => esc_html__( 'Time', 'ivy-school' ),
				'description' => esc_html__( 'Show Time start and time end in course', 'ivy-school' ),
				'default'     => ''
			)
		);
		 lp_meta_box_text_input_field(
			array(
				'id'          => 'thim_course_day_of_week',
				'label'       => esc_html__( 'Day of Week', 'ivy-school' ),
				'description' => esc_html__( 'Show Day of Week Course', 'ivy-school' ),
				'default'     => ''
			)
		);
	}
}

add_action( 'learnpress/course-settings/after-general', 'ivy_school_add_custom_field_course' );

add_action('learnpress_save_lp_course_metabox', function ( $post_id ) {
		$thim_course_media         = ! empty( $_POST['thim_course_media'] ) ? $_POST['thim_course_media'] : '';
		$thim_course_info_button      = ! empty( $_POST['thim_course_info_button'] ) ? $_POST['thim_course_info_button'] : '';
		$thim_course_includes = ! empty( $_POST['thim_course_includes'] ) ? $_POST['thim_course_includes'] : '';
		$thim_course_time = ! empty( $_POST['thim_course_time'] ) ? $_POST['thim_course_time'] : '';
		$thim_course_day_of_week = ! empty( $_POST['thim_course_day_of_week'] ) ? $_POST['thim_course_day_of_week'] : '';

		update_post_meta( $post_id, 'thim_course_media', $thim_course_media );
		update_post_meta( $post_id, 'thim_course_info_button', $thim_course_info_button );
		update_post_meta( $post_id, 'thim_course_includes', $thim_course_includes );
		update_post_meta( $post_id, 'thim_course_time', $thim_course_time );
		update_post_meta( $post_id, 'thim_course_day_of_week', $thim_course_day_of_week );
	}
);
// add class fix style use don't description in page profile
add_filter( 'learn-press/profile/class', 'thim_class_has_description_user' );
function thim_class_has_description_user( $classes ) {
	$profile = LP_Profile::instance();
	$user    = $profile->get_user();
	if ( ! isset( $user ) ) {
		return;
	}
	$bio = $user->get_description();
	if ( ! $bio ) {
		$classes[] = 'no-bio-user';
	}

	return $classes;
}

/**
 * Add format icon before curriculum items
 *
 * @param $lesson_or_quiz
 * @param $enrolled
 */
if ( ! function_exists( 'thim_add_format_icon' ) ) {
	function thim_add_format_icon( $item ) {
		$format = get_post_format( $item->get_id() );
		if ( get_post_type( $item->get_id() ) == 'lp_quiz' ) {
			echo '<span class="course-format-icon"><i class="fa fa-puzzle-piece"></i></span>';
		} elseif ( $format == 'video' ) {
			echo '<span class="course-format-icon"><i class="fa fa-play-circle"></i></span>';
		} else {
			echo '<span class="course-format-icon"><i class="fa fa-file-o"></i></span>';
		}
	}
}

add_action( 'learn_press_before_section_item_title', 'thim_add_format_icon', 10, 1 );
