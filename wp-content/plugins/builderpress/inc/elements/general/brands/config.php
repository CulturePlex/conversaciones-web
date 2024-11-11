<?php
/**
 * BuilderPress Brands config class
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

if ( ! class_exists( 'BuilderPress_Config_Brands' ) ) {
	/**
	 * Class BuilderPress_Config_Brands
	 */
	class BuilderPress_Config_Brands extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_Brands constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'brands';
			$this->name = __( 'Brands', 'builderpress' );
			$this->desc = __( 'Display brands slider', 'builderpress' );

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
						'type'        => 'radio_image',
						'heading'     => __( 'Layout', 'builderpress' ),
						'param_name'  => 'layout',
						'options'     => array(
							'layout-slider'       => $this->assets_url . 'images/layouts/layout-slider.jpg',
							'layout-grid'         => $this->assets_url . 'images/layouts/layout-grid.jpg',
							'layout-slider-title' => $this->assets_url . 'images/layouts/layout-slider-title.jpg',
							'marketing-layout-1'  => $this->assets_url . 'images/layouts/marketing-layout-1.jpg',
						),
						'std'         => 'layout-slider',
						'description' => __( 'Select type of style.', 'builderpress' ),
					),
					array(
						'type'       => 'param_group',
						'heading'    => __( 'Brands', 'builderpress' ),
						'param_name' => 'items',
						'params'     => array(
							array(
								'type'       => 'attach_image',
								'heading'    => esc_html__( 'Logo', 'builderpress' ),
								'param_name' => 'img',
							),
							array(
								'type'       => 'vc_link',
								'heading'    => esc_html__( 'Brand Link', 'builderpress' ),
								'param_name' => 'link',
							),
						),
						'dependency' => array(
							'element' => 'layout',
							'value'   => array( 'layout-slider', 'layout-grid', 'marketing-layout-1' ),
						),
					),

					array(
						'type'       => 'param_group',
						'heading'    => __( 'Brands', 'builderpress' ),
						'param_name' => 'items-title',
						'params'     => array(
							array(
								'type'       => 'attach_image',
								'heading'    => esc_html__( 'Logo', 'builderpress' ),
								'param_name' => 'img',
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__( 'Brand title hover', 'builderpress' ),
								'param_name' => 'title',
							),
						),
						'dependency' => array(
							'element' => 'layout',
							'value'   => array( 'layout-slider-title' ),
						),
					),

					array(
						'type'        => 'checkbox',
						'heading'     => esc_html__( 'Show pagination', 'builderpress' ),
						'param_name'  => 'pagination',
						'std'         => false,
						'admin_label' => true,
						'dependency'  => array(
							'element' => 'layout',
							'value'   => array( 'layout-slider', 'layout-slider-title' ),
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
						'edit_field_class' => 'vc_col-sm-6',
					),

					array(
						'type'       => 'css_editor',
						'heading'    => __( 'CSS Shortcode', 'js_composer' ),
						'param_name' => 'bp_css',
						'group'      => __( 'Design Options', 'js_composer' ),
					),
				),
				// config slider number items
				$this->_number_items_options(
					array(
						'items_visible' => 6,
						'items_tablet'  => 4,
						'items_mobile'  => 2,
					)
				)
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_styles() {
			return array(
				'brands' => array(
					'src'  => 'brands.css',
					'deps' => array(
						'builder-press-owl-carousel',
					),
				),
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'brands' => array(
					'src'  => 'brands.js',
					'deps' => array(
						'jquery',
						'builder-press-owl-carousel',
					),
				),
			);
		}
	}
}
