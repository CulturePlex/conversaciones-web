<?php
/**
 * BuilderPress Visual Composer Slide Image Box shortcode
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

if ( ! class_exists( 'BuilderPress_VC_Slide_Image_Box' ) ) {
	/**
	 * Class BuilderPress_VC_Slide_Image_Box
	 */
	class BuilderPress_VC_Slide_Image_Box extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_Slide_Image_Box constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Slide_Image_Box';

			parent::__construct();
		}
	}
}

new BuilderPress_VC_Slide_Image_Box();