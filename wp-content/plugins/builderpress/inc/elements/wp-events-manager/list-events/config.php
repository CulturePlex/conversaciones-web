<?php
/**
 * BuilderPress WP Events Manager List Events config class
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

if ( ! class_exists( 'BuilderPress_Config_List_Events' ) ) {
	/**
	 * Class BuilderPress_Config_List_Events
	 */
	class BuilderPress_Config_List_Events extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_List_Events constructor.
		 */
		public function __construct() {

			// info
			$this->base = 'list-events';
			$this->name = __( 'List Events', 'builderpress' );
			$this->desc = __( 'Display WP Events Manager list events', 'builderpress' );

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
						'layout-1'        			=> $this->assets_url . 'images/layouts/layout-1.jpg',
						'layout-list'     			=> $this->assets_url . 'images/layouts/layout-list.jpg',
                        'layout-list-2'     		=> $this->assets_url . 'images/layouts/layout-list-2.png',
						'layout-slider'   			=> $this->assets_url . 'images/layouts/layout-slider.jpg',
						'layout-slider-2' 			=> $this->assets_url . 'images/layouts/layout-slider-2.jpg',
						'layout-slider-3' 			=> $this->assets_url . 'images/layouts/layout-slider-3.jpg',
						'stocklab-layout-slider-4' 	=> $this->assets_url . 'images/layouts/stocklab-layout-slider-4.png',
                        'coach-life-layout-1' 		=> $this->assets_url . 'images/layouts/coach-life-layout-1.png'
					),
					'std'         => 'layout-list',
					'description' => __( 'Select type of style.', 'builderpress' )
				),
				array(
					'type'       => 'attach_image',
					'heading'    => __( 'Background', 'builderpress' ),
					'param_name' => 'background',
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout-slider-3' ),
					),
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Event category', 'builderpress' ),
					'param_name' => 'category',
					'value'      => $this->_post_type_categories( 'tp_event_category' ),
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Event status', 'builderpress' ),
					'param_name' => 'status',
					'value'      => $this->_event_statuses(),
				),
				array(
					'type'       => 'number',
					'heading'    => esc_html__( 'Number items', 'builderpress' ),
					'param_name' => 'number_items',
					'std'        => 3
				),
                array(
                    'type'       => 'number',
                    'heading'    => esc_html__( 'Number event slider', 'builderpress' ),
                    'param_name' => 'number_event_slider',
                    'std'        => 3,
                    'dependency'  => array(
                        'element' => 'layout',
                        'value'   => array( 'layout-list-2' ),
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
                    'type'             => 'attach_image',
                    'heading'          => __( 'Image', 'builderpress' ),
                    'param_name'       => 'image',
                    'dependency'  => array(
                        'element' => 'layout',
                        'value'   => array( 'layout-list-2' ),
                    ),
                    'edit_field_class' => 'vc_col-sm-6'
                ),
				array(
					'type'       => 'css_editor',
					'heading'    => __( 'CSS Shortcode', 'js_composer' ),
					'param_name' => 'bp_css',
					'group'      => __( 'Design Options', 'js_composer' ),
				)

			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_styles() {
			return array(
				'list-events' => array(
					'src'      => 'list-events.css',
					'deps'     => array(
						'builder-press-ionicons'
					),
					'deps_src' => array(
						'builder-press-ionicons' => BUILDER_PRESS_URL . '/assets/css/fonts/ionicons.css'
					)
				)
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'list-events' => array(
					'src'  => 'list-events.js',
					'deps' => array(
						'jquery',
						'builder-press-slick'
					)
				)
			);
		}
	}
}
