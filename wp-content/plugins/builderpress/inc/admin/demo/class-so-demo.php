<?php
/**
 * BuilderPress Siteorigin Demo widget
 *
 * @version     1.0.0
 * @author      ThimPress
 * @package     BuilderPress/Classes
 * @category    Classes
 * @author      Thimpress, vinhnq
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'BuilderPress_SO_Demo' ) ) {
	/**
	 * Class BuilderPress_SO_Demo
	 */
	class BuilderPress_SO_Demo extends BuilderPress_SO_Widget {

		/**
		 * BuilderPress_SO_Demo constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Demo';

			parent::__construct();
		}
	}
}

add_action( 'widgets_init', 'builder_press_so_register_widget_demo' );

if ( ! function_exists( 'builder_press_so_register_widget_demo' ) ) {
	/**
	 * Register widget
	 */
	function builder_press_so_register_widget_demo() {
		register_widget( 'BuilderPress_SO_Demo' );
	}
}
