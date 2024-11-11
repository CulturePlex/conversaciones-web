<?php
/**
 * BuilderPress Pricing Table config class
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

if ( ! class_exists( 'BuilderPress_Config_Pricing_Table' ) ) {
	/**
	 * Class BuilderPress_Config_Pricing_Table
	 */
	class BuilderPress_Config_Pricing_Table extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_Pricing_Table constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'pricing-table';
			$this->name = __( 'Pricing Table', 'builderpress' );
			$this->desc = __( 'Display pricing table.', 'builderpress' );

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
                        'layout-1'   => $this->assets_url . 'images/layouts/layout-1.png',
                        'layout-2'   => $this->assets_url . 'images/layouts/layout-2.png',
                        'layout-3'   => $this->assets_url . 'images/layouts/layout-3.png',
                        'marketing-layout-1'   => $this->assets_url . 'images/layouts/marketing-layout-1.jpg',
                    ),
                    'std'         => 'layout-1',
                    'description' => __( 'Select type of style.', 'builderpress' )
                ),
				array(
					'type'       => 'param_group',
					'value'      => '',
					'heading'    => __( 'Packages', 'builderpress' ),
					'param_name' => 'packages',
					'params'     => array(

						array(
							'type'       => 'textfield',
							'heading'    => __( 'Title', 'builderpress' ),
							'param_name' => 'name',
							'std'        => __( 'Standard', 'builderpress' )
						),
                        array(
                            'type'       => 'textfield',
                            'heading'    => __( 'SubTitle', 'builderpress' ),
                            'param_name' => 'sub_title',
                        ),

						array(
							'type'       => 'textfield',
							'heading'    => __( 'Description', 'builderpress' ),
							'param_name' => 'description',
							'std'        => __( 'Price standard package', 'builderpress' )
						),

						array(
							'type'             => 'textfield',
							'heading'          => __( 'Price', 'builderpress' ),
							'param_name'       => 'price',
							'edit_field_class' => 'vc_col-sm-6',
							'std'              => 50
						),

						array(
							'type'             => 'textfield',
							'heading'          => __( 'Original Price', 'builderpress' ),
							'param_name'       => 'original_price',
							'edit_field_class' => 'vc_col-sm-6'
						),

						array(
							'type'       => 'textfield',
							'heading'    => __( 'Unit', 'builderpress' ),
							'param_name' => 'unit',
							'std'        => 'mo'
						),

						array(
							'type'       => 'vc_link',
							'heading'    => __( 'Link', 'builderpress' ),
							'param_name' => 'link'
						),

						array(
							'type'             => 'attach_image',
							'heading'          => __( 'Image', 'builderpress' ),
							'param_name'       => 'image',
							'edit_field_class' => 'vc_col-sm-6',

						),

                        array(
                            'type'             => 'colorpicker',
                            'heading'          => __( 'Background', 'builderpress' ),
                            'param_name'       => 'background_color',
                            'edit_field_class' => 'vc_col-sm-6'
                        ),

						array(
							'type'             => 'checkbox',
							'heading'          => __( 'Featured', 'builderpress' ),
							'param_name'       => 'featured',
							'description'      => __( 'Set package as featured.', 'builderpress' ),
							'edit_field_class' => 'vc_col-sm-6',
							'std'              => false
						),
						array(
							'type'       => 'param_group',
							'value'      => '',
							'heading'    => __( 'Features', 'builderpress' ),
							'param_name' => 'features',
							'max_el_items' => 10,
							'params'     => array(
								array(
									'type'       => 'textfield',
									'heading'    => __( 'Name', 'builderpress' ),
									'param_name' => 'title',
									'std'        => __( 'Free setup', 'builderpress' )
								),
                                array(
                                    'type'             => 'checkbox',
                                    'heading'          => esc_html__( 'Show icon', 'builderpress' ),
                                    'description'      => __( 'Display icon Features', 'builderpress' ),
                                    'param_name'       => 'show_icon_features',
                                    'std'              => false,
                                )
							)
						)
					)
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Number columns', 'builderpress' ),
					'param_name' => 'number_columns',
					'value'      => array(
						'1' => 1,
						'3' => 3,
						'4' => 4,
						'6' => 6,
					),
					'std'        => 3,
                    'edit_field_class' => 'vc_col-sm-6'
				),
                array(
                    'type'             => 'dropdown',
                    'admin_label'      => false,
                    'heading'          => esc_html__( 'Background color style', 'builderpress' ),
                    'param_name'       => 'background_color',
                    'description'      => __( 'Position of icon relative to content.', 'builderpress' ),
                    'value'            => array(
                        esc_html__('Default', 'builderpress')  => 'background-default',
                        esc_html__( 'Gradient', 'builderpress' )    => 'background-gradient',
                    ),
                    'dependency' => array(
                        'element' => 'layout',
                        'value'   => array(
                            'layout-2',
                        )
                    ),
                    'std'              => 'background-default',
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
				'pricing-table' => array(
					'src'  => 'pricing-table.css',
				)
			);
		}
	}
}
