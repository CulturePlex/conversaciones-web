<?php
/**
 * BuilderPress Visual Composer Login Form shortcode
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

if ( ! class_exists( 'BuilderPress_VC_Login_Form' ) ) {
	/**
	 * Class BuilderPress_VC_Login_Form
	 */
	class BuilderPress_VC_Login_Form extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_Login_Form constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Login_Form';

			parent::__construct();
		}
	}
}

new BuilderPress_VC_Login_Form();