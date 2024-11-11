<?php
/**
 * Wrapper Layout
 *
 */

/**
 * Thim wrapper layout
 *
 * @return string
 */
if ( ! function_exists( 'thim_wrapper_layout' ) ) :
	function thim_wrapper_layout() {
		global $wp_query;
		$postid            = get_the_ID();
		$thim_options      = get_theme_mods();
		$using_custom_layout = $cat_ID = '';
        $wrapper_layout = 'sidebar-right';
		$wrapper_class_col = 'col-sm-12 col-lg-9 flex-first';

		if ( get_post_type() == "tp_event" ) {
            $prefix = 'event_';
        } elseif ( get_post_type() == "product" ) {
            $prefix = 'woo_';
        } elseif ( get_post_type() == "lpr_course" || get_post_type() == "lpr_quiz" || get_post_type() == "lp_course" || get_post_type() == 'lp_quiz' || get_post_type() == "lp_collection" || thim_check_is_course() || thim_check_is_course_taxonomy() ) {
            $prefix = 'learnpress_';
		} else {
            if ( get_post_type() == "post" ) {
                $prefix = 'blog_';
            } else {
                $prefix = '';
            }
		}

		// get id category
		$cat_obj = $wp_query->get_queried_object();
		if ( isset( $cat_obj->term_id ) ) {
			$cat_ID = $cat_obj->term_id;
		}

        $using_custom_layout    = get_post_meta( $postid, 'thim_enable_custom_layout', true );
        $customize_custom_layout = get_post_meta( $postid, 'thim_custom_layout', true );
		//Get layout from customizer
		if ( is_page() ) {
			if ( isset( $thim_options['page_layout'] ) ) {
				$wrapper_layout = get_theme_mod( 'page_layout' );
			}
 			if ( get_the_ID() == get_option( 'learn_press_profile_page_id' ) ||
				get_the_ID() == get_option( 'learn_press_instructors_page_id' ) ||
				get_the_ID() == get_option( 'learn_press_single_instructor_page_id' )) {
				$wrapper_layout = 'no-sidebar';
			}

			// Get custom layout for page options ( metabox).
            if ( $using_custom_layout && $customize_custom_layout ) {
				$wrapper_layout = get_post_meta( $postid, 'thim_custom_layout', true );
			}

		} elseif ( is_single() ) {
			if ( isset( $thim_options[ '' . $prefix . 'single_layout' ] ) ) {
				$wrapper_layout = get_theme_mod( '' . $prefix . 'single_layout' );
			}
			// Get custom layout for single post options ( meta-box).
            if ( $using_custom_layout && $customize_custom_layout ) {
				$wrapper_layout = get_post_meta( $postid, 'thim_custom_layout', true );
			}

		} else {
			if ( isset( $thim_options[ '' . $prefix . 'archive_layout' ] ) ) {
				$wrapper_layout = get_theme_mod( '' . $prefix . 'archive_layout' );
			}
			// Get custom layout for category,... from category options.
			// Code a here.
		}

		// Get layout for custom post type (testimonial, ourteam, ...) // Code a here.
		if ( 'our_team' == get_post_type() ) {
			$wrapper_layout = 'no-sidebar';
		}

        if ( 'elementor_library' == get_post_type() ) {
            $wrapper_layout = 'no-sidebar';
        }

		if ( isset( $_GET['layout'] ) ) {
			$wrapper_layout = trim( $_GET['layout'] );
		}

        if( is_search() ) {
			$wrapper_layout = 'sidebar-right';
		}

		if( is_404() ) {
			$wrapper_layout = 'no-sidebar';
		}

        //Single Style 2
        if ( get_theme_mod( 'single_style', 'default' ) == 'style-2' ) {
            $wrapper_layout = 'no-sidebar';
        }
        if ( isset( $_GET['single'] ) &&  'post' == get_post_type() ) {
            if ( $_GET['single'] == 'style-2' ) {
                $wrapper_layout = 'no-sidebar';
            }
        }

		return $wrapper_layout;
	}
endif;




add_action( 'thim_wrapper_loop_start', 'thim_wrapper_loop_start' );
/**
 * Get wrapper layout start
 *
 * @return string
 */
