<?php
/**
 * BuilderPress LearnPress Course Reviews config class
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

if ( ! class_exists( 'BuilderPress_Config_Course_Reviews' ) ) {
	/**
	 * Class BuilderPress_Config_Course_Reviews
	 */
	class BuilderPress_Config_Course_Reviews extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_Course_Reviews constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'course-reviews';
			$this->name = __( 'Course Reviews', 'builderpress' );
			$this->desc = __( 'Display Learnpress course reviews', 'builderpress' );

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
					'admin_label' => true,
					'heading'     => esc_html__( 'Course', 'builderpress' ),
					'param_name'  => 'course',
					'value'       => $this->_all_courses_options()
				),
				array(
					'type'        => 'number',
					'admin_label' => true,
					'heading'     => esc_attr__( 'Number reviews', 'builderpress' ),
					'param_name'  => 'number_reviews',
					'value'       => 3,
					'description' => __( 'Number of reviews you want to show.', 'builderpress' )
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
				'course-reviews' => array(
					'src' => 'course-reviews.css'
				)
			);
		}
	}
}
