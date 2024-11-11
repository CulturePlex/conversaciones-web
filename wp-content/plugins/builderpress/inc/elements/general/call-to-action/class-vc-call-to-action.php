<?php
/**
 * BuilderPress Visual Composer Call To Action shortcode
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

if ( ! class_exists( 'BuilderPress_VC_Call_To_Action' ) ) {
	/**
	 * Class BuilderPress_VC_Call_To_Action
	 */
	class BuilderPress_VC_Call_To_Action extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_Call_To_Action constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Call_To_Action';

			parent::__construct();
		}
	}
}

new BuilderPress_VC_Call_To_Action();