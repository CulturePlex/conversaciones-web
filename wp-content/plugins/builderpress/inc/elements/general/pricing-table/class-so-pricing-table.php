<?php
/**
 * BuilderPress Siteorigin Pricing Table widget
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

if (!class_exists('BuilderPress_SO_Pricing_Table')) {
    /**
     * Class BuilderPress_SO_Pricing_Table
     */
    class BuilderPress_SO_Pricing_Table extends BuilderPress_SO_Widget{
        /**
         * BuilderPress_SO_Pricing_Table constructor.
         */
        public function __construct(){
            // set config class
            $this->config_class = 'BuilderPress_Config_Pricing_Table';

            parent::__construct();
        }
    }
}

add_action( 'widgets_init', 'builder_press_so_register_widget_pricing_table' );

if ( ! function_exists( 'builder_press_so_register_widget_pricing_table' ) ) {
	/**
	 * Register widget
	 */
	function builder_press_so_register_widget_pricing_table() {
		register_widget( 'BuilderPress_SO_Pricing_Table' );
	}
}
