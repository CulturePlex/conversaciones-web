<?php
/**
 * BuilderPress functions
 *
 * @version     1.0.0
 * @package     BuilderPress/Classes
 * @category    Classes
 * @author      Thimpress, leehld
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'builder_press_get_template' ) ) {
	/**
	 * @param        $template_name
	 * @param array  $args
	 * @param string $template_path
	 * @param string $default_path
	 */
	function builder_press_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
		if ( is_array( $args ) && isset( $args ) ) {
			extract( $args );
		}

		if ( false === strpos( $template_name, '.php' ) ) {
			$template_name .= '.php';
		}

		$template_file = builder_press_locate_template( $template_name, $template_path, $default_path );

		if ( ! file_exists( $template_file ) ) {
			_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $template_file ), '1.0.0' );

			return;
		}

		include $template_file;
	}
}

if ( ! function_exists( 'builder_press_locate_template' ) ) {
	/**
	 * @param        $template_name
	 * @param string $template_path
	 * @param string $default_path
	 *
	 * @return mixed
	 */
	function builder_press_locate_template( $template_name, $template_path = '', $default_path = '' ) {

		if ( ! $template_path ) {
			$template_path = 'elements/';
		}

		// Set default plugin templates path.
		if ( ! $default_path ) {
			$default_path = BUILDER_PRESS_INC . 'elements/' . $template_path; // Path to the template folder
		}

		$base = substr( ( substr( $template_path, 0, strpos( $template_path, '/tpl' ) ) ), strpos( $template_path, '/' ) + 1 );
		// Search template file in theme folder.
		$template = locate_template( array(
			"builderpress/$base/$template_name",
			$template_name
		) );

		// Get plugins template file.
		if ( ! $template ) {
			$template = $default_path . $template_name;
		}

		return apply_filters( 'builder-press/locate-template', $template, $template_name, $template_path, $default_path );
	}
}

if ( ! function_exists( 'builder_press_get_elements' ) ) {
	/**
	 * @return mixed
	 */
	function builder_press_get_elements() {
		$BP       = BuilderPress();
		$elements = $BP->get_elements();

		// allow unset elements
		$unset = apply_filters( 'builder-press/elements-unset', array() );

		foreach ( $elements as $plugin => $_elements ) {
			foreach ( $unset as $item ) {
				$index = array_search( $item, $_elements );

				if ( $index != false ) {
					unset( $elements[ $plugin ][ $index ] );
				}
			}
		}

		return $elements;
	}
}

if ( ! function_exists( 'builder_press_get_group' ) ) {
	/**
	 * Get group of element (widget/shortcode) by name
	 *
	 * @param $name
	 *
	 * @return int|mixed|string
	 */
	function builder_press_get_group( $name ) {
		$BP       = BuilderPress();
		$elements = $BP->get_elements();

		foreach ( $elements as $group => $_elements ) {
			if ( in_array( $name, $_elements ) ) {
				return $group;
			}
		}

		return apply_filters( 'builder-press/default-group', 'general', $name );
	}
}

if ( ! function_exists( 'builder_press_aq_resize' ) ) {
	/**
	 * This is just a tiny wrapper function for the class above so that there is no
	 * need to change any code in your own WP themes. Usage is still the same :)
	 *
	 * @param      $url
	 * @param null $width
	 * @param null $height
	 * @param null $crop
	 * @param bool $single
	 * @param bool $upscale
	 *
	 * @return array|bool|string
	 * @throws Aq_Exception
	 */
	function builder_press_aq_resize( $url, $width = null, $height = null, $crop = null, $single = true, $upscale = false ) {
		/* WPML Fix */
		if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {
			global $sitepress;
			$url = $sitepress->convert_url( $url, $sitepress->get_default_language() );
		}
		/* WPML Fix */
		$aq_resize = Aq_Resize::getInstance();

		return $aq_resize->process( $url, $width, $height, $crop, $single, $upscale );
	}
}

if ( ! function_exists( 'builder_press_get_attachment_image' ) ) {
	/**
	 * @param        $id
	 * @param string $size
	 * @param string $type
	 * @param bool   $link
	 * @param string $classes
	 */
	function builder_press_get_attachment_image( $id, $size = 'thumbnail', $type = 'attachment', $link = false, $classes = '' ) {

		$attachment_id = $id;
		if ( $type == 'post' ) {
			$attachment_id = get_post_thumbnail_id( $id );
		}

		$src = wp_get_attachment_image_src( $attachment_id, 'full' );

		if ( ! $src ) {
			// Get demo image
			global $wpdb;
			$key           = 'builder-press/attachment_image/demo_image';
			$attachment_id = builderpress_cache_load_first( 'get', $key );
            if ( false === $attachment_id ) {
	            $attachment_id = $wpdb->get_col(
		            $wpdb->prepare(
			            "SELECT p.ID FROM $wpdb->posts AS p INNER JOIN $wpdb->postmeta AS pm ON p.ID = pm.post_id
				WHERE 	pm.meta_key = %s
				AND 	pm.meta_value LIKE %s",
			            '_wp_attached_file',
			            '%demo_image.jpg'
		            )
	            );

                builderpress_cache_load_first( 'set', $key, $attachment_id );
            }

			if ( empty( $attachment_id[0] ) ) {
				return;
			}

			$attachment_id = $attachment_id[0];
			$src           = wp_get_attachment_image_src( $attachment_id, 'full' );
		}

		if ( $size != 'full' && ! in_array( $size, get_intermediate_image_sizes() ) ) {
			//custom size
			$thumbnail_size = explode( 'x', $size );
			$width          = $thumbnail_size[0];
			$height         = $thumbnail_size[1];
			$img_src        = builder_press_aq_resize( $src[0], $width, $height, true );
		} elseif ( $size == 'full' ) {
			$img_src = $src[0];
			$width   = $src[1];
			$height  = $src[2];
		} else {
			$image_size = wp_get_attachment_image_src( $attachment_id, $size );
			$img_src    = $image_size[0];
			$width      = $image_size[1];
			$height     = $image_size[2];
		}

		if ( empty( $img_src ) ) {
			$img_src = $src[0];
		}

		if ( $img_src ) {
			if ( $link ) { ?>
				<a href="<?php echo esc_url( get_permalink( $id ) ); ?>" class="img-link" target="_self">
			<?php } ?>

			<img <?php image_hwstring( $width, $height ); ?> src="<?php echo esc_attr( $img_src ); ?>"
															 alt="<?php echo get_the_title( $id ); ?>"
															 class="<?php echo esc_attr( $classes ); ?>">

			<?php if ( $link ) { ?>
				</a>
			<?php }
		}
	}
}

if ( ! function_exists( 'bp_get_entry_meta_tax' ) ) {
	function bp_get_entry_meta_tax( $post_id = 0, $limit = - 1, $tax_name = 'category' ) {
		$html = '';
		if ( $post_id == 0 ) {
			$post_id = get_the_ID();
		}
		if ( $tax_name == 'category' ) {
			$categories = get_the_category();
		} else {
			$categories = get_the_terms( $post_id, $tax_name );
		}
		if ( ! empty( $categories ) ) {
			if ( $limit == - 1 ) {
				foreach ( $categories as $cat ) {
					$html .= '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a><span>,</span>';
				}
			} else {
				foreach ( $categories as $key => $cat ) {
					if ( $key == $limit ) {
						break;
					}
					if ( $tax_name = 'category' ) {
						$html .= '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a> ';
					} else {
						$html .= '<a href="' . esc_url( get_term_link( $cat->term_id, $tax_name ) ) . '">' . esc_html( $cat->name ) . '</a> ';
					}
				}
			}
		}

		return $html;
	}
}

if ( ! function_exists( 'bp_template_build_link' ) ) {
	/**
	 * Show link attrs in template.
	 *
	 * @param array $link
	 *
	 * @return string
	 */
	function bp_template_build_link( $link = array() ) {
		$target = ! empty( $link['target'] ) ? " target='" . esc_attr( $link['target'] ) . "'" : '';
		$rel    = ! empty( $link['rel'] ) ? " rel='" . esc_attr( $link['rel'] ) . "'" : '';
		$title  = ! empty( $link['title'] ) ? " title='" . esc_attr( $link['title'] ) . "'" : '';

		return $target . $title . $rel;
	}
}

/**
 * Support SSL (https)
 */
function bp_ssl_secure_url( $sources ) {
	$scheme = parse_url( site_url(), PHP_URL_SCHEME );
	if ( 'https' == $scheme ) {
		if ( stripos( $sources, 'http://' ) === 0 ) {
			$sources = 'https' . substr( $sources, 4 );
		}

		return $sources;
	}

	return $sources;
}

function bp_ssl_secure_image_srcset( $sources ) {
	$scheme = parse_url( site_url(), PHP_URL_SCHEME );
	if ( 'https' == $scheme ) {
		foreach ( $sources as &$source ) {
			if ( stripos( $source['url'], 'http://' ) === 0 ) {
				$source['url'] = 'https' . substr( $source['url'], 4 );
			}
		}

		return $sources;
	}

	return $sources;
}

add_filter( 'wp_calculate_image_srcset', 'bp_ssl_secure_image_srcset' );
add_filter( 'wp_get_attachment_url', 'bp_ssl_secure_url', 1000 );
add_filter( 'image_widget_image_url', 'bp_ssl_secure_url' );

/**
 * Optimize: script_version
 */

function bp_optimize_remove_script_version( $src ) {
	$parts = explode( '?ver', $src );

	return $parts[0];
}

//add_filter( 'script_loader_src', 'bp_optimize_remove_script_version', 15, 1 );
//add_filter( 'style_loader_src', 'bp_optimize_remove_script_version', 15, 1 );

/**
 * Reset password failed
 */
if ( ! function_exists( 'thim_reset_password_failed' ) ) {
	function bp_reset_password_failed() {
		//setup your custom URL for redirection
		$url = add_query_arg( 'action', 'lostpassword', bp_get_login_page_url() );

		if ( empty( $_POST['user_login'] ) ) {
			$url = add_query_arg( 'empty', '1', $url );
			wp_redirect( $url );
			exit;
		} elseif ( strpos( $_POST['user_login'], '@' ) ) {
			$user_data = get_user_by( 'email', trim( $_POST['user_login'] ) );
			if ( empty( $user_data ) ) {
				$url = add_query_arg( 'user_not_exist', '1', $url );
				wp_redirect( $url );
				exit;
			}
		} elseif ( ! username_exists( $_POST['user_login'] ) ) {
			$url = add_query_arg( 'user_not_exist', '1', $url );
			wp_redirect( $url );
			exit;
		}
	}
}
add_action( 'lostpassword_post', 'bp_reset_password_failed', 999 );

