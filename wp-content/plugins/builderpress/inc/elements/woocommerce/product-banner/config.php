<?php
/**
 * BuilderPress Product-banner config class
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

if ( ! class_exists( 'BuilderPress_Config_Product_Banner' ) ) {
	/**
	 * Class BuilderPress_Config_Product_Banner
	 */
	class BuilderPress_Config_Product_Banner extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_Product_Banner constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'product-banner';
			$this->name = __( 'Product Banner', 'builderpress' );
			$this->desc = __( 'Display product banner', 'builderpress' );

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
                        esc_html__( 'Layout 2', 'builderpress' )    => 'layout-2',
                        esc_html__( 'Layout 3', 'builderpress' )    => 'layout-3',
                        esc_html__( 'Layout 4', 'builderpress' )    => 'layout-4',
                    ),
                    'std'         => 'layout-1',
                    'edit_field_class' => 'vc_col-xs-6'
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
                            'type'       => 'vc_link',
                            'heading'    => __( 'Action', 'builderpress' ),
                            'param_name' => 'link'
                        ),
                    ),
                    'dependency' => array(
                        'element' => 'layout',
                        'value'   => array(
                            'layout-1',
                        ),
                    ),

                ),

                array(
                    'type'       => 'param_group',
                    'heading'    => __( 'Images', 'builderpress' ),
                    'param_name' => 'images-2',
                    'params'     => array(
                        array(
                            'type'             => 'attach_image',
                            'heading'          => esc_html__( 'Image', 'builderpress' ),
                            'param_name'       => 'img',
                            'edit_field_class' => 'vc_col-xs-6'
                        ),
                        array(
                            "type"             => "textfield",
                            "heading"          => esc_html__( "Banner Title", 'builderpress' ),
                            "param_name"       => "banner_title",
                            "admin_label"      => true,
                            'edit_field_class' => 'vc_col-xs-6',
                           // 'std'              => __( 'This is title', 'builderpress' ),
                        ),

                        array(
                            "type"             => "textfield",
                            "heading"          => esc_html__( "Flag Title", 'builderpress' ),
                            "param_name"       => "flag_title",
                            "admin_label"      => true,
                            'edit_field_class' => 'vc_col-xs-6',
                            'std'              => __( 'This is flag title', 'builderpress' ),
                        ),
                        array(
                            'type'       => 'textfield',
                            'heading'    => __( 'Price', 'builderpress' ),
                            'param_name' => 'flag_price',
                            'description'=> esc_html__( 'Custom price. Example: $30.00, 25%', 'builderpress' ),
                            'std'        => '$30.00',
                            'edit_field_class' => 'vc_col-xs-6',
                        ),
                        array(
                            'type'       => 'textfield',
                            'heading'    => __( 'Sale Price ', 'builderpress' ),
                            'param_name' => 'flag_price_sale',
                            'description'=> esc_html__( 'Custom price. Example: $10.00', 'builderpress' ),
                            'std'        => '',
                            'edit_field_class' => 'vc_col-xs-6',
                        ),
                        array(
                            'type'       => 'vc_link',
                            'heading'    => __( 'Action', 'builderpress' ),
                            'param_name' => 'link'
                        ),
                    ),
                    'dependency' => array(
                        'element' => 'layout',
                        'value'   => array(
                            'layout-2',
                        ),
                    ),

                ),

                array(
                    'type'       => 'param_group',
                    'heading'    => __( 'Images', 'builderpress' ),
                    'param_name' => 'images-3',
                    'params'     => array(
                        array(
                            'type'             => 'attach_image',
                            'heading'          => esc_html__( 'Image', 'builderpress' ),
                            'param_name'       => 'img',
                            'edit_field_class' => 'vc_col-xs-6'
                        ),
                        array(
                            "type"             => "textfield",
                            "heading"          => esc_html__( "Banner Title", 'builderpress' ),
                            "param_name"       => "title",
                            "admin_label"      => true,
                           // 'std'              => __( 'This is title', 'builderpress' ),
                        ),

                        array(
                            "type"             => "textarea",
                            "heading"          => esc_html__( "Banner Description", 'builderpress' ),
                            "param_name"       => "description",
                            "admin_label"      => true,
                            //'std'              => __( 'This is description', 'builderpress' ),
                        ),
                        array(
                            'type'       => 'textfield',
                            'heading'    => __( 'Price', 'builderpress' ),
                            'param_name' => 'price',
                            'description'=> esc_html__( 'Custom price. Example: $30.00', 'builderpress' ),
                            'std'        => '$30.00',
                            'edit_field_class' => 'vc_col-xs-6',
                        ),
                        array(
                            'type'       => 'textfield',
                            'heading'    => __( 'Sale Price ', 'builderpress' ),
                            'param_name' => 'price_sale',
                            'description'=> esc_html__( 'Custom price. Example: $19.99', 'builderpress' ),
                            'std'        => '$19.99',
                            'edit_field_class' => 'vc_col-xs-6',
                        ),
                        array(
                            'type'       => 'vc_link',
                            'heading'    => __( 'Action', 'builderpress' ),
                            'param_name' => 'link'
                        ),
                    ),
                    'dependency' => array(
                        'element' => 'layout',
                        'value'   => array(
                            'layout-3',
                        ),
                    ),

                ),

                array(
                    'type'             => 'number',
                    'heading'          => __( 'Height', 'builderpress' ),
                    'param_name'       => 'height',
                    'description'      => esc_html__( 'Custom height. Unit is pixel', 'builderpress' ),
                    'std'              => '717',
                    'edit_field_class' => 'vc_col-xs-6',
                    'dependency' => array(
                        'element' => 'layout',
                        'value'   => array(
                            'layout-1',
                            'layout-2',
                            'layout-3',
                        ),
                    ),
                ),

                array(
                    'type'             => 'checkbox',
                    'heading'          => esc_html__( 'Show background overlay', 'builderpress' ),
                    'param_name'       => 'overlay',
                    'std'              => true,
                    'admin_label'      => true,
                    'edit_field_class' => 'vc_col-xs-6',
                    'dependency' => array(
                        'element' => 'layout',
                        'value'   => array(
                            'layout-1',
                            'layout-2',
                            'layout-3',
                        ),
                    ),
                ),

                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Title top', 'builderpress' ),
                    'param_name' => 'bn_title_top',
                    'std'        => __( 'The Original', 'builderpress' ),
                    'dependency' => array(
                        'element' => 'layout',
                        'value'   => array(
                            'layout-4',
                        ),
                    ),
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Title large', 'builderpress' ),
                    'param_name' => 'bn_title_large',
                    'std'        => __( 'Chicken', 'builderpress' ),
                    'dependency' => array(
                        'element' => 'layout',
                        'value'   => array(
                            'layout-4',
                        ),
                    ),
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Title bottom', 'builderpress' ),
                    'param_name' => 'bn_title_bottom',
                    'std'        => __( 'Burger', 'builderpress' ),
                    'dependency' => array(
                        'element' => 'layout',
                        'value'   => array(
                            'layout-4',
                        ),
                    ),
                ),
                array(
                    'type'       => 'textarea',
                    'heading'    => __( 'Title bottom', 'builderpress' ),
                    'param_name' => 'bn_description',
                    'dependency' => array(
                        'element' => 'layout',
                        'value'   => array(
                            'layout-4',
                        ),
                    ),
                    'std'        => __( 'Extra-virgin calenda tofv olive oil, garlic , mozzarella cheese, onions, mushrooms, green olives, black olives, fresh tomatoes.', 'builderpress' )
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Text line', 'builderpress' ),
                    'param_name' => 'bn_text_line',
                    'std'        => __( 'Pick Size', 'builderpress' ),
                    'dependency' => array(
                        'element' => 'layout',
                        'value'   => array(
                            'layout-4',
                        ),
                    ),
                ),
                array(
                    'type'       => 'param_group',
                    'heading'    => __( 'Sizes', 'builderpress' ),
                    'param_name' => 'size',
                    'params'     => array(
                        array(
                            'type'             => 'textfield',
                            'heading'          => esc_html__( 'Number', 'builderpress' ),
                            'param_name'       => 'bn_number',
                            'std'              => __( '22', 'builderpress' ),
                            'edit_field_class' => 'vc_col-xs-6'
                        ),
                        array(
                            'type'             => 'textfield',
                            'heading'          => esc_html__( 'Number Unit', 'builderpress' ),
                            'param_name'       => 'bn_unit',
                            'std'              => __( 'cm', 'builderpress' ),
                            'edit_field_class' => 'vc_col-xs-6'
                        ),
                        array(
                            'type'             => 'textfield',
                            'heading'          => esc_html__( 'Price', 'builderpress' ),
                            'param_name'       => 'bn_price',
                            'std'              => __( '$19.90', 'builderpress' ),
                            'edit_field_class' => 'vc_col-xs-6'
                        ),

                    ),
                    'dependency' => array(
                        'element' => 'layout',
                        'value'   => array(
                            'layout-4',
                        ),
                    ),

                ),
                array(
                    'type'       => 'vc_link',
                    'heading'    => __( 'Action', 'builderpress' ),
                    'param_name' => 'bn_link',
                    'dependency' => array(
                        'element' => 'layout',
                        'value'   => array(
                            'layout-4',
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
            );
		}

		/**
		 * @return array|mixed
		 */
		public function get_styles() {
			return array(
				'product-banner' => array(
					'src' => 'product-banner.css'
				)
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'product-banner' => array(
					'src'  => 'product-banner.js',
					'deps' => array(
						'jquery'
					)
				)
			);
		}
	}
}
