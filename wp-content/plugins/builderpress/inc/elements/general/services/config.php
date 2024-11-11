<?php
/**
 * BuilderPress Services config class
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

if ( ! class_exists( 'BuilderPress_Config_Services' ) ) {
	/**
	 * Class BuilderPress_Config_Services
	 */
	class BuilderPress_Config_Services extends BuilderPress_Abstract_Config {
		/**
		 * BuilderPress_Config_Services constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'services';
			$this->name = __( 'Services', 'builderpress' );
			$this->desc = __( 'Display services', 'builderpress' );

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
						'type'       => 'radio_image',
						'heading'    => __( 'Layout', 'builderpress' ),
						'param_name' => 'layout',
						'options'    => array(
							'layout-slider' => $this->assets_url . 'images/layouts/layout-slider.jpg',
							'layout-grid'   => $this->assets_url . 'images/layouts/layout-grid.jpg'
						),
						'std'        => 'layout-slider'
					),
					//group
					array(
						'type'       => 'param_group',
						'heading'    => __( 'Services', 'builderpress' ),
						'param_name' => 'services',
						'params'     => array(
							array(
								'type'        => 'textfield',
								'heading'     => __( 'Title', 'builderpress' ),
								'param_name'  => 'title',
								'description' => __( 'Enter text used as title.', 'builderpress' ),
								'std'         => __( 'Customer service', 'builderpress' )
							),
							array(
								'type'        => 'textfield',
								'heading'     => __( 'Description', 'builderpress' ),
								'param_name'  => 'description',
								'description' => __( 'More information for title.', 'builderpress' )
							),
							array(
								'type'             => 'attach_image',
								'heading'          => __( 'Thumbnail', 'builderpress' ),
								'param_name'       => 'thumbnail',
								'description'      => __( 'Select an image to upload', 'builderpress' ),
								'edit_field_class' => 'vc_col-sm-6'
							),
							array(
								'type'             => 'textfield',
								'heading'          => __( 'Link', 'builderpress' ),
								'param_name'       => 'link',
								'value'            => '#',
								'edit_field_class' => 'vc_col-xs-6'
							),
						)
					),

					array(
						'type'        => 'vc_link',
						'heading'     => __( 'Button', 'builderpress' ),
						'param_name'  => 'view_all',
						'description' => esc_html__( 'View all services button.', 'builderpress' )
					),

					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__( 'Number Columns', 'builderpress' ),
						'param_name' => 'number_columns',
						'value'      => array(
							esc_attr__( '1 Column', 'builderpress' )  => '1',
							esc_attr__( '2 Columns', 'builderpress' ) => '2',
							esc_attr__( '3 Columns', 'builderpress' ) => '3',
							esc_attr__( '4 Columns', 'builderpress' ) => '4',
							esc_attr__( '6 Columns', 'builderpress' ) => '6'
						),
						'dependency' => array(
							'element' => 'layout',
							'value'   => 'layout-grid'
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
                    array(
                        'type' => 'css_editor',
                        'heading' => __( 'CSS Shortcode', 'js_composer' ),
                        'param_name' => 'bp_css',
                        'group' => __( 'Design Options', 'js_composer' ),
                    )
				),
					// config slider number items
					$this->_number_items_options()
				);
		}

		/**
		 * @return array|mixed
		 */
		public function get_styles() {
			return array(
				'services' => array(
					'src'  => 'services.css',
					'deps' => array(
						'builder-press-slick'
					)
				)
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'services' => array(
					'src'  => 'services.js',
					'deps' => array(
						'jquery',
						'builder-press-slick'
					)
				)
			);
		}
	}
}
