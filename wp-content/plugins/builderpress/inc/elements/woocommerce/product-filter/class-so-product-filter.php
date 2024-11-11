<?php
/**
 * BuilderPress Siteorigin Product-filter widget
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

if ( ! class_exists( 'BuilderPress_SO_Product_Filter' ) ) {
	/**
	 * Class BuilderPress_SO_Product-filter
	 */
	class BuilderPress_SO_Product_Filter extends BuilderPress_SO_Widget {

		/**
		 * BuilderPress_SO_Product-filter constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Product_Filter';

			parent::__construct();
		}
	}
}

add_action( 'widgets_init', 'builder_press_so_register_widget_product_filter' );

if ( ! function_exists( 'builder_press_so_register_widget_product_filter' ) ) {
	/**
	 * Register widget
	 */
	function builder_press_so_register_widget_product_filter() {
		register_widget( 'BuilderPress_SO_Product_Filter' );
	}
}
