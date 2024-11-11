<?php
/**
 * BuilderPress Siteorigin Google-maps widget
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

if ( ! class_exists( 'BuilderPress_SO_Google_maps' ) ) {
	/**
	 * Class BuilderPress_SO_Google_maps
	 */
	class BuilderPress_SO_Google_maps extends BuilderPress_SO_Widget {

		/**
		 * BuilderPress_SO_Google_maps constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Google_maps';

			parent::__construct();
		}
	}
}

add_action( 'widgets_init', 'builder_press_so_register_widget_google_maps' );

if ( ! function_exists( 'builder_press_so_register_widget_google_maps' ) ) {
	/**
	 * Register widget
	 */
	function builder_press_so_register_widget_google_maps() {
		register_widget( 'BuilderPress_SO_Google_maps' );
	}
}
