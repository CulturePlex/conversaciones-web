<?php
/**
 * BuilderPress Siteorigin Learnpress List Instructors widget
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

if ( ! class_exists( 'BuilderPress_SO_List_Instructors' ) ) {
	/**
	 * Class BuilderPress_SO_List_Instructors
	 */
	class BuilderPress_SO_List_Instructors extends BuilderPress_SO_Widget {

		/**
		 * BuilderPress_SO_List_Instructors constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_List_Instructors';

			parent::__construct();
		}
	}
}

add_action( 'widgets_init', 'builder_press_so_register_widget_list_instructors' );

if ( ! function_exists( 'builder_press_so_register_widget_list_instructors' ) ) {
	/**
	 * Register widget
	 */
	function builder_press_so_register_widget_list_instructors() {
		register_widget( 'BuilderPress_SO_List_Instructors' );
	}
}
