<?php
/**
 * BuilderPress Siteorigin St-search-videos widget
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

if ( ! class_exists( 'BuilderPress_SO_Newsletter' ) ) {
	/**
	 * Class BuilderPress_SO_Newsletter
	 */
	class BuilderPress_SO_Newsletter extends BuilderPress_SO_Widget {

		/**
		 * BuilderPress_SO_St_newsletter constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Newsletter';

			parent::__construct();
		}
	}
}

add_action( 'widgets_init', 'builder_press_so_register_widget_newsletter' );

if ( ! function_exists( 'builder_press_so_register_widget_newsletter' ) ) {
	/**
	 * Register widget
	 */
	function builder_press_so_register_widget_newsletter() {
		register_widget( 'BuilderPress_SO_Newsletter' );
	}
}
