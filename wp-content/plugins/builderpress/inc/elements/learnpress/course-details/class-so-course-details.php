<?php
/**
 * BuilderPress Siteorigin Learnpress Course Details widget
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

if ( ! class_exists( 'BuilderPress_SO_Course_Details' ) ) {
	/**
	 * Class BuilderPress_SO_Course_Details
	 */
	class BuilderPress_SO_Course_Details extends BuilderPress_SO_Widget {

		/**
		 * BuilderPress_SO_Course_Details constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Course_Details';

			parent::__construct();
		}
	}
}

add_action( 'widgets_init', 'builder_press_so_register_widget_course_details' );

if ( ! function_exists( 'builder_press_so_register_widget_course_details' ) ) {
	/**
	 * Register widget
	 */
	function builder_press_so_register_widget_course_details() {
		register_widget( 'BuilderPress_SO_Course_Details' );
	}
}
