<?php
/**
 * BuilderPress Siteorigin Accordion widget
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

if ( ! class_exists( 'BuilderPress_SO_Accordion' ) ) {
	/**
	 * Class BuilderPress_SO_Accordion
	 */
	class BuilderPress_SO_Accordion extends BuilderPress_SO_Widget {

		/**
		 * BuilderPress_SO_Accordion constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Accordion';

			parent::__construct();
		}
	}
}

add_action( 'widgets_init', 'builder_press_so_register_widget_accordion' );

if ( ! function_exists( 'builder_press_so_register_widget_accordion' ) ) {
	/**
	 * Register widget
	 */
	function builder_press_so_register_widget_accordion() {
		register_widget( 'BuilderPress_SO_Accordion' );
	}
}
