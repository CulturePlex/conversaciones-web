<?php
/**
 * BuilderPress Siteorigin Google Map widget
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

if (!class_exists('BuilderPress_SO_Google_Map')) {
    /**
     * Class BuilderPress_SO_Google_Map
     */
    class BuilderPress_SO_Google_Map extends BuilderPress_SO_Widget{
        /**
         * BuilderPress_SO_Google_Map constructor.
         */
        public function __construct(){
            // set config class
            $this->config_class = 'BuilderPress_Config_Google_Map';

            parent::__construct();
        }
    }
}

add_action( 'widgets_init', 'builder_press_so_register_widget_google_map' );

if ( ! function_exists( 'builder_press_so_register_widget_google_map' ) ) {
	/**
	 * Register widget
	 */
	function builder_press_so_register_widget_google_map() {
		register_widget( 'BuilderPress_SO_Google_Map' );
	}
}