/**
 * Action add menu account
 */
add_action( 'thim_menu_account', 'builderpress_login_menu_account' );
function builderpress_login_menu_account() {
	?>
	<ul class="user-info">
		<?php
		if ( thim_plugin_active( 'learnpress' ) ) :
			$profile = LP_Profile::instance();
			?>
			<li>
				<a class="profile"
				   href="<?php echo esc_url( learn_press_user_profile_link() ); ?>"><?php esc_html_e( 'Profile', 'ivy-school' ); ?></a>
			</li>
			<li>
				<a class="courses"
				   href="<?php echo esc_url( $profile->get_tab_link( 'courses', true ) ); ?>"><?php esc_html_e( 'Courses', 'ivy-school' ); ?></a>
			</li>
			<li>
				<a class="orders"
				   href="<?php echo esc_url( $profile->get_tab_link( 'orders', true ) ); ?>"><?php esc_html_e( 'Orders', 'ivy-school' ); ?></a>
			</li>
			<li>
				<a class="become_a_teacher"
				   href="<?php echo learn_press_get_page_link( 'become_a_teacher' ); ?>"><?php esc_html_e( 'Become An Instructor', 'ivy-school' ); ?></a>
			</li>
			<li>
				<a class="settings"
				   href="<?php echo esc_url( $profile->get_tab_link( 'settings', true ) ); ?>"><?php esc_html_e( 'Edit Profile', 'ivy-school' ); ?></a>
			</li>
		<?php endif; ?>
		<li>
			<a class="logout" title="<?php echo esc_attr__( 'Logout', 'ivy-school' ) ?>"
			   href="<?php echo esc_url( wp_logout_url() ); ?>">
        <span class="text-logout">
            <?php echo esc_html__( 'Logout', 'ivy-school' ); ?>
        </span>

			</a>
		</li>
	</ul>

	<?php
}

/**
 * Action add menu account woocommerce
 */
add_action( 'thim_woo_account', 'builderpress_woo_login_menu_account' );
function builderpress_woo_login_menu_account() {
	?>
	<ul class="user-info">
		<?php if ( thim_plugin_active( 'woocommerce' ) ) :
			$wc_account_items = wc_get_account_menu_items();
			foreach ( $wc_account_items as $wc_account_item => $name_label ):
				?>
				<li>
					<a href="<?php echo esc_url( wc_get_account_endpoint_url( $wc_account_item ) ); ?>"><?php echo esc_html( $name_label ); ?></a>
				</li>
			<?php
			endforeach;
		endif; ?>
	</ul>
	<?php
}


/**
 * Get url account page
 */
if ( ! function_exists( 'bp_get_login_page_url' ) ) {
	function bp_get_login_page_url( $redirect_url = '' ) {
		$page = get_page_by_path( 'account' );
		if ( $page ) {
			return ! empty( $redirect_url ) ? add_query_arg( 'redirect_to', urlencode( $redirect_url ), get_permalink( $page[0] ) ) : get_permalink( $page->ID );
		}

		return wp_login_url();
	}
}

/**
 * Detect device
 */
if ( ! function_exists( 'bp_detect_device' ) ) {
	function bp_detect_device() {
		$detect = 'desktop';
		if ( wp_is_mobile() ) {
			$detect = 'mobile';
			if ( strpos( $_SERVER['HTTP_USER_AGENT'], 'iPad' ) !== false ) {
				$detect = 'tablet';
			}
		}

		return $detect;
	}
}

if ( ! function_exists( 'bp_custom_css_class_shortcode' ) ) {
	function bp_custom_css_class_shortcode( $value, $pre = '' ) {
		$class = preg_match( '/\s*\.([^\{]+)\s*\{\s*([^\}]+)\s*\}\s*/', $value ) ? $pre . preg_replace( '/\s*\.([^\{]+)\s*\{\s*([^\}]+)\s*\}\s*/', '$1', $value ) : '';

		return $class;
	}
}

