<?php
/**
 * BuilderPress Siteorigin Login Popup widget
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
defined('ABSPATH') || exit;

if (!class_exists('BuilderPress_SO_Login_Popup')) {
    /**
     * Class BuilderPress_SO_Login_Popup
     */
    class BuilderPress_SO_Login_Popup extends BuilderPress_SO_Widget{
        /**
         * BuilderPress_SO_Login_Popup constructor.
         */
        public function __construct(){
            // set config class
            $this->config_class = 'BuilderPress_Config_Login_Popup';

            parent::__construct();
        }
    }
}

add_action( 'widgets_init', 'builder_press_so_register_widget_login_popup' );

if ( ! function_exists( 'builder_press_so_register_widget_login_popup' ) ) {
	/**
	 * Register widget
	 */
	function builder_press_so_register_widget_login_popup() {
		register_widget( 'BuilderPress_SO_Login_Popup' );
	}
}

