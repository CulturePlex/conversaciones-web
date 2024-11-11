<?php
/**
 * BuilderPress Visual Composer Products shortcode
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

if ( ! class_exists( 'BuilderPress_VC_Products' ) ) {
	/**
	 * Class BuilderPress_VC_Products
	 */
	class BuilderPress_VC_Products extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_Products constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Products';

			parent::__construct();
		}
	}
}

new BuilderPress_VC_Products();