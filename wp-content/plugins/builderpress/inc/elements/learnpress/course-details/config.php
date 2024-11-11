<?php
/**
 * BuilderPress LearnPress Course Details config class
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

if ( ! class_exists( 'BuilderPress_Config_Course_Details' ) ) {
	/**
	 * Class BuilderPress_Config_Course_Details
	 */
	class BuilderPress_Config_Course_Details extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_Course_Details constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'course-details';
			$this->name = __( 'Course Details', 'builderpress' );
			$this->desc = __( 'Display Learnpress course details', 'builderpress' );

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
						'layout-1' => $this->assets_url . 'images/layouts/layout-1.jpg',
						'layout-2' => $this->assets_url . 'images/layouts/layout-2.jpg'
					),
					'std'         => 'layout-1',
					'description' => __( 'Select type of style.', 'builderpress' )
				),
				array(
					'type'        => 'dropdown',
					'admin_label' => true,
					'heading'     => esc_html__( 'Course', 'builderpress' ),
					'param_name'  => 'course',
					'value'       => $this->_all_courses_options()
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
				'course-details' => array(
					'src' => 'course-details.css'
				)
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'course-details' => array(
					'src' => 'course-details.js'
				)
			);
		}
	}
}
