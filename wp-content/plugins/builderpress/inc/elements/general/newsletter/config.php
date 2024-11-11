<?php
/**
 * BuilderPress St-search-videos config class
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

if ( ! class_exists( 'BuilderPress_Config_Newsletter' ) ) {
	/**
	 * Class BuilderPress_Config_St_newsletter
	 */
	class BuilderPress_Config_Newsletter extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_Newsletter constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'newsletter';
			$this->name = __( 'newsletter', 'builderpress' );
			$this->desc = __( 'Display Newsletter', 'builderpress' );

			parent::__construct();
		}

		/**
		 * @return array
		 */
		public function get_options() {
			static $options;
			if ( ! is_null( $options ) ) {
				return $options;
			}

			// options
			return $options = array(
                array(
                    'type'        => 'textfield',
                    'heading'     => __( 'Title', 'builderpress' ),
                    'param_name'  => 'title',
                    'std'         => __( 'Work with Passion', 'builderpress' ),
                    'admin_label' => true
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Shortcode', 'builderpress' ),
                    'param_name' => 'shortcode'
                ),
                array(
                    'type'             => 'dropdown',
                    'heading'          => __( 'Style Layout', 'builderpress' ),
                    'param_name'       => 'style_layout',
                    'value'            => array(
                        __( 'Style Default', 'builderpress' )   => '',
                    ),
                    'std'              => '',
                    'edit_field_class' => 'vc_col-sm-6'
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
				'newsletter' => array(
					'src' => 'newsletter.css'
				)
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'newsletter' => array(
					'src'  => 'newsletter.js',
					'deps' => array(
						'jquery'
					)
				)
			);
		}
	}
}