if ( ! function_exists( 'bp_list_ionicons' ) ) {
	function bp_list_ionicons() {
		$ionicons = apply_filters( 'builderpress/list-ionicons', array(
			array( 'ion-alert' => 'Alert' ),
			array( 'ion-alert-circled' => 'Alert Circled' ),
			array( 'ion-android-add' => 'Android Add' ),
			array( 'ion-android-add-circle' => 'Android Add Circle' ),
			array( 'ion-android-alarm-clock' => 'Android Alarm Clock' ),
			array( 'ion-android-alert' => 'Android Alert' ),
			array( 'ion-android-apps' => 'Android Apps' ),
			array( 'ion-android-archive' => 'Android Archive' ),
			array( 'ion-android-arrow-back' => 'Android Arrow Back' ),
			array( 'ion-android-arrow-down' => 'Android Arrow Down' ),
			array( 'ion-android-arrow-dropdown' => 'Android Arrow Dropdown' ),
			array( 'ion-android-arrow-dropdown-circle' => 'Android Arrow Dropdown Circle' ),
			array( 'ion-android-arrow-dropleft' => 'Android Arrow Dropleft' ),
			array( 'ion-android-arrow-dropleft-circle' => 'Android Arrow Dropleft Circle' ),
			array( 'ion-android-arrow-dropright' => 'Android Arrow Dropright' ),
			array( 'ion-android-arrow-dropright-circle' => 'Android Arrow Dropright Circle' ),
			array( 'ion-android-arrow-dropup' => 'Android Arrow Dropup' ),
			array( 'ion-android-arrow-dropup-circle' => 'Android Arrow Dropup Circle' ),
			array( 'ion-android-arrow-forward' => 'Android Arrow Forward' ),
			array( 'ion-android-arrow-up' => 'Android Arrow Up' ),
			array( 'ion-android-attach' => 'Android Attach' ),
			array( 'ion-android-bar' => 'Android Bar' ),
			array( 'ion-android-bicycle' => 'Android Bicycle' ),
			array( 'ion-android-boat' => 'Android Boat' ),
			array( 'ion-android-bookmark' => 'Android Bookmark' ),
			array( 'ion-android-bulb' => 'Android Bulb' ),
			array( 'ion-android-bus' => 'Android Bus' ),
			array( 'ion-android-calendar' => 'Android Calendar' ),
			array( 'ion-android-call' => 'Android Call' ),
			array( 'ion-android-camera' => 'Android Camera' ),
			array( 'ion-android-cancel' => 'Android Cancel' ),
			array( 'ion-android-car' => 'Android Car' ),
			array( 'ion-android-cart' => 'Android Cart' ),
			array( 'ion-android-chat' => 'Android Chat' ),
			array( 'ion-android-checkbox' => 'Android Checkbox' ),
			array( 'ion-android-checkbox-blank' => 'Android Checkbox Blank' ),
			array( 'ion-android-checkbox-outline' => 'Android Checkbox Outline' ),
			array( 'ion-android-checkbox-outline-blank' => 'Android Checkbox Outline Blank' ),
			array( 'ion-android-checkmark-circle' => 'Android Checkmark Circle' ),
			array( 'ion-android-clipboard' => 'Android Clipboard' ),
			array( 'ion-android-close' => 'Android Close' ),
			array( 'ion-android-cloud' => 'Android Cloud' ),
			array( 'ion-android-cloud-circle' => 'Android Cloud Circle' ),
			array( 'ion-android-cloud-done' => 'Android Cloud Done' ),
			array( 'ion-android-cloud-outline' => 'Android Cloud Outline' ),
			array( 'ion-android-color-palette' => 'Android Color Palette' ),
			array( 'ion-android-compass' => 'Android Compass' ),
			array( 'ion-android-contact' => 'Android Contact' ),
			array( 'ion-android-contacts' => 'Android Contacts' ),
			array( 'ion-android-contract' => 'Android Contract' ),
			array( 'ion-android-create' => 'Android Create' ),
			array( 'ion-android-delete' => 'Android Delete' ),
			array( 'ion-android-desktop' => 'Android Desktop' ),
			array( 'ion-android-document' => 'Android Document' ),
			array( 'ion-android-done' => 'Android Done' ),
			array( 'ion-android-done-all' => 'Android Done All' ),
			array( 'ion-android-download' => 'Android Download' ),
			array( 'ion-android-drafts' => 'Android Drafts' ),
			array( 'ion-android-exit' => 'Android Exit' ),
			array( 'ion-android-expand' => 'Android Expand' ),
			array( 'ion-android-favorite' => 'Android Favorite' ),
			array( 'ion-android-favorite-outline' => 'Android Favorite Outline' ),
			array( 'ion-android-film' => 'Android Film' ),
			array( 'ion-android-folder' => 'Android Folder' ),
			array( 'ion-android-folder-open' => 'Android Folder Open' ),
			array( 'ion-android-funnel' => 'Android Funnel' ),
			array( 'ion-android-globe' => 'Android Globe' ),
			array( 'ion-android-hand' => 'Android Hand' ),
			array( 'ion-android-hangout' => 'Android Hangout' ),
			array( 'ion-android-happy' => 'Android Happy' ),
			array( 'ion-android-home' => 'Android Home' ),
			array( 'ion-android-image' => 'Android Image' ),
			array( 'ion-android-laptop' => 'Android Laptop' ),
			array( 'ion-android-list' => 'Android List' ),
			array( 'ion-android-locate' => 'Android Locate' ),
			array( 'ion-android-lock' => 'Android Lock' ),
			array( 'ion-android-mail' => 'Android Mail' ),
			array( 'ion-android-map' => 'Android Map' ),
			array( 'ion-android-menu' => 'Android Menu' ),
			array( 'ion-android-microphone' => 'Android Microphone' ),
			array( 'ion-android-microphone-off' => 'Android Microphone Off' ),
			array( 'ion-android-more-horizontal' => 'Android More Horizontal' ),
			array( 'ion-android-more-vertical' => 'Android More Vertical' ),
			array( 'ion-android-navigate' => 'Android Navigate' ),
			array( 'ion-android-notifications' => 'Android Notifications' ),
			array( 'ion-android-notifications-none' => 'Android Notifications None' ),
			array( 'ion-android-notifications-off' => 'Android Notifications Off' ),
			array( 'ion-android-open' => 'Android Open' ),
			array( 'ion-android-options' => 'Android Options' ),
			array( 'ion-android-people' => 'Android People' ),
			array( 'ion-android-person' => 'Android Person' ),
			array( 'ion-android-person-add' => 'Android Person Add' ),
			array( 'ion-android-phone-landscape' => 'Android Phone Landscape' ),
			array( 'ion-android-phone-portrait' => 'Android Phone Portrait' ),
			array( 'ion-android-pin' => 'Android Pin' ),
			array( 'ion-android-plane' => 'Android Plane' ),
			array( 'ion-android-playstore' => 'Android Playstore' ),
			array( 'ion-android-print' => 'Android Print' ),
			array( 'ion-android-radio-button-off' => 'Android Radio Button Off' ),
			array( 'ion-android-radio-button-on' => 'Android Radio Button On' ),
			array( 'ion-android-refresh' => 'Android Refresh' ),
			array( 'ion-android-remove' => 'Android Remove' ),
			array( 'ion-android-remove-circle' => 'Android Remove Circle' ),
			array( 'ion-android-restaurant' => 'Android Restaurant' ),
			array( 'ion-android-sad' => 'Android Sad' ),
			array( 'ion-android-search' => 'Android Search' ),
			array( 'ion-android-send' => 'Android Send' ),
			array( 'ion-android-settings' => 'Android Settings' ),
			array( 'ion-android-share' => 'Android Share' ),
			array( 'ion-android-share-alt' => 'Android Share Alt' ),
			array( 'ion-android-star' => 'Android Star' ),
			array( 'ion-android-star-half' => 'Android Star Half' ),
			array( 'ion-android-star-outline' => 'Android Star Outline' ),
			array( 'ion-android-stopwatch' => 'Android Stopwatch' ),
			array( 'ion-android-subway' => 'Android Subway' ),
			array( 'ion-android-sunny' => 'Android Sunny' ),
			array( 'ion-android-sync' => 'Android Sync' ),
			array( 'ion-android-textsms' => 'Android Textsms' ),
			array( 'ion-android-time' => 'Android Time' ),
			array( 'ion-android-train' => 'Android Train' ),
			array( 'ion-android-unlock' => 'Android Unlock' ),
			array( 'ion-android-upload' => 'Android Upload' ),
			array( 'ion-android-volume-down' => 'Android Volume Down' ),
			array( 'ion-android-volume-mute' => 'Android Volume Mute' ),
			array( 'ion-android-volume-off' => 'Android Volume Off' ),
			array( 'ion-android-volume-up' => 'Android Volume Up' ),
			array( 'ion-android-walk' => 'Android Walk' ),
			array( 'ion-android-warning' => 'Android Warning' ),
			array( 'ion-android-watch' => 'Android Watch' ),
			array( 'ion-android-wifi' => 'Android Wifi' ),
			array( 'ion-aperture' => 'Aperture' ),
			array( 'ion-archive' => 'Archive' ),
			array( 'ion-arrow-down-a' => 'Arrow Down A' ),
			array( 'ion-arrow-down-b' => 'Arrow Down B' ),
			array( 'ion-arrow-down-c' => 'Arrow Down C' ),
			array( 'ion-arrow-expand' => 'Arrow Expand' ),
			array( 'ion-arrow-graph-down-left' => 'Arrow Graph Down Left' ),
			array( 'ion-arrow-graph-down-right' => 'Arrow Graph Down Right' ),
			array( 'ion-arrow-graph-up-left' => 'Arrow Graph Up Left' ),
			array( 'ion-arrow-graph-up-right' => 'Arrow Graph Up Right' ),
			array( 'ion-arrow-left-a' => 'Arrow Left A' ),
			array( 'ion-arrow-left-b' => 'Arrow Left B' ),
			array( 'ion-arrow-left-c' => 'Arrow Left C' ),
			array( 'ion-arrow-move' => 'Arrow Move' ),
			array( 'ion-arrow-resize' => 'Arrow Resize' ),
			array( 'ion-arrow-return-left' => 'Arrow Return Left' ),
			array( 'ion-arrow-return-right' => 'Arrow Return Right' ),
			array( 'ion-arrow-right-a' => 'Arrow Right A' ),
			array( 'ion-arrow-right-b' => 'Arrow Right B' ),
			array( 'ion-arrow-right-c' => 'Arrow Right C' ),
			array( 'ion-arrow-shrink' => 'Arrow Shrink' ),
			array( 'ion-arrow-swap' => 'Arrow Swap' ),
			array( 'ion-arrow-up-a' => 'Arrow Up A' ),
			array( 'ion-arrow-up-b' => 'Arrow Up B' ),
			array( 'ion-arrow-up-c' => 'Arrow Up C' ),
			array( 'ion-asterisk' => 'Asterisk' ),
			array( 'ion-at' => 'At' ),
			array( 'ion-backspace' => 'Backspace' ),
			array( 'ion-backspace-outline' => 'Backspace Outline' ),
			array( 'ion-bag' => 'Bag' ),
			array( 'ion-battery-charging' => 'Battery Charging' ),
			array( 'ion-battery-empty' => 'Battery Empty' ),
			array( 'ion-battery-full' => 'Battery Full' ),
			array( 'ion-battery-half' => 'Battery Half' ),
			array( 'ion-battery-low' => 'Battery Low' ),
			array( 'ion-beaker' => 'Beaker' ),
			array( 'ion-beer' => 'Beer' ),
			array( 'ion-bluetooth' => 'Bluetooth' ),
			array( 'ion-bonfire' => 'Bonfire' ),
			array( 'ion-bookmark' => 'Bookmark' ),
			array( 'ion-bowtie' => 'Bowtie' ),
			array( 'ion-briefcase' => 'Briefcase' ),
			array( 'ion-bug' => 'Bug' ),
			array( 'ion-calculator' => 'Calculator' ),
			array( 'ion-calendar' => 'Calendar' ),
			array( 'ion-camera' => 'Camera' ),
			array( 'ion-card' => 'Card' ),
			array( 'ion-cash' => 'Cash' ),
			array( 'ion-chatbox' => 'Chatbox' ),
			array( 'ion-chatbox-working' => 'Chatbox Working' ),
			array( 'ion-chatboxes' => 'Chatboxes' ),
			array( 'ion-chatbubble' => 'Chatbubble' ),
			array( 'ion-chatbubble-working' => 'Chatbubble Working' ),
			array( 'ion-chatbubbles' => 'Chatbubbles' ),
			array( 'ion-checkmark' => 'Checkmark' ),
			array( 'ion-checkmark-circled' => 'Checkmark Circled' ),
			array( 'ion-checkmark-round' => 'Checkmark Round' ),
			array( 'ion-chevron-down' => 'Chevron Down' ),
			array( 'ion-chevron-left' => 'Chevron Left' ),
			array( 'ion-chevron-right' => 'Chevron Right' ),
			array( 'ion-chevron-up' => 'Chevron Up' ),
			array( 'ion-clipboard' => 'Clipboard' ),
			array( 'ion-clock' => 'Clock' ),
			array( 'ion-close' => 'Close' ),
			array( 'ion-close-circled' => 'Close Circled' ),
			array( 'ion-close-round' => 'Close Round' ),
			array( 'ion-closed-captioning' => 'Closed Captioning' ),
			array( 'ion-cloud' => 'Cloud' ),
			array( 'ion-code' => 'Code' ),
			array( 'ion-code-download' => 'Code Download' ),
			array( 'ion-code-working' => 'Code Working' ),
			array( 'ion-coffee' => 'Coffee' ),
			array( 'ion-compass' => 'Compass' ),
			array( 'ion-compose' => 'Compose' ),
			array( 'ion-connection-bars' => 'Connectbars' ),
			array( 'ion-contrast' => 'Contrast' ),
			array( 'ion-crop' => 'Crop' ),
			array( 'ion-cube' => 'Cube' ),
			array( 'ion-disc' => 'Disc' ),
			array( 'ion-document' => 'Document' ),
			array( 'ion-document-text' => 'Document Text' ),
			array( 'ion-drag' => 'Drag' ),
			array( 'ion-earth' => 'Earth' ),
			array( 'ion-easel' => 'Easel' ),
			array( 'ion-edit' => 'Edit' ),
			array( 'ion-egg' => 'Egg' ),
			array( 'ion-eject' => 'Eject' ),
			array( 'ion-email' => 'Email' ),
			array( 'ion-email-unread' => 'Email Unread' ),
			array( 'ion-erlenmeyer-flask' => 'Erlenmeyer Flask' ),
			array( 'ion-erlenmeyer-flask-bubbles' => 'Erlenmeyer Flask Bubbles' ),
			array( 'ion-eye' => 'Eye' ),
			array( 'ion-eye-disabled' => 'Eye Disabled' ),
			array( 'ion-female' => 'Female' ),
			array( 'ion-filing' => 'Filing' ),
			array( 'ion-film-marker' => 'Film Marker' ),
			array( 'ion-fireball' => 'Fireball' ),
			array( 'ion-flag' => 'Flag' ),
			array( 'ion-flame' => 'Flame' ),
			array( 'ion-flash' => 'Flash' ),
			array( 'ion-flash-off' => 'Flash Off' ),
			array( 'ion-folder' => 'Folder' ),
			array( 'ion-fork' => 'Fork' ),
			array( 'ion-fork-repo' => 'Fork Repo' ),
			array( 'ion-forward' => 'Forward' ),
			array( 'ion-funnel' => 'Funnel' ),
			array( 'ion-gear-a' => 'Gear A' ),
			array( 'ion-gear-b' => 'Gear B' ),
			array( 'ion-grid' => 'Grid' ),
			array( 'ion-hammer' => 'Hammer' ),
			array( 'ion-happy' => 'Happy' ),
			array( 'ion-happy-outline' => 'Happy Outline' ),
			array( 'ion-headphone' => 'Headphone' ),
			array( 'ion-heart' => 'Heart' ),
			array( 'ion-heart-broken' => 'Heart Broken' ),
			array( 'ion-help' => 'Help' ),
			array( 'ion-help-buoy' => 'Help Buoy' ),
			array( 'ion-help-circled' => 'Help Circled' ),
			array( 'ion-home' => 'Home' ),
			array( 'ion-icecream' => 'Icecream' ),
			array( 'ion-image' => 'Image' ),
			array( 'ion-images' => 'Images' ),
			array( 'ion-information' => 'Information' ),
			array( 'ion-information-circled' => 'Informatcircled' ),
			array( 'ion-ionic' => 'Ionic' ),
			array( 'ion-ios-alarm' => 'Ios Alarm' ),
			array( 'ion-ios-alarm-outline' => 'Ios Alarm Outline' ),
			array( 'ion-ios-albums' => 'Ios Albums' ),
			array( 'ion-ios-albums-outline' => 'Ios Albums Outline' ),
			array( 'ion-ios-americanfootball' => 'Ios Americanfootball' ),
			array( 'ion-ios-americanfootball-outline' => 'Ios Americanfootball Outline' ),
			array( 'ion-ios-analytics' => 'Ios Analytics' ),
			array( 'ion-ios-analytics-outline' => 'Ios Analytics Outline' ),
			array( 'ion-ios-arrow-back' => 'Ios Arrow Back' ),
			array( 'ion-ios-arrow-down' => 'Ios Arrow Down' ),
			array( 'ion-ios-arrow-forward' => 'Ios Arrow Forward' ),
			array( 'ion-ios-arrow-left' => 'Ios Arrow Left' ),
			array( 'ion-ios-arrow-right' => 'Ios Arrow Right' ),
			array( 'ion-ios-arrow-thin-down' => 'Ios Arrow Thin Down' ),
			array( 'ion-ios-arrow-thin-left' => 'Ios Arrow Thin Left' ),
			array( 'ion-ios-arrow-thin-right' => 'Ios Arrow Thin Right' ),
			array( 'ion-ios-arrow-thin-up' => 'Ios Arrow Thin Up' ),
			array( 'ion-ios-arrow-up' => 'Ios Arrow Up' ),
			array( 'ion-ios-at' => 'Ios At' ),
			array( 'ion-ios-at-outline' => 'Ios At Outline' ),
			array( 'ion-ios-barcode' => 'Ios Barcode' ),
			array( 'ion-ios-barcode-outline' => 'Ios Barcode Outline' ),
			array( 'ion-ios-baseball' => 'Ios Baseball' ),
			array( 'ion-ios-baseball-outline' => 'Ios Baseball Outline' ),
			array( 'ion-ios-basketball' => 'Ios Basketball' ),
			array( 'ion-ios-basketball-outline' => 'Ios Basketball Outline' ),
			array( 'ion-ios-bell' => 'Ios Bell' ),
			array( 'ion-ios-bell-outline' => 'Ios Bell Outline' ),
			array( 'ion-ios-body' => 'Ios Body' ),
			array( 'ion-ios-body-outline' => 'Ios Body Outline' ),
			array( 'ion-ios-bolt' => 'Ios Bolt' ),
			array( 'ion-ios-bolt-outline' => 'Ios Bolt Outline' ),
			array( 'ion-ios-book' => 'Ios Book' ),
			array( 'ion-ios-book-outline' => 'Ios Book Outline' ),
			array( 'ion-ios-bookmarks' => 'Ios Bookmarks' ),
			array( 'ion-ios-bookmarks-outline' => 'Ios Bookmarks Outline' ),
			array( 'ion-ios-box' => 'Ios Box' ),
			array( 'ion-ios-box-outline' => 'Ios Box Outline' ),
			array( 'ion-ios-briefcase' => 'Ios Briefcase' ),
			array( 'ion-ios-briefcase-outline' => 'Ios Briefcase Outline' ),
			array( 'ion-ios-browsers' => 'Ios Browsers' ),
			array( 'ion-ios-browsers-outline' => 'Ios Browsers Outline' ),
			array( 'ion-ios-calculator' => 'Ios Calculator' ),
			array( 'ion-ios-calculator-outline' => 'Ios Calculator Outline' ),
			array( 'ion-ios-calendar' => 'Ios Calendar' ),
			array( 'ion-ios-calendar-outline' => 'Ios Calendar Outline' ),
			array( 'ion-ios-camera' => 'Ios Camera' ),
			array( 'ion-ios-camera-outline' => 'Ios Camera Outline' ),
			array( 'ion-ios-cart' => 'Ios Cart' ),
			array( 'ion-ios-cart-outline' => 'Ios Cart Outline' ),
			array( 'ion-ios-chatboxes' => 'Ios Chatboxes' ),
			array( 'ion-ios-chatboxes-outline' => 'Ios Chatboxes Outline' ),
			array( 'ion-ios-chatbubble' => 'Ios Chatbubble' ),
			array( 'ion-ios-chatbubble-outline' => 'Ios Chatbubble Outline' ),
			array( 'ion-ios-checkmark' => 'Ios Checkmark' ),
			array( 'ion-ios-checkmark-empty' => 'Ios Checkmark Empty' ),
			array( 'ion-ios-checkmark-outline' => 'Ios Checkmark Outline' ),
			array( 'ion-ios-circle-filled' => 'Ios Circle Filled' ),
			array( 'ion-ios-circle-outline' => 'Ios Circle Outline' ),
			array( 'ion-ios-clock' => 'Ios Clock' ),
			array( 'ion-ios-clock-outline' => 'Ios Clock Outline' ),
			array( 'ion-ios-close' => 'Ios Close' ),
			array( 'ion-ios-close-empty' => 'Ios Close Empty' ),
			array( 'ion-ios-close-outline' => 'Ios Close Outline' ),
			array( 'ion-ios-cloud' => 'Ios Cloud' ),
			array( 'ion-ios-cloud-download' => 'Ios Cloud Download' ),
			array( 'ion-ios-cloud-download-outline' => 'Ios Cloud Download Outline' ),
			array( 'ion-ios-cloud-outline' => 'Ios Cloud Outline' ),
			array( 'ion-ios-cloud-upload' => 'Ios Cloud Upload' ),
			array( 'ion-ios-cloud-upload-outline' => 'Ios Cloud Upload Outline' ),
			array( 'ion-ios-cloudy' => 'Ios Cloudy' ),
			array( 'ion-ios-cloudy-night' => 'Ios Cloudy Night' ),
			array( 'ion-ios-cloudy-night-outline' => 'Ios Cloudy Night Outline' ),
			array( 'ion-ios-cloudy-outline' => 'Ios Cloudy Outline' ),
			array( 'ion-ios-cog' => 'Ios Cog' ),
			array( 'ion-ios-cog-outline' => 'Ios Cog Outline' ),
			array( 'ion-ios-color-filter' => 'Ios Color Filter' ),
			array( 'ion-ios-color-filter-outline' => 'Ios Color Filter Outline' ),
			array( 'ion-ios-color-wand' => 'Ios Color Wand' ),
			array( 'ion-ios-color-wand-outline' => 'Ios Color Wand Outline' ),
			array( 'ion-ios-compose' => 'Ios Compose' ),
			array( 'ion-ios-compose-outline' => 'Ios Compose Outline' ),
			array( 'ion-ios-contact' => 'Ios Contact' ),
			array( 'ion-ios-contact-outline' => 'Ios Contact Outline' ),
			array( 'ion-ios-copy' => 'Ios Copy' ),
			array( 'ion-ios-copy-outline' => 'Ios Copy Outline' ),
			array( 'ion-ios-crop' => 'Ios Crop' ),
			array( 'ion-ios-crop-strong' => 'Ios Crop Strong' ),
			array( 'ion-ios-download' => 'Ios Download' ),
			array( 'ion-ios-download-outline' => 'Ios Download Outline' ),
			array( 'ion-ios-drag' => 'Ios Drag' ),
			array( 'ion-ios-email' => 'Ios Email' ),
			array( 'ion-ios-email-outline' => 'Ios Email Outline' ),
			array( 'ion-ios-eye' => 'Ios Eye' ),
			array( 'ion-ios-eye-outline' => 'Ios Eye Outline' ),
			array( 'ion-ios-fastforward' => 'Ios Fastforward' ),
			array( 'ion-ios-fastforward-outline' => 'Ios Fastforward Outline' ),
			array( 'ion-ios-filing' => 'Ios Filing' ),
			array( 'ion-ios-filing-outline' => 'Ios Filing Outline' ),
			array( 'ion-ios-film' => 'Ios Film' ),
			array( 'ion-ios-film-outline' => 'Ios Film Outline' ),
			array( 'ion-ios-flag' => 'Ios Flag' ),
			array( 'ion-ios-flag-outline' => 'Ios Flag Outline' ),
			array( 'ion-ios-flame' => 'Ios Flame' ),
			array( 'ion-ios-flame-outline' => 'Ios Flame Outline' ),
			array( 'ion-ios-flask' => 'Ios Flask' ),
			array( 'ion-ios-flask-outline' => 'Ios Flask Outline' ),
			array( 'ion-ios-flower' => 'Ios Flower' ),
			array( 'ion-ios-flower-outline' => 'Ios Flower Outline' ),
			array( 'ion-ios-folder' => 'Ios Folder' ),
			array( 'ion-ios-folder-outline' => 'Ios Folder Outline' ),
			array( 'ion-ios-football' => 'Ios Football' ),
			array( 'ion-ios-football-outline' => 'Ios Football Outline' ),
			array( 'ion-ios-game-controller-a' => 'Ios Game Controller A' ),
			array( 'ion-ios-game-controller-a-outline' => 'Ios Game Controller A Outline' ),
			array( 'ion-ios-game-controller-b' => 'Ios Game Controller B' ),
			array( 'ion-ios-game-controller-b-outline' => 'Ios Game Controller B Outline' ),
			array( 'ion-ios-gear' => 'Ios Gear' ),
			array( 'ion-ios-gear-outline' => 'Ios Gear Outline' ),
			array( 'ion-ios-glasses' => 'Ios Glasses' ),
			array( 'ion-ios-glasses-outline' => 'Ios Glasses Outline' ),
			array( 'ion-ios-grid-view' => 'Ios Grid View' ),
			array( 'ion-ios-grid-view-outline' => 'Ios Grid View Outline' ),
			array( 'ion-ios-heart' => 'Ios Heart' ),
			array( 'ion-ios-heart-outline' => 'Ios Heart Outline' ),
			array( 'ion-ios-help' => 'Ios Help' ),
			array( 'ion-ios-help-empty' => 'Ios Help Empty' ),
			array( 'ion-ios-help-outline' => 'Ios Help Outline' ),
			array( 'ion-ios-home' => 'Ios Home' ),
			array( 'ion-ios-home-outline' => 'Ios Home Outline' ),
			array( 'ion-ios-infinite' => 'Ios Infinite' ),
			array( 'ion-ios-infinite-outline' => 'Ios Infinite Outline' ),
			array( 'ion-ios-information' => 'Ios Information' ),
			array( 'ion-ios-information-empty' => 'Ios Informatempty' ),
			array( 'ion-ios-information-outline' => 'Ios Informatoutline' ),
			array( 'ion-ios-ionic-outline' => 'Ios Ionic Outline' ),
			array( 'ion-ios-keypad' => 'Ios Keypad' ),
			array( 'ion-ios-keypad-outline' => 'Ios Keypad Outline' ),
			array( 'ion-ios-lightbulb' => 'Ios Lightbulb' ),
			array( 'ion-ios-lightbulb-outline' => 'Ios Lightbulb Outline' ),
			array( 'ion-ios-list' => 'Ios List' ),
			array( 'ion-ios-list-outline' => 'Ios List Outline' ),
			array( 'ion-ios-location' => 'Ios Location' ),
			array( 'ion-ios-location-outline' => 'Ios Locatoutline' ),
			array( 'ion-ios-locked' => 'Ios Locked' ),
			array( 'ion-ios-locked-outline' => 'Ios Locked Outline' ),
			array( 'ion-ios-loop' => 'Ios Loop' ),
			array( 'ion-ios-loop-strong' => 'Ios Loop Strong' ),
			array( 'ion-ios-medical' => 'Ios Medical' ),
			array( 'ion-ios-medical-outline' => 'Ios Medical Outline' ),
			array( 'ion-ios-medkit' => 'Ios Medkit' ),
			array( 'ion-ios-medkit-outline' => 'Ios Medkit Outline' ),
			array( 'ion-ios-mic' => 'Ios Mic' ),
			array( 'ion-ios-mic-off' => 'Ios Mic Off' ),
			array( 'ion-ios-mic-outline' => 'Ios Mic Outline' ),
			array( 'ion-ios-minus' => 'Ios Minus' ),
			array( 'ion-ios-minus-empty' => 'Ios Minus Empty' ),
			array( 'ion-ios-minus-outline' => 'Ios Minus Outline' ),
			array( 'ion-ios-monitor' => 'Ios Monitor' ),
			array( 'ion-ios-monitor-outline' => 'Ios Monitor Outline' ),
			array( 'ion-ios-moon' => 'Ios Moon' ),
			array( 'ion-ios-moon-outline' => 'Ios Moon Outline' ),
			array( 'ion-ios-more' => 'Ios More' ),
			array( 'ion-ios-more-outline' => 'Ios More Outline' ),
			array( 'ion-ios-musical-note' => 'Ios Musical Note' ),
			array( 'ion-ios-musical-notes' => 'Ios Musical Notes' ),
			array( 'ion-ios-navigate' => 'Ios Navigate' ),
			array( 'ion-ios-navigate-outline' => 'Ios Navigate Outline' ),
			array( 'ion-ios-nutrition' => 'Ios Nutrition' ),
			array( 'ion-ios-nutrition-outline' => 'Ios Nutritoutline' ),
			array( 'ion-ios-paper' => 'Ios Paper' ),
			array( 'ion-ios-paper-outline' => 'Ios Paper Outline' ),
			array( 'ion-ios-paperplane' => 'Ios Paperplane' ),
			array( 'ion-ios-paperplane-outline' => 'Ios Paperplane Outline' ),
			array( 'ion-ios-partlysunny' => 'Ios Partlysunny' ),
			array( 'ion-ios-partlysunny-outline' => 'Ios Partlysunny Outline' ),
			array( 'ion-ios-pause' => 'Ios Pause' ),
			array( 'ion-ios-pause-outline' => 'Ios Pause Outline' ),
			array( 'ion-ios-paw' => 'Ios Paw' ),
			array( 'ion-ios-paw-outline' => 'Ios Paw Outline' ),
			array( 'ion-ios-people' => 'Ios People' ),
			array( 'ion-ios-people-outline' => 'Ios People Outline' ),
			array( 'ion-ios-person' => 'Ios Person' ),
			array( 'ion-ios-person-outline' => 'Ios Person Outline' ),
			array( 'ion-ios-personadd' => 'Ios Personadd' ),
			array( 'ion-ios-personadd-outline' => 'Ios Personadd Outline' ),
			array( 'ion-ios-photos' => 'Ios Photos' ),
			array( 'ion-ios-photos-outline' => 'Ios Photos Outline' ),
			array( 'ion-ios-pie' => 'Ios Pie' ),
			array( 'ion-ios-pie-outline' => 'Ios Pie Outline' ),
			array( 'ion-ios-pint' => 'Ios Pint' ),
			array( 'ion-ios-pint-outline' => 'Ios Pint Outline' ),
			array( 'ion-ios-play' => 'Ios Play' ),
			array( 'ion-ios-play-outline' => 'Ios Play Outline' ),
			array( 'ion-ios-plus' => 'Ios Plus' ),
			array( 'ion-ios-plus-empty' => 'Ios Plus Empty' ),
			array( 'ion-ios-plus-outline' => 'Ios Plus Outline' ),
			array( 'ion-ios-pricetag' => 'Ios Pricetag' ),
			array( 'ion-ios-pricetag-outline' => 'Ios Pricetag Outline' ),
			array( 'ion-ios-pricetags' => 'Ios Pricetags' ),
			array( 'ion-ios-pricetags-outline' => 'Ios Pricetags Outline' ),
			array( 'ion-ios-printer' => 'Ios Printer' ),
			array( 'ion-ios-printer-outline' => 'Ios Printer Outline' ),
			array( 'ion-ios-pulse' => 'Ios Pulse' ),
			array( 'ion-ios-pulse-strong' => 'Ios Pulse Strong' ),
			array( 'ion-ios-rainy' => 'Ios Rainy' ),
			array( 'ion-ios-rainy-outline' => 'Ios Rainy Outline' ),
			array( 'ion-ios-recording' => 'Ios Recording' ),
			array( 'ion-ios-recording-outline' => 'Ios Recording Outline' ),
			array( 'ion-ios-redo' => 'Ios Redo' ),
			array( 'ion-ios-redo-outline' => 'Ios Redo Outline' ),
			array( 'ion-ios-refresh' => 'Ios Refresh' ),
			array( 'ion-ios-refresh-empty' => 'Ios Refresh Empty' ),
			array( 'ion-ios-refresh-outline' => 'Ios Refresh Outline' ),
			array( 'ion-ios-reload' => 'Ios Reload' ),
			array( 'ion-ios-reverse-camera' => 'Ios Reverse Camera' ),
			array( 'ion-ios-reverse-camera-outline' => 'Ios Reverse Camera Outline' ),
			array( 'ion-ios-rewind' => 'Ios Rewind' ),
			array( 'ion-ios-rewind-outline' => 'Ios Rewind Outline' ),
			array( 'ion-ios-rose' => 'Ios Rose' ),
			array( 'ion-ios-rose-outline' => 'Ios Rose Outline' ),
			array( 'ion-ios-search' => 'Ios Search' ),
			array( 'ion-ios-search-strong' => 'Ios Search Strong' ),
			array( 'ion-ios-settings' => 'Ios Settings' ),
			array( 'ion-ios-settings-strong' => 'Ios Settings Strong' ),
			array( 'ion-ios-shuffle' => 'Ios Shuffle' ),
			array( 'ion-ios-shuffle-strong' => 'Ios Shuffle Strong' ),
			array( 'ion-ios-skipbackward' => 'Ios Skipbackward' ),
			array( 'ion-ios-skipbackward-outline' => 'Ios Skipbackward Outline' ),
			array( 'ion-ios-skipforward' => 'Ios Skipforward' ),
			array( 'ion-ios-skipforward-outline' => 'Ios Skipforward Outline' ),
			array( 'ion-ios-snowy' => 'Ios Snowy' ),
			array( 'ion-ios-speedometer' => 'Ios Speedometer' ),
			array( 'ion-ios-speedometer-outline' => 'Ios Speedometer Outline' ),
			array( 'ion-ios-star' => 'Ios Star' ),
			array( 'ion-ios-star-half' => 'Ios Star Half' ),
			array( 'ion-ios-star-outline' => 'Ios Star Outline' ),
			array( 'ion-ios-stopwatch' => 'Ios Stopwatch' ),
			array( 'ion-ios-stopwatch-outline' => 'Ios Stopwatch Outline' ),
			array( 'ion-ios-sunny' => 'Ios Sunny' ),
			array( 'ion-ios-sunny-outline' => 'Ios Sunny Outline' ),
			array( 'ion-ios-telephone' => 'Ios Telephone' ),
			array( 'ion-ios-telephone-outline' => 'Ios Telephone Outline' ),
			array( 'ion-ios-tennisball' => 'Ios Tennisball' ),
			array( 'ion-ios-tennisball-outline' => 'Ios Tennisball Outline' ),
			array( 'ion-ios-thunderstorm' => 'Ios Thunderstorm' ),
			array( 'ion-ios-thunderstorm-outline' => 'Ios Thunderstorm Outline' ),
			array( 'ion-ios-time' => 'Ios Time' ),
			array( 'ion-ios-time-outline' => 'Ios Time Outline' ),
			array( 'ion-ios-timer' => 'Ios Timer' ),
			array( 'ion-ios-timer-outline' => 'Ios Timer Outline' ),
			array( 'ion-ios-toggle' => 'Ios Toggle' ),
			array( 'ion-ios-toggle-outline' => 'Ios Toggle Outline' ),
			array( 'ion-ios-trash' => 'Ios Trash' ),
			array( 'ion-ios-trash-outline' => 'Ios Trash Outline' ),
			array( 'ion-ios-undo' => 'Ios Undo' ),
			array( 'ion-ios-undo-outline' => 'Ios Undo Outline' ),
			array( 'ion-ios-unlocked' => 'Ios Unlocked' ),
			array( 'ion-ios-unlocked-outline' => 'Ios Unlocked Outline' ),
			array( 'ion-ios-upload' => 'Ios Upload' ),
			array( 'ion-ios-upload-outline' => 'Ios Upload Outline' ),
			array( 'ion-ios-videocam' => 'Ios Videocam' ),
			array( 'ion-ios-videocam-outline' => 'Ios Videocam Outline' ),
			array( 'ion-ios-volume-high' => 'Ios Volume High' ),
			array( 'ion-ios-volume-low' => 'Ios Volume Low' ),
			array( 'ion-ios-wineglass' => 'Ios Wineglass' ),
			array( 'ion-ios-wineglass-outline' => 'Ios Wineglass Outline' ),
			array( 'ion-ios-world' => 'Ios World' ),
			array( 'ion-ios-world-outline' => 'Ios World Outline' ),
			array( 'ion-ipad' => 'Ipad' ),
			array( 'ion-iphone' => 'Iphone' ),
			array( 'ion-ipod' => 'Ipod' ),
			array( 'ion-jet' => 'Jet' ),
			array( 'ion-key' => 'Key' ),
			array( 'ion-knife' => 'Knife' ),
			array( 'ion-laptop' => 'Laptop' ),
			array( 'ion-leaf' => 'Leaf' ),
			array( 'ion-levels' => 'Levels' ),
			array( 'ion-lightbulb' => 'Lightbulb' ),
			array( 'ion-link' => 'Link' ),
			array( 'ion-load-a' => 'Load A' ),
			array( 'ion-load-b' => 'Load B' ),
			array( 'ion-load-c' => 'Load C' ),
			array( 'ion-load-d' => 'Load D' ),
			array( 'ion-location' => 'Location' ),
			array( 'ion-lock-combination' => 'Lock Combination' ),
			array( 'ion-locked' => 'Locked' ),
			array( 'ion-log-in' => 'Log In' ),
			array( 'ion-log-out' => 'Log Out' ),
			array( 'ion-loop' => 'Loop' ),
			array( 'ion-magnet' => 'Magnet' ),
			array( 'ion-male' => 'Male' ),
			array( 'ion-man' => 'Man' ),
			array( 'ion-map' => 'Map' ),
			array( 'ion-medkit' => 'Medkit' ),
			array( 'ion-merge' => 'Merge' ),
			array( 'ion-mic-a' => 'Mic A' ),
			array( 'ion-mic-b' => 'Mic B' ),
			array( 'ion-mic-c' => 'Mic C' ),
			array( 'ion-minus' => 'Minus' ),
			array( 'ion-minus-circled' => 'Minus Circled' ),
			array( 'ion-minus-round' => 'Minus Round' ),
			array( 'ion-model-s' => 'Model S' ),
			array( 'ion-monitor' => 'Monitor' ),
			array( 'ion-more' => 'More' ),
			array( 'ion-mouse' => 'Mouse' ),
			array( 'ion-music-note' => 'Music Note' ),
			array( 'ion-navicon' => 'Navicon' ),
			array( 'ion-navicon-round' => 'Navicon Round' ),
			array( 'ion-navigate' => 'Navigate' ),
			array( 'ion-network' => 'Network' ),
			array( 'ion-no-smoking' => 'No Smoking' ),
			array( 'ion-nuclear' => 'Nuclear' ),
			array( 'ion-outlet' => 'Outlet' ),
			array( 'ion-paintbrush' => 'Paintbrush' ),
			array( 'ion-paintbucket' => 'Paintbucket' ),
			array( 'ion-paper-airplane' => 'Paper Airplane' ),
			array( 'ion-paperclip' => 'Paperclip' ),
			array( 'ion-pause' => 'Pause' ),
			array( 'ion-person' => 'Person' ),
			array( 'ion-person-add' => 'Person Add' ),
			array( 'ion-person-stalker' => 'Person Stalker' ),
			array( 'ion-pie-graph' => 'Pie Graph' ),
			array( 'ion-pin' => 'Pin' ),
			array( 'ion-pinpoint' => 'Pinpoint' ),
			array( 'ion-pizza' => 'Pizza' ),
			array( 'ion-plane' => 'Plane' ),
			array( 'ion-planet' => 'Planet' ),
			array( 'ion-play' => 'Play' ),
			array( 'ion-playstation' => 'Playstation' ),
			array( 'ion-plus' => 'Plus' ),
			array( 'ion-plus-circled' => 'Plus Circled' ),
			array( 'ion-plus-round' => 'Plus Round' ),
			array( 'ion-podium' => 'Podium' ),
			array( 'ion-pound' => 'Pound' ),
			array( 'ion-power' => 'Power' ),
			array( 'ion-pricetag' => 'Pricetag' ),
			array( 'ion-pricetags' => 'Pricetags' ),
			array( 'ion-printer' => 'Printer' ),
			array( 'ion-pull-request' => 'Pull Request' ),
			array( 'ion-qr-scanner' => 'Qr Scanner' ),
			array( 'ion-quote' => 'Quote' ),
			array( 'ion-radio-waves' => 'Radio Waves' ),
			array( 'ion-record' => 'Record' ),
			array( 'ion-refresh' => 'Refresh' ),
			array( 'ion-reply' => 'Reply' ),
			array( 'ion-reply-all' => 'Reply All' ),
			array( 'ion-ribbon-a' => 'Ribbon A' ),
			array( 'ion-ribbon-b' => 'Ribbon B' ),
			array( 'ion-sad' => 'Sad' ),
			array( 'ion-sad-outline' => 'Sad Outline' ),
			array( 'ion-scissors' => 'Scissors' ),
			array( 'ion-search' => 'Search' ),
			array( 'ion-settings' => 'Settings' ),
			array( 'ion-share' => 'Share' ),
			array( 'ion-shuffle' => 'Shuffle' ),
			array( 'ion-skip-backward' => 'Skip Backward' ),
			array( 'ion-skip-forward' => 'Skip Forward' ),
			array( 'ion-social-android' => 'Social Android' ),
			array( 'ion-social-android-outline' => 'Social Android Outline' ),
			array( 'ion-social-angular' => 'Social Angular' ),
			array( 'ion-social-angular-outline' => 'Social Angular Outline' ),
			array( 'ion-social-apple' => 'Social Apple' ),
			array( 'ion-social-apple-outline' => 'Social Apple Outline' ),
			array( 'ion-social-bitcoin' => 'Social Bitcoin' ),
			array( 'ion-social-bitcoin-outline' => 'Social Bitcoin Outline' ),
			array( 'ion-social-buffer' => 'Social Buffer' ),
			array( 'ion-social-buffer-outline' => 'Social Buffer Outline' ),
			array( 'ion-social-chrome' => 'Social Chrome' ),
			array( 'ion-social-chrome-outline' => 'Social Chrome Outline' ),
			array( 'ion-social-codepen' => 'Social Codepen' ),
			array( 'ion-social-codepen-outline' => 'Social Codepen Outline' ),
			array( 'ion-social-css3' => 'Social Css3' ),
			array( 'ion-social-css3-outline' => 'Social Css3 Outline' ),
			array( 'ion-social-designernews' => 'Social Designernews' ),
			array( 'ion-social-designernews-outline' => 'Social Designernews Outline' ),
			array( 'ion-social-dribbble' => 'Social Dribbble' ),
			array( 'ion-social-dribbble-outline' => 'Social Dribbble Outline' ),
			array( 'ion-social-dropbox' => 'Social Dropbox' ),
			array( 'ion-social-dropbox-outline' => 'Social Dropbox Outline' ),
			array( 'ion-social-euro' => 'Social Euro' ),
			array( 'ion-social-euro-outline' => 'Social Euro Outline' ),
			array( 'ion-social-facebook' => 'Social Facebook' ),
			array( 'ion-social-facebook-outline' => 'Social Facebook Outline' ),
			array( 'ion-social-foursquare' => 'Social Foursquare' ),
			array( 'ion-social-foursquare-outline' => 'Social Foursquare Outline' ),
			array( 'ion-social-freebsd-devil' => 'Social Freebsd Devil' ),
			array( 'ion-social-github' => 'Social Github' ),
			array( 'ion-social-github-outline' => 'Social Github Outline' ),
			array( 'ion-social-google' => 'Social Google' ),
			array( 'ion-social-google-outline' => 'Social Google Outline' ),
			array( 'ion-social-googleplus' => 'Social Googleplus' ),
			array( 'ion-social-googleplus-outline' => 'Social Googleplus Outline' ),
			array( 'ion-social-hackernews' => 'Social Hackernews' ),
			array( 'ion-social-hackernews-outline' => 'Social Hackernews Outline' ),
			array( 'ion-social-html5' => 'Social Html5' ),
			array( 'ion-social-html5-outline' => 'Social Html5 Outline' ),
			array( 'ion-social-instagram' => 'Social Instagram' ),
			array( 'ion-social-instagram-outline' => 'Social Instagram Outline' ),
			array( 'ion-social-javascript' => 'Social Javascript' ),
			array( 'ion-social-javascript-outline' => 'Social Javascript Outline' ),
			array( 'ion-social-linkedin' => 'Social Linkedin' ),
			array( 'ion-social-linkedin-outline' => 'Social Linkedin Outline' ),
			array( 'ion-social-markdown' => 'Social Markdown' ),
			array( 'ion-social-nodejs' => 'Social Nodejs' ),
			array( 'ion-social-octocat' => 'Social Octocat' ),
			array( 'ion-social-pinterest' => 'Social Pinterest' ),
			array( 'ion-social-pinterest-outline' => 'Social Pinterest Outline' ),
			array( 'ion-social-python' => 'Social Python' ),
			array( 'ion-social-reddit' => 'Social Reddit' ),
			array( 'ion-social-reddit-outline' => 'Social Reddit Outline' ),
			array( 'ion-social-rss' => 'Social Rss' ),
			array( 'ion-social-rss-outline' => 'Social Rss Outline' ),
			array( 'ion-social-sass' => 'Social Sass' ),
			array( 'ion-social-skype' => 'Social Skype' ),
			array( 'ion-social-skype-outline' => 'Social Skype Outline' ),
			array( 'ion-social-snapchat' => 'Social Snapchat' ),
			array( 'ion-social-snapchat-outline' => 'Social Snapchat Outline' ),
			array( 'ion-social-tumblr' => 'Social Tumblr' ),
			array( 'ion-social-tumblr-outline' => 'Social Tumblr Outline' ),
			array( 'ion-social-tux' => 'Social Tux' ),
			array( 'ion-social-twitch' => 'Social Twitch' ),
			array( 'ion-social-twitch-outline' => 'Social Twitch Outline' ),
			array( 'ion-social-twitter' => 'Social Twitter' ),
			array( 'ion-social-twitter-outline' => 'Social Twitter Outline' ),
			array( 'ion-social-usd' => 'Social Usd' ),
			array( 'ion-social-usd-outline' => 'Social Usd Outline' ),
			array( 'ion-social-vimeo' => 'Social Vimeo' ),
			array( 'ion-social-vimeo-outline' => 'Social Vimeo Outline' ),
			array( 'ion-social-whatsapp' => 'Social Whatsapp' ),
			array( 'ion-social-whatsapp-outline' => 'Social Whatsapp Outline' ),
			array( 'ion-social-windows' => 'Social Windows' ),
			array( 'ion-social-windows-outline' => 'Social Windows Outline' ),
			array( 'ion-social-wordpress' => 'Social Wordpress' ),
			array( 'ion-social-wordpress-outline' => 'Social Wordpress Outline' ),
			array( 'ion-social-yahoo' => 'Social Yahoo' ),
			array( 'ion-social-yahoo-outline' => 'Social Yahoo Outline' ),
			array( 'ion-social-yen' => 'Social Yen' ),
			array( 'ion-social-yen-outline' => 'Social Yen Outline' ),
			array( 'ion-social-youtube' => 'Social Youtube' ),
			array( 'ion-social-youtube-outline' => 'Social Youtube Outline' ),
			array( 'ion-soup-can' => 'Soup Can' ),
			array( 'ion-soup-can-outline' => 'Soup Can Outline' ),
			array( 'ion-speakerphone' => 'Speakerphone' ),
			array( 'ion-speedometer' => 'Speedometer' ),
			array( 'ion-spoon' => 'Spoon' ),
			array( 'ion-star' => 'Star' ),
			array( 'ion-stats-bars' => 'Stats Bars' ),
			array( 'ion-steam' => 'Steam' ),
			array( 'ion-stop' => 'Stop' ),
			array( 'ion-thermometer' => 'Thermometer' ),
			array( 'ion-thumbsdown' => 'Thumbsdown' ),
			array( 'ion-thumbsup' => 'Thumbsup' ),
			array( 'ion-toggle' => 'Toggle' ),
			array( 'ion-toggle-filled' => 'Toggle Filled' ),
			array( 'ion-transgender' => 'Transgender' ),
			array( 'ion-trash-a' => 'Trash A' ),
			array( 'ion-trash-b' => 'Trash B' ),
			array( 'ion-trophy' => 'Trophy' ),
			array( 'ion-tshirt' => 'Tshirt' ),
			array( 'ion-tshirt-outline' => 'Tshirt Outline' ),
			array( 'ion-umbrella' => 'Umbrella' ),
			array( 'ion-university' => 'University' ),
			array( 'ion-unlocked' => 'Unlocked' ),
			array( 'ion-upload' => 'Upload' ),
			array( 'ion-usb' => 'Usb' ),
			array( 'ion-videocamera' => 'Videocamera' ),
			array( 'ion-volume-high' => 'Volume High' ),
			array( 'ion-volume-low' => 'Volume Low' ),
			array( 'ion-volume-medium' => 'Volume Medium' ),
			array( 'ion-volume-mute' => 'Volume Mute' ),
			array( 'ion-wand' => 'Wand' ),
			array( 'ion-waterdrop' => 'Waterdrop' ),
			array( 'ion-wifi' => 'Wifi' ),
			array( 'ion-wineglass' => 'Wineglass' ),
			array( 'ion-woman' => 'Woman' ),
			array( 'ion-wrench' => 'Wrench' ),
			array( 'ion-xbox' => 'Xbox' ),
		) );

		return $ionicons;
	}
}

