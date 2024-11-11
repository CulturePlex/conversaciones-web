<?php
/**
 * Custom Functions
 */

/**
 * Check a plugin active
 *
 * @param $plugin_dir
 * @param $plugin_file
 *
 * @return bool
 */


function thim_plugin_active( $plugin_dir, $plugin_file = null ) {
	$plugin_file            = $plugin_file ? $plugin_file : ( $plugin_dir . '.php' );
	$plugin                 = $plugin_dir . '/' . $plugin_file;
	$active_plugins_network = get_site_option( 'active_sitewide_plugins' );

	if ( isset( $active_plugins_network[$plugin] ) ) {
		return true;
	}

	$active_plugins = get_option( 'active_plugins' );

	if ( in_array( $plugin, $active_plugins ) ) {
		return true;
	}

	return false;
}

/**
 * Get header layouts
 *
 * @return string CLASS for header layouts
 */
function thim_header_layout_class() {
	if ( get_theme_mod( 'header_position', 'overlay' ) === 'default' ) {
		echo ' header-default';
	} else {
		echo ' header-overlay';
	}

	if ( get_theme_mod( 'show_sticky_menu', true ) ) {
		echo ' sticky-header';
	}

	if ( get_theme_mod( 'sticky_menu_style', 'same' ) === 'custom' ) {
		echo ' custom-sticky';
	} else {
		echo '';
	}

	if ( get_theme_mod( 'header_retina_logo', false ) ) {
		echo ' has-retina-logo';
	}

	echo ' ' . get_theme_mod( 'header_style', 'header_v1' );

	// Check header background color has opacity 0
	preg_match_all( '/\d+/', get_theme_mod( 'header_background_color', '#ffffff' ), $header_bg_color );
	$header_color_arr = array_filter( $header_bg_color[0] );

	if ( $header_color_arr && 3 == count( $header_color_arr ) ) {
		echo ' transparent';
	}
}

/**
 * Get Header Logo
 *
 * @return string
 */
if ( ! function_exists( 'thim_header_logo' ) ) {
	function thim_header_logo() {
		$thim_options         = get_theme_mods();
		$thim_logo_src        = THIM_URI . "assets/images/retina-logo.png";
		$thim_mobile_logo_src = THIM_URI . "assets/images/retina-logo.png";
		$thim_retina_logo_src = THIM_URI . "assets/images/retina-logo.png";

		if ( isset( $thim_options['header_logo'] ) && $thim_options['header_logo'] <> '' ) {
			$thim_logo_src = get_theme_mod( 'header_logo' );
			if ( is_numeric( $thim_logo_src ) ) {
				$logo_attachment = wp_get_attachment_image_src( $thim_logo_src, 'full' );
				$thim_logo_src   = $logo_attachment[0];
			}
		}

		if ( isset( $thim_options['mobile_logo'] ) && $thim_options['mobile_logo'] <> '' ) {
			$thim_mobile_logo_src = get_theme_mod( 'mobile_logo' );
			if ( is_numeric( $thim_mobile_logo_src ) ) {
				$logo_attachment      = wp_get_attachment_image_src( $thim_mobile_logo_src, 'full' );
				$thim_mobile_logo_src = $logo_attachment[0];
			}
		}
		echo '<a class="no-sticky-logo" href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '" rel="home">';
		echo '<img class="logo" src="' . esc_url( $thim_logo_src ) . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" />';


		if ( get_theme_mod( 'header_retina_logo', false ) ) {
			$thim_retina_logo_src = get_theme_mod( 'header_retina_logo' );
			if ( is_numeric( $thim_retina_logo_src ) ) {
				$logo_attachment      = wp_get_attachment_image_src( $thim_retina_logo_src, 'full' );
				$thim_retina_logo_src = $logo_attachment[0];
			}

		}
		if ( $thim_retina_logo_src ) {
			echo '<img class="retina-logo" src="' . esc_url( $thim_retina_logo_src ) . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" />';
		}


		echo '<img class="mobile-logo" src="' . esc_url( $thim_mobile_logo_src ) . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" />';
		echo '</a>';
	}
}
add_action( 'thim_header_logo', 'thim_header_logo' );

/**
 * Get Header Sticky logo
 *
 * @return string
 */
if ( ! function_exists( 'thim_header_sticky_logo' ) ) {
	function thim_header_sticky_logo() {
		$thim_logo_stick_logo_src = THIM_URI . "assets/images/retina-logo.png";
		if ( get_theme_mod( 'header_sticky_logo' ) != '' ) {
			$thim_logo_stick_logo     = get_theme_mod( 'header_sticky_logo' );
			$thim_logo_stick_logo_src = $thim_logo_stick_logo; // For the default value
			if ( is_numeric( $thim_logo_stick_logo ) ) {
				$logo_attachment = wp_get_attachment_image_src( $thim_logo_stick_logo, 'full' );
				if ( $logo_attachment ) {
					$thim_logo_stick_logo_src = $logo_attachment[0];
				} else {
					$thim_logo_stick_logo_src = THIM_URI . 'assets/images/sticky-logo.png';
				}
			}
			$site_title = esc_attr( get_bloginfo( 'name', 'display' ) );
			echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '" rel="home" class="sticky-logo">
					<img src="' . $thim_logo_stick_logo_src . '" alt="' . $site_title . '" /></a>';
		} else {
			echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '" rel="home" class="sticky-logo">
			        <img src="' . $thim_logo_stick_logo_src . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" /></a>';
		}
	}
}
add_action( 'thim_header_sticky_logo', 'thim_header_sticky_logo' );

