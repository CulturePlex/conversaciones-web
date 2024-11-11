<?php
/**
 * Page Title Bar
 */

if ( 'elementor_library' == get_post_type() ) {
	return;
}

global $wp_query, $post;
$GLOBALS['post']      = $wp_query->post;
$thim_options         = get_theme_mods();
$thim_heading_top_src = $custom_title = $subtitle = $text_color = $sub_color = $bg_color = $front_title = '';
$hide_breadcrumb      = $hide_title = $hide_page_title = 0;
$bg_opacity           = $hiden_subtitle = 1;

if ( get_post_type() == "lpr_course" || get_post_type() == "lpr_quiz" || get_post_type() == "lp_course" || get_post_type() == "lp_quiz" || get_post_type() == "lp_collection" || thim_check_is_course() || thim_check_is_course_taxonomy() ) {
	$prefix = 'learnpress_';
} elseif ( get_post_type() == "tp_event" ) {
	$prefix = 'event_';
} elseif ( get_post_type() == "product" ) {
	$prefix = 'woo_';
} elseif ( get_post_type() == "post" ) {
	$prefix = 'blog_';
} else {
	$prefix = '';
}
$cat_obj = $wp_query->get_queried_object();
if ( isset( $cat_obj->term_id ) ) {
	$cat_ID = $cat_obj->term_id;
} else {
	$cat_ID = "";
}

if ( isset( $thim_options['hide_page_title'] ) ) {
	$hide_title = get_theme_mod( 'hide_page_title', false );
}

if ( isset( $thim_options['disable_breadcrumb'] ) ) {
	$hide_breadcrumb = get_theme_mod( 'disable_breadcrumb' );
}

if ( isset( $thim_options['page_title_background_color'] ) ) {
	$bg_color = get_theme_mod( 'page_title_background_color' );
}

if ( isset( $thim_options['page_title_background_opacity'] ) ) {
	$bg_opacity = (float) get_theme_mod( 'page_title_background_opacity' );
}

if ( ( isset( $thim_options['page_title_background_image'] ) && get_theme_mod( 'page_title_background_image' ) <> '' ) ) {
	$thim_heading_top_img = get_theme_mod( 'page_title_background_image' );
	$thim_heading_top_src = $thim_heading_top_img; // For the default value

	if ( is_numeric( $thim_heading_top_img ) ) {
		$thim_heading_top_attachment = wp_get_attachment_image_src( $thim_heading_top_img, 'full' );
		$thim_heading_top_src        = $thim_heading_top_attachment[0];
	}
}

// Get Style From MTB
$blog_id = get_option( 'page_for_posts' );

if ( is_page() ) {

} elseif ( is_single() ) {
	if ( isset( $thim_options['' . $prefix . 'single_hide_page_title'] ) ) {
		$hide_page_title = get_theme_mod( '' . $prefix . 'single_hide_page_title' );
	}
	if ( isset( $thim_options['' . $prefix . 'single_hide_breadcrumb'] ) ) {
		$hide_breadcrumb = get_theme_mod( '' . $prefix . 'single_hide_breadcrumb' );
	}
	if ( ( isset( $thim_options['' . $prefix . 'single_heading_background_image'] ) && get_theme_mod( '' . $prefix . 'single_heading_background_image' ) <> '' ) ) {
		$thim_heading_top_img = get_theme_mod( '' . $prefix . 'single_heading_background_image' );
		$thim_heading_top_src = $thim_heading_top_img; // For the default value

		if ( is_numeric( $thim_heading_top_img ) ) {
			$thim_heading_top_attachment = wp_get_attachment_image_src( $thim_heading_top_img, 'full' );
			$thim_heading_top_src        = $thim_heading_top_attachment[0];
		}
	}
	if ( isset( $thim_options['' . $prefix . 'single_heading_background_color'] ) ) {
		$bg_color = get_theme_mod( '' . $prefix . 'single_heading_background_color' );
	}
	if ( isset( $thim_options['' . $prefix . 'single_background_opacity'] ) ) {
		$bg_opacity = (float) get_theme_mod( '' . $prefix . 'single_background_opacity' );
	}
} else {
	if ( isset( $thim_options['' . $prefix . 'archive_hide_page_title'] ) ) {
		$hide_page_title = get_theme_mod( '' . $prefix . 'archive_hide_page_title' );
	}
	if ( isset( $thim_options['' . $prefix . 'archive_hide_breadcrumb'] ) ) {
		$hide_breadcrumb = get_theme_mod( '' . $prefix . 'archive_hide_breadcrumb' );
	}
	if ( ( isset( $thim_options['' . $prefix . 'archive_heading_background_image'] ) && get_theme_mod( '' . $prefix . 'single_heading_background_image' ) <> '' ) ) {
		$thim_heading_top_img = get_theme_mod( '' . $prefix . 'archive_heading_background_image' );
		$thim_heading_top_src = $thim_heading_top_img; // For the default value

		if ( is_numeric( $thim_heading_top_img ) ) {
			$thim_heading_top_attachment = wp_get_attachment_image_src( $thim_heading_top_img, 'full' );
			$thim_heading_top_src        = $thim_heading_top_attachment[0];
		}
	}
	if ( isset( $thim_options['' . $prefix . 'archive_heading_background_color'] ) ) {
		$bg_color = get_theme_mod( '' . $prefix . 'archive_heading_background_color' );
	}
	if ( isset( $thim_options['' . $prefix . 'archive_background_opacity'] ) ) {
		$bg_opacity = (float) get_theme_mod( '' . $prefix . 'archive_background_opacity' );
	}
}

