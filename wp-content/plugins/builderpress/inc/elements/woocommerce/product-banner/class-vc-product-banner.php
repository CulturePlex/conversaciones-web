<?php
/**
 * BuilderPress Visual Composer Product-banner shortcode
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

if ( ! class_exists( 'BuilderPress_VC_Product_Banner' ) ) {
	/**
	 * Class BuilderPress_VC_Product-banner
	 */
	class BuilderPress_VC_Product_Banner extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_Product-banner constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Product_Banner';

			parent::__construct();
		}
	}
}

new BuilderPress_VC_Product_Banner();