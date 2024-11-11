<?php
/**
 * BuilderPress Siteorigin Product-banner widget
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

if ( ! class_exists( 'BuilderPress_SO_Product_Banner' ) ) {
	/**
	 * Class BuilderPress_SO_Product-banner
	 */
	class BuilderPress_SO_Product_Banner extends BuilderPress_SO_Widget {

		/**
		 * BuilderPress_SO_Product-banner constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Product_Banner';

			parent::__construct();
		}
	}
}

add_action( 'widgets_init', 'builder_press_so_register_widget_product_banner' );

if ( ! function_exists( 'builder_press_so_register_widget_product_banner' ) ) {
	/**
	 * Register widget
	 */
	function builder_press_so_register_widget_product_banner() {
		register_widget( 'BuilderPress_SO_Product_Banner' );
	}
}