/**
 * Get Page Title Content For Single
 *
 * @return string HTML for Page title bar
 */
function thim_get_single_page_title_content() {
	$post_id = get_the_ID();

	if ( get_post_type( $post_id ) == 'post' ) {
		$categories = get_the_category();
	} elseif ( get_post_type( $post_id ) == 'attachment' ) {
		echo '<h2 class="title">' . esc_html__( 'Attachment', 'ivy-school' ) . '</h2>';

		return;
	} else {// Custom post type
		$categories = get_the_terms( $post_id, 'taxonomy' );
	}
	if ( ! empty( $categories ) ) {
		echo '<h2 class="title">' . esc_html( $categories[0]->name ) . '</h2>';
	}
}

/**
 * Get Page Title Content For Date Format
 *
 * @return string HTML for Page title bar
 */
function thim_get_page_title_date() {
	if ( is_year() ) {
		echo '<h2 class="title">' . esc_html__( 'Year', 'ivy-school' ) . '</h2>';
	} elseif ( is_month() ) {
		echo '<h2 class="title">' . esc_html__( 'Month', 'ivy-school' ) . '</h2>';
	} elseif ( is_day() ) {
		echo '<h2 class="title">' . esc_html__( 'Day', 'ivy-school' ) . '</h2>';
	}

	$date  = '';
	$day   = intval( get_query_var( 'day' ) );
	$month = intval( get_query_var( 'monthnum' ) );
	$year  = intval( get_query_var( 'year' ) );
	$m     = get_query_var( 'm' );

	if ( ! empty( $m ) ) {
		$year  = intval( substr( $m, 0, 4 ) );
		$month = intval( substr( $m, 4, 2 ) );
		$day   = substr( $m, 6, 2 );

		if ( strlen( $day ) > 1 ) {
			$day = intval( $day );
		} else {
			$day = 0;
		}
	}

	if ( $day > 0 ) {
		$date .= $day . ' ';
	}
	if ( $month > 0 ) {
		global $wp_locale;
		$date .= $wp_locale->get_month( $month ) . ' ';
	}
	$date .= $year;
	echo '<div class="description">' . esc_attr( $date ) . '</div>';
}

/**
 * Get Page Title Content
 *
 * @return string HTML for Page title bar
 */
if ( ! function_exists( 'thim_page_title_content' ) ) {
	function thim_page_title_content() {
		if ( is_front_page() ) {// Front page
			echo '<h2 class="title">' . get_bloginfo( 'name' ) . '</h2>';
			echo '<div class="description">' . get_bloginfo( 'description' ) . '</div>';
		} elseif ( is_home() ) {// Post page
			echo '<h2 class="title">' . esc_html__( 'Blog', 'ivy-school' ) . '</h2>';
			echo '<div class="description">' . get_bloginfo( 'description' ) . '</div>';
		} elseif ( is_page() ) {// Page
			echo '<h2 class="title">' . get_the_title() . '</h2>';
		} elseif ( is_single() ) {// Single
			thim_get_single_page_title_content();
		} elseif ( is_author() ) {// Author
			echo '<h2 class="title">' . esc_html__( 'Author', 'ivy-school' ) . '</h2>';
			echo '<div class="description">' . get_the_author() . '</div>';
		} elseif ( is_search() ) {// Search
			echo '<h2 class="title">' . esc_html__( 'Search', 'ivy-school' ) . '</h2>';
			echo '<div class="description">' . get_search_query() . '</div>';
		} elseif ( is_tag() ) {// Tag
			echo '<h2 class="title">' . esc_html__( 'Tag', 'ivy-school' ) . '</h2>';
			echo '<div class="description">' . single_tag_title( '', false ) . '</div>';
		} elseif ( is_category() ) {// Archive
			echo '<h2 class="title">' . esc_html__( 'Category', 'ivy-school' ) . '</h2>';
			echo '<div class="description">' . single_cat_title( '', false ) . '</div>';
		} elseif ( is_404() ) {
			echo '<h2 class="title">' . esc_html__( 'Page Not Found!', 'ivy-school' ) . '</h2>';
		} elseif ( is_date() ) {
			thim_get_page_title_date();
		}
	}
}
add_action( 'thim_page_title_content', 'thim_page_title_content' );