if ( ! function_exists( 'thim_wrapper_loop_start' ) ) :
	function thim_wrapper_loop_start() {
		$class_no_padding = '';
        $wrapper_class_col = 'col-sm-12 full-width';
        $wrapper_layout = 'no-sidebar';

        if ( get_post_type() == "tp_event" ) {
            $prefix = 'event_';
        } elseif ( get_post_type() == "product" ) {
            $prefix = 'woo_';
        } elseif ( get_post_type() == "lpr_course" || get_post_type() == "lpr_quiz" || get_post_type() == "lp_course" || get_post_type() == 'lp_quiz' || get_post_type() == "lp_collection" || thim_check_is_course() || thim_check_is_course_taxonomy() ) {
            $prefix = 'learnpress_';
        } else {
            if ( get_post_type() == "post" ) {
                $prefix = 'blog_';
            } else {
                $prefix = '';
            }
        }

		if ( is_page() || is_single() ) {
			$mtb_no_padding = get_post_meta( get_the_ID(), 'thim_no_padding_content', true );
			if ( $mtb_no_padding ) {
				$class_no_padding = 'no-padding';
			}
		}


        $wrapper_layout = thim_wrapper_layout();

        // Get class layout
        if ( $wrapper_layout == 'no-sidebar' ) {
            $wrapper_class_col = "col-sm-12 full-width";
        }
        if ( $wrapper_layout == 'sidebar-left' ) {
            $wrapper_class_col = "col-lg-9 flex-last";
        }
        if ( $wrapper_layout == 'sidebar-right' ) {
            $wrapper_class_col = 'col-lg-9 flex-first';
        }
        if ( $wrapper_layout == 'full-sidebar' ) {
            $wrapper_class_col = 'col-lg-6 flex-unordered';
        }

		echo '<div class="container site-content ' . $wrapper_layout . ' ' . $class_no_padding . '"><div class="row">';

		if ( $wrapper_layout == 'full-sidebar' ) {
			$postid = get_the_ID();
			if ( is_page() ) {
				$get_sidebar_left = get_theme_mod( 'page_layout_sidebar_left' );
				// get sidebar from MTB
				$sidebar_left = get_post_meta( $postid, 'thim_custom_sidebar_left', true );
				if ( $sidebar_left ) {
					$get_sidebar_left = get_post_meta( $postid, 'thim_custom_sidebar_left', true );
				}
			} elseif ( is_single() ) {
				$get_sidebar_left = get_theme_mod( '' . $prefix . 'single_layout_sidebar_left' );
				// get sidebar from MTB
				$sidebar_left = get_post_meta( $postid, 'thim_custom_sidebar_left', true );
				if ( $sidebar_left ) {
					$get_sidebar_left = get_post_meta( $postid, 'thim_custom_sidebar_left', true );
				}
			} else {
				$get_sidebar_left = get_theme_mod( '' . $prefix . 'archive_layout_sidebar_left' );
			}
			echo '<aside id="secondary-left" class="widget-area col-lg-3 sticky-sidebar sidebar-left">';
			dynamic_sidebar( $get_sidebar_left );
			echo '</aside>';
		}

		if( $wrapper_layout=='sidebar-right' ) $wrapper_class_col .= ' border-right';
		echo '<main id="main" class="site-main ' . $wrapper_class_col . '" >';
	}
endif;


add_action( 'thim_wrapper_loop_end', 'thim_wrapper_loop_end' );
/**
 * Get wrapper layout end
 *
 * @return string
 */
if ( ! function_exists( 'thim_wrapper_loop_end' ) ) :
	function thim_wrapper_loop_end() {
		$postid = get_the_ID();
        $wrapper_class_col = 'col-sm-12 full-width';
        $wrapper_layout = 'sidebar-right';

        if ( get_post_type() == "tp_event" ) {
            $prefix = 'event_';
        } elseif ( get_post_type() == "product" ) {
            $prefix = 'woo_';
        } elseif ( get_post_type() == "lpr_course" || get_post_type() == "lpr_quiz" || get_post_type() == "lp_course" || get_post_type() == 'lp_quiz' || get_post_type() == "lp_collection" || thim_check_is_course() || thim_check_is_course_taxonomy() ) {
            $prefix = 'learnpress_';
        } else {
            if ( get_post_type() == "post" ) {
                $prefix = 'blog_';
            } else {
                $prefix = '';
            }
        }

        $wrapper_layout = thim_wrapper_layout();

        // Get class layout
        if ( $wrapper_layout == 'no-sidebar' ) {
            $wrapper_class_col = "col-sm-12 full-width";
        }
        if ( $wrapper_layout == 'sidebar-left' ) {
            $wrapper_class_col = "col-lg-9 flex-last";
        }
        if ( $wrapper_layout == 'sidebar-right' ) {
            $wrapper_class_col = 'col-lg-9 flex-first';
        }
        if ( $wrapper_layout == 'full-sidebar' ) {
            $wrapper_class_col = 'col-lg-6 flex-unordered';
        }

		if ( is_404() ) {
			$wrapper_class_col = 'col-sm-12 full-width';
		}
        if ( is_singular('post') ) {
            if ( get_theme_mod( 'blog_single_related_post', true ) ) :
                get_template_part( 'templates/template-parts/related-single' );
            endif;
        }

		echo '</main>';
		if ( $wrapper_class_col != 'col-sm-12 full-width' && $wrapper_class_col != 'col-sm-6 flex-unordered' ) {
			if ( get_post_type() == "lpr_course" || get_post_type() == "lpr_quiz" || get_post_type() == "lp_course" || get_post_type() == "lp_quiz" || get_post_type() == "lp_collection" || thim_check_is_course() || thim_check_is_course_taxonomy() ) {
                get_sidebar('courses');
            } else if ( get_post_type() == "tp_event" ) {
                get_sidebar( 'events' );
			} else {
				get_sidebar();
			}
		}
		if ( $wrapper_class_col == 'col-sm-6 flex-unordered' ) {
			if ( is_page() ) {
				$get_sidebar_right = get_theme_mod( 'page_layout_sidebar_right' );
				// get sidebar from MTB
				$sidebar_right = get_post_meta( $postid, 'thim_custom_sidebar_right', true );
				if ( $sidebar_right ) {
					$get_sidebar_right = get_post_meta( $postid, 'thim_custom_sidebar_right', true );
				}
			} elseif ( is_single() ) {
				$get_sidebar_right = get_theme_mod( '' . $prefix . 'single_layout_sidebar_right' );
				// get sidebar from MTB
				$sidebar_right = get_post_meta( $postid, 'thim_custom_sidebar_right', true );
				if ( $sidebar_right ) {
					$get_sidebar_right = get_post_meta( $postid, 'thim_custom_sidebar_right', true );
				}
			} else {
				$get_sidebar_right = get_theme_mod( '' . $prefix . 'archive_layout_sidebar_right' );
			}
			echo '<aside id="secondary-right" class="widget-area col-lg-3 sticky-sidebar">';
			dynamic_sidebar( $get_sidebar_right );
			echo '</aside>';
		}

		echo '</div></div>';

	}
endif;