if ( is_page() || is_single() ) {
	$postid               = get_the_ID();
	$using_custom_heading = get_post_meta( $postid, 'thim_enable_custom_title', true );

	if ( $using_custom_heading ) {
		$hide_page_title = get_post_meta( $postid, 'thim_group_custom_title_hide_page_title', true );
		$hide_title      = get_post_meta( $postid, 'thim_group_custom_title_hide_title', true );
		$custom_title    = get_post_meta( $postid, 'thim_group_custom_title_new_title', true );
		$subtitle        = get_post_meta( $postid, 'thim_group_custom_title_custom_sub_title', true );
		$hiden_subtitle  = $hide_breadcrumb = '0';
		$hiden_subtitle  = get_post_meta( $postid, 'thim_group_custom_title_hide_sub_title', true );
		$hide_breadcrumb = get_post_meta( $postid, 'thim_group_custom_title_hide_breadcrumbs', true );

		$bg_color_1 = get_post_meta( $postid, 'thim_group_custom_title_bg_color', true );
		if ( $bg_color_1 <> '' && $bg_color_1 != '#' ) {
			$bg_color = $bg_color_1;
		}
		$cate_top_image = get_post_meta( $postid, 'thim_group_custom_title_bg_img', true );
		if ( is_numeric( $cate_top_image ) ) {
			$post_page_top_attachment = wp_get_attachment_image_src( $cate_top_image, 'full' );
			$thim_heading_top_src     = $post_page_top_attachment[0];
		}
	}
}

