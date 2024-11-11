<?php
/**
 * BuilderPress Visual Composer Event Calendar shortcode
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

if ( ! class_exists( 'BuilderPress_VC_Event_Calendar' ) ) {
	/**
	 * Class BuilderPress_VC_Event_Calendar
	 */
	class BuilderPress_VC_Event_Calendar extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_Event_Calendar constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Event_Calendar';

			parent::__construct();
		}
	}
}

new BuilderPress_VC_Event_Calendar();