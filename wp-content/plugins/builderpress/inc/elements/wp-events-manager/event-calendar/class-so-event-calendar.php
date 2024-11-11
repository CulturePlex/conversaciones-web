<?php
/**
 * BuilderPress Siteorigin Event Calendar widget
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

if ( ! class_exists( 'BuilderPress_SO_Event_Calendar' ) ) {
	/**
	 * Class BuilderPress_SO_Event_Calendar
	 */
	class BuilderPress_SO_Event_Calendar extends BuilderPress_SO_Widget {

		/**
		 * BuilderPress_SO_Event_Calendar constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Event_Calendar';

			parent::__construct();
		}
	}
}

add_action( 'widgets_init', 'builder_press_so_register_widget_event_calendar' );

if ( ! function_exists( 'builder_press_so_register_widget_event_calendar' ) ) {
	/**
	 * Register widget
	 */
	function builder_press_so_register_widget_event_calendar() {
		register_widget( 'BuilderPress_SO_Event_Calendar' );
	}
}
