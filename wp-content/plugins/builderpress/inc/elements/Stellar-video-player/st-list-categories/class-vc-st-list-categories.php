<?php
/**
 * BuilderPress Visual Composer St-list-categories shortcode
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

if ( ! class_exists( 'BuilderPress_VC_St_list_categories' ) ) {
	/**
	 * Class BuilderPress_VC_St_list_categories
	 */
	class BuilderPress_VC_St_list_categories extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_St_list_categories constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_St_list_categories';

			parent::__construct();
		}
	}
}

new BuilderPress_VC_St_list_categories();