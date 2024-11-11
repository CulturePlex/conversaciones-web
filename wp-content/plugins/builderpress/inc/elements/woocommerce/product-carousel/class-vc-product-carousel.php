<?php
/**
 * BuilderPress Visual Composer Woocommerce Product Carousel shortcode
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

if ( ! class_exists( 'BuilderPress_VC_Product_Carousel' ) ) {
	/**
	 * Class BuilderPress_VC_Product_Carousel
	 */
	class BuilderPress_VC_Product_Carousel extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_Product_Carousel constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Product_Carousel';

			parent::__construct();
		}
	}
}

new BuilderPress_VC_Product_Carousel();