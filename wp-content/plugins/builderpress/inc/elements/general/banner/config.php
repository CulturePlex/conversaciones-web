<?php
/**
 * BuilderPress Banner config class
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

if ( ! class_exists( 'BuilderPress_Config_Banner' ) ) {
	/**
	 * Class BuilderPress_Config_Banner
	 */
	class BuilderPress_Config_Banner extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_Banner constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'banner';
			$this->name = __( 'Banner', 'builderpress' );
			$this->desc = __( 'Display banner', 'builderpress' );

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
                        'coach-life-layout-1'   => $this->assets_url . 'images/layouts/coach-life-layout-1.png',
                        'coach-life-layout-2'   => $this->assets_url . 'images/layouts/coach-life-layout-2.png',
                        'coach-life-layout-3'   => $this->assets_url . 'images/layouts/coach-life-layout-3.png',
                    ),
                    'std'         => 'coach-life-layout-1',
                    'description' => __( 'Select type of style.', 'builderpress' )
                ),
                array(
                    'type'             => 'attach_image',
                    'heading'          => __( 'Main Image', 'builderpress' ),
                    'param_name'       => 'main_image',
                    'edit_field_class' => 'vc_col-sm-6'
                ),

                array(
                    'type'             => 'attach_image',
                    'heading'          => __( 'Background Image', 'builderpress' ),
                    'param_name'       => 'background_image',
                    'edit_field_class' => 'vc_col-sm-6',
                    'dependency' => array(
                        'element' => 'layout',
                        'value'   => array(
                            'coach-life-layout-1',
                        ),
                    ),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => __( 'Title', 'builderpress' ),
                    'param_name'  => 'title',
                    //'std'        => __( 'This is title', 'builderpress' )
                ),
                array(
                    'type'       => 'textarea',
                    'heading'    => __( 'Description', 'builderpress' ),
                    'param_name' => 'description',
                   // 'std'        => __( 'This is description', 'builderpress' )
                ),
                array(
                    'type'       => 'vc_link',
                    'heading'    => esc_html__( 'Button', 'builderpress' ),
                    'param_name' => 'link_button',
                ),
                array(
                    'type'       => 'vc_link',
                    'heading'    => esc_html__( 'Link Video', 'builderpress' ),
                    'param_name' => 'link_video_button'
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
				'banner' => array(
					'src' => 'banner.css'
				)
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'banner' => array(
					'src'  => 'banner.js',
					'deps' => array(
						'jquery'
					)
				)
			);
		}
	}
}
