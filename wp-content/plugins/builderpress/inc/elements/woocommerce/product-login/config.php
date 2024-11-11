<?php
/**
 * BuilderPress Product-login config class
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

if ( ! class_exists( 'BuilderPress_Config_Product_Login' ) ) {
	/**
	 * Class BuilderPress_Config_Product-login
	 */
	class BuilderPress_Config_Product_Login extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_Product-login constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'product-login';
			$this->name = __( 'Product Login', 'builderpress' );
			$this->desc = __( 'Display product login', 'builderpress' );

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
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Layout', 'builderpress' ),
                    'param_name'  => 'layout',
                    'save_always' => true,
                    'value'       => array(
                        esc_html__( 'Layout 1', 'builderpress' )    => 'layout-1',
                    ),

                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => __( 'Login Label', 'builderpress' ),
                    'param_name'  => 'text_login',
                    'admin_label' => true
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => __( 'Logout Label', 'builderpress' ),
                    'param_name'  => 'text_logout',
                    'admin_label' => true
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

                array(
                    'type' => 'css_editor',
                    'heading' => __( 'CSS Shortcode', 'js_composer' ),
                    'param_name' => 'at_css',
                    'group' => __( 'Design Options', 'js_composer' ),
                ),

                array(
                    'type' => 'css_editor',
                    'heading' => __( 'CSS Shortcode', 'js_composer' ),
                    'param_name' => 'bp_css',
                    'group' => __( 'Design Options', 'js_composer' ),
                )
            );
		}

		/**
		 * @return array|mixed
		 */
		public function get_styles() {
			return array(
				'product-login' => array(
					'src' => 'product-login.css'
				)
			);
		}

	}
}
