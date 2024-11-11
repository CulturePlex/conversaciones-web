<?php
/**
 * BuilderPress Siteorigin Images_slide widget
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

if ( ! class_exists( 'BuilderPress_SO_Images_slide' ) ) {
	/**
	 * Class BuilderPress_SO_Images_slide
	 */
	class BuilderPress_SO_Images_slide extends BuilderPress_SO_Widget {

		/**
		 * BuilderPress_SO_Images_slide constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Images_slide';

			parent::__construct();
		}
	}
}

add_action( 'widgets_init', 'builder_press_so_register_widget_images_slide' );

if ( ! function_exists( 'builder_press_so_register_widget_images_slide' ) ) {
	/**
	 * Register widget
	 */
	function builder_press_so_register_widget_images_slide() {
		register_widget( 'BuilderPress_SO_Images_slide' );
	}
}
