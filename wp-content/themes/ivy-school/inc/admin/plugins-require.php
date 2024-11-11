<?php
if ( ! function_exists( 'thim_get_all_plugins_require' ) ) {
	function thim_get_all_plugins_require( $plugins ) {
		$extra_plugin = $sp_lp3 = array();
		if ( apply_filters( 'thim_required_plugin_sp_lp3', false ) ) {
			$sp_lp3 = array(
				array(
					'name'       => 'Theme Ivyschool Layout LearnPress V3',
					'slug'       => 'ivyschool-learnpress-v3',
					'premium'    => true,
					'required'   => false,
					'no-install' => true,
				),
			);
		}
		$plugins = array(
			array(
				'name'     => 'WPBakery Page Builder',
				'slug'     => 'js_composer',
				'premium'  => true,
	//			'version'  => '5.4.5',
				'required' => false,
				'icon'        => 'https://s3.envato.com/files/260579516/wpb-logo.png',
			),
			array(
				'name'     => 'Slider Revolution',
				'slug'     => 'revslider',
				'premium'  => true,
				'required' => false,
	//			'version'  => '5.4.5.1',
			),
			array(
				'name'     => 'SiteOrigin Page Builder',
				'slug'     => 'siteorigin-panels',
				'required' => false,
			),
			array(
				'name'     => 'Elementor Page Builder',
				'slug'     => 'elementor',
				'required' => false,
			),
			array(
				'name'     => 'Thim Elementor Kit',
				'slug'     => 'thim-elementor-kit',
				'required' => false,
			),
			array(
				'name' => 'Contact Form 7',
				'slug' => 'contact-form-7'
			),
			array(
				'name'        => 'MC4WP: Mailchimp for WordPress',
				'slug'        => 'mailchimp-for-wp',
				'required'    => false,
				//'version'     => '6.4.5',
				'description' => 'Mailchimp for WordPress by ibericode. Adds various highly effective sign-up methods to your site.',
			),
			array(
				'name'     => 'Instagram Feed',
				'slug'     => 'instagram-feed',
				'required' => false,
			),

			array(
				'name'        => 'BuilderPress',
				'slug'        => 'builderpress',
				'premium'     => true,
				'required'    => true,
				//'version'     => '1.0',
				'description' => 'Full of Thim features for page builders: Visual Composer, Site Origin, Elementor',
			),
			array(
				'name'        => 'LearnPress',
				'slug'        => 'learnpress',
				'required'    => true,
				//'version'     => '3.0',
				'description' => 'LearnPress is a WordPress complete solution for creating a Learning Management System (LMS). It can help you to create courses, lessons and quizzes. By ThimPress.',
			),

			array(
				'name'        => 'LearnPress Certificates',
				'slug'        => 'learnpress-certificates',
				'premium'     => true,
				'required'    => false,
				'icon'        => 'https://plugins.thimpress.com/downloads/images/learnpress-certificates.png',
				//'version'     => '3.0',
				'description' => 'An addon for LearnPress plugin to create certificate for a course By ThimPress.',
				'add-on'      => true,
			),

			array(
				'name'        => 'LearnPress Collections',
				'slug'        => 'learnpress-collections',
				'premium'     => true,
				'required'    => false,
				'icon'        => 'https://plugins.thimpress.com/downloads/images/learnpress-collections.png',
				//'version'     => '3.0',
				'description' => 'Collecting related courses into one collection by administrator By ThimPress.',
				'add-on'      => true,
			),

			array(
				'name'        => 'LearnPress - Paid Memberships Pro',
				'slug'        => 'learnpress-paid-membership-pro',
				'premium'     => true,
				'required'    => false,
				'icon'        => 'https://plugins.thimpress.com/downloads/images/learnpress-paid-membership-pro.png',
				//'version'     => '3.0',
				'description' => 'Paid Membership Pro add-on for LearnPress By ThimPress.',
				'add-on'      => true,
			),

			array(
				'name'        => 'LearnPress Co-Instructors',
				'slug'        => 'learnpress-co-instructor',
				'premium'     => true,
				'required'    => false,
				'icon'        => 'https://plugins.thimpress.com/downloads/images/learnpress-co-instructor.png',
				//'version'     => '3.0',
				'description' => 'Building courses with other instructors By ThimPress.',
				'add-on'      => true,
			),

			array(
				'name'        => 'LearnPress Course Review',
				'slug'        => 'learnpress-course-review',
				'required'    => false,
				//'version'     => '3.0',
				'description' => 'Adding review for course By ThimPress.',
				'add-on'      => true,
			),

			array(
				'name'        => 'LearnPress - Coming Soon Courses',
				'slug'        => 'learnpress-coming-soon-courses',
				'premium'     => true,
				'required'    => false,
				//'version'     => '3.0',
				'description' => 'Set a course is "Coming Soon" and schedule to public',
				'add-on'      => true,
			),

			array(
				'name'        => 'LearnPress Wishlist',
				'slug'        => 'learnpress-wishlist',
				'required'    => false,
				//'version'     => '3.0',
				'description' => 'Wishlist feature By ThimPress.',
				'add-on'      => true,
			),

			array(
				'name'        => 'LearnPress Instructor Commission',
				'slug'        => 'learnpress-commission',
				'premium'     => true,
				'required'    => false,
				//'version'     => '3.0',
				'description' => 'Commission add-on for LearnPress.',
				'add-on'      => true,
			),

			array(
				'name'        => 'LearnPress Prerequisites Courses',
				'slug'        => 'learnpress-prerequisites-courses',
				'required'    => false,
				//'version'     => '3.0',
				'description' => 'Allow you to set prerequisite courses for a certain course in a LearnPress site',
				'add-on'      => true,
			),

			array(
				'name'        => 'LearnPress BuddyPress Integration',
				'slug'        => 'learnpress-buddypress',
				'required'    => false,
				//'version'     => '3.0',
				'description' => 'You can view the courses you have taken, finished or wanted to learn inside of wonderful profile page of BuddyPress with LearnPress buddyPress plugin.',
				'add-on'      => true,
			),

			array(
				'name'        => 'LearnPress Offline Payment',
				'slug'        => 'learnpress-offline-payment',
				'required'    => false,
				//'version'     => '3.0',
				'description' => 'Allow you to manually create order for offline payment instead of paying via any payment gateways to sell course.',
				'add-on'      => true,
			),

			array(
				'name'        => 'LearnPress Fill in Blank Question',
				'slug'        => 'learnpress-fill-in-blank',
				'required'    => false,
				//'version'     => '3.0',
				'description' => 'It brings fill-in-blank question type feature to your courses quizzes.',
				'add-on'      => true,
			),

			array(
				'name'        => 'LearnPress - WooCommerce Payments',
				'slug'        => 'learnpress-woo-payment',
				'premium'     => true,
				'required'    => false,
				//'version'     => '3.0',
				'description' => 'Using the payment system provided by WooCommerce.',
				'add-on'      => true,
			),

			array(
				'name'        => 'LearnPress - Content Drip',
				'slug'        => 'learnpress-content-drip',
				'premium'     => true,
				'required'    => false,
				//'version'     => '3.0',
				'description' => 'Decide when learners will be able to access the lesson content.',
				'add-on'      => true,
			),

			array(
				'name'        => 'LearnPress - Authorize.net Payment',
				'slug'        => 'learnpress-authorizenet-payment',
				'premium'     => true,
				'required'    => false,
				//'version'     => '3.0',
				'description' => 'Payment Authorize.net for LearnPress.',
				'add-on'      => true,
			),

			array(
				'name'        => 'LearnPress - Gradebook',
				'slug'        => 'learnpress-gradebook',
				'premium'     => true,
				'required'    => false,
				//'version'     => '3.0',
				'description' => 'Adding Course Gradebook for LearnPress.',
				'add-on'      => true,
			),

			array(
				'name'        => 'LearnPress - myCred Integration',
				'slug'        => 'learnpress-mycred',
				'premium'     => true,
				'required'    => false,
				//'version'     => '3.0',
				'description' => 'Running with the point management system - myCred.',
				'add-on'      => true,
			),

			array(
				'name'        => 'LearnPress - Randomize Quiz Questions',
				'slug'        => 'learnpress-random-quiz',
				'premium'     => true,
				'required'    => false,
				//'version'     => '3.0',
				'description' => 'Mix all available questions in a quiz',
				'add-on'      => true,
			),

			array(
				'name'        => 'LearnPress - Stripe Payment',
				'slug'        => 'learnpress-stripe',
				'premium'     => true,
				'required'    => false,
				//'version'     => '3.0',
				'description' => 'Stripe payment gateway for LearnPress',
				'add-on'      => true,
			),

			array(
				'name'        => 'LearnPress - Sorting Choice Question',
				'slug'        => 'learnpress-sorting-choice',
				'premium'     => true,
				'required'    => false,
				//'version'     => '3.0',
				'description' => 'Sorting Choice provide ability to sorting the options of a question to the right order',
				'add-on'      => true,
			),

			array(
				'name'        => 'LearnPress - Students List	',
				'slug'        => 'learnpress-students-list',
				//'source'      => 'https://plugins.thimpress.com/downloads/eduma-plugins/learnpress-students-list.zip',
				'premium'     => true,
				'required'    => false,
				//'version'     => '3.0',
				'description' => 'Get students list by filters.',
				'add-on'      => true,
			),

			array(
				'name'        => 'LearnPress bbPress',
				'slug'        => 'learnpress-bbpress',
				'required'    => false,
				//'version'     => '3.0',
				'description' => 'Using the forum for courses provided by bbPress By ThimPress.',
				'add-on'      => true,
			),

			array(
				'name'        => 'LearnPress Export Import',
				'slug'        => 'learnpress-import-export',
				'required'    => false,
				//'version'     => '3.0',
				'description' => 'Allow export course, lesson, quiz, question from a LearnPress site to back up or bring to another LearnPress site.',
				'add-on'      => true,
			),

			array(
				'name'     => 'WooCommerce',
				'slug'     => 'woocommerce',
				'icon'     => 'https://ps.w.org/woocommerce/assets/icon-128x128.gif',
				'required' => false,
			),

			array(
				'name'        => 'WP Events Manager',
				'slug'        => 'wp-events-manager',
				'required'    => false,
				//'version'     => '2.0.5',
				'description' => 'WP Events Manager is a powerful Events Manager plugin with all of the most important features of an Event Website.',
			),

			array(
				'name'        => 'WP Events Manager - WooCommerce Payment ',
				'slug'        => 'wp-events-manager-woo-payment',
				'premium'     => true,
				'required'    => false,
				//'version'     => '2.2',
				'description' => 'Support paying for a booking with the payment methods provided by Woocommerce',
				'add-on'      => true,
			),

			// array(
			// 	'name'        => 'Paid Memberships Pro',
			// 	'slug'        => 'paid-memberships-pro',
			// 	'required'    => false,
			// 	//'version'     => '1.9.1',
			// 	'description' => 'A revenue-generating machine for membership sites. Unlimited levels with recurring payment, protected content and member management.',
			// ),


		);
		return array_merge( $sp_lp3, $plugins );
	}
}

