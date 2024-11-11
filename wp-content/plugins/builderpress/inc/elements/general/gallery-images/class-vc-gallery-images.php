<?php
/**
 * BuilderPress Visual Composer Gallery-images shortcode
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

if ( ! class_exists( 'BuilderPress_VC_Gallery_Images' ) ) {
	/**
	 * Class BuilderPress_VC_Gallery_Images
	 */
	class BuilderPress_VC_Gallery_Images extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_Gallery_Images constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Gallery_images';

			parent::__construct();
		}
	}
}

new BuilderPress_VC_Gallery_Images();