<?php
/**
 * BuilderPress Visual Composer Product-filter shortcode
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

if ( ! class_exists( 'BuilderPress_VC_Product_Filter' ) ) {
	/**
	 * Class BuilderPress_VC_Product-filter
	 */
	class BuilderPress_VC_Product_Filter extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_Product-filter constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Product_Filter';

			parent::__construct();
		}
	}
}

new BuilderPress_VC_Product_Filter();