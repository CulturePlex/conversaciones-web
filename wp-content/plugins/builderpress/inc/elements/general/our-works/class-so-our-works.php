<?php
/**
 * BuilderPress Siteorigin Our Works widget
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

if (!class_exists('BuilderPress_SO_Our_Works')) {
    /**
     * Class BuilderPress_SO_Our_Works
     */
    class BuilderPress_SO_Our_Works extends BuilderPress_SO_Widget{
        /**
         * BuilderPress_SO_Our_Works constructor.
         */
        public function __construct(){
            // set config class
            $this->config_class = 'BuilderPress_Config_Our_Works';

            parent::__construct();
        }
    }
}

add_action( 'widgets_init', 'builder_press_so_register_widget_our_works' );

if ( ! function_exists( 'builder_press_so_register_widget_our_works' ) ) {
	/**
	 * Register widget
	 */
	function builder_press_so_register_widget_our_works() {
		register_widget( 'BuilderPress_SO_Our_Works' );
	}
}
