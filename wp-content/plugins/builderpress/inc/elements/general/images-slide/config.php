<?php
/**
 * BuilderPress Images-slide config class
 *
 * @version     1.0.0
 * @author      ThimPress
 * @package     BuilderPress/Classes
 * @category    Classes
 * @author      Thimpress, vinhnq
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'BuilderPress_Config_Images_slide' ) ) {
	/**
	 * Class BuilderPress_Config_Images_slide
	 */
	class BuilderPress_Config_Images_slide extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_Images_slide constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'images-slide';
			$this->name = __( 'Images slide', 'builderpress' );
			$this->desc = __( 'Display images slide', 'builderpress' );

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
                        'coach-life-layout-1'   => $this->assets_url . 'images/layouts/coach-life-layout-1.jpg',
                    ),
					'std'         => 'coach-life-layout-1',
                    'description' => __( 'Select type of style.', 'builderpress' )
                ),
                array(
                    'type'       => 'param_group',
                    'heading'    => __( 'Images Slide', 'builderpress' ),
                    'param_name' => 'items',
                    'params'     => array(
                        array(
                            'type'       => 'attach_image',
                            'heading'    => esc_html__( 'Image', 'builderpress' ),
                            'param_name' => 'img'
                        ),
                    ),
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
                    'heading' => __( 'CSS on Tablet', 'js_composer' ),
                    'param_name' => 'bp_css_tablet',
                    'group' => __( 'Design Options', 'js_composer' ),
                ),

                array(
                    'type' => 'css_editor',
                    'heading' => __( 'CSS on Mobile', 'js_composer' ),
                    'param_name' => 'bp_css_mobile',
                    'group' => __( 'Design Options', 'js_composer' ),
                ),
            );
		}

		/**
		 * @return array|mixed
		 */
		public function get_styles() {
			return array(
				'images-slide' => array(
					'src' => 'images-slide.css'
				)
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'images-slide' => array(
					'src'  => 'images-slide.js',
					'deps' => array(
						'jquery'
					)
				)
			);
		}
	}
}