function thim_breadcrumb_delimiter( $defaults ) {
	$icon = html_entity_decode( get_theme_mod( 'breadcrumb_icon', '/' ) );
	// Change the breadcrumb delimeter from '/' to '>'
	$defaults['delimiter'] = '<li><span class="breadcrum-icon">' . ent2ncr( $icon ) . '</span></li>';

	return $defaults;
}

add_filter( 'thim_breadcrumb_defaults', 'thim_breadcrumb_delimiter' );
/**
 * Get list sidebars
 */

if ( ! function_exists( 'thim_get_list_sidebar' ) ) {
	function thim_get_list_sidebar() {
		global $wp_registered_sidebars;

		$sidebar_array = array();
		$dp_sidebars   = $wp_registered_sidebars;

		$sidebar_array[''] = esc_attr__( '-- Select Sidebar --', 'ivy-school' );

		foreach ( $dp_sidebars as $sidebar ) {
			$sidebar_array[$sidebar['name']] = $sidebar['name'];
		}

		return $sidebar_array;
	}
}

/**
 * Turn on and get the back to top
 *
 * @return string HTML for the back to top
 */
if ( ! class_exists( 'thim_back_to_top' ) ) {
	function thim_back_to_top() {
		if ( get_theme_mod( 'feature_backtotop', true ) ) {
			?>
			<div id="back-to-top" class="<?php echo get_theme_mod( 'position_back_to_top', 'default' ) ?>">
				<?php
				get_template_part( 'templates/footer/back-to-top' );
				?>
			</div>
			<?php
		}
	}
}
add_action( 'thim_space_body', 'thim_back_to_top', 10 );

/**
 * Switch footer layout
 *
 * @return string HTML footer layout
 */
if ( ! function_exists( 'thim_footer_layout' ) ) {
	function thim_footer_layout() {
		$template_name = 'templates/footer/' . get_theme_mod( 'footer_template', 'default' );
		get_template_part( $template_name );
	}
}

/**
 * Footer Widgets
 *
 * @return bool
 * @return string
 */
if ( ! function_exists( 'thim_footer_widgets' ) ) {
	function thim_footer_widgets() {
		if ( get_theme_mod( 'footer_widgets', true ) ) : ?>
			<div class="footer-sidebars columns-<?php echo get_theme_mod( 'footer_columns', 4 ); ?> row">
				<?php
				$col = 12 / get_theme_mod( 'footer_columns', 4 );
				if ( get_theme_mod( 'footer_columns' ) == 5 ) {
					$col = '';
				}
				for ( $i = 1; $i <= get_theme_mod( 'footer_columns', 4 ); $i ++ ): ?>
					<div class="col-12 col-xs-12 col-sm-6 col-xl-<?php echo esc_attr( $col ); ?>">
						<?php dynamic_sidebar( 'footer-sidebar-' . $i ); ?>
					</div>
				<?php endfor; ?>
			</div>
		<?php endif;
	}
}


/**
 * Footer Copyright bar
 *
 * @return bool
 * @return string
 */
if ( ! function_exists( 'thim_copyright_bar' ) ) {
	function thim_copyright_bar() {
		if ( get_theme_mod( 'copyright_bar', true ) ) : ?>
			<div class="copyright-text">
				<?php
				$copyright_text = get_theme_mod( 'copyright_text', 'Designed by <a href="https://thimpress.com">ThimPress</a>. Powered by WordPress.' );
				echo ent2ncr( $copyright_text );
				?>
			</div>
		<?php endif;
	}
}

/**
 * Theme Feature: RTL Support.
 *
 * @return @string
 */
if ( ! function_exists( 'thim_feature_rtl_support' ) ) {
	function thim_feature_rtl_support() {
		if ( get_theme_mod( 'feature_rtl_support', false ) ) {
			echo " dir=\"rtl\"";
		}
	}

	//	add_filter( 'language_attributes', 'thim_feature_rtl_support', 10 );
}


/**
 * Theme Feature: Open Graph insert doctype
 *
 * @param $output
 */
if ( ! function_exists( 'thim_doctype_opengraph' ) ) {
	function thim_doctype_opengraph( $output ) {
		if ( get_theme_mod( 'feature_open_graph_meta', true ) ) {
			return $output . ' prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#"';
		}
	}

	//	add_filter( 'language_attributes', 'thim_doctype_opengraph' );
}

/**
 * Theme Feature: Preload
 *
 * @return bool
 * @return string HTML for preload
 */
