<?php
/**
 * BuilderPress Login Form config class
 *
 * @version     1.0.0
 * @author      ThimPress
 * @package     BuilderPress/Classes
 * @category    Classes
 * @author      Thimpress, leehld
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'BuilderPress_Config_Login_Form' ) ) {
	/**
	 * Class BuilderPress_Config_Login_Form
	 */
	class BuilderPress_Config_Login_Form extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_Login_Form constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'login-form';
			$this->name = __( 'Login Form', 'builderpress' );
			$this->desc = __( 'Display login-form', 'builderpress' );

			parent::__construct();
		}

		/**
		 * @return array
		 */
		public function get_options() {
			static $options;
			if ( ! is_null( $options ) ) {
				return $options;
			}

			// options
			return $options = array(
                array(
                    'type'             => 'dropdown',
                    'heading'          => __( 'Style Layout', 'builderpress' ),
                    'param_name'       => 'style_layout',
                    'value'            => array(
                        __( 'Style Default', 'builderpress' )   => '',
                    ),
                    'std'              => '',
                    'edit_field_class' => 'vc_col-sm-6'
                ),
                array(
                    'type' => 'css_editor',
                    'heading' => __( 'CSS Shortcode', 'js_composer' ),
                    'param_name' => 'bp_css',
                    'group' => __( 'Design Options', 'js_composer' ),
                ),
            );
		}

		/**
		 * @return array|mixed
		 */
		public function get_styles() {
			return array(
				'login-form' => array(
					'src' => 'login-form.css'
				)
			);
		}


		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'login-form' => array(
					'src'  => 'login-form.js',
					'deps' => array(
						'jquery'
					)
				)
			);
		}
	}
}

/**
 * Filter lost password link
 *
 * @param $url
 *
 * @return string
 */
if ( ! function_exists( 'thim_get_lost_password_url' ) ) {
	function thim_get_lost_password_url() {
		$url = add_query_arg( 'action', 'lostpassword', bp_get_login_page_url() );

		return $url;
	}
}

/**
 * Filter register link
 *
 * @param $register_url
 *
 * @return string|void
 */
if ( ! function_exists( 'thim_get_register_url' ) ) {
	function thim_get_register_url( $redirect_url = '' ) {
		$url = add_query_arg( 'action', 'register', bp_get_login_page_url( $redirect_url ) );

		return $url;
	}
}

/**
 * Redirect to custom login page
 */
if ( ! function_exists( 'thim_login_failed' ) ) {
	function thim_login_failed() {
		if ( ( isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'thim_login_ajax' ) || ( isset( $_REQUEST['lp-ajax'] ) && $_REQUEST['lp-ajax'] == 'login' ) || ( is_admin() && defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
			return;
		}

		wp_redirect( add_query_arg( 'result', 'failed', bp_get_login_page_url() ) );
		exit;
	}

	add_action( 'wp_login_failed', 'thim_login_failed', 1000 );
}
