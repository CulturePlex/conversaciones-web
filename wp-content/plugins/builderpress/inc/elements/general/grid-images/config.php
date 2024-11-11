<?php
/**
 * BuilderPress Grid Images config class
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

if ( ! class_exists( 'BuilderPress_Config_Grid_Images' ) ) {
	/**
	 * Class BuilderPress_Config_Grid_Images
	 */
	class BuilderPress_Config_Grid_Images extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_Grid_Images constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'grid-images';
			$this->name = __( 'Grid Images', 'builderpress' );
			$this->desc = __( 'Display grid images', 'builderpress' );

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
                    'type'       => 'radio_image',
                    'heading'    => __( 'Layout', 'builderpress' ),
                    'param_name' => 'layout',
                    'options'    => array(
                        'layout-1'                      => $this->assets_url . 'images/layouts/layout-grid.jpg',
                        'layout-images-slider'          => $this->assets_url . 'images/layouts/layout-slider.jpg',
                        'layout-2'                      => $this->assets_url . 'images/layouts/layout-2.png',
                        'coach-life-layout-isotope-1'   => $this->assets_url . 'images/layouts/coach-life-layout-isotope-1.png',
                    ),
                    'std'        => 'layout-1'
                ),

                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Title', 'builderpress' ),
                    'param_name' => 'grid_title',
                    'dependency'  => array(
                        'element' => 'layout',
                        'value'   => array(
                            'coach-life-layout-isotope-1'
                        )
                    ),
                   // 'std'         => __( 'This is title', 'builderpress' ),
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Sub Title', 'builderpress' ),
                    'param_name' => 'grid_sub_title',
                    'dependency'  => array(
                        'element' => 'layout',
                        'value'   => array(
                            'coach-life-layout-isotope-1'
                        )
                    ),
                    //'std'        => __( 'This is sub title', 'builderpress' ),
                ),
                array(
                    'type'       => 'textarea',
                    'heading'    => __( 'Description', 'builderpress' ),
                    'param_name' => 'grid_img_content',
                    'dependency'  => array(
                        'element' => 'layout',
                        'value'   => array(
                            'coach-life-layout-isotope-1'
                        )
                    ),
//                    'std'        => __( 'This is description', 'builderpress' ),
                ),
                array(
                    'type'       => 'vc_link',
                    'heading'    => esc_attr__( 'Link', 'builderpress' ),
                    'param_name' => 'box_link',
                    'dependency'  => array(
                        'element' => 'layout',
                        'value'   => array(
                            'coach-life-layout-isotope-1'
                        )
                    ),
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Text Link', 'builderpress' ),
                    'param_name' => 'text_link',
                    'dependency'  => array(
                        'element' => 'layout',
                        'value'   => array(
                            'coach-life-layout-isotope-1'
                        )
                    ),
                    'std'        => __( 'Join Now', 'builderpress' ),
                ),


				array(
					'type'       => 'param_group',
					'heading'    => __( 'Images', 'builderpress' ),
					'param_name' => 'images',
					'params'     => array(
						array(
							'type'             => 'attach_image',
							'heading'          => esc_html__( 'Image', 'builderpress' ),
							'param_name'       => 'img',
							'edit_field_class' => 'vc_col-xs-6'
						),
						array(
							'type'             => 'dropdown',
							'heading'          => esc_html__( 'Size', 'builderpress' ),
							'param_name'       => 'size',
							'value'            => array(
								esc_html__( '1x1', 'builderpress' ) => '1x1',
								esc_html__( '2x2', 'builderpress' ) => '2x2',
								esc_html__( '3x2', 'builderpress' ) => '3x2'
							),
							'std'              => '1x1',
							'edit_field_class' => 'vc_col-xs-6'
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__( 'Title', 'builderpress' ),
							'param_name' => 'title',
                          //  'std'        => __( 'This is title', 'builderpress' ),
						),
                        array(
                            'type'       => 'textfield',
                            'heading'    => esc_html__( 'Sub Title', 'builderpress' ),
                            'param_name' => 'sub_title',
                           // 'std'        => __( 'This is sub title', 'builderpress' ),
                        ),
					)
				),
                array(
                    'type'       => 'number',
                    'heading'    => __( 'Space', 'builderpress' ),
                    'param_name' => 'space',
                    'std'        => 0
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
				'grid-images' => array(
					'src' => 'grid-images.css'
				)
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'grid-images' => array(
					'src' => 'grid-images.js',
                    'deps' => array(
                        'jquery',
                        'builder-press-isotope',
                        'builder-press-magnific-popup'
                    ),
					'deps_src' => array(
						'builder-press-isotope' => BUILDER_PRESS_URL . 'assets/libs/isotope/isotope.pkgd.min.js',
						'builder-press-magnific-popup' => BUILDER_PRESS_URL . 'assets/libs/magnific-popup/jquery.magnific-popup.min.js'
					)
				)
			);
		}
	}
}
