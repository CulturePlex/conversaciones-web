<?php
/**
 * BuilderPress Visual Composer Learnpress Course Details shortcode
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

if ( ! class_exists( 'BuilderPress_VC_Course_Details' ) ) {
	/**
	 * Class BuilderPress_VC_Course_Details
	 */
	class BuilderPress_VC_Course_Details extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_Course_Details constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Course_Details';

			parent::__construct();
		}
	}
}

new BuilderPress_VC_Course_Details();