<?php
/**
 * BuilderPress Siteorigin Course Categories widget
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

if ( ! class_exists( 'BuilderPress_SO_Course_Categories' ) ) {
	/**
	 * Class BuilderPress_SO_Course_Categories
	 */
	class BuilderPress_SO_Course_Categories extends BuilderPress_SO_Widget {

		/**
		 * BuilderPress_SO_Course_Categories constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Course_Categories';

			parent::__construct();
		}
	}
}

add_action( 'widgets_init', 'builder_press_so_register_widget_Course_Categories' );

if ( ! function_exists( 'builder_press_so_register_widget_Course_Categories' ) ) {
	/**
	 * Register widget
	 */
	function builder_press_so_register_widget_Course_Categories() {
		register_widget( 'BuilderPress_SO_Course_Categories' );
	}
}
