<?php
/**
 * BuilderPress Google Map config class
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

if ( ! class_exists( 'BuilderPress_Config_Google_Map' ) ) {
	/**
	 * Class BuilderPress_Config_Google_Map
	 */
	class BuilderPress_Config_Google_Map extends BuilderPress_Abstract_Config {
		/**
		 * BuilderPress_Config_Google_Map constructor.
		 */
		public function __construct() {

			// info
			$this->base = 'google-map';
			$this->name = __( 'Google Map', 'builderpress' );
			$this->desc = __( 'Display a Google Map location', 'builderpress' );

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
				// Map center
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Map center location', 'builderpress' ),
					'param_name'  => 'map_center',
					'admin_label' => true,
					'value'       => __( 'Paris', 'builderpress' ),
					'description' => __( 'Enter a location. It can be a town, city, country or exact address.', 'builderpress' )
				),
				// API
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Google Map API Key', 'builderpress' ),
					'param_name'  => 'api_key',
					'value'       => 'AIzaSyAW5xIv-4qwWvWHi1laXij0KwV6wiBfIlg',
					'description' => wp_kses( __( sprintf( 'Enter Google Map API Key. <a href="%1$s" target="_blank" >Get an API Key</a>', esc_url( 'https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key' ) ), 'builderpress' ), array(
						'a' => array(
							'href'   => array(),
							'target' => array()
						)
					) )
				),
				// Map height
				array(
					'type'             => 'number',
					'heading'          => __( 'Height', 'builderpress' ),
					'param_name'       => 'height',
					'min'              => 0,
					'value'            => 480,
					'suffix'           => 'px',
					'description'      => __( 'Height for viewing the location.', 'builderpress' ),
					'edit_field_class' => 'vc_col-sm-6'
				),

				// Zoom options
				array(
					'type'             => 'number',
					'heading'          => __( 'Zoom level', 'builderpress' ),
					'param_name'       => 'zoom',
					'min'              => 0,
					'max'              => 21,
					'value'            => 12,
					'description'      => __( 'From 0 (world level) to 21 (street level).', 'builderpress' ),
					'edit_field_class' => 'vc_col-sm-6'
				),

				// Other options
				array(
					'type'             => 'checkbox',
					'heading'          => __( 'Scroll to zoom', 'builderpress' ),
					'param_name'       => 'scroll_zoom',
					'description'      => __( 'Scrolling on the map to zoom in or out.', 'builderpress' ),
					'edit_field_class' => 'vc_col-sm-6',
					'std'              => false
				),

				// Other options
				array(
					'type'             => 'checkbox',
					'heading'          => __( 'Draggable', 'builderpress' ),
					'param_name'       => 'draggable',
					'description'      => __( 'Dragging mouse to move around the map.', 'builderpress' ),
					'edit_field_class' => 'vc_col-sm-6',
					'std'              => false
				),

				// Get marker
				array(
					'type'             => 'attach_image',
					'heading'          => __( 'Choose pinpoint marker icon', 'builderpress' ),
					'param_name'       => 'marker_icon',
					'edit_field_class' => 'vc_col-sm-6'
				),

				// Get Cover image
				array(
					'type'             => 'attach_image',
					'heading'          => __( 'Choose preload cover image', 'builderpress' ),
					'param_name'       => 'map_cover_image',
					'edit_field_class' => 'vc_col-sm-6'
				),

				// Style
				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Map Style', 'builderpress' ),
					'param_name' => 'map_style',
					'value'      => array(
						esc_attr__( 'Default', 'builderpress' )     => 'default',
						esc_attr__( 'Light', 'builderpress' )       => 'light',
						esc_attr__( 'Dark', 'builderpress' )        => 'dark',
						esc_attr__( 'Import JSON', 'builderpress' ) => 'import_json'
					),
					'std'        => 'default'
				),

				// Import JSON data
				array(
					'type'        => 'textarea_raw_html',
					'heading'     => __( 'JSON Data', 'builderpress' ),
					'param_name'  => 'json_style',
					'description' => sprintf( 'Paste in your <a href="%1$s" target="_blank" >JSON</a>', esc_url( 'https://mapstyle.withgoogle.com/' ) ),
					'dependency'  => array(
						'element' => 'map_style',
						'value'   => array( 'import_json' )
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
                )
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_styles() {
			return array(
				'google-map' => array(
					'src' => 'google-map.css'
				)
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'google-map' => array(
					'src'  => 'google-map.js',
					'deps' => array(
						'jquery'
					)
				)
			);
		}
	}
}
