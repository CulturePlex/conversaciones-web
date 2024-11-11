<?php
/**
 * BuilderPress Siteorigin Login Form widget
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

if ( ! class_exists( 'BuilderPress_SO_Login_Form' ) ) {
	/**
	 * Class BuilderPress_SO_Login_Form
	 */
	class BuilderPress_SO_Login_Form extends BuilderPress_SO_Widget {

		/**
		 * BuilderPress_SO_Login_Form constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Login_Form';

			parent::__construct();
		}
	}
}

add_action( 'widgets_init', 'builder_press_so_register_widget_login_form' );

if ( ! function_exists( 'builder_press_so_register_widget_login_form' ) ) {
	/**
	 * Register widget
	 */
	function builder_press_so_register_widget_login_form() {
		register_widget( 'BuilderPress_SO_Login_Form' );
	}
}
