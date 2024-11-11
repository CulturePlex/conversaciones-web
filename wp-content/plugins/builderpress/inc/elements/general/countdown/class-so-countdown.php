<?php
/**
 * BuilderPress Siteorigin Countdown widget
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

if ( ! class_exists( 'BuilderPress_SO_Countdown' ) ) {
	/**
	 * Class BuilderPress_SO_Countdown
	 */
	class BuilderPress_SO_Countdown extends BuilderPress_SO_Widget {

		/**
		 * BuilderPress_SO_Countdown constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Countdown';

			parent::__construct();
		}
	}
}

add_action( 'widgets_init', 'builder_press_so_register_widget_countdown' );

if ( ! function_exists( 'builder_press_so_register_widget_countdown' ) ) {
	/**
	 * Register widget
	 */
	function builder_press_so_register_widget_countdown() {
		register_widget( 'BuilderPress_SO_Countdown' );
	}
}
