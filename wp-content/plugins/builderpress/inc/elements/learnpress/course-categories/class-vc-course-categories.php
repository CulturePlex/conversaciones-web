<?php
/**
 * BuilderPress Visual Composer Course Categories shortcode
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

if ( ! class_exists( 'BuilderPress_VC_Course_Categories' ) ) {
	/**
	 * Class BuilderPress_VC_Course_Categories
	 */
	class BuilderPress_VC_Course_Categories extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_Course_Categories constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Course_Categories';

			parent::__construct();
		}
	}
}

new BuilderPress_VC_Course_Categories();