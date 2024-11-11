<?php
/**
 * BuilderPress Products config class
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

if ( ! class_exists( 'BuilderPress_Config_Products' ) ) {
	/**
	 * Class BuilderPress_Config_Products
	 */
	class BuilderPress_Config_Products extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_Products constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'products';
			$this->name = __( 'Products', 'builderpress' );
			$this->desc = __( 'Display products', 'builderpress' );

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
                        'vblog-layout-list-1'   => $this->assets_url . 'images/layouts/vblog-layout-list-1.jpg',
                        'vblog-layout-slider-1' => $this->assets_url . 'images/layouts/vblog-layout-slider-1.png',
                        'tee-layout-list-1'     => $this->assets_url . 'images/layouts/tee-layout-list-1.jpg',
                        'tee-layout-list-2'     => $this->assets_url . 'images/layouts/tee-layout-list-2.jpg',
                    ),
                    'std'        => 'vblog-layout-list-1'
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Title', 'builderpress' ),
                    'param_name'  => 'title',
                    'admin_label' => true,
                   // 'std'         => __( 'This is title', 'builderpress' ),
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_attr__( 'Category', 'builderpress' ),
                    'param_name'  => 'category',
                    'admin_label' => true,
                    'value'       => $this->_post_type_categories( 'product_cat' ),
                    'description' => esc_attr__( 'Select product category.', 'builderpress' )
                ),

                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Product Popular',  'builderpress' ),
                    'param_name' => 'product_popular',
                    'value' => array(
                        __( 'Default','builderpress'  )      => '',
                        __( 'Featured','builderpress'  )     => 'featured',
                        __( 'Sale Price','builderpress'  )   => '_sale_price',
                        __( 'Average Rating','builderpress') => '_wc_average_rating',
                    ),
                    'description' => __( 'Choose Product Popular', 'builderpress' ),
                    'edit_field_class' => 'vc_col-xs-6'
                ),

                array(
                    'type'             => 'number',
                    'heading'          => esc_html__( 'Number items', 'builderpress' ),
                    'param_name'       => 'number_items',
                    'value'            => '3',
                ),
                array(
                    'type'             => 'number',
                    'heading'          => esc_html__( 'Number items on mobile', 'builderpress' ),
                    'param_name'       => 'number_items_mobile',
                    'value'            => '3',
                ),

                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Sort',  'builderpress' ),
                    'param_name' => 'sort_product',
                    'value' => array(
                        __( 'Date',    'builderpress'  ) => 'date',
                        __( 'Random',  'builderpress'  ) => 'rand',
                        __( 'Title',   'builderpress'  ) => 'title',
                    ),
                    'description' => __( 'Choose Sort', 'builderpress' ),
                    'edit_field_class' => 'vc_col-xs-6'
                ),

                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Order By',  'builderpress' ),
                    'param_name' => 'order_product',
                    'value' => array(
                        __( 'DESC', 'builderpress'  )    => 'desc',
                        __( 'ASC',  'builderpress'  )    => 'asc',
                    ),
                    'description' => __( 'Choose Order By', 'builderpress' ),
                    'dependency'  => array(
                        'element' => 'sort_product',
                        'value'   => array(
                            'date',
                            'title'
                        )
                    ),
                    'edit_field_class' => 'vc_col-xs-4'
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
				'products' => array(
					'src' => 'products.css'
				)
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'products' => array(
					'src'  => 'products.js',
					'deps' => array(
						'jquery'
					)
				)
			);
		}
	}
}
