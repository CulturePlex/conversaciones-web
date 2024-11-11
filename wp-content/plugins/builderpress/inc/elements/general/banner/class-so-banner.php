<?php
/**
 * BuilderPress Siteorigin Banner widget
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

if ( ! class_exists( 'BuilderPress_SO_Banner' ) ) {
	/**
	 * Class BuilderPress_SO_Banner
	 */
	class BuilderPress_SO_Banner extends BuilderPress_SO_Widget {

		/**
		 * BuilderPress_SO_Banner constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Banner';

			parent::__construct();
		}
	}
}

add_action( 'widgets_init', 'builder_press_so_register_widget_banner' );

if ( ! function_exists( 'builder_press_so_register_widget_banner' ) ) {
	/**
	 * Register widget
	 */
	function builder_press_so_register_widget_banner() {
		register_widget( 'BuilderPress_SO_Banner' );
	}
}
