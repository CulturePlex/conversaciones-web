<?php
/**
 * BuilderPress Visual Composer Grid Images shortcode
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

if ( ! class_exists( 'BuilderPress_VC_Grid_Images' ) ) {
	/**
	 * Class BuilderPress_VC_Grid_Images
	 */
	class BuilderPress_VC_Grid_Images extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_Grid_Images constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Grid_Images';

			parent::__construct();
		}
	}
}

new BuilderPress_VC_Grid_Images();