add_action( 'wp_ajax_nopriv_builderpress_search_ajax', 'search_ajax' );
add_action( 'wp_ajax_builderpress_search_ajax', 'search_ajax' );
function search_ajax() {
	$keyword = $_REQUEST['keyword'];
	$newdata = array();

	// allow filter to update post types to search
	$post_types = apply_filters( 'builder-press/post-types-search', array( 'post', 'page' ) );

	if ( $keyword ) {
		$keyword   = strtoupper( $keyword );
		$arr_query = array(
			'post_type'           => $post_types,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			's'                   => $keyword
		);
		$search    = new WP_Query( $arr_query );
		foreach ( $search->posts as $post ) {
			$newdata[] = array(
				'id'    => $post->ID,
				'title' => $post->post_title,
				'guid'  => get_permalink( $post->ID ),
			);
		}

		if ( ! count( $search->posts ) ) {
			$newdata[] = array(
				'id'    => '',
				'title' => esc_attr__( 'No posts found', 'builderpress' ),
				'guid'  => '#',
			);
		}
	}
	wp_send_json_success( $newdata );
	wp_die();
}

/**
 * Ajax Login popup
 */
add_action( 'wp_ajax_nopriv_builderpress_login_popup_ajax', 'login_ajax' );
add_action( 'wp_ajax_builderpress_login_popup_ajax', 'login_ajax' );
function login_ajax() {
	global $wpdb;

	//We shall SQL prepare all inputs to avoid sql injection.
	$username    = $wpdb->prepare( $_REQUEST['username'], array() );
	$password    = $_REQUEST['password'];
	$redirect_to = $_REQUEST['redirect_to'];
	$remember    = $wpdb->prepare( $_REQUEST['remember'], array() );

	if ( $remember ) {
		$remember = "true";
	} else {
		$remember = "false";
	}

	$login_data                  = array();
	$login_data['user_login']    = $username;
	$login_data['user_password'] = $password;
	$login_data['redirect_to']   = $redirect_to;
	$login_data['remember']      = $remember;
	$user_verify                 = wp_signon( $login_data, '' );

	$code = 1;

	if ( is_wp_error( $user_verify ) ) {
		$message = '<p class="message message-error">' . esc_html__( 'Wrong username or password.', 'builderpress' ) . '</p>';
		$code    = - 1;
	} else {
		$message = '<p class="message message-success">' . esc_html__( 'Login successful, redirecting...', 'builderpress' ) . '</p>';
	}
	$response_data = array(
		'code'    => $code,
		'message' => $message
	);
	if ( ! empty( $login_data['redirect_to'] ) ) {
		$response_data['redirect'] = $login_data['redirect_to'];
	}

	echo json_encode( $response_data );
	die(); // this is required to return a proper result
}

