<?php
/**
 * BuilderPress Siteorigin Grid Images widget
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

if ( ! class_exists( 'BuilderPress_SO_Grid_Images' ) ) {
	/**
	 * Class BuilderPress_SO_Grid_Images
	 */
	class BuilderPress_SO_Grid_Images extends BuilderPress_SO_Widget {

		/**
		 * BuilderPress_SO_Grid_Images constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Grid_Images';

			parent::__construct();
		}
	}
}

add_action( 'widgets_init', 'builder_press_so_register_widget_grid_images' );

if ( ! function_exists( 'builder_press_so_register_widget_grid_images' ) ) {
	/**
	 * Register widget
	 */
	function builder_press_so_register_widget_grid_images() {
		register_widget( 'BuilderPress_SO_Grid_Images' );
	}
}
