<?php
/**
 * BuilderPress Learnpress Course Collections config class
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

if ( ! class_exists( 'BuilderPress_Config_Course_Collections' ) ) {
	/**
	 * Class BuilderPress_Config_Course_Collections
	 */
	class BuilderPress_Config_Course_Collections extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_Course_Collections constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'course-collections';
			$this->name = __( 'Course Collections', 'builderpress' );
			$this->desc = __( 'Display LearnPress list course collections', 'builderpress' );

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
			// get collections
			$thim_collections     = get_posts( array(
				'posts_per_page' => - 1,
				'post_type'      => 'lp_collection'
			) );
			$thim_collections_arr = array();
			foreach ( $thim_collections as $collection ) {
				$thim_collections_arr[] = array(
					'value' => $collection->ID,
					'label' => $collection->post_title,
				);
			}

			// options
			return $options = array_merge( array(

                array(
                    'type'        => 'radio_image',
                    'heading'     => __( 'Layout', 'builderpress' ),
                    'param_name'  => 'layout',
                    'options'     => array(
                        'layout-slider'   => $this->assets_url . 'images/layouts/layout-slider-1.jpg',
                        'layout-slider-2' => $this->assets_url . 'images/layouts/layout-slider-2.jpg',
                        'layout-grid'     => $this->assets_url . 'images/layouts/layout-grid.png',
                        'stocklab-layout-slider-3' => $this->assets_url . 'images/layouts/stocklab-layout-slider-3.png',
                    ),
                    'std'         => 'layout-slider',
                    'description' => __( 'Select type of style.', 'builderpress' )
                ),
                array(
                    'type'        => 'vc_link',
                    'heading'     => esc_html__( 'Link', 'builderpress' ),
                    'param_name'  => 'course_link',
                    'dependency' => array(
                        'element' => 'layout',
                        'value'   => array(
                            'layout-grid',
                        ),
                    ),
                    'admin_label' => true
                ),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Type Get Collections', 'builderpress' ),
					'param_name'  => 'type_get',
					'save_always' => true,
					'value'       => array(
						esc_html__( 'default', 'builderpress' ) => 'default',
						esc_html__( 'Custom', 'builderpress' )  => 'custom',
					),
					'std'         => 'default',
				),

				array(
					'type'        => 'autocomplete',
					'heading'     => esc_html__( 'Input Collection Name', 'builderpress' ),
					'param_name'  => 'collections_id',
					'admin_label' => true,
					'description' => __( 'Add Post by title.', 'builderpress' ),
					'settings'    => array(
						'multiple' => true,
						'sortable' => true,
						'groups'   => true,
						'values'   => $thim_collections_arr
					),
					'dependency'  => array(
						'element' => 'type_get',
						'value'   => array(
							'custom',
						),
					),
				),
				array(
					'type'       => 'number',
					'heading'    => esc_html__( 'Number Items', 'builderpress' ),
					'param_name' => 'number_items',
					'value'      => 8,
                    'edit_field_class' => 'vc_col-sm-6',
					'dependency'  => array(
						'element' => 'type_get',
						'value'   => array(
							'default',
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
                )
			),
				// config slider number items
				$this->_number_items_options()
			);

		}

		/**
		 * @return array|mixed
		 */
		public function get_styles() {
			return array(
				'course-collections' => array(
					'src' => 'course-collections.css'
				)
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'course-collections' => array(
					'src'  => 'course-collections.js',
					'deps' => array(
						'builder-press-slick'
					),
					'deps_src' => array(
						'builder-press-slick' => BUILDER_PRESS_URL . 'assets/libs/slick/slick.min.js'
					)
				)
			);
		}
	}
}
