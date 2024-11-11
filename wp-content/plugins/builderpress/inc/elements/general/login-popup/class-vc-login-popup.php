<?php
/**
 * BuilderPress Visual Composer Login Popup shortcode
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

if ( ! class_exists( 'BuilderPress_VC_Login_Popup' ) ) {
	/**
	 * Class BuilderPress_VC_Login_Popup
	 */
	class BuilderPress_VC_Login_Popup extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_Login_Popup constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Login_Popup';

			parent::__construct();
		}
	}
}

new BuilderPress_VC_Login_Popup();