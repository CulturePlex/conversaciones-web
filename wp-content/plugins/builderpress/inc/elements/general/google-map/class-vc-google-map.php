<?php
/**
 * BuilderPress Visual Composer Google Map shortcode
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

if ( ! class_exists( 'BuilderPress_VC_Google_Map' ) ) {
	/**
	 * Class BuilderPress_VC_Google_Map
	 */
	class BuilderPress_VC_Google_Map extends BuilderPress_VC_Shortcode {

		/**
		 * BuilderPress_VC_Google_Map constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'BuilderPress_Config_Google_Map';

			parent::__construct();
		}

		/**
		 * @param $atts
		 *
		 * @return string
		 */
		public function shortcode( $atts ) {
			// get params form shortcode atts
			$params = $this->_handle_attrs($atts);

			$params['json_style'] = $params['json_style'] ? json_encode( json_decode( rawurldecode( base64_decode( strip_tags( $params['json_style'] ) ) ), true ) ) : '';

			return parent::output( $params );
		}
	}
}

new BuilderPress_VC_Google_Map();