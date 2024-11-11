<?php
/**
 * BuilderPress Visual Composer St-search-videos shortcode
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

if ( ! class_exists( 'BuilderPress_VC_Newsletter' ) ) {
	/**
	 * Class BuilderPress_VC_Newsletter
	 */
	class BuilderPress_VC_Newsletter extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_Newsletter constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Newsletter';

			parent::__construct();
		}

	}
}

new BuilderPress_VC_Newsletter();