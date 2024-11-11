<?php
/**
 * BuilderPress Visual Composer Learnpress List Instructors shortcode
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

if ( ! class_exists( 'BuilderPress_VC_List_Instructors' ) ) {
	/**
	 * Class BuilderPress_VC_List_Instructors
	 */
	class BuilderPress_VC_List_Instructors extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_List_Instructors constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_List_Instructors';

			parent::__construct();
		}
	}
}

new BuilderPress_VC_List_Instructors();