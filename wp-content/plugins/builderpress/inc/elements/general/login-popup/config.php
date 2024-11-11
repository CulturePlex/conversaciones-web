<?php
/**
 * BuilderPress Login Popup config class
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

if ( ! class_exists( 'BuilderPress_Config_Login_Popup' ) ) {
	/**
	 * Class BuilderPress_Config_Login_Popup
	 */
	class BuilderPress_Config_Login_Popup extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_Login_Popup constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'login-popup';
			$this->name = __( 'Login Popup', 'builderpress' );
			$this->desc = __( 'Display a Login button with popup form', 'builderpress' );

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

			    // Layout
                array(
                    'type'       => 'radio_image',
                    'heading'    => __( 'Layout', 'builderpress' ),
                    'param_name' => 'layout',
                    'options'    => array(
                        'layout-1' => $this->assets_url . 'images/layouts/layout-1.jpg',
                        'layout-2' => $this->assets_url . 'images/layouts/layout-2.jpg',
                        'layout-3' => $this->assets_url . 'images/layouts/layout-3.png'
                    ),
                    'std'        => 'layout-1'
                ),
				//  Login text
				array(
					'type'        => 'textfield',
					'admin_label' => true,
					'heading'     => esc_html__( 'Login Label', 'builderpress' ),
					'param_name'  => 'text_login',
					'std'         => esc_html__( 'Login', 'builderpress' ),
				),

				//  Login text
				array(
					'type'        => 'textfield',
					'admin_label' => true,
					'heading'     => esc_html__( 'Register Label', 'builderpress' ),
					'param_name'  => 'text_register',
					'std'         => esc_html__( 'Register', 'builderpress' ),
				),

				//  Logout text
				array(
					'type'        => 'textfield',
					'admin_label' => true,
					'heading'     => esc_html__( 'Logout Label', 'builderpress' ),
					'param_name'  => 'text_logout',
					'std'         => esc_html__( 'Account', 'builderpress' ),
				),

				// Color Label
				array(
					'type'             => 'colorpicker',
					'heading'          => __( 'Color Label', 'builderpress' ),
					'param_name'       => 'color_label',
					'std'              => '',
				),

                // Have user menu?
                array(
                    'type'             => 'checkbox',
                    'heading'          => esc_html__( 'User Menu', 'builderpress' ),
                    'param_name'       => 'user_menu',
                    'std'              => false,
                    'edit_field_class' => 'vc_col-sm-6'
                ),

                // Have icon?
                array(
                    'type'             => 'checkbox',
                    'heading'          => esc_html__( 'Show icon?', 'builderpress' ),
                    'param_name'       => 'show_icon',
                    'std'              => false,
                    'edit_field_class' => 'vc_col-sm-6'
                ),

				//  Shortcode text
				array(
					'type'             => 'textfield',
					'admin_label'      => true,
					'heading'          => esc_html__( 'Shortcode', 'builderpress' ),
					'param_name'       => 'shortcode',
					'description'      => __( 'Shortcode want to embed into popup.', 'builderpress' ),
					'edit_field_class' => 'vc_col-sm-6'
				),

				array(
					'type'             => 'attach_image',
					'heading'          => esc_html__( 'Popup Image', 'builderpress' ),
					'param_name'       => 'popup_image',
					'edit_field_class' => 'vc_col-sm-6'
				),

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
				'login-popup' => array(
					'src'  => 'login-popup.css',
					'deps' => array(
						'builder-press-magnific-popup'
					)
				)
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'login-popup' => array(
					'src'  => 'login-popup.js',
					'deps' => array(
						'jquery',
						'builder-press-magnific-popup'
					)
				)
			);
		}

		/**
		 * @return mixed
		 */
		public function get_localize() {
			return array(
				'login_popup_js' => array(
					'login'    => esc_html__( 'Email', 'builderpress' ),
					'password' => esc_html__( 'Password', 'builderpress' )
				)
			);
		}

	}
}