/**
 * Ajax Register popup
 */
add_action( 'wp_ajax_nopriv_builderpress_register_ajax', 'register_ajax' );
add_action( 'wp_ajax_builderpress_register_ajax', 'register_ajax' );
function register_ajax() {
// First check the nonce, if it fails the function will break
	$secure = check_ajax_referer( 'ajax_register_nonce', 'register_security', false );

	if ( ! $secure ) {
		$response_data = array(
			'message' => '<p class="message message-error">' . esc_html__( 'Something wrong. Please try again.', 'builderpress' ) . '</p>'
		);

		wp_send_json_error( $response_data );
	}

	parse_str( $_POST['data'], $data );
	$info = array();

	$info['user_login'] = sanitize_user( $data['user_login'] );
	$info['user_email'] = sanitize_email( $data['user_email'] );
	$info['user_pass']  = sanitize_text_field( $data['password'] );

	$confirm_password = sanitize_text_field( $data['repeat_password'] );

	if ( $info['user_pass'] !== $confirm_password ) {
		$response_data = array(
			'message' => '<p class="message message-error">' . esc_html__( 'Those passwords didn\'t match. Try again.', 'builderpress' ) . '</p>'
		);

		wp_send_json_error( $response_data );
	}

	// Register the user
	$user_register = wp_insert_user( $info );

	if ( is_wp_error( $user_register ) ) {
		$error = $user_register->get_error_codes();

		if ( in_array( 'empty_user_login', $error ) ) {
			$response_data = array(
				'message' => '<p class="message message-error">' . esc_html__( $user_register->get_error_message( 'empty_user_login' ), 'builderpress' ) . '</p>'
			);

		} elseif ( in_array( 'existing_user_login', $error ) ) {
			$response_data = array(
				'message' => '<p class="message message-error">' . esc_html__( 'This username is already registered.', 'builderpress' ) . '</p>'
			);
		} elseif ( in_array( 'existing_user_email', $error ) ) {
			$response_data = array(
				'message' => '<p class="message message-error">' . esc_html__( 'This email address is already registered.', 'builderpress' ) . '</p>'
			);
		}

		wp_send_json_error( $response_data );
	} else {
		$creds                  = array();
		$creds['user_login']    = $info['user_login'];
		$creds['user_password'] = $info['user_pass'];

		$user_signon = wp_signon( $creds, false );
		if ( is_wp_error( $user_signon ) ) {
			$response_data = array(
				'message' => '<p class="message message-error">' . esc_html__( 'Wrong username or password.', 'builderpress' ) . '</p>'
			);

			wp_send_json_error( $response_data );
		} else {
			wp_set_current_user( $user_signon->ID );
			wp_set_auth_cookie( $user_signon->ID );

			$response_data = array(
				'message' => '<p class="message message-success">' . esc_html__( 'Registration successful, redirecting...', 'builderpress' ) . '</p>'
			);

			wp_send_json_success( $response_data );
		}
	}
}