if ( is_front_page() || is_home() ) {

	if ( isset( $thim_options['blog_archive_hide_page_title'] ) ) {
		$hide_title = get_theme_mod( 'blog_archive_hide_page_title', false );
	}

	if ( isset( $thim_options['blog_archive_hide_breadcrumb'] ) ) {
		$hide_breadcrumb = get_theme_mod( 'blog_archive_hide_breadcrumb' );
	}

	if ( isset( $thim_options['blog_archive_heading_background_color'] ) ) {
		$bg_color = get_theme_mod( 'blog_archive_heading_background_color' );
	}

	if ( isset( $thim_options['blog_archive_background_opacity'] ) ) {
		$bg_opacity = (float) get_theme_mod( 'blog_archive_background_opacity' );
	}

	if ( ( isset( $thim_options['blog_archive_heading_background_image'] ) && get_theme_mod( 'blog_archive_heading_background_image' ) <> '' ) ) {
		$thim_heading_top_img = get_theme_mod( 'blog_archive_heading_background_image' );
		$thim_heading_top_src = $thim_heading_top_img; // For the default value

		if ( is_numeric( $thim_heading_top_img ) ) {
			$thim_heading_top_attachment = wp_get_attachment_image_src( $thim_heading_top_img, 'full' );
			if($thim_heading_top_attachment){
				$thim_heading_top_src        = $thim_heading_top_attachment[0];
			}

		}
	}

	$blog_id = get_option( 'page_for_posts' );
	if ( $blog_id ) {
		$using_custom_heading = get_post_meta( $blog_id, 'thim_enable_custom_title', true );

		if ( $using_custom_heading ) {
 			$hide_page_title = get_post_meta( $blog_id, 'thim_group_custom_title_hide_page_title', true );
			$hide_title      = get_post_meta( $blog_id, 'thim_group_custom_title_hide_title', true );
			$custom_title    = get_post_meta( $blog_id, 'thim_group_custom_title_new_title', true );
			$subtitle        = get_post_meta( $blog_id, 'thim_group_custom_title_custom_sub_title', true );
			$hiden_subtitle  = $hide_breadcrumb = '0';
			$hiden_subtitle  = get_post_meta( $blog_id, 'thim_group_custom_title_hide_sub_title', true );
			$hide_breadcrumb = get_post_meta( $blog_id, 'thim_group_custom_title_hide_breadcrumbs', true );

			$bg_color_1 = get_post_meta( $blog_id, 'thim_group_custom_title_bg_color', true );
			if ( $bg_color_1 <> '' && $bg_color_1 != '#' ) {
				$bg_color = $bg_color_1;
			}
			$cate_top_image = get_post_meta( $blog_id, 'thim_group_custom_title_bg_img', true );
			if ( is_numeric( $cate_top_image ) ) {
				$post_page_top_attachment = wp_get_attachment_image_src( $cate_top_image, 'full' );
				if($post_page_top_attachment){
					$thim_heading_top_src     = $post_page_top_attachment[0];
				}
 			}

		}
	}
}


$hide_title      = ( $hide_title == '1' ) ? '1' : $hide_title;
$hide_breadcrumb = ( $hide_breadcrumb == '1' ) ? '1' : $hide_breadcrumb;

// style css
$c_css_style       = $overlay_css_style = $title_css_style = $title_css = '';
$overlay_css_style .= ( $bg_color != '' ) ? 'background-color: ' . $bg_color . ';' : '';
$overlay_css_style .= ( $bg_color != '' ) ? 'opacity: ' . $bg_opacity . ';' : '';
$c_css_style       .= ( $thim_heading_top_src != '' ) ? 'background-image:url(' . $thim_heading_top_src . ');' : '';

$title_css_style .= ( $text_color != '' ) ? 'color: ' . $text_color . ';' : '';
$c_css_sub_color = ( $sub_color != '' ) ? 'style="color:' . $sub_color . '"' : '';

$title_css   = ( $title_css_style != '' ) ? 'style="' . $title_css_style . '"' : '';
$c_css       = ( $c_css_style != '' ) ? 'style="' . $c_css_style . '"' : '';
$overlay_css = ( $overlay_css_style != '' ) ? 'style="' . $overlay_css_style . '"' : '';
$parallax    = get_theme_mod( 'enable_parallax_page_title', true ) ? ' data-stellar-background-ratio="0.5"' : '';
?>

