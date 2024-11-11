<?php
/**
 * BuilderPress Visual Composer Learnpress Course Reviews shortcode
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

if ( ! class_exists( 'BuilderPress_VC_Course_Reviews' ) ) {
	/**
	 * Class BuilderPress_VC_Course_Reviews
	 */
	class BuilderPress_VC_Course_Reviews extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_Course_Reviews constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Course_Reviews';

			parent::__construct();
		}
	}
}

new BuilderPress_VC_Course_Reviews();