/**
 * Ajax Search Course
 */
add_action( 'wp_ajax_nopriv_builderpress_search_courses_ajax', 'search_courses_ajax' );
add_action( 'wp_ajax_builderpress_search_courses_ajax', 'search_courses_ajax' );
function search_courses_ajax() {
	$keyword = $_REQUEST['keyword'];
	$newdata = array();

	// allow filter to update post types to search
	$post_types = apply_filters( 'builder-press/post-types-search-courses', array( 'lp_course' ) );
	if ( $keyword ) {
		$keyword   = strtoupper( $keyword );
		$arr_query = array(
			'post_type'           => $post_types,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			's'                   => $keyword
		);
		$search    = new WP_Query( $arr_query );
		foreach ( $search->posts as $post ) {
			$newdata[] = array(
				'id'    => $post->ID,
				'title' => $post->post_title,
				'guid'  => get_permalink( $post->ID ),
			);
		}

		if ( ! count( $search->posts ) ) {
			$newdata[] = array(
				'id'    => '',
				'title' => esc_attr__( 'No courses found', 'builderpress' ),
				'guid'  => '#',
			);
		}
	}
	wp_send_json_success( $newdata );
	wp_die();
}

/**
 * Ajax Open Video popup
 */
add_action( 'wp_ajax_nopriv_builderpress_open_video_popup_ajax', 'open_video_popup_ajax' );
add_action( 'wp_ajax_builderpress_open_video_popup_ajax', 'open_video_popup_ajax' );
function open_video_popup_ajax() {
	$id_video = $_REQUEST['id_video'];
	if ( get_post_meta( $id_video, 'thim_video_meta_player_sc', true ) ) {
		$sc = get_post_meta( $id_video, 'thim_video_meta_player_sc', true );
		if ( is_plugin_active( 'Stellar-video-player/video-player.php' ) ) {
			$file = ABSPATH . "/wp-content/plugins/Stellar-video-player/includes/plugin-frontend.php";
			if ( file_exists( $file ) ) {
				include( $file );
			}
		}
		echo do_shortcode( $sc );
		echo '<script>';
		readfile( ABSPATH . '/wp-content/plugins/Stellar-video-player/js/embed.min.js' );
		echo '</script>';
	} elseif ( get_post_meta( $id_video, 'thim_video_meta_player_iframe', true ) ) {
		echo get_post_meta( get_the_ID(), 'thim_video_meta_player_iframe', true );
	}

	wp_die();
}

