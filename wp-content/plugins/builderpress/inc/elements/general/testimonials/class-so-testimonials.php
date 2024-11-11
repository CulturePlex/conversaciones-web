<?php
/**
 * BuilderPress Siteorigin Testimonials widget
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

if ( ! class_exists( 'BuilderPress_SO_Testimonials' ) ) {
	/**
	 * Class BuilderPress_SO_Testimonials
	 */
	class BuilderPress_SO_Testimonials extends BuilderPress_SO_Widget {
		/**
		 * BuilderPress_SO_Testimonials constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Testimonials';

			parent::__construct();
		}
	}
}

add_action( 'widgets_init', 'builder_press_so_register_widget_testimonials' );

if ( ! function_exists( 'builder_press_so_register_widget_testimonials' ) ) {
	/**
	 * Register widget
	 */
	function builder_press_so_register_widget_testimonials() {
		register_widget( 'BuilderPress_SO_Testimonials' );
	}
}