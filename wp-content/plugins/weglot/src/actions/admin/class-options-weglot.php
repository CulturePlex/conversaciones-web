<?php

namespace WeglotWP\Actions\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Exception;
use WeglotWP\Helpers\Helper_Tabs_Admin_Weglot;
use WeglotWP\Helpers\Helper_Pages_Weglot;
use WeglotWP\Helpers\Helper_Flag_Type;
use WeglotWP\Models\Hooks_Interface_Weglot;
use WeglotWP\Services\Option_Service_Weglot;
use WeglotWP\Services\User_Api_Service_Weglot;

/**
 * Sanitize options after submit form
 *
 * @since 2.0
 */
class Options_Weglot implements Hooks_Interface_Weglot {
	/**
	 * @var Option_Service_Weglot
	 */
	private $option_services;
	/**
	 * @var User_Api_Service_Weglot
	 */
	private $user_api_services;

	/**
	 * @throws Exception
	 * @since 2.0
	 */
	public function __construct() {
		$this->option_services   = weglot_get_service( 'Option_Service_Weglot' );
		$this->user_api_services = weglot_get_service( 'User_Api_Service_Weglot' );
	}

	/**
	 * @return void
	 * @throws Exception
	 * @version 3.0.0
	 * @see Hooks_Interface_Weglot
	 *
	 * @since 2.0
	 */
	public function hooks() {
		add_action( 'admin_post_weglot_save_settings', array( $this, 'weglot_save_settings' ) );
		$api_key = $this->option_services->get_api_key( true );
		if ( empty( $api_key ) && ( ! isset( $_GET['page'] ) || strpos( $_GET['page'], 'weglot-settings' ) === false) ) { // phpcs:ignore
			// We don't show the notice if we are on Weglot configuration.
			add_action( 'admin_notices', array( '\WeglotWP\Notices\No_Configuration_Weglot', 'admin_notice' ) );
		}
	}

	/**
	 * Activate plugin
	 *
	 * @return void
	 */
	public function activate() {
		update_option( 'weglot_version', WEGLOT_VERSION );
	}


	/**
	 * @since 3.0.0
	 * @return void
	 */
	public function weglot_save_settings() {

		$redirect_url = admin_url( 'admin.php?page=' . Helper_Pages_Weglot::SETTINGS );
		if ( ! isset( $_GET['tab'] ) || ! isset( $_GET['_wpnonce'] ) ) { //phpcs:ignore
			wp_safe_redirect( $redirect_url );
			exit;
		}

		if ( ! wp_verify_nonce( $_GET[ '_wpnonce' ], 'weglot_save_settings' ) ) { //phpcs:ignore
			wp_safe_redirect( $redirect_url );
			exit;
		}

		$tab = $_GET[ 'tab' ]; //phpcs:ignore
		$options = $_POST[ WEGLOT_SLUG ]; //phpcs:ignore

		// SAVE USER VERSION OF PLUGIN INTO SETTINGS.
		$options['custom_settings']['wp_user_version'] = WEGLOT_VERSION;
		$options_bdd = $this->option_services->get_options_bdd_v3();

		switch ( $tab ) {
			case Helper_Tabs_Admin_Weglot::SETTINGS:
				$has_first_settings = $this->option_services->get_has_first_settings();
				$options            = $this->sanitize_options_settings( $options, $has_first_settings );
				$response           = $this->option_services->save_options_to_weglot( $options );

				if ( $response['success'] && is_array( $response['result'] ) ) {
					delete_transient( 'weglot_cache_cdn' );

					$api_key_private = $this->option_services->get_api_key_private();

					$option_v2 = $this->option_services->get_options_from_v2();
					if ( ! $api_key_private && $option_v2 ) {
						$options_bdd['custom_urls']             = $option_v2['custom_urls'];
						$options_bdd['menu_switcher']           = $option_v2['menu_switcher'];
						$options_bdd['has_first_settings']      = $option_v2['has_first_settings'];
						$options_bdd['show_box_first_settings'] = $option_v2['show_box_first_settings'];
					}

					if ( $has_first_settings ) {
						$options_bdd['has_first_settings']      = false;
						$options_bdd['show_box_first_settings'] = true;
					}

					if ( array_key_exists( 'flag_css', $options ) ) {
						$options_bdd['flag_css'] = $options['flag_css'];
					}

					$this->option_services->set_options( $options_bdd );

					update_option( sprintf( '%s-%s', WEGLOT_SLUG, 'api_key_private' ), $options['api_key_private'] );
					update_option( sprintf( '%s-%s', WEGLOT_SLUG, 'api_key' ), $response['result']['api_key'] );

					// get menu options.
					$options_menu = $this->option_services->get_option( 'menu_switcher' );
					if ( is_array( $options_menu ) ) {
						if ( ! empty( $options_menu ) ) {
							foreach ( $options_menu as $key => $menu ) {
								// Ensure $menu is an array before modifying
								if ( is_array( $menu ) ) {
									if ( $options['custom_settings']['button_style']['is_dropdown'] ) {
										$options_menu[ $key ]['dropdown'] = 1;
									} else {
										$options_menu[ $key ]['dropdown'] = 0;
									}
								}
							}
						}
					}

					delete_transient( 'weglot_cache_cdn' );
					$this->option_services->set_option_by_key( 'menu_switcher', $options_menu );
				}
				break;
			case Helper_Tabs_Admin_Weglot::SUPPORT:
				if ( array_key_exists( 'active_wc_reload', $options ) && 'on' === $options['active_wc_reload'] ) {
					$options_bdd['active_wc_reload'] = true;
				} else {
					$options_bdd['active_wc_reload'] = false;
				}

				$this->option_services->set_options( $options_bdd );
				break;
		}

		wp_redirect( $redirect_url ); //phpcs:ignore
		exit;
	}