/**
 * Ajax Search video
 */
add_action( 'wp_ajax_nopriv_builderpress_search_video_ajax', 'search_video_ajax' );
add_action( 'wp_ajax_builderpress_search_video_ajax', 'search_video_ajax' );
function search_video_ajax() {
	$keyword = $_REQUEST['keyword'];
	$cat     = $_REQUEST['cat_filter'];
	$newdata = array();

	// allow filter to update post types to search
	$post_types = apply_filters( 'builder-press/post-types-search-video', array( 'post' ) );

	if ( $keyword ) {
		$keyword   = strtoupper( $keyword );
		$arr_query = array(
			'post_type'           => $post_types,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'tax_query'           => array(
				array(
					'taxonomy' => 'post_format',
					'field'    => 'slug',
					'terms'    => array( 'post-format-video' ),
				)
			),
			's'                   => $keyword
		);
		if ( $cat ) {
			$arr_query['cat'] = $cat;
		}
		$search = new WP_Query( $arr_query );
		foreach ( $search->posts as $post ) {
			$newdata[] = array(
				'id'    => $post->ID,
				'title' => $post->post_title,
				'guid'  => get_permalink( $post->ID ),
			);
		}

		if ( ! count( $search->posts ) ) {
			$newdata[] = array(
				'id'    => '',
				'title' => esc_attr__( 'No videos found', 'builderpress' ),
				'guid'  => '#',
			);
		}
	}
	wp_send_json_success( $newdata );
	wp_die();
}

