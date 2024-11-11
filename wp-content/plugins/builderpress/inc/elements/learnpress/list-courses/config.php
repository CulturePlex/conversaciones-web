<?php
/**
 * BuilderPress Learnpress List Courses config class
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

if ( ! class_exists( 'BuilderPress_Config_List_Courses' ) ) {
	/**
	 * Class BuilderPress_Config_List_Courses
	 */
	class BuilderPress_Config_List_Courses extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_List_Courses constructor.
		 */
		public function __construct() {

			// info
			$this->base = 'list-courses';
			$this->name = __( 'List Courses', 'builderpress' );
			$this->desc = __( 'Display LearnPress list courses', 'builderpress' );

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
						'layout-list'   				=> $this->assets_url . 'images/layouts/layout-list.jpg',
                        'layout-list-2' 				=> $this->assets_url . 'images/layouts/layout-list-2.jpg',
                        'layout-grid'   				=> $this->assets_url . 'images/layouts/layout-grid.jpg',
						'layout-slider' 				=> $this->assets_url . 'images/layouts/layout-slider.jpg',
                        'layout-slider-2' 				=> $this->assets_url . 'images/layouts/layout-slider-2.png',
                        'kindergarten-layout-grid-1' 	=> $this->assets_url . 'images/layouts/kindergarten-layout-grid-1.png',
                        'kindergarten-layout-slider-1' 	=> $this->assets_url . 'images/layouts/kindergarten-layout-slider-1.jpg',
                        'kindergarten-layout-grid-2' 	=> $this->assets_url . 'images/layouts/kindergarten-layout-grid-2.jpg',
                        'coach-life-layout-slider-1' 	=> $this->assets_url . 'images/layouts/coach-life-layout-slider-1.png',
                        'coach-life-layout-grid-1' 		=> $this->assets_url . 'images/layouts/coach-life-layout-grid-1.png',
                        'coach-life-layout-slider-2' 	=> $this->assets_url . 'images/layouts/coach-life-layout-slider-2.png',
					),
					'std'         => 'layout-list',
					'description' => __( 'Select type of style.', 'builderpress' )
				),
                array(
                    'type'             => 'textfield',
                    'heading'          => esc_html__( 'Title', 'builderpress' ),
                    'param_name'       => 'title',
                    'admin_label'      => true,
					//'std'              => __( 'This is title', 'builderpress' ),
                ),
				array(
					'type'             => 'dropdown',
					'admin_label'      => true,
					'heading'          => esc_html__( 'Filter by', 'builderpress' ),
					'param_name'       => 'filter_by',
					'value'            => array(
						esc_html__( 'Latest', 'builderpress' )   => '',
						esc_html__( 'Popular', 'builderpress' )  => 'popular',
						esc_html__( 'Category', 'builderpress' ) => 'category'
					),
					'edit_field_class' => 'vc_col-sm-6'
				),
				array(
					'type'             => 'dropdown',
					'admin_label'      => true,
					'heading'          => esc_html__( 'Course category', 'builderpress' ),
					'param_name'       => 'category',
					'value'            => $this->_post_type_categories( 'course_category' ),
					'edit_field_class' => 'vc_col-sm-6',
					'dependency'       => array(
						'element' => 'filter_by',
						'value'   => array( 'category' )
					)
				),
				array(
					'type'       => 'number',
					'heading'    => esc_html__( 'Number items', 'builderpress' ),
					'param_name' => 'number_items',
					'value'      => 8
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
					'type'       => 'vc_link',
					'heading'    => esc_html__( 'Button', 'builderpress' ),
					'param_name' => 'button',
                    'dependency'       => array(
                        'element' => 'layout',
                        'value'   => array( 'coach-life-layout-slider-1' )
                    )
				),
                array(
                    'type' => 'css_editor',
                    'heading' => __( 'CSS Shortcode', 'js_composer' ),
                    'param_name' => 'bp_css',
                    'group' => __( 'Design Options', 'js_composer' ),
                )
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
				'list-courses' => array(
					'src' => 'list-courses.css'
				)
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'list-courses' => array(
					'src'  => 'list-courses.js',
					'deps' => array(
						'jquery',
						'builder-press-slick'
					)
				)
			);
		}
	}
}
