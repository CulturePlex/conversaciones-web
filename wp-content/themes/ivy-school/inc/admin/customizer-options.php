<?php

/**
 * Class Thim_Customize_Options
 */
class Thim_Customize_Options {
	/**
	 * Thim_Customize_Options constructor.
	 */
	public function __construct() {
		add_action( 'customize_register', [ $this, 'thim_deregister' ] );
		add_action( 'thim_customizer_register', [ $this, 'thim_create_customize_options' ] );
	}

	/**
	 * Deregister customize default unnecessary
	 *
	 * @param $wp_customize WP_Customize_Manager
	 */
	public function thim_deregister( $wp_customize ) {
		$wp_customize->remove_section( 'colors' );
		$wp_customize->remove_section( 'background_image' );
		$wp_customize->remove_section( 'header_image' );
		$wp_customize->remove_control( 'blogdescription' );
		$wp_customize->remove_control( 'blogname' );
		$wp_customize->remove_control( 'display_header_text' );
		$wp_customize->remove_section( 'static_front_page' );
		// Rename existing section
		$wp_customize->add_section( 'title_tagline', array(
			'title'    => esc_html__( 'Logo', 'ivy-school' ),
			'panel'    => 'general',
			'priority' => 20,
		) );
	}

	/**
	 * Create customize
	 *
	 * @param $wp_customize
	 */
	public function thim_create_customize_options( $wp_customize ) {

		// include sections
		$customize_path = THIM_DIR . 'inc/admin/customizer-sections/';

		require_once $customize_path . 'blog.php';
		require_once $customize_path . 'blog-general.php';
		require_once $customize_path . 'blog-layouts.php';
		require_once $customize_path . 'blog-meta.php';
		require_once $customize_path . 'blog-sharing.php';
		require_once $customize_path . 'footer.php';
		require_once $customize_path . 'footer-copyright.php';
		require_once $customize_path . 'footer-options.php';
		require_once $customize_path . 'general.php';
		require_once $customize_path . 'general-features.php';
		require_once $customize_path . 'general-layouts.php';
		require_once $customize_path . 'general-logo.php';
		require_once $customize_path . 'general-styling.php';
		require_once $customize_path . 'general-styling-boxed-bg.php';
		require_once $customize_path . 'general-typography.php';
		require_once $customize_path . 'general-typography-heading.php';
		require_once $customize_path . 'header.php';
		require_once $customize_path . 'header-layouts.php';
		require_once $customize_path . 'header-main-menu.php';
		require_once $customize_path . 'header-sticky-menu.php';
        require_once $customize_path . 'header-mobile-menu.php';
		require_once $customize_path . 'header-sub-menu.php';
		require_once $customize_path . 'header-topbar.php';
		require_once $customize_path . 'page-title.php';
		require_once $customize_path . 'page-title-bar.php';
		require_once $customize_path . 'page-title-breadcrumb.php';
		require_once $customize_path . 'page-title-styling.php';
		require_once $customize_path . 'responsive.php';
		require_once $customize_path . 'sidebars.php';
		require_once $customize_path . 'nav-menus.php';
		require_once $customize_path . 'widgets.php';
        require_once $customize_path . 'event.php';
        require_once $customize_path . 'event-sharing.php';
        require_once $customize_path . 'event-archive.php';
        require_once $customize_path . 'event-single.php';
        require_once $customize_path . 'event-setting.php';
        require_once $customize_path . 'learnpress.php';
        require_once $customize_path . 'learnpress-archive.php';
        require_once $customize_path . 'learnpress-single.php';
        require_once $customize_path . 'learnpress-sharing.php';
	}
}

$thim_customize = new Thim_Customize_Options();