add_filter( 'thim_core_get_all_plugins_require', 'thim_get_all_plugins_require' );

function thim_setup_core_installer_theme_config() {
	return array(
		'name'          => esc_html__( 'ivy-school', 'ivy-school' ),
		'slug'          => 'ivy-school',
		'support_link'  => 'https://thimpress.com/forums/forum/ivy-school/',
		'installer_uri' => get_template_directory_uri() . '/inc/admin/installer' //Installer directory URI
	);
}

add_filter( 'thim_core_installer_theme_config', 'thim_setup_core_installer_theme_config' );


/**
 * List child themes.
 *
 * @return array
 */
function thim_ivy_list_child_themes() {
	return array(
		'ivy-school-child' => array(
			'name'       => 'Ivy School Child',
			'slug'       => 'ivy-school-child',
			'screenshot' => 'https://thimpresswp.github.io/demo-data/ivy/child-themes/ivy-school-child.jpg',
			'source'     => 'https://thimpresswp.github.io/demo-data/ivy/child-themes/ivy-school-child.zip',
			'version'    => '1.0.0'
		),
	);
}

add_filter( 'thim_core_list_child_themes', 'thim_ivy_list_child_themes' );

//Add info for Dashboard Admin
if ( ! function_exists( 'thim_links_guide_user' ) ) {
	function thim_links_guide_user() {
		return array(
			'docs'      => 'http://docspress.thimpress.com/ivy-school/',
			'support'   => 'https://thimpress.com/forums/forum/ivy-school/',
			'knowledge' => 'https://thimpress.com/knowledge-base/',
		);
	}
}
add_filter( 'thim_theme_links_guide_user', 'thim_links_guide_user' );

/**
 * Link purchase theme.
 */
if ( ! function_exists( 'thim_link_purchase' ) ) {
	function thim_link_purchase() {
		return 'https://1.envato.market/akrzZ';
	}
}
add_filter( 'thim_envato_link_purchase', 'thim_link_purchase' );

/**
 * Envato id.
 */
if ( ! function_exists( 'thim_envato_item_id' ) ) {
	function thim_envato_item_id() {
		return '22773871';
	}
}
add_filter( 'thim_envato_item_id', 'thim_envato_item_id' );

add_filter( 'thim_prefix_folder_download_data_demo', function () {
	return 'ivy';
} );
