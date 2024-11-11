<?php
/**
 * BuilderPress Siteorigin Products widget
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

if ( ! class_exists( 'BuilderPress_SO_Products' ) ) {
	/**
	 * Class BuilderPress_SO_Products
	 */
	class BuilderPress_SO_Products extends BuilderPress_SO_Widget {

		/**
		 * BuilderPress_SO_Products constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Products';

			parent::__construct();
		}
	}
}

add_action( 'widgets_init', 'builder_press_so_register_widget_products' );

if ( ! function_exists( 'builder_press_so_register_widget_products' ) ) {
	/**
	 * Register widget
	 */
	function builder_press_so_register_widget_products() {
		register_widget( 'BuilderPress_SO_Products' );
	}
}
