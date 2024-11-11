<?php
/**
 * BuilderPress Visual Composer Our Team shortcode
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

if ( ! class_exists( 'BuilderPress_VC_Our_Team' ) ) {
	/**
	 * Class BuilderPress_VC_Our_Team
	 */
	class BuilderPress_VC_Our_Team extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_Our_Team constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Our_Team';

			parent::__construct();
		}
	}
}

new BuilderPress_VC_Our_Team();