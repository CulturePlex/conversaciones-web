<?php
/**
 * BuilderPress Visual Composer Button shortcode
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

if ( ! class_exists( 'BuilderPress_VC_Button' ) ) {
	/**
	 * Class BuilderPress_VC_Button
	 */
	class BuilderPress_VC_Button extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_Button constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Button';

			parent::__construct();
		}
	}
}

new BuilderPress_VC_Button();