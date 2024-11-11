<?php
/**
 * BuilderPress Siteorigin Call To Action widget
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

if ( ! class_exists( 'BuilderPress_SO_Call_To_Action' ) ) {
	/**
	 * Class BuilderPress_SO_Call_To_Action
	 */
	class BuilderPress_SO_Call_To_Action extends BuilderPress_SO_Widget {
		/**
		 * BuilderPress_SO_Call_To_Action constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Call_To_Action';

			parent::__construct();
		}
	}
}

add_action( 'widgets_init', 'builder_press_so_register_widget_call_to_action' );

if ( ! function_exists( 'builder_press_so_register_widget_call_to_action' ) ) {
	/**
	 * Register widget
	 */
	function builder_press_so_register_widget_call_to_action() {
		register_widget( 'BuilderPress_SO_Call_To_Action' );
	}
}