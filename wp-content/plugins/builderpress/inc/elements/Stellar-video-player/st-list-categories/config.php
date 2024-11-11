<?php
/**
 * BuilderPress St-list-categories config class
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

if ( ! class_exists( 'BuilderPress_Config_St_list_categories' ) ) {
	/**
	 * Class BuilderPress_Config_St_list_categories
	 */
	class BuilderPress_Config_St_list_categories extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_St-list-categories constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'st-list-categories';
			$this->name = __( 'St-list-categories', 'builderpress' );
			$this->desc = __( 'Display st-list-categories', 'builderpress' );

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
                        'vblog-layout-slider-1' => $this->assets_url . 'images/layouts/vblog-layout-slider-1.jpg',
                        'vblog-layout-slider-2' => $this->assets_url . 'images/layouts/vblog-layout-slider-2.jpg',
                    ),
                    'std'        => 'vblog-layout-slider-2',
                    'admin_label'      => true,
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Title', 'builderpress' ),
                    'param_name'  => 'title',
                    'admin_label' => true,
                    //'std'         => __( 'This is title', 'builderpress' ),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Sub Title', 'builderpress' ),
                    'param_name'  => 'sub_title',
                    //'std'         => __( 'This is sub title', 'builderpress' ),
                ),
                array(
                    'type'             => 'number',
                    'heading'          => esc_html__( 'Number of videos', 'builderpress' ),
                    'param_name'       => 'number',
                    'std'              => '5',
                ),
                array(
                    'type'             => 'dropdown',
                    'heading'          => esc_html__( 'Parent Category', 'builderpress' ),
                    'param_name'       => 'parent_category',
                    'value'            => $this->_post_type_categories( 'category' ),
                ),
                array(
                    'type'             => 'dropdown',
                    'admin_label'      => false,
                    'heading'          => esc_html__( 'Type', 'builderpress' ),
                    'param_name'       => 'type_category',
                    'description'      => __( 'Select type of category.', 'builderpress' ),
                    'value'            => array(
                        esc_html__('All', 'builderpress')  => '',
                        esc_html__( 'Trending', 'builderpress' )    => 'trending',
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
				'st-list-categories' => array(
					'src' => 'st-list-categories.css'
				)
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'st-list-categories' => array(
					'src'  => 'st-list-categories.js',
					'deps' => array(
						'jquery'
					)
				)
			);
		}
	}
}
