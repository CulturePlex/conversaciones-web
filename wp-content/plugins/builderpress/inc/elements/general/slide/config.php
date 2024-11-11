<?php
/**
 * BuilderPress Slide config class
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

if ( ! class_exists( 'BuilderPress_Config_Slide' ) ) {
	/**
	 * Class BuilderPress_Config_Slide_Image_Box
	 */
	class BuilderPress_Config_Slide extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_Slide constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'slide';
			$this->name = __( 'Slide', 'builderpress' );
			$this->desc = __( 'Display slide', 'builderpress' );

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
			return $options = array_merge(
			    array(
                    array(
                        'type'       => 'radio_image',
                        'heading'    => __( 'Layout', 'builderpress' ),
                        'param_name' => 'layout',
                        'options'    => array(
                            'marketing-layout-1' => $this->assets_url . 'images/layout/marketing-layout-1.png',
                        ),
                        'std'        => 'marketing-layout-1'
                    ),


                    array(
                        'type'             => 'dropdown',
                        'heading'          => __( 'Style Layout', 'builderpress' ),
                        'param_name'       => 'style_layout',
                        'value'            => array(
                            __( 'Style Default', 'builderpress' )   => '',
                            __( 'Style 1', 'builderpress' ) => 'style-1',
                            __( 'Style 2', 'builderpress' ) => 'style-2',
                        ),
                        'std'              => '',
                    ),

                    array(
                        'type'             => 'checkbox',
                        'heading'          => esc_html__( 'Show Button', 'builderpress' ),
                        'param_name'       => 'show_button',
                        'std'              => false,
                        'admin_label'      => true,
                        'edit_field_class' => 'vc_col-xs-6'
                    ),

                    array(
                        'type'       => 'vc_link',
                        'heading'    => esc_html__( 'Button', 'builderpress' ),
                        'param_name' => 'link_button'
                    ),

                    array(
                        'type'       => 'param_group',
                        'value'      => '',
                        'heading'    => __( 'Slide Image', 'builderpress' ),
                        'param_name' => 'slide_image',
                        'params'     => array(
                            array(
                                'type'       => 'textfield',
                                'heading'    => __( 'Title', 'builderpress' ),
                                'param_name' => 'title',
                               // 'std'        => __( 'This is title', 'builderpress' )
                            ),
                            array(
                                'type'       => 'textfield',
                                'heading'    => __( 'Sub Title', 'builderpress' ),
                                'param_name' => 'sub_title',
                                //'std'        => __( 'This is sub title', 'builderpress' )
                            ),

                            array(
                                'type'       => 'textarea',
                                'heading'    => __( 'Description', 'builderpress' ),
                                'param_name' => 'description',
                               // 'std'        => __( 'This is description', 'builderpress' )
                            ),
                            array(
                                'type'             => 'dropdown',
                                'heading'          => __( 'Style Button', 'builderpress' ),
                                'param_name'       => 'style',
                                'value'            => array(
                                    __( 'Normal', 'builderpress' )   => '',
                                    __( 'Gradient', 'builderpress' ) => 'style-gradient',
                                ),
                                'std'              => '',
                            ),
                            array(
                                'type'       => 'vc_link',
                                'heading'    => esc_html__( 'Link', 'builderpress' ),
                                'param_name' => 'link'
                            ),
                            array(
                                'type'             => 'attach_image',
                                'heading'          => __( 'Main Image', 'builderpress' ),
                                'param_name'       => 'main_image',
                                'edit_field_class' => 'vc_col-sm-6'
                            ),
                        )
                    ),

                    array(
                        'type'             => 'checkbox',
                        'heading'          => esc_html__( 'Hidden Dot', 'builderpress' ),
                        'param_name'       => 'hidden_dot',
                        'std'              => false,
                        'admin_label'      => true,
                        'edit_field_class' => 'vc_col-xs-6'
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
                )
            );
		}

		/**
		 * @return array|mixed
		 */
		public function get_styles() {
			return array(
				'slide' => array(
					'src' => 'slide.css'
				)
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'slide' => array(
					'src'  => 'slide.js',
					'deps' => array(
						'jquery'
					)
				)
			);
		}
	}
}