	/**
	 * @since 2.0
	 * @version 2.0.6
	 * @param array<string|int,mixed> $options
	 * @param mixed $has_first_settings
	 * @return array<string|int,mixed>
	 */
	public function sanitize_options_settings( $options, $has_first_settings = false ) {
		$user_info = $this->user_api_services->get_user_info( $options['api_key_private'] );
		$switchers = $this->option_services->get_switchers_editor_button();

		// Limit language.
		$limit = 30;
		if ( isset( $user_info['languages_limit'] ) ) {
			$limit = $user_info['languages_limit'];
		}
		$options['languages'] = array_splice( $options['languages'], 0, $limit );

		$default_options = $this->option_services->get_options_default();

		$options['custom_settings']['button_style']['is_dropdown'] = isset( $options['custom_settings']['button_style']['is_dropdown'] );
		$options['custom_settings']['button_style']['with_flags']  = isset( $options['custom_settings']['button_style']['with_flags'] );
		$options['custom_settings']['button_style']['full_name']   = isset( $options['custom_settings']['button_style']['full_name'] );
		$options['custom_settings']['button_style']['with_name']   = isset( $options['custom_settings']['button_style']['with_name'] );

		if ( $has_first_settings ) {
			$options['custom_settings']['button_style']['is_dropdown'] = $default_options['custom_settings']['button_style']['is_dropdown'];
			$options['custom_settings']['button_style']['with_flags']  = $default_options['custom_settings']['button_style']['with_flags'];
			$options['custom_settings']['button_style']['full_name']   = $default_options['custom_settings']['button_style']['full_name'];
			$options['custom_settings']['button_style']['with_name']   = $default_options['custom_settings']['button_style']['with_name'];
		}

		// Prioritize custom_css from options : custom_css, fallback to button_style : custom_css if needed
		if (!empty($options['custom_css'])) {
			$options['custom_settings']['button_style']['custom_css'] = stripcslashes($options['custom_css']);
		}
		elseif (!isset($options['custom_css']) && !empty($options['custom_settings']['button_style']['custom_css'])) {
			$options['custom_css'] = stripcslashes($options['custom_settings']['button_style']['custom_css']);
		}
		else {
			$options['custom_settings']['button_style']['custom_css'] = isset($options['custom_settings']['button_style']['custom_css']) ? stripcslashes($options['custom_settings']['button_style']['custom_css']) : '';
		}

		$options['custom_settings']['button_style']['flag_type'] = isset( $options['custom_settings']['button_style']['flag_type'] ) ? $options['custom_settings']['button_style']['flag_type'] : Helper_Flag_Type::RECTANGLE_MAT;

		$options['custom_settings']['translate_email']  = isset( $options['custom_settings']['translate_email'] );
		$options['custom_settings']['translate_search'] = isset( $options['custom_settings']['translate_search'] );
		$options['custom_settings']['translate_amp']    = isset( $options['custom_settings']['translate_amp'] );
		$options['custom_settings']['wp_user_version']  = $options['custom_settings']['wp_user_version'] ?? '';

		if(WEGLOT_WOOCOMMERCE){
			$options['custom_settings']['woocommerce_integration'] = true;
		}

		$options['auto_switch'] = isset( $options['auto_switch'] );

		// Ensure options:custom_settings:switchers is set correctly
		$options['custom_settings']['switchers'] = !empty($switchers) ? $switchers : [];

		// Ensure $options['switchers'] is also updated if it's empty but custom_settings['switchers'] is not
		if (empty($options['switchers']) && !empty($options['custom_settings']['switchers'])) {
			$options['switchers'] = $options['custom_settings']['switchers'];
		}

		return $options;
	}
}
