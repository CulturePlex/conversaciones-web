<?php
/**
 * BuilderPress Visual Composer WP Events Manager List Events shortcode
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

if ( ! class_exists( 'BuilderPress_VC_List_Events' ) ) {
	/**
	 * Class BuilderPress_VC_List_Events
	 */
	class BuilderPress_VC_List_Events extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_List_Events constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_List_Events';

			parent::__construct();
		}
	}
}

new BuilderPress_VC_List_Events();