<?php
/**
 * BuilderPress Siteorigin Tabs widget
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

if ( ! class_exists( 'BuilderPress_SO_Tabs' ) ) {
	/**
	 * Class BuilderPress_SO_Tabs
	 */
	class BuilderPress_SO_Tabs extends BuilderPress_SO_Widget {

		/**
		 * BuilderPress_SO_Tabs constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Tabs';

			parent::__construct();
		}
	}
}

add_action( 'widgets_init', 'builder_press_so_register_widget_tabs' );

if ( ! function_exists( 'builder_press_so_register_widget_tabs' ) ) {
	/**
	 * Register widget
	 */
	function builder_press_so_register_widget_tabs() {
		register_widget( 'BuilderPress_SO_Tabs' );
	}
}
