<?php
/**
 * BuilderPress Visual Composer Product-isotope shortcode
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

if ( ! class_exists( 'BuilderPress_VC_Product_Isotope' ) ) {
	/**
	 * Class BuilderPress_VC_Product-isotope
	 */
	class BuilderPress_VC_Product_Isotope extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_Product-isotope constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Product_Isotope';

			parent::__construct();
		}
	}
}

new BuilderPress_VC_Product_Isotope();