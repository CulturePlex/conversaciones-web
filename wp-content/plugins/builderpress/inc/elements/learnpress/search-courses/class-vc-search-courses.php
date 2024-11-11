<?php
/**
 * BuilderPress Visual Composer Search Courses shortcode
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

if ( ! class_exists( 'BuilderPress_VC_Search_Courses' ) ) {
	/**
	 * Class BuilderPress_VC_Search_Courses
	 */
	class BuilderPress_VC_Search_Courses extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_Search_Posts constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Search_Courses';

			parent::__construct();

		}


	}
}

new BuilderPress_VC_Search_Courses();