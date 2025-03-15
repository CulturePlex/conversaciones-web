<?php
/**
 * Theme functions and definitions.
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 */

define( 'THIM_DIR', trailingslashit( get_template_directory() ) );
define( 'THIM_URI', trailingslashit( get_template_directory_uri() ) );
define( 'THIM_VERSION', '1.5.9' );

if ( ! function_exists( 'thim_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function thim_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on this theme, use a find and replace
		 * to change 'ivy-school' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'ivy-school', THIM_DIR . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		//		add_theme_support( 'ivy-demo-data' );

		// Add support Woocommerce
		add_theme_support( 'woocommerce' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary'      => esc_html__( 'Primary Menu', 'ivy-school' ),
				'menu-account' => esc_html__( 'Menu Account', 'ivy-school' ),
			)
		);

		if ( get_theme_mod( 'copyright_menu', true ) ) {
			register_nav_menus(
				array(
					'copyright_menu' => esc_html__( 'Copyright Menu', 'ivy-school' ),
				)
			);
		}

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support(
			'post-formats', array(
				'aside',
				'image',
				'video',
				'audio',
				'quote',
				'link',
				'gallery',
				'chat',
			)
		);

		add_theme_support( 'custom-background' );

		add_theme_support( 'thim-core' );

		// Support Gutenberg

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Editor color palette.
		add_theme_support(
			'editor-color-palette', array(

				array(
					'name'  => esc_html__( 'Primary Color', 'ivy-school' ),
					'slug'  => 'primary',
					'color' => get_theme_mod( 'body_primary_color', '#3ac569' ),
				),

				array(
					'name'  => esc_html__( 'Title Color', 'ivy-school' ),
					'slug'  => 'title',
					'color' => get_theme_mod( 'thim_font_title_color', '#333333' ),
				),

				array(
					'name'  => esc_html__( 'Body Color', 'ivy-school' ),
					'slug'  => 'body',
					'color' => get_theme_mod( 'thim_font_body_color', '#777777' ),
				),

				array(
					'name'  => esc_html__( 'Border Color', 'ivy-school' ),
					'slug'  => 'border',
					'color' => '#eeeeee',
				),
			)
		);
		add_filter( 'thim_core_enqueue_file_css_customizer', '__return_false' );

	}
endif;
add_action( 'after_setup_theme', 'thim_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function thim_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'thim_content_width', 640 );
}

