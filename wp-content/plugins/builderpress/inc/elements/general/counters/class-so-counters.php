<?php
/**
 * BuilderPress Siteorigin Counter Box widget
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

if ( ! class_exists( 'BuilderPress_SO_Counters' ) ) {
	/**
	 * Class BuilderPress_SO_Counter_Box
	 */
	class BuilderPress_SO_Counters extends BuilderPress_SO_Widget {

		/**
		 * BuilderPress_SO_Counters constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Counters';

			parent::__construct();
		}
	}
}

add_action( 'widgets_init', 'builder_press_so_register_widget_counters' );

if ( ! function_exists( 'builder_press_so_register_widget_counters' ) ) {
	/**
	 * Register widget
	 */
	function builder_press_so_register_widget_counters() {
		register_widget( 'BuilderPress_SO_Counters' );
	}
}