if ( ! function_exists( 'thim_preloading' ) ) {
	function thim_preloading() {
		$preloading = get_theme_mod( 'theme_feature_preloading', 'off' );
		if ( $preloading != 'off' ) {

			echo '<div id="thim-preloading">';

			switch ( $preloading ) {
				case 'custom-image':
					$preloading_image = get_theme_mod( 'theme_feature_preloading_custom_image', false );
					if ( $preloading_image ) {
						if ( locate_template( 'templates/features/preloading/' . $preloading . '.php' ) ) {
							include locate_template( 'templates/features/preloading/' . $preloading . '.php' );
						}
					}
					break;
				default:
					if ( locate_template( 'templates/features/preloading/' . $preloading . '.php' ) ) {
						include locate_template( 'templates/features/preloading/' . $preloading . '.php' );
					}
					break;
			}

			echo '</div>';

		}
	}

	add_action( 'thim_before_body', 'thim_preloading', 10 );
}

/**
 * Theme Feature: Open Graph meta tag
 *
 * @param string
 */
if ( ! function_exists( 'thim_add_opengraph' ) ) {
	function thim_add_opengraph() {
		global $post;

		if ( get_theme_mod( 'feature_open_graph_meta', true ) ) {
			if ( is_single() ) {
				if ( has_post_thumbnail( $post->ID ) ) {
					$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
					$img_src = esc_attr( $img_src[0] );
				} else {
					$img_src = THIM_URI . 'assets/images/opengraph.png';
				}
				if ( $excerpt = $post->post_excerpt ) {
					$excerpt = strip_tags( $post->post_excerpt );
					$excerpt = str_replace( "", "'", $excerpt );
				} else {
					$excerpt = get_bloginfo( 'description' );
				}
				?>

				<meta property="og:title" content="<?php echo the_title(); ?>"/>
				<meta property="og:description" content="<?php echo esc_attr( $excerpt ); ?>"/>
				<meta property="og:type" content="article"/>
				<meta property="og:url" content="<?php echo the_permalink(); ?>"/>
				<meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/>
				<meta property="og:image" content="<?php echo esc_attr( $img_src ); ?>"/>

				<?php
			} else {
				return;
			}
		}
	}

	add_action( 'wp_head', 'thim_add_opengraph', 10 );
}


/**
 * Theme Feature: Google theme color
 */
if ( ! function_exists( 'thim_google_theme_color' ) ) {
	function thim_google_theme_color() {
		if ( get_theme_mod( 'feature_google_theme', false ) ) { ?>
			<meta name="theme-color"
				  content="<?php echo esc_attr( get_theme_mod( 'feature_google_theme_color', '#333333' ) ) ?>">
			<?php
		}
	}

	add_action( 'wp_head', 'thim_google_theme_color', 10 );
}

/**
 * Responsive: enable or disable responsive
 *
 * @return string
 * @return bool
 */
if ( ! function_exists( 'thim_enable_responsive' ) ) {
	function thim_enable_responsive() {
		if ( get_theme_mod( 'enable_responsive', true ) ) {
			echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
		}
	}

	add_action( 'wp_head', 'thim_enable_responsive', 1 );
}


/**
 *
 * Display Topbar
 *
 * @return void
 *
 */
if ( ! function_exists( 'thim_topbar' ) ) {
	function thim_topbar() {
		$display     = get_theme_mod( 'header_topbar_display', false );
		$style       = get_theme_mod( 'header_position', 'default' );
		$size_topbar = get_theme_mod( 'size_topbar', 'default' );
		if ( $display ) {
			echo '<div id="thimHeaderTopBar" class="thim-topbar ' . $size_topbar . ' style-' . $style . ' ">';
			get_template_part( 'templates/header/topbar' );
			echo '</div>';
		}
	}

	add_action( 'thim_topbar', 'thim_topbar', 10 );
}


/**
 * Override ajax-loader contact form
 *
 * $return mixed
 */

function thim_wpcf7_ajax_loader() {
	return THIM_URI . 'assets/images/icons/ajax-loader.gif';
}

add_filter( 'wpcf7_ajax_loader', 'thim_wpcf7_ajax_loader' );


/**
 * Get feature image
 *
 * @param int  $width
 * @param int  $height
 * @param bool $link
 *
 * @return string
 */
function thim_feature_image( $attachment_id = 0, $width = 1024, $height = 768, $link = true ) {
	$thumbnail_full = wp_get_attachment_image_src( $attachment_id, 'full' );
	$imgurl         = wp_get_attachment_image_src( $attachment_id, array( $width, $height ) );
	if ( isset( $thumbnail_full[0] ) ) {
		if ( $imgurl[0] ) {
			if ( $link ) {
				echo '<div class="thumbnail"><a href="' . esc_url( get_permalink() ) . '" title = "' . get_the_title() . '">';
				echo '<img src="' . $imgurl[0] . '" alt= "' . get_the_title() . '" title = "' . get_the_title() . '" />';
				echo '</a></div>';
			} else {
				echo '<div class="thumbnail">';
				echo '<img src="' . $imgurl[0] . '" alt= "' . get_the_title() . '" title = "' . get_the_title() . '" />';
				echo '</div>';
			}
		} else {
			if ( $link ) {
				echo '<div class="thumbnail"><a href="' . esc_url( get_permalink() ) . '" title = "' . get_the_title() . '">';
				echo '<img src="' . $thumbnail_full[0] . '" alt= "' . get_the_title() . '" title = "' . get_the_title() . '" />';
				echo '</a></div>';
			} else {
				echo '<div class="thumbnail">';
				echo '<img src="' . $thumbnail_full[0] . '" alt= "' . get_the_title() . '" title = "' . get_the_title() . '" />';
				echo '</div>';
			}
		}
	}

}


