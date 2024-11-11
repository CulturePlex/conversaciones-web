<?php
/**
 * BuilderPress Siteorigin Learnpress Course Reviews widget
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

if ( ! class_exists( 'BuilderPress_SO_Course_Reviews' ) ) {
	/**
	 * Class BuilderPress_SO_Course_Reviews
	 */
	class BuilderPress_SO_Course_Reviews extends BuilderPress_SO_Widget {

		/**
		 * BuilderPress_SO_Course_Reviews constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Course_Reviews';

			parent::__construct();
		}
	}
}

add_action( 'widgets_init', 'builder_press_so_register_widget_course_reviews' );

if ( ! function_exists( 'builder_press_so_register_widget_course_reviews' ) ) {
	/**
	 * Register widget
	 */
	function builder_press_so_register_widget_course_reviews() {
		register_widget( 'BuilderPress_SO_Course_Reviews' );
	}
}