add_action( 'after_setup_theme', 'thim_content_width', 0 );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function thim_widgets_init() {
	$thim_options = get_theme_mods();
	unregister_sidebar( 'course-sidebar' );
	unregister_sidebar( 'archive-courses-sidebar' );
	/**
	 * Sidebar for module Topbar
	 */
	if ( get_theme_mod( 'header_topbar_display', true ) ) {
		if ( get_theme_mod( 'header_style', 'header_v1' ) == 'header_v3' ) {
			register_sidebar(
				array(
					'name'          => esc_html__( 'Top Bar', 'ivy-school' ),
					'id'            => 'topbar',
					'description'   => esc_html__( 'Display in topbar.', 'ivy-school' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>',
				)
			);
		} else {
			register_sidebar(
				array(
					'name'          => esc_html__( 'Top Bar - Left', 'ivy-school' ),
					'id'            => 'topbar_left',
					'description'   => esc_html__( 'Display in topbar left.', 'ivy-school' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>',
				)
			);
			register_sidebar(
				array(
					'name'          => esc_html__( 'Top Bar - Right', 'ivy-school' ),
					'id'            => 'topbar_right',
					'description'   => esc_html__( 'Display in topbar right.', 'ivy-school' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>',
				)
			);
		}
	}

	if ( get_theme_mod( 'header_style', 'header_v1' ) == 'header_v3' ) {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Logo Right', 'ivy-school' ),
				'id'            => 'logo-right',
				'description'   => esc_html__( 'Display in sidebar logo.', 'ivy-school' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
	}

	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'ivy-school' ),
			'id'            => 'sidebar',
			'description'   => esc_html__( 'Appears in the Sidebar section of the site.', 'ivy-school' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar Courses', 'ivy-school' ),
			'id'            => 'sidebar-courses',
			'description'   => esc_html__( 'Appears in the Sidebar section of the site.', 'ivy-school' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar Event', 'ivy-school' ),
			'id'            => 'sidebar-events',
			'description'   => esc_html__( 'Appears in the Sidebar section of the site.', 'ivy-school' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Right Menu', 'ivy-school' ),
			'id'            => 'menu-right',
			'description'   => esc_html__( 'Appears in right of primary menu.', 'ivy-school' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Top', 'ivy-school' ),
			'id'            => 'footer-top',
			'description'   => esc_html__( 'Appears in top of footer.', 'ivy-school' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	if ( isset( $thim_options['footer_columns'] ) ) {
		$footer_columns = (int) $thim_options['footer_columns'];
		for ( $i = 1; $i <= $footer_columns; $i ++ ) {
			register_sidebar(
				array(
					'name'          => sprintf( 'Footer Sidebar %s', $i ),
					'id'            => 'footer-sidebar-' . $i,
					'description'   => esc_html__( 'Sidebar display widgets.', 'ivy-school' ),
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget'  => '</aside>',
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>',
				)
			);
		}
	}

	register_sidebar(
		array(
			'name'          => esc_html__( 'Copy Right', 'ivy-school' ),
			'id'            => 'copy-right',
			'description'   => esc_html__( 'Appears in copy right of footer.', 'ivy-school' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	/**
	 * Not remove
	 * Function create sidebar on wp-admin.
	 */
	$sidebars = apply_filters( 'thim_core_list_sidebar', array() );
	if ( count( $sidebars ) > 0 ) {
		foreach ( $sidebars as $sidebar ) {
			$new_sidebar = array(
				'name'          => $sidebar['name'],
				'id'            => $sidebar['id'],
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			);

			register_sidebar( $new_sidebar );
		}
	}

}

add_action( 'widgets_init', 'thim_widgets_init' );
/**
 * thim_get_option_var_css
 */
function thim_get_theme_option( $name = '', $value_default = '' ) {
	$data = get_theme_mods();
	if ( isset( $data[$name] ) ) {
		return $data[$name];
	} else {
		return $value_default;
	}
}

function thim_get_option_var_css() {
	$css           = '';
	$theme_options = array(
		// hearder
		'body_primary_color'             => '#4c71b3',
		'body_primary2_color'            => '#df4658',
		'button_text_color'              => '#fff',
		'button_hover_color'             => '#1e73be',
		'header_background_color'        => '#ffffff',
		'header_padding_top'             => '17px',
		'header_padding_bottom'          => '17px',
		'theme_feature_preloading_style' => array(
			'background' => '#ffffff',
			'color'      => '#333333',
		),

		// Thim Logo
		'width_logo'                     => '213px',
		// Thim ToolBar
		'topbar_background_color'        => '#ffffff',
		'topbar_separated_line'          => '#ebebeb',
		'font_topbar'                  => array(
			'font-size' => '18px',
			'color'     => '#878787',
		),
		'topbar_height'                  => '37px',
		// Main Menu
		'main_menu_typo'                 => array(
			'font-family'    => 'Roboto',
			'variant'        => '300',
			'font-size'      => '18px',
			'line-height'    => '1.2',
			'letter-spacing' => '0.9px',
			'text-transform' => 'uppercase',
			'color'          => '#ffffff',
		),
		'main_menu_hover_color'          => '#439fdf',
		// Sticky Menu
		'header_sticky_padding_top'      => '17px',
		'header_sticky_padding_bottom'   => '17px',
		'sticky_menu_background_color'   => '#fff',
		'sticky_menu_text_color'         => '#333333',
		'sticky_menu_text_color_hover'   => '#439fdf',
		// Sub Menu
		'sub_menu_background_color'      => '#fff',
		'sub_menu_text_color'            => '#333333',
		'sub_menu_text_color_hover'      => '#439fdf',

		// Mobile Menu
		'bg_mobile_menu_color'           => '#232323',
		'mobile_menu_text_color'         => '#777777',
		'mobile_menu_text_hover_color'   => '#fff',
		//page title
		'page_title_background_color'    => '#222222',
		'page_title_background_opacity'  => '0.5',
		'page_title_height'              => '400px',
		'page_title_padding_top'         => '0',
		'font_page_title'                => array(
			'font-size'  => '70px',
			'color'      => '#ffffff',
			'text-align' => 'center',
		),
		'font_page_title_description'    => array(
			'font-size' => '20px',
			'color'     => '#ffffff',
		),
		'font_breadcrumb'                => array(
			'font-size' => '16px',
			'color'     => '#fff',
		),
		//siderbar
		'sidebar_widget_title'           => array(
			'font-size' => '20px',
			'color'     => '#333333',
		),

		'footer_background_color' => '#242d5b',
		'footer_color'            => array(
			'title' => '#ffffff',
			'text'  => '#cccccc',
			'link'  => '#cccccc',
			'hover' => '#c48981',
		),

		'font_body'                         => array(
			'font-family'    => 'Roboto',
			'variant'        => '400',
			'font-size'      => '15px',
			'line-height'    => '1.6em',
			'letter-spacing' => '0',
			'color'          => '#777777',
			'text-transform' => 'none',
		),
		'font_title'                        => array(
			'font-family' => 'Playfair Display',
			'color'       => '#333333',
			'variant'     => '700',
		),
		'font_subtitle'                     => array(
			'font-family' => 'Poppins',
			'color'       => '#fff',
			'variant'     => 'Bold',
		),
		'font_h1'                           => array(
			'font-size'      => '44px',
			'line-height'    => '1.6em',
			'text-transform' => 'none',
		),
		'font_h2'                           => array(
			'font-size'      => '40px',
			'line-height'    => '1.6em',
			'text-transform' => 'none',
		),
		'font_h3'                           => array(
			'font-size'      => '36px',
			'line-height'    => '1.6em',
			'text-transform' => 'none',
		),
		'font_h4'                           => array(
			'font-size'      => '20px',
			'line-height'    => '1.6em',
			'text-transform' => 'none',
		),
		'font_h5'                           => array(
			'font-size'      => '18px',
			'line-height'    => '1.6em',
			'text-transform' => 'none',
		),
		'font_h6'                           => array(
			'font-size'      => '16px',
			'line-height'    => '1.6em',
			'text-transform' => 'none',
		),
		'theme_feature_preloading_style'    => array(
			'background' => '#fff',
			'color'      => '#2e91d3',
		),
		'copyright_background_color'        => '#333333',
		'font_copyright_color'              => array(
			'text'  => '#ffffff',
			'link'  => '#777777',
			'hover' => '#333333',
		),
		//responsive
		'mobile_menu_hamburger_color'       => '#fff',
		'mobile_menu_background_color'      => '#222222',
		'text_color_header_mobile'          => '#ffffff',
		'text_color_hover_header_mobile'    => '#439fdf',
		'background_boxed_color'            => '#FFFFFF',
		'background_boxed_image'            => '',
		'background_boxed_image_repeat'     => '',
		'background_boxed_image_position'   => 'Left',
		'background_boxed_image_attachment' => 'fixed',
		'background_boxed_pattern_image'    => THIM_URI . 'assets/images/patterns/pattern1.png',
		'background_main_image_repeat'      => 'no-repeat',
		'background_main_image_position'    => 'center',
		'background_main_image'             => '',
		'background_main_image_attachment'  => 'fixed',
		'background_main_pattern_image'     => THIM_URI . 'assets/images/patterns/pattern1.png',
		'background_main_color'             => '#FFFFFF',

	);

	foreach ( $theme_options as $key => $val ) {
		$val_opt = thim_get_theme_option( $key, $val );
		if ( is_array( $val_opt ) ) {
			// get options default
			foreach ( $val as $attr => $value ) {
				$val_ar = isset( $val_opt[$attr] ) ? $val_opt[$attr] : $value;
				$css    .= '--thim-' . str_replace( '_', '-', $key ) . '-' . $attr . ':' . $val_ar . ';';
			}
			if ( $key == 'font_title' ) {
				$val_font_title = get_theme_mod( $key );
				if ( is_array( $val_font_title ) ) {
					foreach ( $val_font_title as $key_title => $value ) {
						if ( $key_title == 'color' ) {
							list( $r, $g, $b ) = sscanf( $value, "#%02x%02x%02x" );
							$css .= '--thim-font_title_' . $key_title . '_rgb: ' . $r . ',' . $g . ',' . $b . ';';
						}
					}
				}
			}
		} else {
			if ( $val_opt != '' ) {
				if ( in_array( $key, array( 'background_main_image', 'background_boxed_image', 'background_boxed_pattern_image', 'background_main_pattern_image' ) ) ) {
					$val_opt = 'url("' . $val_opt . '")';
				}

				$css .= '--thim-' . str_replace( '_', '-', $key ) . ':' . $val_opt . ';';
				// convert primary color to rga

				if ( $key == 'body_primary_color' || $key == 'body_primary2_color' || $key == 'main_menu_text_color' || $key == 'sticky_main_menu_text_color' || $key == 'font_title_color' ) {
					list( $r, $g, $b ) = sscanf( $val_opt, "#%02x%02x%02x" );
					$css .= '--thim-' . $key . '_rgb: ' . $r . ',' . $g . ',' . $b . ';';
				}
			}
		}


		// get data for on type is image
	}


	return apply_filters( 'thim_get_var_css_customizer', $css );
}

/**
 * Enqueue styles.
 */
if ( ! function_exists( 'thim_styles' ) ) {
	function thim_styles() {
		// ionicon
		wp_enqueue_style( 'builder-ionicons', THIM_URI . 'assets/css/libs/ionicons/ionicons.css', array(), THIM_VERSION );
		//awesome
		// wp_enqueue_style( 'font-awesome', THIM_URI . 'assets/css/libs/awesome/font-awesome.css', array() );
		wp_dequeue_style( 'font-awesome' );
		wp_enqueue_style( 'font-awesome-5-all', THIM_URI . 'assets/css/libs/awesome/all.min.css', array(), THIM_VERSION );
		wp_enqueue_style( 'font-awesome-4-shim', THIM_URI . 'assets/css/libs/awesome/v4-shims.min.css', array(), THIM_VERSION );
		// select 2
		wp_enqueue_style( 'select2-style', THIM_URI . 'assets/css/libs/select2/core.css', array() );
		// bootstrap
		wp_enqueue_style( 'builder-press-bootstrap', THIM_URI . 'assets/css/libs/bootstrap/bootstrap.css', array() );
		// Slick
		wp_enqueue_style( 'builder-press-slick', THIM_URI . 'assets/css/libs/slick/slick.css', array() );
		wp_enqueue_style( 'magnific', THIM_URI . 'assets/css/magnific-popup.css', array() );
		// Style default
		if ( ! thim_plugin_active( 'thim-core' ) ) {
			wp_enqueue_style( 'font-poppins', 'https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i', array() );
			wp_enqueue_style( 'thim-default', THIM_URI . 'inc/data/default.css', array() );
		}
		//	RTL
		if ( get_theme_mod( 'feature_rtl_support', false ) ) {
			wp_enqueue_style( 'thim-style-rtl', THIM_URI . 'rtl.css', array() );
		}
		// Theme Style
		if ( is_multisite() ) {
			wp_enqueue_style( 'thim-style', THIM_URI . 'style.css', array(), THIM_VERSION );
		} else {
			wp_enqueue_style( 'thim-style', get_stylesheet_uri(), array(), THIM_VERSION );
		}

		$css_line = ':root{' . preg_replace( array( '/\s*(\w)\s*{\s*/', '/\s*(\S*:)(\s*)([^;]*)(\ s|\n)*;(\n|\s)*/', '/\n/', '/\s*}\s*/' ), array( '$1{ ', '$1$3;', "", '} ' ),
				thim_get_option_var_css() ) . '}';
		//		 get custom css
		$css_line .= trim( get_theme_mod( 'thim_custom_css' ) );
		wp_add_inline_style(
			'thim-style', $css_line
		);

	}
}
add_action( 'wp_enqueue_scripts', 'thim_styles', 1001 );

/**
 * Enqueue scripts
 */
if ( ! function_exists( 'thim_scripts' ) ) {
	function thim_scripts() {
		wp_enqueue_script( 'builder-press-slick', THIM_URI . 'assets/js/libs/slick.min.js', array( 'jquery' ), THIM_VERSION, true );
		wp_enqueue_script( 'tether', THIM_URI . 'assets/js/libs/1_tether.min.js', array( 'jquery' ), THIM_VERSION, true );
		wp_enqueue_script( 'bootstrap', THIM_URI . 'assets/js/libs/bootstrap.min.js', array( 'jquery' ), THIM_VERSION, true );
		wp_enqueue_script( 'flexslider', THIM_URI . 'assets/js/libs/jquery.flexslider-min.js', array( 'jquery' ), THIM_VERSION, true );
		wp_enqueue_script( 'select2', THIM_URI . 'assets/js/libs/select2.min.js', array( 'jquery' ), THIM_VERSION, true );
		wp_enqueue_script( 'stellar', THIM_URI . 'assets/js/libs/stellar.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'magnific', THIM_URI . 'assets/js/libs/jquery.magnific-popup.min.js', array( 'jquery' ), '', true );
		if ( thim_plugin_active( 'thim-core' ) ) {
			wp_enqueue_script( 'theia-sticky-sidebar', THIM_URI . 'assets/js/libs/theia-sticky-sidebar.js', array( 'jquery' ), '', true );
		}
		if ( get_theme_mod( 'feature_smoothscroll', false ) ) {
			wp_enqueue_script( 'smoothscroll', THIM_URI . 'assets/js/libs/smoothscroll.min.js', array( 'jquery' ), '', true );
		}
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		if ( is_page_template( 'templates/comingsoon.php' ) ) {
			wp_enqueue_script( 'knob-lugin', THIM_URI . 'assets/js/libs/jquery.plugin.min.js', array( 'jquery' ), '', true );
			wp_enqueue_script( 'countdown-js', THIM_URI . 'assets/js/libs/jquery.countdown.min.js', array( 'jquery' ), '', true );
		}
		if ( is_post_type_archive( 'product' ) ) {
			wp_enqueue_script( 'wc-add-to-cart-variation' );
		}
		//	Scripts
		wp_enqueue_script(
			'thim-custom', THIM_URI . 'assets/js/thim-custom.min.js', array(
			'jquery',
			'imagesloaded'
		), THIM_VERSION, true
		);
	}
}
add_action( 'wp_enqueue_scripts', 'thim_scripts', 1000 );

add_action( 'admin_enqueue_scripts', 'thim_admin_scripts' );
function thim_admin_scripts() {
	wp_enqueue_script( 'thim-admin-script', THIM_URI . 'assets/js/admin-script.js', array( 'jquery' ), THIM_VERSION, true );
	wp_enqueue_style( 'thim-admin-style', THIM_URI . 'assets/css/admin.css', array() );
}

add_action('thim_wrapper_loop_start', function(){
	echo '<section class="content-area">';
	get_template_part( 'templates/page-title/page', 'title' );
}, 0);
add_action('thim_wrapper_loop_end', function(){
	echo '</section>';
}, 100);

/**
 * Implement the Custom Header feature.
 */
require_once( THIM_DIR . 'inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require_once( THIM_DIR . 'inc/template-tags.php' );

/**
 * Custom functions that act independently of the theme templates.
 */
require_once( THIM_DIR . 'inc/extras.php' );

/**
 * Extra setting on plugins, export & import with demo data.
 */
include_once THIM_DIR . 'inc/data/extra-plugin-settings.php';

/**
 * Load Jetpack compatibility file.
 */
require_once( THIM_DIR . 'inc/jetpack.php' );

/**
 * Custom wrapper layout for theme
 */
require_once( THIM_DIR . 'inc/wrapper-layout.php' );

/**
 * Custom functions
 */
require_once( THIM_DIR . 'inc/custom-functions.php' );
/**
 * Check new version of LearnPress
 *
 * @return mixed
 */
function thim_is_new_learnpress( $version ) {
	if ( defined( 'LEARNPRESS_VERSION' ) ) {
		return version_compare( LEARNPRESS_VERSION, $version, '>=' );
	} else {
		return version_compare( get_option( 'learnpress_version' ), $version, '>=' );
	}
}

/************************* Compatible LP 3 ***************************************/
if ( class_exists( 'LearnPress' ) ) {

	if ( thim_is_new_learnpress( '4.0.0-beta-0' ) ) {
		/**
		 * Filter Learnpress override path.
		 *
		 * @return string
		 */
		function thim_lp_template_path() {
			return 'learnpress-v4';
		}

		add_filter( 'learn_press_template_path', 'thim_lp_template_path', 999 );
		require_once THIM_DIR . 'inc/learnpress-v4-functions.php';
	} else {
		add_filter( 'thim_required_plugin_sp_lp3', '__return_true' );
		add_action( 'admin_notices', 'theme_show_note_use_plugin_support_lernpress_v3', 5 );
		function theme_show_note_use_plugin_support_lernpress_v3() {
			if ( ! defined( 'IVYSCHOOL_LP_SP_V3_VERSION' ) ) {
				echo '<div class="notice notice-error"><p>Please install plugin <a href="' . admin_url( 'admin.php?page=thim-plugins' ) . '">Theme Ivy School Layout LearnPress V3</a> or Update LearnPress to last version</p></div>';
			}
		}
	}
	require_once THIM_DIR . 'inc/learnpress-functions.php';
}


/**
 * Woocommerce custom functions
 */
if ( class_exists( 'WooCommerce' ) ) {
	include_once THIM_DIR . 'woocommerce/custom-functions.php';
}

/**
 * Option Shortcode
 */
require_once( THIM_DIR . 'inc/custom-shortcodes.php' );

/**
 * Customizer additions.
 */
require_once( THIM_DIR . 'inc/customizer.php' );

/**
 * Require plugins
 */
if ( is_admin() && current_user_can( 'manage_options' ) ) {
	include_once THIM_DIR . 'inc/admin/installer/installer.php';
	include_once THIM_DIR . 'inc/admin/plugins-require.php';
}

/*
 * WPBakery Page Builder custom functions
 * */
if ( thim_plugin_active( 'js_composer' ) ) {
	require_once( THIM_DIR . 'vc_templates/js_composer.php' );
}

add_filter( 'builder-press/elements-unset', 'thim_custom_builder_press_elements' );

if ( ! function_exists( 'thim_custom_builder_press_elements' ) ) {
	/**
	 * @param $elements
	 *
	 * @return mixed
	 */
	function thim_custom_builder_press_elements( $unset ) {

		// elements want to remove
		$elements = array();

		$unset = array_merge( $unset, $elements );

		return $unset;
	}
}


add_filter( 'login_url', 'thim_ivy_custom_login_url', 999, 3 );
if ( ! function_exists( 'thim_ivy_custom_login_url' ) ) {
	function thim_ivy_custom_login_url( $login_url, $redirect, $force_reauth ) {
		if ( isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'resetpass' ) {
			$login_url = thim_get_login_page_url();
		}

		return $login_url;
	}
}
// Override support ajax course lp theme Ivy School
function custom_learnpress_support_theme_no_ajax( $themes ) {

	$index = array_search( 'Ivy School', $themes );
	if ( $index !== false ) {
		unset( $themes[$index] );
	}

	return $themes;
}

add_filter( 'lp/page/courses/themes/no_load_ajax', 'custom_learnpress_support_theme_no_ajax' );

// WP Event Manager

if(! function_exists('thim_get_event_up_comming_query')) {
	function thim_get_event_up_comming_query() {
        $_upcoming_query = thim_get_upcoming_events(3);
        if ( $_upcoming_query->have_posts() ) {
            ?>
            <div class="archive-events">
                <div class="item-featured">
                    <div class="slide-item-featured js-call-slick-col" data-numofslide="1" data-numofscroll="1" data-loopslide="1" data-autoscroll="0" data-speedauto="6000" data-respon="[1, 1], [1, 1], [1, 1], [1, 1], [1, 1]">
                        <div class="slide-slick">
                            <?php
                            while ( $_upcoming_query->have_posts() ) :
                                $_upcoming_query->the_post();
                                ?>
                                <div class="item-event-slide">
                                    <?php echo thim_feature_image( get_post_thumbnail_id( get_the_ID()), 1329, 459, false );?>

                                    <div class="info-event">
                                        <?php
                                        $time         = wpems_get_time( 'Y-m-d H:i', null, false );
                                        $date = new DateTime( date( 'Y-m-d H:i', strtotime( $time ) ) );
                                        ?>
                                        <div class="tp_event_counter" data-time="<?php echo esc_attr( $date->format( 'M j, Y H:i:s O' ) ) ?>"></div>

                                        <div class="title-event">
                                            <a href="<?php the_permalink() ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </div>

                                        <div class="meta-event">
                                    <span>
                                        <i class="ion ion-android-alarm-clock"></i>
                                        <?php echo wpems_event_start( 'H:i', null, false );?> -  <?php echo wpems_event_end( 'H:i', null, false );?>
                                    </span>

                                            <span>
														<i class="ion ion-android-calendar"></i>
                                                <?php echo wpems_event_start( 'M d, Y', null );?>
													</span>

                                            <span>
                                        <i class="ion ion-ios-location-outline"></i>
                                                <?php echo wpems_event_location();?>
                                    </span>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile;?>
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>
        <?php wp_reset_postdata();
	}
}

add_action('tp_event_before_main_content', function($template) {
	if (is_single()) {
		do_action( 'thim_wrapper_loop_start' );
	}
}, 0);

add_action('tp_event_after_main_content', function($template) {
	if (is_single()) {
		do_action( 'thim_wrapper_loop_end' );
	}
}, 100);

function load_learnpress_translations() {
    wp_set_script_translations( 'learnpress-custom', 'learnpress', WP_LANG_DIR . '/plugins/' );
}
add_action( 'wp_enqueue_scripts', 'load_learnpress_translations' );
