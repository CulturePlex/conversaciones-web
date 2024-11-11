<?php
/**
 * BuilderPress Siteorigin Social Links widget
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

if (!class_exists('BuilderPress_SO_Social_Links')) {
    /**
     * Class BuilderPress_SO_Social_Links
     */
    class BuilderPress_SO_Social_Links extends BuilderPress_SO_Widget{
        /**
         * BuilderPress_SO_Social_Links constructor.
         */
        public function __construct(){
            // set config class
            $this->config_class = 'BuilderPress_Config_Social_Links';

            parent::__construct();
        }
    }
}

add_action( 'widgets_init', 'builder_press_so_register_widget_social_links' );

if ( ! function_exists( 'builder_press_so_register_widget_social_links' ) ) {
	/**
	 * Register widget
	 */
	function builder_press_so_register_widget_social_links() {
		register_widget( 'BuilderPress_SO_Social_Links' );
	}
}