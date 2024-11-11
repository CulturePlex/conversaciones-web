<?php
/**
 * BuilderPress Woocommerce Product Carousel config class
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

if ( ! class_exists( 'BuilderPress_Config_Product_Carousel' ) ) {
	/**
	 * Class BuilderPress_Config_Product_Carousel
	 */
	class BuilderPress_Config_Product_Carousel extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_Product_Carousel constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'product-carousel';
			$this->name = __( 'Product Carousel', 'builderpress' );
			$this->desc = __( 'Display Woocommerce product carousel', 'builderpress' );

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
			return $options = array_merge( array(
				array(
					'type'        => 'dropdown',
					'heading'     => esc_attr__( 'Category', 'builderpress' ),
					'param_name'  => 'category',
					'admin_label' => true,
					'value'       => $this->_post_type_categories( 'product_cat' ),
					'description' => esc_attr__( 'Select product category.', 'builderpress' )
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
					'std'         => ''
				),
				array(
					'type'             => 'number',
					'heading'          => esc_html__( 'Number items', 'builderpress' ),
					'param_name'       => 'number_items',
					'value'            => '8',
					'edit_field_class' => 'vc_col-sm-6'
				),
				array(
					'type'             => 'number',
					'heading'          => esc_html__( 'Rows', 'builderpress' ),
					'param_name'       => 'rows',
					'value'            => '1',
					'edit_field_class' => 'vc_col-sm-6'
				),
				array(
					'type'             => 'checkbox',
					'heading'          => esc_html__( 'Show label', 'builderpress' ),
					'description'      => __( 'Show label likes Hot, Sale', 'builderpress' ),
					'param_name'       => 'show_label',
					'std'              => true,
					'admin_label'      => true,
					'edit_field_class' => 'vc_col-xs-4'
				),
				array(
					'type'             => 'checkbox',
					'heading'          => esc_html__( 'Show rating', 'builderpress' ),
					'param_name'       => 'show_rating',
					'std'              => true,
					'admin_label'      => true,
					'edit_field_class' => 'vc_col-xs-4'
				),
				array(
					'type'             => 'checkbox',
					'heading'          => esc_html__( 'Show pagination', 'builderpress' ),
					'param_name'       => 'show_nav',
					'std'              => true,
					'admin_label'      => true,
					'edit_field_class' => 'vc_col-xs-4'
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

			),
				// config slider number items
				$this->_number_items_options( array( 'items_visible' => 3 ) )
			);

		}

		/**
		 * @return array|mixed
		 */
		public function get_styles() {
			return array(
				'product-carousel' => array(
					'src'  => 'product-carousel.css',
					'deps' => array(
						'builder-press-owl-carousel'
					)
				)
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'product-carousel' => array(
					'src'  => 'product-carousel.js',
					'deps' => array(
						'jquery',
						'builder-press-owl-carousel'
					)
				)
			);
		}
	}
}
