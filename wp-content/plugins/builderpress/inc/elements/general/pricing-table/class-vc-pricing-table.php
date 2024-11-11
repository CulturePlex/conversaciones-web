<?php
/**
 * BuilderPress Visual Composer Pricing Table shortcode
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

if ( ! class_exists( 'BuilderPress_VC_Pricing_Table' ) ) {
	/**
	 * Class BuilderPress_VC_Pricing_Table
	 */
	class BuilderPress_VC_Pricing_Table extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_Pricing_Table constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Pricing_Table';

			parent::__construct();
		}
	}
}

new BuilderPress_VC_Pricing_Table();