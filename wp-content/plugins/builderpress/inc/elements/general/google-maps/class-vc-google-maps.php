<?php
/**
 * BuilderPress Visual Composer Google_maps shortcode
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

if ( ! class_exists( 'BuilderPress_VC_Google_maps' ) ) {
	/**
	 * Class BuilderPress_VC_Google_maps
	 */
	class BuilderPress_VC_Google_maps extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_Google_maps constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Google_maps';

			parent::__construct();
		}
	}
}

new BuilderPress_VC_Google_maps();