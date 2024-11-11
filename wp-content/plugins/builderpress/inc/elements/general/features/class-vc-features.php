<?php
/**
 * BuilderPress Visual Composer Features shortcode
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

if ( ! class_exists( 'BuilderPress_VC_Features' ) ) {
	/**
	 * Class BuilderPress_VC_Features
	 */
	class BuilderPress_VC_Features extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_Features constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Features';

			parent::__construct();
		}
	}
}

new BuilderPress_VC_Features();