<?php
/**
 * BuilderPress Siteorigin Image Box widget
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

if ( ! class_exists( 'BuilderPress_SO_Image_Box' ) ) {
	/**
	 * Class BuilderPress_SO_Image_Box
	 */
	class BuilderPress_SO_Image_Box extends BuilderPress_SO_Widget {

		/**
		 * BuilderPress_SO_Image_Box constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Image_Box';

			parent::__construct();
		}
	}
}

add_action( 'widgets_init', 'builder_press_so_register_widget_image_box' );

if ( ! function_exists( 'builder_press_so_register_widget_image_box' ) ) {
	/**
	 * Register widget
	 */
	function builder_press_so_register_widget_image_box() {
		register_widget( 'BuilderPress_SO_Image_Box' );
	}
}
