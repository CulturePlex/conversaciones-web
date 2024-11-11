<?php
/**
 * BuilderPress Video Box config class
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

if ( ! class_exists( 'BuilderPress_Config_Video_Box' ) ) {
	/**
	 * Class BuilderPress_Config_Video_Box
	 */
	class BuilderPress_Config_Video_Box extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_Video_Box constructor.
		 */
		public function __construct() {

			// info
			$this->base = 'video-box';
			$this->name = __( 'Video Box', 'builderpress' );
			$this->desc = __( 'Display popup video box', 'builderpress' );

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
						'layout-2' => $this->assets_url . 'images/layouts/layout-2.jpg',
                        'layout-3' => $this->assets_url . 'images/layouts/layout-3.jpg',
                        'layout-4' => $this->assets_url . 'images/layouts/layout-4.jpg',
                        'layout-5' => $this->assets_url . 'images/layouts/layout-5.jpg',
                        'layout-6' => $this->assets_url . 'images/layouts/layout-6.png',
                        'layout-7' => $this->assets_url . 'images/layouts/layout-7.png',
                        'kindergarten-layout-1' => $this->assets_url . 'images/layouts/kindergarten-layout-1.jpg',
                        'marketing-layout-1' => $this->assets_url . 'images/layouts/marketing-layout-1.png'
					),
					'std'        => 'layout-1'
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Title', 'builderpress' ),
					'param_name' => 'title',
					'value'      => esc_html__( 'Your Business Great Again!', 'builderpress' )
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'SubTitle', 'builderpress' ),
					'param_name' => 'subtitle',
					'value'      => esc_html__( 'How do we make', 'builderpress' )
				),
				array(
					'type'       => 'vc_link',
					'heading'    => esc_html__( 'Sub Button', 'builderpress' ),
					'param_name' => 'sub_button',
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout-1' ),
					),
				),
				array(
					'type'       => 'vc_link',
					'heading'    => esc_html__( 'Video Button', 'builderpress' ),
					'param_name' => 'video_button'
				),
				array(
					'type'       => 'attach_image',
					'heading'    => esc_html__( 'Background Image', 'builderpress' ),
					'param_name' => 'background_img'
				),

                array(
                    'type'       => 'attach_image',
                    'heading'    => esc_html__( 'Background Image Overlay', 'builderpress' ),
                    'param_name' => 'background_img_overlay',
                    'dependency' => array(
                        'element' => 'layout',
                        'value'   => 'kindergarten-layout-1'
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
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_styles() {
			return array(
				'video-box' => array(
					'src'  => 'video-box.css',
					'deps' => array(
						'builder-press-magnific-popup'
					)
				)
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'video-box' => array(
					'src'  => 'video-box.js',
					'deps' => array(
						'jquery',
						'builder-press-magnific-popup'
					)
				)
			);
		}
	}
}
