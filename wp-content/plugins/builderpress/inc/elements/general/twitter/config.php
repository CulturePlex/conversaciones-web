<?php
/**
 * BuilderPress Twitter config class
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

if ( ! class_exists( 'BuilderPress_Config_Twitter' ) ) {
	/**
	 * Class BuilderPress_Config_Twitter
	 */
	class BuilderPress_Config_Twitter extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_Twitter constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'twitter';
			$this->name = __( 'Twitter', 'builderpress' );
			$this->desc = __( 'Display list tweets', 'builderpress' );

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
					'type'        => 'radio_image',
					'heading'     => __( 'Layout', 'builderpress' ),
					'param_name'  => 'layout',
					'options'     => array(
						'layout-list'   => $this->assets_url . 'images/layouts/layout-list.jpg',
						'layout-slider' => $this->assets_url . 'images/layouts/layout-slider.jpg'
					),
					'std'         => 'layout-list',
					'description' => __( 'Select type of style.', 'builderpress' )
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Title', 'builderpress' ),
					'param_name'  => 'title',
					//'std'         => __( 'This is title', 'builderpress' ),
					'admin_label' => true
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Username', 'builderpress' ),
					'param_name'  => 'username',
					'admin_label' => true
				),
				array(
					'type'        => 'number',
					'heading'     => esc_html__( 'Number tweets', 'builderpress' ),
					'param_name'  => 'number',
					'std'         => '2',
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
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_styles() {
			return array(
				'twitter' => array(
					'src' => 'twitter.css'
				)
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'twitter' => array(
					'src'  => 'twitter.js',
					'deps' => array(
						'jquery',
						'builder-press-slick'
					)
				)
			);
		}
	}
}
