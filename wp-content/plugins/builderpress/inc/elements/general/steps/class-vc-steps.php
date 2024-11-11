<?php
/**
 * BuilderPress Visual Composer Steps shortcode
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

if ( ! class_exists( 'BuilderPress_VC_Steps' ) ) {
	/**
	 * Class BuilderPress_VC_Steps
	 */
	class BuilderPress_VC_Steps extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_Steps constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Steps';

			parent::__construct();
		}
	}
}

new BuilderPress_VC_Steps();