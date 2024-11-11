<?php
/**
 * BuilderPress Slide Image Box config class
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

if ( ! class_exists( 'BuilderPress_Config_Slide_Image_Box' ) ) {
	/**
	 * Class BuilderPress_Config_Slide_Image_Box
	 */
	class BuilderPress_Config_Slide_Image_Box extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_Slide_Image_Box constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'slide-image-box';
			$this->name = __( 'Slide Image Box', 'builderpress' );
			$this->desc = __( 'Display slide-image-box', 'builderpress' );

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
//                $this->_icon_options(),
			    array(
                    array(
                        'type'       => 'radio_image',
                        'heading'    => __( 'Layout', 'builderpress' ),
                        'param_name' => 'layout',
                        'options'    => array(
                            'default'              => $this->assets_url . 'images/layout/default.jpg',
                            'marketing-layout-1'   => $this->assets_url . 'images/layout/marketing-layout-1.jpg',
                        ),
                        'std'        => 'default'
                    ),

                    array(
                        'type'        => 'vc_link',
                        'heading'     => esc_html__( 'Link', 'builderpress' ),
                        'param_name'  => 'image_box_link',
                        'dependency' => array(
                            'element' => 'layout',
                            'value'   => array(
                                'marketing-layout-1'
                            ),
                        ),
                    ),

                    array(
                        'type'             => 'dropdown',
                        'heading'          => __( 'Style', 'builderpress' ),
                        'param_name'       => 'style',
                        'value'            => array(
                            __( 'Container', 'builderpress' )  => '',
                            __( 'Full width', 'builderpress' ) => 'style-full-width',
                        ),
                        'std'              => '',
                        'dependency'  => array(
                            'element' => 'layout',
                            'value'   => array(
                                'marketing-layout-1'
                            )
                        ),
                        'edit_field_class' => 'vc_col-sm-6',
                    ),

                    array(
                        'type'       => 'param_group',
                        'value'      => '',
                        'heading'    => __( 'Slide Image Box', 'builderpress' ),
                        'param_name' => 'slide_image_box',
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
                              //  'std'        => __( 'This is sub title', 'builderpress' )
                            ),

                            array(
                                'type'       => 'textarea',
                                'heading'    => __( 'Description', 'builderpress' ),
                                'param_name' => 'description',
                              //  'std'        => __( 'This is description', 'builderpress' )
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

                            array(
                                'type'             => 'attach_image',
                                'heading'          => __( 'Symbol Image', 'builderpress' ),
                                'param_name'       => 'symbol_image',
                                'edit_field_class' => 'vc_col-sm-6'
                            ),
                        )
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
                )
            );
		}

		/**
		 * @return array|mixed
		 */
		public function get_styles() {
			return array(
				'slide-image-box' => array(
					'src' => 'slide-image-box.css'
				)
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'slide-image-box' => array(
					'src'  => 'slide-image-box.js',
					'deps' => array(
						'jquery'
					)
				)
			);
		}
	}
}