/**
 * Get template.
 *
 * Search for the template and include the file.
 *
 * @param string $template_name Template to load.
 * @param array  $args          Args passed for the template file.
 * @param string $string        $template_path    Path to templates.
 * @param string $default_path  Default path to template files.
 *
 * @since 1.0.0
 *
 * @see   wcpt_locate_template()
 *
 */
function thim_get_template( $template_name, $args = array(), $tempate_path = '', $default_path = '' ) {
	if ( is_array( $args ) && isset( $args ) ) :
		extract( $args );
	endif;

	$template_name = $template_name . '.php';
	$posts         = isset( $args['posts'] ) ? $args['posts'] : array();
	$params        = isset( $args['params'] ) ? $args['params'] : array();

	$template_file = thim_locate_template( $template_name, $tempate_path, $default_path );

	if ( ! file_exists( $template_file ) ) :
		_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $template_file ), '1.0.0' );

		return;
	endif;

	include $template_file;
}



/**
 * Locate template.
 *
 * Locate the called template.
 * Search Order:
 *
 * @param string $template_name Template to load.
 * @param string $string        $template_path    Path to templates.
 * @param string $default_path  Default path to template files.
 *
 * @return    string                            Path to the template file.
 * @since 1.0.0
 *
 */
function thim_locate_template( $template_name, $template_path = '', $default_path = '' ) {
	if ( ! $template_path ) :
		$template_path = 'templates/';
	endif;

	// Set default plugin templates path.
	if ( ! $default_path ) :
		$default_path = THIM_MAGWP_PATH . $template_path; // Path to the template folder
	endif;

	// Search template file in theme folder.
	$template = locate_template( array(
		$template_path . $template_name,
		$template_name
	) );

	// Get plugins template file.
	if ( ! $template ) :
		$template = $default_path . $template_name;
	endif;

	return apply_filters( 'thim_locate_template', $template, $template_name, $template_path, $default_path );
}

//Edit Widget Categories
add_filter( 'wp_list_categories', 'thim_add_span_cat_count' );
function thim_add_span_cat_count( $links ) {
	$links = str_replace( '<span class="count">(', '<span class="count">', $links );
	$links = str_replace( ')</span>', '</span>', $links );


	$links = str_replace( '(', '<span class="count">', $links );
	$links = str_replace( ')', '</span>', $links );

	return $links;
}

/**
 * @param      $id
 * @param      $size
 */
if ( ! function_exists( 'thim_thumbnail' ) ) {
	function thim_thumbnail( $id, $size, $type = 'post', $link = true, $classes = '' ) {
		echo thim_get_thumbnail( $id, $size, $type, $link, $classes );
	}
}

/**
 * @param $id
 * @param $size
 * @param $type : default is post
 *
 * @return string
 */
if ( ! function_exists( 'thim_get_thumbnail' ) ) {
	function thim_get_thumbnail( $id, $size = 'thumbnail', $type = 'post', $link = true, $classes = '' ) {
		$width         = 0;
		$height        = 0;
		$attachment_id = $id;

		$image_id = get_post_thumbnail_id( $id );

		if ( $type === 'post' ) {
			$attachment_id = get_post_thumbnail_id( $id );
		}
		$src = wp_get_attachment_image_src( $attachment_id, 'full' );

		if ( $size != 'full' && ! in_array( $size, get_intermediate_image_sizes() ) ) {
			//custom size
			$thumbnail_size = explode( 'x', $size );
			$width          = $thumbnail_size[0];
			$height         = $thumbnail_size[1];
			$img_src        = wp_get_attachment_image_src( $image_id, array( $width, $height ) );
		} else if ( $size == 'full' ) {
			$img_src = $src[0];
			$width   = $src[1];
			$height  = $src[2];
		} else {
			$image_size = wp_get_attachment_image_src( $attachment_id, $size );
			$width      = $image_size[1];
			$height     = $image_size[2];
		}

		if ( empty( $img_src ) ) {
			$img_src = $src[0];
		}

		$html = '';
		if ( $link ) {
			$html .= '<a href="' . esc_url( get_permalink( $id ) ) . '" class="img-link" target="_self">';
		}
		$html .= '<img ' . image_hwstring( $width, $height ) . ' src="' . esc_url( $img_src[0] ) . '" alt="' . get_the_title( $id ) . '" class="' . $classes . '">';
		if ( $link ) {
			$html .= '</a>';
		}

		return $html;
	}
}

/**
 * Add background overlay to VC Row
 */
