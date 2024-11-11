<?php
/**
 * BuilderPress Visual Composer Learnpress Course Collections shortcode
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

if ( ! class_exists( 'BuilderPress_VC_Course_Collections' ) ) {
	/**
	 * Class BuilderPress_VC_Course_Collections
	 */
	class BuilderPress_VC_Course_Collections extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_Course_Collections constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Course_Collections';

			parent::__construct();
		}
	}
}

new BuilderPress_VC_Course_Collections();