<?php
/**
 * BuilderPress Visual Composer Accordion shortcode
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

if ( ! class_exists( 'BuilderPress_VC_Accordion' ) ) {
	/**
	 * Class BuilderPress_VC_Accordion
	 */
	class BuilderPress_VC_Accordion extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_Accordion constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Accordion';

			parent::__construct();
		}
	}
}

new BuilderPress_VC_Accordion();