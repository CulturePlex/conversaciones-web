<?php
/**
 * BuilderPress Siteorigin Product-Login widget
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

if ( ! class_exists( 'BuilderPress_SO_Product_Login' ) ) {
	/**
	 * Class BuilderPress_SO_Product-login
	 */
	class BuilderPress_SO_Product_Login extends BuilderPress_SO_Widget {

		/**
		 * BuilderPress_SO_Product-login constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Product_Login';

			parent::__construct();
		}
	}
}

add_action( 'widgets_init', 'builder_press_so_register_widget_product_login' );

if ( ! function_exists( 'builder_press_so_register_widget_product_login' ) ) {
	/**
	 * Register widget
	 */
	function builder_press_so_register_widget_product_login() {
		register_widget( 'BuilderPress_SO_Product_Login' );
	}
}