if ( class_exists( 'Vc_Manager' ) ) {
	$thim_row_bg_overlay_attributes = array(
		'type'       => 'colorpicker',
		'heading'    => "Background Overlay",
		'param_name' => 'overlay_color',
		'value'      => '',
		'group'      => 'Advance Options',
	);
	vc_add_param( 'vc_row', $thim_row_bg_overlay_attributes );
}

/**
 * Support excerpt feature for page
 */
add_action( 'wp_enqueue_scripts', 'thim_frontend_dashicons', 20 );
function thim_frontend_dashicons() {
	wp_enqueue_style( 'dashicons' );
}

/* custom length excerpt*/
function custom_excerpt_length( $length ) {
	return 20;
}

add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/**/
add_post_type_support( 'page', 'excerpt' );

/**
 * Get User meta
 */
if ( ! function_exists( 'thim_get_user_meta' ) ) {
	function thim_get_user_meta( $a ) {
		return $a[0];
	}
}


/**
 * Get Event Upcoming
 */
//Filter post_status tp_event
if ( ! function_exists( 'thim_get_upcoming_events' ) ) {
	function thim_get_upcoming_events( $limit = 1, $args = array() ) {
		if ( is_tax( 'tp_event_category' ) ) {
			$args = wp_parse_args(
				$args,
				array(
					'post_type'      => 'tp_event',
					'posts_per_page' => $limit,
					'meta_query'     => array(
						array(
							'key'     => 'tp_event_status',
							'value'   => 'upcoming',
							'compare' => '=',
						),
					),
					'tax_query'      => array(
						array(
							'taxonomy' => 'tp_event_category',
							'field'    => 'slug',
							'terms'    => get_query_var( 'term' ),
						)
					),
				)
			);
		} else {
			$args = wp_parse_args(
				$args,
				array(
					'post_type'      => 'tp_event',
					'posts_per_page' => $limit,
					'meta_query'     => array(
						array(
							'key'     => 'tp_event_status',
							'value'   => 'upcoming',
							'compare' => '=',
						),
					),
				)
			);
		}

		return new WP_Query( $args );
	}
}

/**
 * Filter Event
 */
remove_action( 'tp_event_after_single_event', 'wpems_single_event_register' );
add_action( 'thim_event_loop_event_contact', 'wpems_single_event_register' );
// Filter height google map
add_filter( 'tp_event_filter_event_location_map', 'thim_tp_event_filter_event_location_map', 1, 5 );
if ( ! function_exists( 'thim_tp_event_filter_event_location_map' ) ) {
	function thim_tp_event_filter_event_location_map( $arg ) {
		$arg['height'] = '450px';

		return $arg;
	}
}

add_action( 'tp_event_after_single_event', 'func_event_loop_event_author' );
if ( ! function_exists( 'func_event_loop_event_author' ) ) {
	function func_event_loop_event_author() {
		wpems_get_template( 'loop/author.php' );
	}

}

/**
 * Get url account page
 */
if ( ! function_exists( 'thim_get_login_page_url' ) ) {
	function thim_get_login_page_url( $redirect_url = '' ) {
		$page = get_page_by_path( 'account' );
		if ( $page ) {
			return ! empty( $redirect_url ) ? add_query_arg( 'redirect_to', urlencode( $redirect_url ), get_permalink( $page[0] ) ) : get_permalink( $page->ID );
		}

		return wp_login_url();
	}
}

/**
 * Get url account page
 */
if ( ! function_exists( 'thim_get_login_page_url_event' ) ) {
	function thim_get_login_page_url_event( $redirect_url = '' ) {
		$page = get_page_by_path( 'account' );
		if ( $page ) {
			return ! empty( $redirect_url ) ? add_query_arg( 'redirect_to', urlencode( $redirect_url ), get_permalink( $page[0] ) ) : get_permalink( $page->ID );
		}

		return wp_login_url();
	}
}

/**
 * Footer Bottom
 */
if ( ! function_exists( 'thim_footer_top' ) ) {
	function thim_footer_top() {
		$thim_hidden_footer_top = thim_meta( 'thim_footer_top' );
		if ( is_active_sidebar( 'footer-top' ) && $thim_hidden_footer_top == 0 ) {
			?>
			<div class="footer-bottom">

				<div class="container">
					<?php dynamic_sidebar( 'footer-top' ); ?>
				</div>

			</div>
		<?php }
	}
}
add_action( 'thim_above_footer_area', 'thim_footer_top' );

/**
 * Remove hook tp-event-auth
 */
if ( class_exists( 'WPEMS_User_Process' ) ) {

	remove_filter( 'logout_redirect', array( 'WPEMS_User_Process', 'logout_redirect' ) );
}

/**
 * Add filter login redirect
 */
