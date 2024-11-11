<?php
/**
 * BuilderPress Visual Composer Images_slide shortcode
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

if ( ! class_exists( 'BuilderPress_VC_Images_slide' ) ) {
	/**
	 * Class BuilderPress_VC_Images_slide
	 */
	class BuilderPress_VC_Images_slide extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_Images_slide constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Images_slide';

			parent::__construct();
		}
	}
}

new BuilderPress_VC_Images_slide();