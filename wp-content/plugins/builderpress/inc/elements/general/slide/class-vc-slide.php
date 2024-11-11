<?php
/**
 * BuilderPress Visual Composer Slide shortcode
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

if ( ! class_exists( 'BuilderPress_VC_Slide' ) ) {
	/**
	 * Class BuilderPress_VC_Slide
	 */
	class BuilderPress_VC_Slide extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_Slide constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Slide';

			parent::__construct();
		}
	}
}

new BuilderPress_VC_Slide();