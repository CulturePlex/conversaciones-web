<?php
/**
 * BuilderPress St-list-videos config class
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

if ( ! class_exists( 'BuilderPress_Config_St_list_videos' ) ) {
	/**
	 * Class BuilderPress_Config_St_list_videos
	 */
	class BuilderPress_Config_St_list_videos extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_St_list_videos constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'st-list-videos';
			$this->name = __( 'St list videos', 'builderpress' );
			$this->desc = __( 'Display list videos', 'builderpress' );

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
                        'vblog-layout-1'        => $this->assets_url . 'images/layouts/layout-1.jpg',
                        'vblog-layout-1-1'      => $this->assets_url . 'images/layouts/vblog-layout-1-1.jpg',
                        'vblog-layout-slider-1' => $this->assets_url . 'images/layouts/vblog-layout-slider-1.jpg',
                        'vblog-layout-slider-2' => $this->assets_url . 'images/layouts/vblog-layout-slider-2.jpg',
                        'vblog-layout-grid-1'   => $this->assets_url . 'images/layouts/vblog-layout-grid-1.jpg',
                        'vblog-layout-grid-2'   => $this->assets_url . 'images/layouts/vblog-layout-grid-2.jpg',
                        'vblog-layout-grid-3'   => $this->assets_url . 'images/layouts/vblog-layout-grid-3.png',
                        'vblog-layout-2'        => $this->assets_url . 'images/layouts/vblog-layout-2.jpg',
                        'vblog-layout-3'        => $this->assets_url . 'images/layouts/vblog-layout-3.jpg',
                        'vblog-layout-slider-4' => $this->assets_url . 'images/layouts/vblog-layout-slider-4.png',
                        'vblog-layout-slider-3' => $this->assets_url . 'images/layouts/vblog-layout-slider-3.png'
                    ),
                    'std'        => 'vblog-layout-1',
                    'admin_label'      => true,
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Title', 'builderpress' ),
                    'param_name'  => 'title',
                    'admin_label' => true,
                    //'std'         => __( 'This is title', 'builderpress' )
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Sub Title', 'builderpress' ),
                    'param_name'  => 'sub_title',
                    'dependency' => array(
                        'element' => 'layout',
                        'value'   => array('vblog-layout-slider-1'),
                    ),
                    'std'         => __( 'This is sub title', 'builderpress' ),
                    'edit_field_class' => 'vc_col-sm-6'
                ),
                array(
                    'type'       => 'vc_link',
                    'heading'    => __( 'Link All', 'builderpress' ),
                    'param_name' => 'link_all',
                    'dependency' => array(
                        'element' => 'layout',
                        'value'   => array(
                            'vblog-layout-slider-1',
                            'vblog-layout-grid-1',
                            'vblog-layout-grid-2'
                        )
                    ),
                    'edit_field_class' => 'vc_col-sm-6'
                ),
                array(
                    'type'             => 'number',
                    'heading'          => esc_html__( 'Number of videos', 'builderpress' ),
                    'param_name'       => 'number',
                    'std'              => '5',
                ),
                array(
                    'type'             => 'dropdown',
                    'heading'          => esc_html__( 'Category', 'builderpress' ),
                    'param_name'       => 'category',
                    'value'            => $this->_post_type_categories( 'category' ),
                ),
                array(
                    'type'             => 'dropdown',
                    'heading'          => esc_html__( 'Type', 'builderpress' ),
                    'param_name'       => 'type',
                    'value'            => $this->_post_type_categories( 'type' ),
                ),
                array(
                    'type'             => 'checkbox',
                    'heading'          => esc_html__( 'Show filter category', 'builderpress' ),
                    'param_name'       => 'filter_categories',
                    'std'              => false,
                    'dependency' => array(
                        'element' => 'layout',
                        'value'   => array('vblog-layout-grid-1', 'vblog-layout-grid-2', 'vblog-layout-3', 'vblog-layout-grid-3'),
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
				'st-list-videos' => array(
					'src' => 'st-list-videos.css'
				)
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'st-list-videos' => array(
					'src'  => 'st-list-videos.js',
					'deps' => array(
						'jquery',
                        'builder-press-isotope',
                        'builder-press-magnific-popup'
					)
				)
			);
		}
	}
}
