<?php
/**
 * BuilderPress Testimonials config class
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

if ( ! class_exists( 'BuilderPress_Config_Testimonials' ) ) {
	/**
	 * Class BuilderPress_Config_Testimonials
	 */
	class BuilderPress_Config_Testimonials extends BuilderPress_Abstract_Config {
		/**
		 * BuilderPress_Config_Testimonials constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'testimonials';
			$this->name = __( 'Testimonials', 'builderpress' );
			$this->desc = __( 'Display a testimonials box.', 'builderpress' );

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
			return $options = array_merge(
				array(
					array(
						'type'        => 'radio_image',
						'heading'     => __( 'Layout', 'builderpress' ),
						'param_name'  => 'layout',
						'options'     => array(
							'layout-slider-1'              => $this->assets_url . 'images/layouts/layout-1.jpg',
							'layout-slider-2'              => $this->assets_url . 'images/layouts/layout-2.jpg',
							'layout-slider-3'              => $this->assets_url . 'images/layouts/layout-3.jpg',
							'layout-slider-4'              => $this->assets_url . 'images/layouts/layout-slider-4.jpg',
							'layout-slider-5'              => $this->assets_url . 'images/layouts/layout-slider-5.jpg',
							'layout-slider-6'              => $this->assets_url . 'images/layouts/layout-6.png',
							'layout-slider-7'              => $this->assets_url . 'images/layouts/layout-7.png',
							'layout-slider-8'              => $this->assets_url . 'images/layouts/layout-8.png',
							'layout-slider-9'              => $this->assets_url . 'images/layouts/layout-9.png',
							'layout-slider-10'             => $this->assets_url . 'images/layouts/layout-10.png',
							'vblog-layout-slider-1'        => $this->assets_url . 'images/layouts/vblog-layout-slider-1.jpg',
							'kindergarten-layout-slider-2' => $this->assets_url . 'images/layouts/kindergarten-layout-slider-2.jpg',
							'marketing-layout-1'           => $this->assets_url . 'images/layouts/marketing-layout-1.jpg',
							'marketing-layout-2'           => $this->assets_url . 'images/layouts/marketing-layout-2.jpg',
						),
						'std'         => 'layout-slider-1',
						'description' => __( 'Select type of style.', 'builderpress' ),
					),
					array(
						'type'             => 'textfield',
						'heading'          => __( 'Title', 'builderpress' ),
						'param_name'       => 'title',
						'admin_label'      => true,
						'dependency'       => array(
							'element' => 'layout',
							'value'   => array( 'marketing-layout-2' ),
						),
						'edit_field_class' => 'vc_col-sm-6',

					),
					array(
						'type'       => 'param_group',
						'value'      => '',
						'heading'    => __( 'Testimonials', 'builderpress' ),
						'param_name' => 'testimonials',
						'params'     => array(
							array(
								'type'       => 'textfield',
								'heading'    => __( 'Name', 'builderpress' ),
								'param_name' => 'name',
								'std'        => __( 'John Doe', 'builderpress' ),
							),

							array(
								'type'             => 'attach_image',
								'heading'          => __( 'Image', 'builderpress' ),
								'param_name'       => 'image',
								'edit_field_class' => 'vc_col-sm-6',
							),

							array(
								'type'             => 'textfield',
								'heading'          => __( 'Website', 'builderpress' ),
								'param_name'       => 'website',
								'std'              => '#',
								'edit_field_class' => 'vc_col-sm-6',
							),

							array(
								'type'       => 'textfield',
								'heading'    => __( 'Info', 'builderpress' ),
								'param_name' => 'works',
								'std'        => __( 'Founder', 'builderpress' ),
							),

							array(
								'type'       => 'textarea',
								'heading'    => __( 'Content', 'builderpress' ),
								'param_name' => 'content',
								'value'      => '',
								'std'        => __( 'This is my first time to consult in this hospital and I’m lucky I got a perfect doctor who takes care of me since day one of my consultation, until the day of my surgery.', 'builderpress' ),
							),

							array(
								'type'       => 'number',
								'heading'    => __( 'Rating', 'builderpress' ),
								'param_name' => 'rating',
								'min'        => 0,
								'max'        => 5,
								'step'       => 0.5,
							),

						),
					),
					array(
						'type'       => 'attach_image',
						'heading'    => __( 'Image rating', 'builderpress' ),
						'param_name' => 'image_rating',
						'dependency' => array(
							'element' => 'layout',
							'value'   => array( 'layout-slider-9' ),
						),
					),

					array(
						'type'       => 'dropdown',
						'heading'    => __( 'Style Layout', 'builderpress' ),
						'param_name' => 'style_layout',
						'value'      => array(
							__( 'Style Default', 'builderpress' )   => '',
						),
						'std'        => '',
					),
					// Auto slide
					array(
						'type'             => 'checkbox',
						'heading'          => esc_html__( 'Auto Slide?', 'builderpress' ),
						'description'      => __( 'Set auto play for slide', 'builderpress' ),
						'param_name'       => 'auto_slide',
						'std'              => false,
						'edit_field_class' => 'vc_col-xs-6',
					),
					array(
						'type'             => 'number',
						'heading'          => esc_html__( 'Speed Auto', 'builderpress' ),
						'param_name'       => 'speed_auto',
						'std'              => '6000',
						'edit_field_class' => 'vc_col-xs-6',
					),
					array(
						'type'       => 'attach_image',
						'heading'    => __( 'Background', 'builderpress' ),
						'param_name' => 'background',
						'dependency' => array(
							'element' => 'layout',
							'value'   => array( 'layout-slider-4' ),
						),
					),
					array(
						'type'       => 'css_editor',
						'heading'    => __( 'CSS Shortcode', 'js_composer' ),
						'param_name' => 'bp_css',
						'group'      => __( 'Design Options', 'js_composer' ),
					),
				),
				// config slider number items
				$this->_number_items_options(
					array(
						'items_visible' => 1,
						'items_tablet'  => 1,
						'items_mobile'  => 1,
					)
				)
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_styles() {
			return array(
				'testimonials' => array(
					'src'  => 'testimonials.css',
					'deps' => array(
						'dashicons',
						'builder-press-slick',
					),
				),
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'testimonials' => array(
					'src'  => 'testimonials.js',
					'deps' => array(
						'jquery',
						'builder-press-slick',
					),
				),
			);
		}
	}
}
