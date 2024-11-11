<?php
/**
 * BuilderPress Siteorigin Woocommerce Product Carousel widget
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

if ( ! class_exists( 'BuilderPress_SO_Product_Carousel' ) ) {
	/**
	 * Class BuilderPress_SO_Product_Carousel
	 */
	class BuilderPress_SO_Product_Carousel extends BuilderPress_SO_Widget {

		/**
		 * BuilderPress_SO_Product_Carousel constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Product_Carousel';

			parent::__construct();
		}
	}
}

add_action( 'widgets_init', 'builder_press_so_register_widget_product_carousel' );

if ( ! function_exists( 'builder_press_so_register_widget_product_carousel' ) ) {
	/**
	 * Register widget
	 */
	function builder_press_so_register_widget_product_carousel() {
		register_widget( 'BuilderPress_SO_Product_Carousel' );
	}
}
