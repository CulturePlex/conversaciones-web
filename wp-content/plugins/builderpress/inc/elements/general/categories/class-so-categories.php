<?php
/**
 * BuilderPress Siteorigin Categories widget
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

if ( ! class_exists( 'BuilderPress_SO_Categories' ) ) {
	/**
	 * Class BuilderPress_SO_Categories
	 */
	class BuilderPress_SO_Categories extends BuilderPress_SO_Widget {

		/**
		 * BuilderPress_SO_Categories constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Categories';

			parent::__construct();
		}
	}
}

add_action( 'widgets_init', 'builder_press_so_register_widget_categories' );

if ( ! function_exists( 'builder_press_so_register_widget_categories' ) ) {
	/**
	 * Register widget
	 */
	function builder_press_so_register_widget_categories() {
		register_widget( 'BuilderPress_SO_Categories' );
	}
}