add_filter( 'login_redirect', 'thim_login_redirect', 1000 );
if ( ! function_exists( 'thim_login_redirect' ) ) {
	function thim_login_redirect() {
		if ( empty( $_REQUEST['redirect_to'] ) ) {
			$redirect_url = get_theme_mod( 'theme_feature_login_redirect' );
			if ( ! empty( $redirect_url ) ) {
				return $redirect_url;
			} else {
				return home_url( '/' );
			}
		} else {
			return $_REQUEST['redirect_to'];
		}
	}
}

/**
 * Add filter login redirect
 */
add_filter( 'logout_redirect', 'thim_logout_redirect', 1000 );
if ( ! function_exists( 'thim_logout_redirect' ) ) {
	function thim_logout_redirect() {
		if ( empty( $_REQUEST['redirect_to'] ) ) {
			$redirect_url = get_theme_mod( 'theme_feature_logout_redirect' );
			if ( ! empty( $redirect_url ) ) {
				return $redirect_url;
			} else {
				return home_url( '/' );
			}
		} else {
			return $_REQUEST['redirect_to'];
		}
	}
}

/**
 * Change link reset password in the email
 */
if ( ! function_exists( 'thim_replace_retrieve_password_message' ) ) {
	function thim_replace_retrieve_password_message( $message, $key, $user_login, $user_data ) {

		$reset_link = add_query_arg(
			array(
				'action' => 'rp',
				'key'    => $key,
				'login'  => rawurlencode( $user_login )
			), thim_get_login_page_url()
		);

		// Create new message
		$message = esc_html__( 'Someone has requested a password reset for the following account:', 'ivy-school' ) . "\r\n\r\n";
		$message .= network_home_url( '/' ) . "\r\n\r\n";
		$message .= sprintf( esc_html__( 'Username: %s', 'ivy-school' ), $user_login ) . "\r\n\r\n";
		$message .= esc_html__( 'If this was a mistake, just ignore this email and nothing will happen.', 'ivy-school' ) . "\r\n\r\n";
		$message .= esc_html__( 'To reset your password, visit the following address:', 'ivy-school' ) . "\r\n\r\n";
		$message .= $reset_link . "\r\n";

		return $message;
	}
}

/**
 * Do password reset
 */
if ( ! function_exists( 'thim_do_password_reset' ) ) {
	function thim_do_password_reset() {

		$login_page = thim_get_login_page_url();
		if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {

			if ( ! isset( $_REQUEST['key'] ) || ! isset( $_REQUEST['login'] ) ) {
				return;
			}

			$key   = $_REQUEST['key'];
			$login = $_REQUEST['login'];

			$user = check_password_reset_key( $key, $login );

			if ( ! $user || is_wp_error( $user ) ) {
				if ( $user && $user->get_error_code() === 'expired_key' ) {
					wp_redirect(
						add_query_arg(
							array(
								'action'      => 'rp',
								'expired_key' => '1',
							), $login_page
						)
					);
				} else {
					wp_redirect(
						add_query_arg(
							array(
								'action'      => 'rp',
								'invalid_key' => '1',
							), $login_page
						)
					);
				}
				exit;
			}

			if ( isset( $_POST['password'] ) ) {

				if ( empty( $_POST['password'] ) ) {
					// Password is empty
					wp_redirect(
						add_query_arg(
							array(
								'action'           => 'rp',
								'key'              => $_REQUEST['key'],
								'login'            => $_REQUEST['login'],
								'invalid_password' => '1',
							), $login_page
						)
					);
					exit;
				}

				// Parameter checks OK, reset password
				reset_password( $user, $_POST['password'] );
				wp_redirect(
					add_query_arg(
						array(
							'result' => 'changed',
						), $login_page
					)
				);
			} else {
				_e( 'Invalid request.', 'eduma' );
			}

			exit;
		}
	}
}
add_action( 'login_form_rp', 'thim_do_password_reset', 1000 );
add_action( 'login_form_resetpass', 'thim_do_password_reset', 1000 );

/**
 * Determining engine environment
 */
if ( ! function_exists( 'is_wpe' ) && ! function_exists( 'is_wpe_snapshot' ) ) {
	add_filter( 'retrieve_password_message', 'thim_replace_retrieve_password_message', 10, 4 );
}

/**
 * Filters Paid Membership pro login redirect & register redirect
 */
add_filter( 'pmpro_register_redirect', '__return_false' );

/**
 * Redirect to custom register page in case multi sites
 *
 * @param $url
 *
 * @return mixed
 */
if ( ! function_exists( 'thim_multisite_register_redirect' ) ) {
	function thim_multisite_register_redirect( $url ) {

		if ( is_multisite() ) {
			$url = add_query_arg( 'action', 'register', thim_get_login_page_url() );
		}

		$user_login = isset( $_POST['user_login'] ) ? $_POST['user_login'] : '';
		$user_email = isset( $_POST['user_email'] ) ? $_POST['user_email'] : '';
		$errors     = register_new_user( $user_login, $user_email );
		if ( ! is_wp_error( $errors ) ) {
			$redirect_to = ! empty( $_POST['redirect_to'] ) ? $_POST['redirect_to'] : 'wp-login.php?checkemail=registered';
			wp_safe_redirect( $redirect_to );
			exit();
		}

		return $url;
	}
}
add_filter( 'wp_signup_location', 'thim_multisite_register_redirect' );

