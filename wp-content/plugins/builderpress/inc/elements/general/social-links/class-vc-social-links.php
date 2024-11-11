<?php
/**
 * BuilderPress Visual Composer Social Links shortcode
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

if ( ! class_exists( 'BuilderPress_VC_Social_Links' ) ) {
	/**
	 * Class BuilderPress_VC_Social_Links
	 */
	class BuilderPress_VC_Social_Links extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_Social_Links constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Social_Links';

			parent::__construct();
		}
	}
}

new BuilderPress_VC_Social_Links();