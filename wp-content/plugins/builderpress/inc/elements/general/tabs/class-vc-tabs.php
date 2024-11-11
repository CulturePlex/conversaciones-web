<?php
/**
 * BuilderPress Visual Composer Tabs shortcode
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

if ( ! class_exists( 'BuilderPress_VC_Tabs' ) ) {
	/**
	 * Class BuilderPress_VC_Tabs
	 */
	class BuilderPress_VC_Tabs extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_Tabs constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Tabs';

			parent::__construct();
		}
	}
}

new BuilderPress_VC_Tabs();