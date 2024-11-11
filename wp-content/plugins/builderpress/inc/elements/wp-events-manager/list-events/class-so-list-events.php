<?php
/**
 * BuilderPress Siteorigin Woocommerce List Events widget
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

if ( ! class_exists( 'BuilderPress_SO_List_Events' ) ) {
	/**
	 * Class BuilderPress_SO_List_Events
	 */
	class BuilderPress_SO_List_Events extends BuilderPress_SO_Widget {

		/**
		 * BuilderPress_SO_List_Events constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_List_Events';

			parent::__construct();
		}
	}
}

add_action( 'widgets_init', 'builder_press_so_register_widget_list_events' );

if ( ! function_exists( 'builder_press_so_register_widget_list_events' ) ) {
	/**
	 * Register widget
	 */
	function builder_press_so_register_widget_list_events() {
		register_widget( 'BuilderPress_SO_List_Events' );
	}
}
