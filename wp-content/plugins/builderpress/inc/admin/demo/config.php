<?php
/**
 * BuilderPress Demo config class
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

if ( ! class_exists( 'BuilderPress_Config_Demo' ) ) {
	/**
	 * Class BuilderPress_Config_Demo
	 */
	class BuilderPress_Config_Demo extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_Demo constructor.
		 */
		public function __construct() {
			// info
			self::$base = 'demo';
			self::$name = __( 'Demo', 'builderpress' );
			self::$desc = __( 'Display demo', 'builderpress' );

			parent::__construct();
		}

		/**
		 * @return array
		 */
		public function get_options() {

            // options
            return array(

                array(
                    'type'       => 'radio_image',
                    'heading'    => __( 'Layout', 'builderpress' ),
                    'param_name' => 'layout',
                    'options'    => array(
                        'layout-1' => self::$assets_url . 'images/layouts/layout-1.png',
                    ),
                    'std'        => 'layout-1'
                ),

                array(
                    'type' => 'css_editor',
                    'heading' => __( 'CSS Shortcode', 'js_composer' ),
                    'param_name' => 'bp_css',
                    'group' => __( 'Design Options', 'js_composer' ),
                ),

                array(
                    'type' => 'css_editor',
                    'heading' => __( 'CSS on Tablet', 'js_composer' ),
                    'param_name' => 'bp_css_tablet',
                    'group' => __( 'Design Options', 'js_composer' ),
                ),

                array(
                    'type' => 'css_editor',
                    'heading' => __( 'CSS on Mobile', 'js_composer' ),
                    'param_name' => 'bp_css_mobile',
                    'group' => __( 'Design Options', 'js_composer' ),
                ),
            );
		}

		/**
		 * @return array|mixed
		 */
		public function get_styles() {
			return array(
				'demo' => array(
					'src' => 'demo.css'
				)
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'demo' => array(
					'src'  => 'demo.js',
					'deps' => array(
						'jquery'
					)
				)
			);
		}
	}
}