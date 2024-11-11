<?php
/**
 * BuilderPress Visual Composer Demo shortcode
 *
 * @version     1.0.0
 * @author      ThimPress
 * @package     BuilderPress/Classes
 * @category    Classes
 * @author      Thimpress, vinhnq
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'BuilderPress_VC_Demo' ) ) {
	/**
	 * Class BuilderPress_VC_Demo
	 */
	class BuilderPress_VC_Demo extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_Demo constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Demo';

			parent::__construct();
		}
	}
}

new BuilderPress_VC_Demo();