<?php
/**
 * BuilderPress Visual Composer Our Works shortcode
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

if ( ! class_exists( 'BuilderPress_VC_Our_Works' ) ) {
	/**
	 * Class BuilderPress_VC_Our_Works
	 */
	class BuilderPress_VC_Our_Works extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_Our_Works constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Our_Works';

			parent::__construct();
		}
	}
}

new BuilderPress_VC_Our_Works();