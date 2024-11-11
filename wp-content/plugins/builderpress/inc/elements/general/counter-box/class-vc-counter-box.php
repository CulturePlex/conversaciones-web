<?php
/**
 * BuilderPress Visual Composer Counter Box shortcode
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

if ( ! class_exists( 'BuilderPress_VC_Counter_Box' ) ) {
	/**
	 * Class BuilderPress_VC_Counter_Box
	 */
	class BuilderPress_VC_Counter_Box extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_Brands constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Counter_Box';

			parent::__construct();
		}
	}
}

new BuilderPress_VC_Counter_Box();