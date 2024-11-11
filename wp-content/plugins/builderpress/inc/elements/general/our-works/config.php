<?php
/**
 * BuilderPress Our Works config class
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

if ( ! class_exists( 'BuilderPress_Config_Our_Works' ) ) {
	/**
	 * Class BuilderPress_Config_Our_Works
	 */
	class BuilderPress_Config_Our_Works extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_Our_Works constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'our-works';
			$this->name = __( 'Our Works', 'builderpress' );
			$this->desc = __( 'Display a Our works', 'builderpress' );

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
						'layout-1' => $this->assets_url . 'images/layouts/layout-1.jpg',
						'layout-2' => $this->assets_url . 'images/layouts/layout-2.jpg'
					),
					'std'         => 'layout-1',
					'description' => __( 'Select type of style.', 'builderpress' )
				),
				array(
					'type'       => 'textfield',
					'heading'    => __( 'Title', 'builderpress' ),
					'param_name' => 'title',
					'std'        => __( 'Our Best Works', 'builderpress' )
				),
				array(
					'type'       => 'loop',
					'heading'    => __( 'Data', 'builderpress' ),
					'param_name' => 'data'
				),
				array(
					'type'       => 'vc_link',
					'heading'    => __( 'View All', 'builderpress' ),
					'param_name' => 'button'
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
                )
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_styles() {
			return array(
				'our-works' => array(
					'src'  => 'our-works.css',
					'deps' => array(
						'builder-press-slick'
					)
				)
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'our-works' => array(
					'src'  => 'our-works.js',
					'deps' => array(
						'jquery',
						'builder-press-isotope',
						'builder-press-slick',
						'imagesloaded'
					)
				)
			);
		}
	}
}
