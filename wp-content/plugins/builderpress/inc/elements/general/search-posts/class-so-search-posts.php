<?php
/**
 * BuilderPress Siteorigin Search Posts widget
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

if (!class_exists('BuilderPress_SO_Search_Posts')) {
    /**
     * Class BuilderPress_SO_Search_Posts
     */
    class BuilderPress_SO_Search_Posts extends BuilderPress_SO_Widget{
        /**
         * BuilderPress_SO_Search_Posts constructor.
         */
        public function __construct(){
            // set config class
            $this->config_class = 'BuilderPress_Config_Search_Posts';

            parent::__construct();
        }
    }
}

add_action( 'widgets_init', 'builder_press_so_register_widget_search_posts' );

if ( ! function_exists( 'builder_press_so_register_widget_search_posts' ) ) {
	/**
	 * Register widget
	 */
	function builder_press_so_register_widget_search_posts() {
		register_widget( 'BuilderPress_SO_Search_Posts' );
	}
}
