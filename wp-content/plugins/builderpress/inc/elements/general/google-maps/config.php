<?php
/**
 * BuilderPress Google maps config class
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

if ( ! class_exists( 'BuilderPress_Config_Google_maps' ) ) {
	/**
	 * Class BuilderPress_Config_Google_maps
	 */
	class BuilderPress_Config_Google_maps extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_Google_maps constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'google-maps';
			$this->name = __( 'Google maps', 'builderpress' );
			$this->desc = __( 'Display google maps multi address', 'builderpress' );

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
                    'type'       => 'radio_image',
                    'heading'    => __( 'Layout', 'builderpress' ),
                    'param_name' => 'layout',
                    'options'    => array(
                        'layout-1' => $this->assets_url . 'images/layouts/layout-1.jpg',
                    ),
                    'std'        => 'layout-1'
                ),

                array(
                    'type'             => 'dropdown',
                    'heading'          => __( 'Display Map', 'builderpress' ),
                    'param_name'       => 'style_map',
                    'value'            => array(
                        esc_html__( 'Iframe', 'builderpress')    => 'map-iframe',
                        esc_html__( 'API key', 'builderpress' )   => 'map-api-key',
                    ),
                    'std'              => 'map-iframe',
                ),
                array(
                    'type'       => 'textarea_raw_html',
                    'heading'    => __( 'Iframe', 'builderpress' ),
                    'param_name' => 'iframe_src',
                    'dependency' => array(
                        'element' => 'style_map',
                        'value'   => array(
                            'map-iframe',
                        )
                    ),
                ),

                array(
                    'type'       => 'textarea',
                    'heading'    => __( 'Place', 'builderpress' ),
                    'param_name' => 'iframe_place',
                    'dependency' => array(
                        'element' => 'style_map',
                        'value'   => array(
                            'map-iframe',
                        )
                    ),
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Phone number', 'builderpress' ),
                    'param_name' => 'iframe_phone_place',
                    'dependency' => array(
                        'element' => 'style_map',
                        'value'   => array(
                            'map-iframe',
                        )
                    ),
                ),
                array(
                    'type'             => 'textfield',
                    'heading'          => __( 'Email address', 'builderpress' ),
                    'param_name'       => 'iframe_email_place',
                    'dependency' => array(
                        'element' => 'style_map',
                        'value'   => array(
                            'map-iframe',
                        )
                    ),
                ),
	            array(
		            'type'       => 'textarea',
		            'heading'    => __( 'Content', 'builderpress' ),
		            'param_name' => 'map_center',
		            'dependency' => array(
			            'element' => 'style_map',
			            'value'   => array(
				            'map-api-key',
			            )
		            ),
	            ),

                array(
                    'type'             => 'textfield',
                    'heading'          => __( 'API key', 'builderpress' ),
                    'param_name'       => 'api_key',
                    'dependency' => array(
                        'element' => 'style_map',
                        'value'   => array(
                            'map-api-key',
                        )
                    ),
                ),
                array(
                    'type'             => 'attach_image',
                    'heading'          => esc_html__( 'Marker icon', 'builderpress' ),
                    'param_name'       => 'marker_icon',
                    'dependency' => array(
	                    'element' => 'style_map',
	                    'value'   => array(
		                    'map-api-key',
	                    )
                    ),
                ),
                array(
                    'type'       => 'number',
                    'heading'    => __( 'Height', 'builderpress' ),
                    'param_name' => 'height',
                 ),

                array(
                    'type'       => 'param_group',
                    'heading'    => __( 'List Address', 'builderpress' ),
                    'param_name' => 'list_address',
                    'params'     => array(
                        array(
                            'type'       => 'textarea',
                            'heading'    => __( 'Place', 'builderpress' ),
                            'param_name' => 'place'
                        ),
                        array(
                            'type'       => 'textfield',
                            'heading'    => __( 'Title place', 'builderpress' ),
                            'param_name' => 'title_place'
                        ),
                        array(
                            'type'       => 'textfield',
                            'heading'    => __( 'Phone number', 'builderpress' ),
                            'param_name' => 'phone_place'
                        ),
                        array(
                            'type'             => 'textfield',
                            'heading'          => __( 'Email address', 'builderpress' ),
                            'param_name'       => 'email_place',
                        ),
                    ),
                    'dependency' => array(
                        'element' => 'style_map',
                        'value'   => array(
                            'map-api-key',
                        )
                    ),
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
				'google-maps' => array(
					'src' => 'google-maps.css'
				)
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'google-maps' => array(
					'src'  => 'google-maps.js',
					'deps' => array(
						'jquery'
					)
				)
			);
		}
	}
}