<?php
if ( $hide_page_title != '1' ):
	?>
	<div class="page-title">
		<?php if ( $hide_title != '1' ) : ?>
			<div class="main-top" <?php echo ent2ncr( $c_css ); ?> <?php echo ent2ncr( $parallax ); ?> >
				<span class="overlay-top-header" <?php echo ent2ncr( $overlay_css ); ?>></span>
				<?php if ( $hide_title != '1' ) : ?>
					<div class="content container">
						<?php
						if ( is_single() ) {
							$typography = 'h2 ' . $title_css;
						} else {
							$typography = 'h1 ' . $title_css;
						}
						if ( ( is_category() || is_archive() || is_search() || is_404() ) ) {
							echo '<' . $typography . '>';
							echo thim_archive_title();
							echo '</' . $typography . '>';
							if ( category_description( $cat_ID ) != '' ) {
							} else {
								if ( $hiden_subtitle != '1' ):
									echo esc_html( $subtitle != '' ) ? '<div class="description" ' . $c_css_sub_color . '><p>' . $subtitle . '</p></div>' : '';
								endif;
							}
						} elseif ( is_page() || is_single() ) {
							if ( is_single() ) {
								if ( get_post_type() == "post" ) {
									if ( $custom_title ) {
										$single_title = $custom_title;
									} else {
										$category     = get_the_category();
										$category_id  = get_cat_ID( $category[0]->cat_name );
										$single_title = get_category_parents( $category_id, false, " " );
									}
									echo '<' . $typography . '>';
									echo esc_html( $custom_title != '' ) ? $custom_title : get_the_title();
									echo '</' . $typography . '>';
								}

								if ( get_post_type() == "our_team" ) {
									echo '<' . $typography . '>' . esc_html__( 'Our Team', 'ivy-school' );
									echo '</' . $typography . '>';
								}
								if ( get_post_type() == "tp_event" ) {
									echo '<' . $typography . '>' . esc_html__( 'Events', 'ivy-school' );
									echo '</' . $typography . '>';
								}
								if ( get_post_type() == "product" ) {
									echo '<' . $typography . '>' . esc_html__( 'Products', 'ivy-school' );
									echo '</' . $typography . '>';
								}
								if ( get_post_type() == "lpr_course" || get_post_type() == "lpr_quiz" || get_post_type() == "lp_course" || get_post_type() == "lp_quiz" || thim_check_is_course() || thim_check_is_course_taxonomy() ) {
									echo '<' . $typography . '>';
									echo esc_html( $custom_title != '' ) ? $custom_title : get_the_title();
									echo '</' . $typography . '>';
								}
								if ( get_post_type() == "lp_collection" ) {
									echo '<' . $typography . '>' . esc_html__( 'Collections', 'ivy-school' );
									echo '</' . $typography . '>';
								}
								if ( get_post_type() == "testimonials" ) {
									echo '<' . $typography . '>' . esc_html__( 'Testimonials', 'ivy-school' );
									echo '</' . $typography . '>';
								}
							} else {
								echo '<' . $typography . '>';
								echo esc_html( $custom_title != '' ) ? $custom_title : get_the_title( get_the_ID() );
								echo '</' . $typography . '>';
							}
							if ( $hiden_subtitle != '1' ):
								echo esc_html( $subtitle != '' ) ? '<div class="description" ' . $c_css_sub_color . '><p>' . $subtitle . '</p></div>' : '';
							endif;
						} elseif ( is_front_page() ) {
							if ( $hiden_subtitle != '1' ):
								echo '<div class="description" ' . $c_css_sub_color . '><p>' . get_bloginfo( 'description' ) . '</p></div>';
							endif;
							echo '<h1>';
							echo get_bloginfo( 'name' );
							echo '</h1>';
						} elseif ( is_home() && ! is_front_page() ) {
							$blog_id = get_option( 'page_for_posts' );
							echo '<h1>';
							echo esc_html( $custom_title != '' ) ? $custom_title : esc_html__( 'Blog', 'ivy-school' );
							echo '</h1>';
							if ( $hiden_subtitle != '1' ):
								$sub_title = ( $subtitle != '' ) ? '<div class="description" ' . $c_css_sub_color . '><p>' . $subtitle . '</p></div>' : '';
								echo esc_html( $sub_title );
							endif;
						}
						?>

						<?php
						if ( $hide_breadcrumb != '1' ) :?>
							<div class="breadcrumb-content">
								<?php
								if ( ! is_front_page() || ! is_home() ) { ?>
									<div class="breadcrumbs-wrapper">
										<div class="container">
											<?php
											do_action( 'thim_breadcrumbs' );
											?>
										</div><!-- .container -->
									</div><!-- .breadcrumbs-wrapper -->
								<?php }
								?>
							</div><!-- .breadcrumb-content -->
						<?php
						endif;
						?>
 					</div>
				<?php endif; ?>
			</div><!-- .main-top -->
		<?php endif; ?>
	</div><!-- .page-title -->
<?php endif; ?>
