<?php
/**
 * BuilderPress Siteorigin Features widget
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

if ( ! class_exists( 'BuilderPress_SO_Features' ) ) {
	/**
	 * Class BuilderPress_SO_Features
	 */
	class BuilderPress_SO_Features extends BuilderPress_SO_Widget {
		/**
		 * BuilderPress_SO_Features constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Features';

			parent::__construct();
		}
	}
}

add_action( 'widgets_init', 'builder_press_so_register_widget_features' );

if ( ! function_exists( 'builder_press_so_register_widget_features' ) ) {
	/**
	 * Register widget
	 */
	function builder_press_so_register_widget_features() {
		register_widget( 'BuilderPress_SO_Features' );
	}
}
