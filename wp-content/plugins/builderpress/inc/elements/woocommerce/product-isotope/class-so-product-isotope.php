<?php
/**
 * BuilderPress Siteorigin Product-isotope widget
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

if ( ! class_exists( 'BuilderPress_SO_Product_Isotope' ) ) {
	/**
	 * Class BuilderPress_SO_Product-isotope
	 */
	class BuilderPress_SO_Product_Isotope extends BuilderPress_SO_Widget {

		/**
		 * BuilderPress_SO_Product-isotope constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Product_sotope';

			parent::__construct();
		}
	}
}

add_action( 'widgets_init', 'builder_press_so_register_widget_product_isotope' );

if ( ! function_exists( 'builder_press_so_register_widget_product_isotope' ) ) {
	/**
	 * Register widget
	 */
	function builder_press_so_register_widget_product_isotope() {
		register_widget( 'BuilderPress_SO_Product_Isotope' );
	}
}
