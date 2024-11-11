<?php
/**
 * BuilderPress Learnpress List Instructors config class
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

if ( ! class_exists( 'BuilderPress_Config_List_Instructors' ) ) {
	/**
	 * Class BuilderPress_Config_List_Instructors
	 */
	class BuilderPress_Config_List_Instructors extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_List_Instructors constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'list-instructors';
			$this->name = __( 'List Instructor', 'builderpress' );
			$this->desc = __( 'Display LearnPress list instructors', 'builderpress' );

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
					'type'        => 'radio_image',
					'heading'     => __( 'Layout', 'builderpress' ),
					'param_name'  => 'layout',
					'options'     => array(
						'layout-grid'   	=> $this->assets_url . 'images/layouts/layout-grid.jpg',
						'layout-slider' 	=> $this->assets_url . 'images/layouts/layout-slider.jpg',
                        'layout-slider-2'	=> $this->assets_url . 'images/layouts/layout-slider-2.png',
                        'layout-list' 		=> $this->assets_url . 'images/layouts/layout-list.jpg',
					),
					'std'         => 'layout-grid',
					'description' => __( 'Select type of style.', 'builderpress' )
				),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Title', 'builderpress' ),
                    'param_name' => 'title_instructors',
                    'std'        => __( 'Our Instructors', 'builderpress' ),
                    'dependency'  => array(
                        'element' => 'layout',
                        'value'   => array( 'layout-slider-2' )
                    )
                ),
				array(
					'type'        => 'number',
					'heading'     => esc_html__( 'Number instructors', 'builderpress' ),
					'param_name'  => 'number',
					'std'         => 8,
					'admin_label' => true
				),
				array(
					'type'        => 'checkbox',
					'heading'     => esc_html__( 'Show Load more', 'builderpress' ),
					'param_name'  => 'show_load_more',
					'std'         => true,
					'admin_label' => true,
					'dependency'  => array(
						'element' => 'layout',
						'value'   => array( 'layout-grid' )
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
			),
				// config slider number items
				$this->_number_items_options( array(), array(
					'element' => 'layout',
					'value'   => array( 'layout-slider' )
				) )
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_styles() {
			return array(
				'list-instructors' => array(
					'src' => 'list-instructors.css'
				)
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'list-instructors' => array(
					'src'  => 'list-instructors.js',
					'deps' => array(
						'jquery',
						'builder-press-slick'
					)
				)
			);
		}
	}
}
