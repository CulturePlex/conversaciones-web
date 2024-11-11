<?php
/**
 * BuilderPress Visual Composer Search Posts shortcode
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

if ( ! class_exists( 'BuilderPress_VC_Search_Posts' ) ) {
	/**
	 * Class BuilderPress_VC_Search_Posts
	 */
	class BuilderPress_VC_Search_Posts extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_Search_Posts constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Search_Posts';

			parent::__construct();

		}

	}
}

new BuilderPress_VC_Search_Posts();