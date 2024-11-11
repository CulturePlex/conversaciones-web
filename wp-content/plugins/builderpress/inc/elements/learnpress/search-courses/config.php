<?php
/**
 * BuilderPress Search Posts config class
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

if ( ! class_exists( 'BuilderPress_Config_Search_Courses' ) ) {
	/**
	 * Class BuilderPress_Config_Search_Courses
	 */
	class BuilderPress_Config_Search_Courses extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_Search_Posts constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'search-courses';
			$this->name = __( 'Search Courses', 'builderpress' );
			$this->desc = __( 'Display a Search Courses form', 'builderpress' );

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
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Layout', 'builderpress' ),
                    'param_name'  => 'layout',
                    'save_always' => true,
                    'value'       => array(
                        esc_html__( 'Layout 1', 'builderpress' )    => 'layout-1'
                    ),
                    'std'         => 'layout-1'
                ),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Title', 'builderpress' ),
					'param_name'  => 'title',
					'admin_label' => true,
                    //'std'         => __( 'This is title', 'builderpress' ),
				),
                array(
                    'type'        => 'textfield',
                    'heading'     => __( 'Placeholder', 'builderpress' ),
                    'param_name'  => 'placeholder',
                    'admin_label' => true,
                    'std'        => __( 'What are you looking for?', 'builderpress' ),
                    'dependency' => array(
                        'element' => 'layout',
                        'value'   => array(
                            'layout-2',
                        ),
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
                    'type'             => 'checkbox',
                    'heading'          => esc_html__( 'Show number favorite', 'builderpress' ),
                    'param_name'       => 'show_number_favorite',
                    'std'              => false,
                    'admin_label'      => true,
                    'dependency' => array(
                        'element' => 'layout',
                        'value'   => array(
                            'layout-1',
                        ),
                    ),
				),
                array(
                    'type' => 'css_editor',
                    'heading' => __( 'CSS Shortcode', 'js_composer' ),
                    'param_name' => 'at_css',
                    'group' => __( 'Design Options', 'js_composer' ),
                ),
                array(
                    'type'             => 'checkbox',
                    'heading'          => esc_html__( 'Show read more button', 'builderpress' ),
                    'param_name'       => 'show_readmore',
                    'std'              => true,
                    'admin_label'      => true,
                    'dependency' => array(
                        'element' => 'layout',
                        'value'   => array(
                            'layout-grid',
                            'layout-slider',
                        ),
                    ),
                    'edit_field_class' => 'vc_col-xs-4'
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
				'search-courses' => array(
					'src' => 'search-courses.css'
				)
			);
		}
		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'search-courses' => array(
					'src'  => 'search-courses.js',
					'deps' => array(
						'jquery'
					)
				)
			);
		}

	}
}
