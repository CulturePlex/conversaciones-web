<?php
/**
 * BuilderPress Siteorigin Brands widget
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

if ( ! class_exists( 'BuilderPress_SO_Brands' ) ) {
	/**
	 * Class BuilderPress_SO_Brands
	 */
	class BuilderPress_SO_Brands extends BuilderPress_SO_Widget {

		/**
		 * BuilderPress_SO_Brands constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Brands';

			parent::__construct();
		}
	}
}

add_action( 'widgets_init', 'builder_press_so_register_widget_brands' );

if ( ! function_exists( 'builder_press_so_register_widget_brands' ) ) {
	/**
	 * Register widget
	 */
	function builder_press_so_register_widget_brands() {
		register_widget( 'BuilderPress_SO_Brands' );
	}
}
