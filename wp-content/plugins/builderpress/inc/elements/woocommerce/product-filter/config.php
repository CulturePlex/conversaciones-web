<?php
/**
 * BuilderPress Product-filter config class
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

if ( ! class_exists( 'BuilderPress_Config_Product_Filter' ) ) {
	/**
	 * Class BuilderPress_Config_Product-filter
	 */
	class BuilderPress_Config_Product_Filter extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_Product-filter constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'product-filter';
			$this->name = __( 'Product Filter', 'builderpress' );
			$this->desc = __( 'Display product filter', 'builderpress' );

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
                        esc_html__( 'Grid 1', 'builderpress' )    => 'layout-1',
                        esc_html__( 'Grid 2', 'builderpress' )    => 'layout-4',
                        esc_html__( 'List 1', 'builderpress' )    => 'layout-2',
                        esc_html__( 'List 2', 'builderpress' )    => 'layout-3',
                    ),
                    'std'         => 'layout-1',
                ),

                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_attr__( 'Category', 'builderpress' ),
                    'param_name'  => 'category',
                    'admin_label' => true,
                    'value'       => $this->_post_type_categories( 'product_cat' ),
                    'description' => esc_attr__( 'Select product category.', 'builderpress' ),
                    'edit_field_class' => 'vc_col-xs-6'
                ),

                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Filter by', 'builderpress' ),
                    'param_name'  => 'filter_by',
                    'save_always' => true,
                    'value'       => array(
                        esc_html__( 'Recent products', 'builderpress' )       => '',
                        esc_html__( 'Top rated products', 'builderpress' )    => 'average_rating',
                        esc_html__( 'Best selling products', 'builderpress' ) => 'total_sales',
                        esc_html__( 'Featured products', 'builderpress' )     => 'featured'
                    ),
                    'std'         => '',
                    'edit_field_class' => 'vc_col-xs-6',

                ),

                array(
                    'type'        => 'number',
                    'heading'     => esc_html__( 'Number of product', 'builderpress' ),
                    'param_name'  => 'number',
                    'std'         => '6',
                    'admin_label' => true,
                    'edit_field_class' => 'vc_col-xs-6'
                ),

                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Number Columns', 'builderpress' ),
                    'param_name' => 'columns',
                    'value'      => array(
                        esc_attr__( '2', 'builderpress' ) => '2',
                        esc_attr__( '3', 'builderpress' ) => '3',
                        esc_attr__( '4', 'builderpress' ) => '4',
                    ),
                    'std'        => '3',
                    'edit_field_class' => 'vc_col-xs-6'
                ),
                array(
                    'type'             => 'checkbox',
                    'heading'          => esc_html__( 'Show Add to cart button', 'builderpress' ),
                    'param_name'       => 'add_cart',
                    'std'              => true,
                    'admin_label'      => true,
                    'dependency' => array(
                        'element' => 'layout',
                        'value'   => array('layout-1','layout-2','layout-4'),
                    ),
                    'edit_field_class' => 'vc_col-xs-4'
                ),
                array(
                    'type'             => 'checkbox',
                    'heading'          => esc_html__( 'Show rating', 'builderpress' ),
                    'param_name'       => 'rating',
                    'std'              => true,
                    'admin_label'      => true,
                    'dependency' => array(
                        'element' => 'layout',
                        'value'   => array('layout-1','layout-2','layout-4'),
                    ),
                    'edit_field_class' => 'vc_col-xs-4'
                ),

                array(
                    'type'             => 'checkbox',
                    'heading'          => esc_html__( 'Show description', 'builderpress' ),
                    'param_name'       => 'description',
                    'std'              => true,
                    'admin_label'      => true,
                    'edit_field_class' => 'vc_col-xs-4'
                ),
                array(
                    'type'             => 'checkbox',
                    'heading'          => esc_html__( 'Show price', 'builderpress' ),
                    'param_name'       => 'price',
                    'std'              => true,
                    'admin_label'      => true,
                    'edit_field_class' => 'vc_col-xs-4'
                ),
                array(
                    'type'             => 'checkbox',
                    'heading'          => esc_html__( 'Hide "All" filter', 'builderpress' ),
                    'param_name'       => 'hide_all',
                    'std'              => false,
                    'admin_label'      => true,
                    'dependency' => array(
                        'element' => 'category',
                        'value'   => ' ',
                    ),
                    'edit_field_class' => 'vc_col-xs-4'
                ),

                array(
                    'type'             => 'checkbox',
                    'heading'          => esc_html__( 'Hide nav filter', 'builderpress' ),
                    'param_name'       => 'hide_all_filter',
                    'std'              => false,
                    'admin_label'      => true,
                    'edit_field_class' => 'vc_col-xs-4'
                ),
                array(
                    'type'             => 'checkbox',
                    'heading'          => esc_html__( 'Show label', 'builderpress' ),
                    'description'      => __( 'Show label likes Hot, Sale', 'builderpress' ),
                    'param_name'       => 'label',
                    'std'              => true,
                    'admin_label'      => true,
                    'dependency' => array(
                        'element' => 'layout',
                        'value'   => array('layout-1','layout-2','layout-4'),
                    ),
                    'edit_field_class' => 'vc_col-xs-4'
                ),
                array(
                    'type'       => 'vc_link',
                    'heading'    => __( 'Add Load More button link', 'builderpress' ),
                    'param_name' => 'link'
                ),

                array(
                    'type'             => 'dropdown',
                    'heading'          => esc_html__( 'Size', 'builderpress' ),
                    'param_name'       => 'size',
                    'value'            => array(
                        esc_html__( 'Small', 'builderpress' )  => 'sm',
                        esc_html__( 'Normal', 'builderpress' ) => 'normal',
                        esc_html__( 'Large', 'builderpress' )  => 'lg'
                    ),
                    'description'      => esc_html__( 'Select button display size.', 'builderpress' ),
                    'edit_field_class' => 'vc_col-sm-6',
                    'std'              => 'normal'
                ),

                array(
                    'type'        => 'textfield',
                    'heading'     => __( 'Image Size', 'builderpress' ),
                    'param_name'  => 'img_size',
                    'description' => esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).','pizza-hut'),
                    'admin_label' => true,
                    'std'         => 'full',
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
				'product-filter' => array(
					'src' => 'product-filter.css'
				)
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'product-filter' => array(
					'src'  => 'product-filter.js',
					'deps' => array(
						'jquery'
					)
				)
			);
		}

	}
}
