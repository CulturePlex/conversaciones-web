<?php
/**
 * BuilderPress Siteorigin Services widget
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

if ( ! class_exists( 'BuilderPress_SO_Services' ) ) {
    /**
     * Class BuilderPress_SO_Services
     */
    class BuilderPress_SO_Services extends BuilderPress_SO_Widget {

        /**
         * BuilderPress_SO_Services constructor.
         */
        public function __construct() {
            // set config class
            $this->config_class = 'BuilderPress_Config_Services';

            parent::__construct();
        }
    }
}

add_action( 'widgets_init', 'builder_press_so_register_widget_services' );

if ( ! function_exists( 'builder_press_so_register_widget_services' ) ) {
	/**
	 * Register widget
	 */
	function builder_press_so_register_widget_services() {
		register_widget( 'BuilderPress_SO_Services' );
	}
}