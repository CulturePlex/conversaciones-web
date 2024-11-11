<?php
/**
 * BuilderPress Visual Composer Learnpress List Courses shortcode
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

if ( ! class_exists( 'BuilderPress_VC_List_Courses' ) ) {
	/**
	 * Class BuilderPress_VC_List_Courses
	 */
	class BuilderPress_VC_List_Courses extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_List_Courses constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_List_Courses';

			parent::__construct();
		}
	}
}

new BuilderPress_VC_List_Courses();