/**
 * Check is course
 */
if ( ! function_exists( 'thim_check_is_course' ) ) {
	function thim_check_is_course() {
		if ( function_exists( 'learn_press_is_courses' ) && learn_press_is_courses() ) {
			return true;
		} else {
			return false;
		}
	}
}

/**
 * Check is course taxonomy
 */
if ( ! function_exists( 'thim_check_is_course_taxonomy' ) ) {
	function thim_check_is_course_taxonomy() {
		if ( function_exists( 'learn_press_is_course_taxonomy' ) && learn_press_is_course_taxonomy() ) {
			return true;
		} else {
			return false;
		}
	}
}

/**
 * Get post meta
 *
 * @param $key
 * @param $args
 * @param $post_id
 *
 * @return string
 * @return bool
 */
if ( ! function_exists( 'thim_meta' ) ) {
	function thim_meta( $key, $args = array(), $post_id = null ) {
		$post_id = empty( $post_id ) ? get_the_ID() : $post_id;

		$args = wp_parse_args( $args, array(
			'type' => 'text',
		) );

		// Image
		if ( in_array( $args['type'], array( 'image' ) ) ) {
			if ( isset( $args['single'] ) && $args['single'] == "false" ) {
				// Gallery
				$temp          = array();
				$data          = array();
				$attachment_id = get_post_meta( $post_id, $key, false );
				if ( ! $attachment_id ) {
					return $data;
				}

				if ( empty( $attachment_id ) ) {
					return $data;
				}
				foreach ( $attachment_id as $k => $v ) {
					$image_attributes = wp_get_attachment_image_src( $v, $args['size'] );
					$temp['url']      = $image_attributes[0];
					$data[]           = $temp;
				}

				return $data;
			} else {
				// Single Image
				$attachment_id    = get_post_meta( $post_id, $key, true );
				$image_attributes = wp_get_attachment_image_src( $attachment_id, $args['size'] );

				return $image_attributes;
			}
		}

		return get_post_meta( $post_id, $key, $args );
	}
}

/**
 * Add google analytics & facebook pixel code
 */
if ( ! function_exists( 'thim_add_marketing_code' ) ) {
	function thim_add_marketing_code() {
		$theme_options_data = get_theme_mods();
		if ( ! empty( $theme_options_data['theme_feature_analytics'] ) ) {
			?>
			<script async
					src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_html( $theme_options_data['theme_feature_analytics'] ); ?>">
			</script>
			<script>
				window.dataLayer = window.dataLayer || [];

				function gtag() {
					dataLayer.push(arguments);
				}

				gtag('js', new Date());

				gtag('config', '<?php echo esc_html( $theme_options_data['theme_feature_analytics'] ); ?>');
			</script>
			<?php
		}
		if ( ! empty( $theme_options_data['theme_feature_facebook_pixel'] ) ) {
			?>
			<script>
				!function (f, b, e, v, n, t, s) {
					if (f.fbq) return;
					n = f.fbq = function () {
						n.callMethod ?
							n.callMethod.apply(n, arguments) : n.queue.push(arguments)
					};
					if (!f._fbq) f._fbq = n;
					n.push = n;
					n.loaded = !0;
					n.version = '2.0';
					n.queue = [];
					t = b.createElement(e);
					t.async = !0;
					t.src = v;
					s = b.getElementsByTagName(e)[0];
					s.parentNode.insertBefore(t, s)
				}(window, document, 'script',
					'https://connect.facebook.net/en_US/fbevents.js');
				fbq('init', '<?php echo esc_html( $theme_options_data['theme_feature_facebook_pixel'] ); ?>');
				fbq('track', 'PageView');
			</script>
			<noscript>
				<img height="1" width="1" style="display:none"
					 src="https://www.facebook.com/tr?id=<?php echo esc_attr( $theme_options_data['theme_feature_facebook_pixel'] ); ?>&ev=PageView&noscript=1"/>
			</noscript>
			<?php
		}
		?>
		<?php
	}
}
add_action( 'wp_head', 'thim_add_marketing_code' );

/**
 * Define ajaxurl if not exist
 */
if ( ! function_exists( 'thim_define_ajaxurl' ) ) {
	function thim_define_ajaxurl() {
		?>
		<script type="text/javascript">
			if (typeof ajaxurl === 'undefined') {
				/* <![CDATA[ */
				var ajaxurl = "<?php echo esc_js( admin_url( 'admin-ajax.php' ) ); ?>";
				/* ]]> */
			}
		</script>
		<?php
	}
}
add_action( 'wp_head', 'thim_define_ajaxurl', 1000 );