/**
 * Ajax Search Products
 */
add_action( 'wp_ajax_nopriv_builderpress_product_search_ajax', 'product_search_ajax' );
add_action( 'wp_ajax_builderpress_product_search_ajax', 'product_search_ajax' );
function product_search_ajax() {
	$keyword = $_REQUEST['keyword'];
	$newdata = array();

	// allow filter to update post types to search
	$post_types = apply_filters( 'builder-press/post-types-search-courses', array( 'product' ) );
	if ( $keyword ) {
		$keyword   = strtoupper( $keyword );
		$arr_query = array(
			'post_type'           => $post_types,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			's'                   => $keyword
		);
		$search    = new WP_Query( $arr_query );
		foreach ( $search->posts as $post ) {
			$newdata[] = array(
				'id'    => $post->ID,
				'title' => $post->post_title,
				'guid'  => get_permalink( $post->ID ),
			);
		}

		if ( ! count( $search->posts ) ) {
			$newdata[] = array(
				'id'    => '',
				'title' => esc_attr__( 'No products found', 'builderpress' ),
				'guid'  => '#',
			);
		}
	}
	wp_send_json_success( $newdata );
	wp_die();
}

/**
 * navigation
 */
add_action( 'wp_ajax_bp_product_filter', 'bp_product_filter' );
add_action( 'wp_ajax_nopriv_bp_product_filter', 'bp_product_filter' );
function bp_product_filter() {

	$params = htmlspecialchars_decode( $_POST['params'] );
	$params = json_decode( str_replace( '\\', '', $params ), true );

	$news_args = array(
		'post_type'      => 'product',
		'posts_per_page' => $params['number'],
	);

	if ( $params['category'] != '0' ) {
		$parent_cat = get_category_by_slug( $params['category'] );
		$parent_cat = isset( $parent_cat->term_id ) ? $parent_cat->term_id : 0;
		$categories = get_categories( array( 'hide_empty' => true, 'parent' => $parent_cat ) );
		if ( $categories ) {
			$news_args['product_cat'] = $categories[0]->name;
		} else {
			$news_args['product_cat'] = $params['category'];
		}
	}

	if ( isset( $_POST['page'] ) ) {
		$current_page           = $_POST['page'];
		$params['current_page'] = $current_page;
		$news_args['paged']     = $current_page;
	}

	if ( isset( $_POST['category'] ) ) {
		$news_args['product_cat'] = $_POST['category'];
	}


	$query = new WP_Query( $news_args );


	ob_start();

	builder_press_get_template( $params['layout'], array(
		'params' => $params,
		'query'  => $query
	), $params['template_path'] );

	$html = ob_get_contents();
	ob_end_clean();

	wp_reset_postdata();
	wp_send_json_success( $html );
	wp_die();
}

/**
 * Load more product
 */
add_action( 'wp_ajax_bp_product_isotope_loadmore', 'bp_product_isotope_loadmore' );
add_action( 'wp_ajax_nopriv_bp_product_isotope_loadmore', 'bp_product_isotope_loadmore' );
function bp_product_isotope_loadmore() {
	$params = htmlspecialchars_decode( $_POST['params'] );
	$params = json_decode( str_replace( '\\', '', $params ), true );

	$args = array(
		'post_type'      => 'product',
		'posts_per_page' => $params['number_loadmore'],
	);
	if ( $params['category'] ) {
		$arg['product_cat'] = $params['category'];
	}

	$query_posts = new WP_Query( $args );

	if ( $query_posts->have_posts() ) {
		ob_start();
		while ( $query_posts->have_posts() ) {
			$query_posts->the_post();
			builder_press_get_template( 'loadmore', array(
				'params' => $params,
				'posts'  => $query_posts
			), $params['template_path'] );
		}
		wp_reset_postdata();
		$html = ob_get_contents();
		ob_end_clean();
	}
	wp_send_json_success( $html );
	wp_die();
}

if ( ! function_exists( 'builder_press_excerpt' ) ) {
	function builder_press_excerpt( $limit, $id = null ) {
 		if ( !empty( $id ) ) {
			$content_post = get_post( $id );
			$text         = $content_post->post_content;
 		} else {
			$text = get_the_content();
		}
 		//		$text  = strip_shortcodes( $text );
		$text  = str_replace( ']]>', ']]>', $text );
		$text  = strip_tags( $text );
		$text  = nl2br( $text );
		$words = explode( ' ', $text, $limit + 1 );
		if ( count( $words ) > $limit ) {
			array_pop( $words );
			array_push( $words, '' );
			$text = implode( ' ', $words );
		}

		return apply_filters( 'the_content', $text );
	}
}

add_action( 'user_register', 'builderpress_register_update_pass_and_login_builderpress' , 99999,1);
add_filter( 'login_form_rp', 'builderpress_validate_password_reset_builderpress' , 99999 );
add_filter( 'login_form_resetpass','builderpress_validate_password_reset_builderpress', 99999 );
add_filter( 'password_change_email', 'builderpress_message_when_user_register_auto_login_builderpress' , 999999, 1 );
function builderpress_register_update_pass_and_login_builderpress($user_id){
	if (  ! isset( $_POST['password'] )|| ! get_theme_mod( 'thim_auto_login', true ) ) {
		return;
	}
	$pw = sanitize_text_field( $_POST['password'] );

	$user_data              = array();
	$user_data['ID']        = $user_id;
	$user_data['user_pass'] = $pw;

	$user_data = apply_filters('lp_user_data_register', $user_data, $user_id);
	//add_filter( 'send_password_change_email', '__return_false' );

	$new_user_id = wp_update_user( $user_data );

	if ( $new_user_id instanceof WP_Error ) {
		return;
	}
	if ( ! is_admin() ) {
		wp_set_current_user( $user_id );
		wp_set_auth_cookie( $user_id );
		$register_redirect_option = get_theme_mod( 'thim_register_redirect', false );

		if (!empty($redirect_to_checkout)) {
			$redirect_to = $redirect_to_checkout;
		} elseif (!empty($register_redirect_option)) {
			$redirect_to = $register_redirect_option;
		} elseif (!empty($_REQUEST['redirect_to'])) {
			$redirect_to = $_REQUEST['redirect_to'];
		} else {
			$redirect_to = thim_get_login_page_url();
		}

		wp_safe_redirect($redirect_to);
		die;
	}
}

function builderpress_validate_password_reset_builderpress(){
	if ( wp_doing_ajax() ) {
		return;
	}

	$login_page = thim_get_login_page_url();
	if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {

		if ( ! isset( $_REQUEST['key'] ) || ! isset( $_REQUEST['login'] ) ) {
			return;
		}

		$error_msg = '';
		$key       = $_REQUEST['key'];
		$login     = $_REQUEST['login'];

		$user = check_password_reset_key( $key, $login );

		if ( ! $user || is_wp_error( $user ) ) {
			$error_msg = 'invalid key';

			if ( $user && $error_code = $user->get_error_code() ) {
				$error_msg = $user->errors[ $error_code ][0];

			}

			wp_redirect( add_query_arg(
				array(
					'action'             => 'rp',
					'thim_resetpass_msg' => $error_msg,
				), $login_page
			) );

			die;
		}

		if ( isset( $_POST['password'] ) ) {

			if ( empty( $_POST['password'] ) ) {
				// Password is empty
				wp_redirect( add_query_arg(
					array(
						'action'           => 'rp',
						'key'              => $_REQUEST['key'],
						'login'            => $_REQUEST['login'],
						'invalid_password' => '1',
					), $login_page
				) );
				exit;
			}

			// Parameter checks OK, reset password
			reset_password( $user, $_POST['password'] );

			wp_redirect(
				$login_page
			);
		} else {
			_e( 'Invalid request.', 'ivy-school' );
		}

		exit;
	}

}

function builderpress_message_when_user_register_auto_login_builderpress($pass_change_email) {
 	$pass_change_email['subject'] = 'Welcome to [%s]';
	$pass_change_email['message'] = sprintf(
		'Hi ###USERNAME###,

                    You registered success on %s site

                    This email has been sent to ###EMAIL###

                    Regards,
                    All at ###SITENAME###
                    ###SITEURL###', get_bloginfo());

	return $pass_change_email;
}

add_action('register_post','builderpress_error_user_register',99999,3);

function builderpress_error_user_register($sanitized_user_login, $user_email, $errors ){
	if(is_wp_error( $errors )){
		$err_regist = [];
		foreach ($errors->errors as $k => $err){
			$err_regist[$k] = $err[0];
		}
		if(isset($_REQUEST['redirect_to']) && !empty($_REQUEST['redirect_to'])){
			$url_rediect = add_query_arg($err_regist,$_REQUEST['redirect_to']);
			wp_redirect($url_rediect);
		}

	}
}

if ( ! function_exists( 'thim_get_login_page_url' ) ) {
	function thim_get_login_page_url() {
		$page = get_option( 'thim_login_page' );
		if ( isset($page) ) {
 			return get_permalink( $page );
		} else {
			global $wpdb;
			$page = $wpdb->get_col(
				$wpdb->prepare(
					"SELECT p.ID FROM $wpdb->posts AS p INNER JOIN $wpdb->postmeta AS pm ON p.ID = pm.post_id
						WHERE 	pm.meta_key = %s
						AND 	pm.meta_value = %s
						AND		p.post_type = %s
						AND		p.post_status = %s",
					'thim_login_page',
					'1',
					'page',
					'publish'
				)
			);
			if ( ! empty( $page[0] ) ) {
				return get_permalink( $page[0] );
			}
		}

		return wp_login_url();
	}
}

/**
 * Set value for first load page on one process
 * Apply for query call same many times.
 *
 * @param string $type
 * @param string $key
 * @param $val mixed
 *
 * @author tungnx
 * @version 1.0.0
 * @sicne 4.1.4.1
 * @return false|mixed|string
 */
function builderpress_cache_load_first( string $type = 'get', string $key = '', $val = '' ) {
	static $first_set_value = array();

	if ( 'get' === $type ) {
		if ( ! array_key_exists( $key, $first_set_value ) ) {
			return false;
		} else {
			return $first_set_value[ $key ];
		}
	} elseif ( 'set' === $type ) {
		$first_set_value[ $key ] = $val;

		return $first_set_value[ $key ];
	} elseif ( 'clear' === $type ) {
		unset( $first_set_value[ $key ] );
	}

	return $first_set_value;
}
