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

if ( ! class_exists( 'BuilderPress_Config_St_search_videos' ) ) {
	/**
	 * Class BuilderPress_Config_St_search_videos
	 */
	class BuilderPress_Config_St_search_videos extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_St-search-videos constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'st-search-videos';
			$this->name = __( 'St-search-videos', 'builderpress' );
			$this->desc = __( 'Display st-search-videos', 'builderpress' );

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
                        'vblog-layout-header-1' => $this->assets_url . 'images/layouts/vblog-layout-header-1.jpg',
                        'vblog-layout-header-2' => $this->assets_url . 'images/layouts/vblog-layout-header-2.jpg',
                    ),
                    'std'        => 'vblog-layout-header-1'
                ),
                array(
                    'type'             => 'checkbox',
                    'heading'          => esc_html__( 'Show filter category', 'builderpress' ),
                    'param_name'       => 'show_filter_category',
                    'std'              => false,
                ),
                array(
                    'type'             => 'dropdown',
                    'heading'          => esc_html__( 'Parent Category', 'builderpress' ),
                    'param_name'       => 'parent_category',
                    'value'            => $this->_post_type_categories( 'category' ),
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
				'st-search-videos' => array(
					'src' => 'st-search-videos.css'
				)
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'st-search-videos' => array(
					'src'  => 'st-search-videos.js',
					'deps' => array(
						'jquery'
					)
				)
			);
		}
	}
}
