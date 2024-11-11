<?php
/**
 * BuilderPress Heading config class
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

if ( ! class_exists( 'BuilderPress_Config_Heading' ) ) {
	/**
	 * Class BuilderPress_Config_Heading
	 */
	class BuilderPress_Config_Heading extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_Heading constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'heading';
			$this->name = __( 'Heading', 'builderpress' );
			$this->desc = __( 'Display a heading', 'builderpress' );

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
						'layout-1'              => $this->assets_url . 'images/layout/layout-1.jpg',
						'layout-2'              => $this->assets_url . 'images/layout/layout-2.jpg',
						'layout-3'              => $this->assets_url . 'images/layout/layout-3.png',
						'kindergarten-layout-1' => $this->assets_url . 'images/layout/kindergarten-layout-1.png',
						'kindergarten-layout-2' => $this->assets_url . 'images/layout/kindergarten-layout-2.png',
						'kindergarten-layout-3' => $this->assets_url . 'images/layout/kindergarten-layout-3.jpg',
					),
					'std'        => 'layout-1',
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Title', 'builderpress' ),
					'param_name'  => 'title',
					'admin_label' => true,
//					'std'         => 'This is title',
				),
				array(
					'type'       => 'textfield',
					'heading'    => __( 'Sub Title', 'builderpress' ),
					'param_name' => 'sub_title',
					//'std'        => 'This is sub title',
				),
				array(
					'type'       => 'textarea',
					'heading'    => __( 'Description', 'builderpress' ),
					'param_name' => 'content',
					//'std'        => 'This is description',
				),
				array(
					'type'             => 'checkbox',
					'heading'          => esc_html__( 'Show line', 'builderpress' ),
					'description'      => __( 'Line separates title and description', 'builderpress' ),
					'param_name'       => 'show_line',
					'std'              => false,
					'admin_label'      => true,
					'edit_field_class' => 'vc_col-xs-6',
				),
				array(
					'type'             => 'attach_image',
					'heading'          => __( 'Line Icon', 'builderpress' ),
					'param_name'       => 'image',
					'dependency'       => array(
						'element' => 'layout',
						'value'   => array(
							'kindergarten-layout-3',
						),
					),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => __( 'Style Layout', 'builderpress' ),
					'param_name'       => 'style_layout',
					'value'            => array(
						__( 'Style Default', 'builderpress' )   => '',
					),
					'std'              => '',
					'edit_field_class' => 'vc_col-sm-6',
				),
				//style text title
				array(
					'type'             => 'dropdown',
					'heading'          => __( 'Alignment', 'builderpress' ),
					'param_name'       => 'align',
					'value'            => array(
						__( 'Left', 'builderpress' )   => 'align-left',
						__( 'Center', 'builderpress' ) => 'align-center',
						__( 'Right', 'builderpress' )  => 'align-right',
					),
					'std'              => 'align-left',
					'edit_field_class' => 'vc_col-xs-6',
				),

				/* Typography Group */

				// Max Width
				array(
					'type'        => 'number',
					'admin_label' => false,
					'heading'     => esc_html__( 'Title Max Width', 'builderpress' ),
					'param_name'  => 'title_max_width',
					'description' => esc_html__( 'Custom title max width. Unit is pixel', 'builderpress' ),
					'group'       => esc_html__( 'Typography', 'builderpress' ),
				),

				// Title size
				array(
					'type'        => 'dropdown',
					'admin_label' => false,
					'heading'     => esc_html__( 'Title size', 'builderpress' ),
					'param_name'  => 'title_tag',
					'value'       => $this->_setting_tags(),
					'group'       => esc_html__( 'Typography', 'builderpress' ),
				),

				// Custom Title font size
				array(
					'type'             => 'number',
					'admin_label'      => false,
					'heading'          => esc_html__( 'Title font size', 'builderpress' ),
					'param_name'       => 'title_font_size',
					'description'      => esc_html__( 'Custom title font size. Unit is pixel', 'builderpress' ),
					'edit_field_class' => 'vc_col-sm-6',
					'group'            => esc_html__( 'Typography', 'builderpress' ),
				),

				// Title Line height
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Title Line height', 'builderpress' ),
					'param_name'  => 'title_line_height',
					'admin_label' => false,
					'group'       => esc_html__( 'Typography', 'builderpress' ),
				),

				// Custom Title font weight
				array(
					'type'        => 'dropdown',
					'admin_label' => false,
					'heading'     => esc_html__( 'Title font weight', 'builderpress' ),
					'param_name'  => 'title_font_weight',
					'description' => esc_html__( 'Select custom title font weight', 'builderpress' ),
					'value'       => $this->_setting_font_weights(),
					'group'       => esc_html__( 'Typography', 'builderpress' ),
				),

				// Custom Title text transform
				array(
					'type'        => 'dropdown',
					'admin_label' => false,
					'heading'     => esc_html__( 'Title text transform', 'builderpress' ),
					'param_name'  => 'title_text_transform',
					'description' => esc_html__( 'Select custom title text transform', 'builderpress' ),
					'value'       => $this->_setting_text_transform(),
					'group'       => esc_html__( 'Typography', 'builderpress' ),
				),

				// Custom Sub Title font size
				array(
					'type'             => 'number',
					'admin_label'      => false,
					'heading'          => esc_html__( 'Sub Title font size', 'builderpress' ),
					'param_name'       => 'sub_title_font_size',
					'description'      => esc_html__( 'Custom title font size. Unit is pixel', 'builderpress' ),
					'edit_field_class' => 'vc_col-sm-6',
					'dependency'       => array(
						'element'   => 'sub_title',
						'not_empty' => true,
					),
					'group'            => esc_html__( 'Typography', 'builderpress' ),
				),

				// Sub Title Line height
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Sub Title Line height', 'builderpress' ),
					'param_name'  => 'sub_title_line_height',
					'admin_label' => false,
					'group'       => esc_html__( 'Typography', 'builderpress' ),
				),

				// Custom Sub Title font weight
				array(
					'type'        => 'dropdown',
					'admin_label' => false,
					'heading'     => esc_html__( 'Sub Title font weight', 'builderpress' ),
					'param_name'  => 'sub_title_font_weight',
					'description' => esc_html__( 'Select custom title font weight', 'builderpress' ),
					'value'       => $this->_setting_font_weights(),
					'dependency'  => array(
						'element'   => 'sub_title',
						'not_empty' => true,
					),
					'group'       => esc_html__( 'Typography', 'builderpress' ),
				),

				// Custom Sub Title text transform
				array(
					'type'        => 'dropdown',
					'admin_label' => false,
					'heading'     => esc_html__( 'Sub Title text transform', 'builderpress' ),
					'param_name'  => 'sub_title_text_transform',
					'description' => esc_html__( 'Select custom sub title text transform', 'builderpress' ),
					'value'       => $this->_setting_text_transform(),
					'group'       => esc_html__( 'Typography', 'builderpress' ),
				),

				// Description font weight
				array(
					'type'        => 'dropdown',
					'admin_label' => false,
					'heading'     => esc_html__( 'Description font weight', 'builderpress' ),
					'param_name'  => 'desc_font_weight',
					'description' => esc_html__( 'Select custom description font weight', 'builderpress' ),
					'value'       => $this->_setting_font_weights(),
					'dependency'  => array(
						'element'   => 'description',
						'not_empty' => true,
					),
					'group'       => esc_html__( 'Typography', 'builderpress' ),
				),

				// Description font size
				array(
					'type'             => 'number',
					'admin_label'      => false,
					'heading'          => esc_html__( 'Description font size', 'builderpress' ),
					'param_name'       => 'desc_font_size',
					'description'      => esc_html__( 'Custom description font size. Unit is pixel', 'builderpress' ),
					'edit_field_class' => 'vc_col-sm-6',
					'dependency'       => array(
						'element'   => 'description',
						'not_empty' => true,
					),
					'group'            => esc_html__( 'Typography', 'builderpress' ),
				),

				// Line Widht
				array(
					'type'        => 'number',
					'heading'     => __( 'Line Width', 'builderpress' ),
					'param_name'  => 'line_width',
					'admin_label' => false,
					'group'       => esc_html__( 'Typography', 'builderpress' ),
				),

				// Line Widht
				array(
					'type'        => 'number',
					'heading'     => __( 'Line Height', 'builderpress' ),
					'param_name'  => 'line_height',
					'admin_label' => false,
					'group'       => esc_html__( 'Typography', 'builderpress' ),
				),

				/* Color Group */

				// Title color
				array(
					'type'        => 'colorpicker',
					'admin_label' => false,
					'heading'     => esc_html__( 'Title color', 'builderpress' ),
					'param_name'  => 'title_color',
					'value'       => esc_html__( '', 'builderpress' ),
					'description' => esc_html__( 'Select the title color.', 'builderpress' ),
					'group'       => esc_html__( 'Color', 'builderpress' ),
				),

				// Sub title color
				array(
					'type'        => 'colorpicker',
					'admin_label' => false,
					'heading'     => esc_html__( 'Sub Title color', 'builderpress' ),
					'param_name'  => 'sub_title_color',
					'value'       => esc_html__( '', 'builderpress' ),
					'description' => esc_html__( 'Select the title color.', 'builderpress' ),
					'dependency'  => array(
						'element'   => 'sub_title',
						'not_empty' => true,
					),
					'group'       => esc_html__( 'Color', 'builderpress' ),
				),

				// Background color Line
				array(
					'type'        => 'colorpicker',
					'admin_label' => false,
					'heading'     => esc_html__( 'Background color line', 'builderpress' ),
					'param_name'  => 'line_color',
					'value'       => esc_html__( '', 'builderpress' ),
					'description' => esc_html__( 'Select the background color line.', 'builderpress' ),
					'group'       => esc_html__( 'Color', 'builderpress' ),
					'dependency'  => array(
						'element' => 'layout',
						'value'   => array(
							'layout-1',
							'layout-2',
							'layout-1',
						),
					),
				),

				// color line
				array(
					'type'        => 'colorpicker',
					'admin_label' => false,
					'heading'     => esc_html__( 'Color line', 'builderpress' ),
					'param_name'  => 'color_line',
					'value'       => esc_html__( '', 'builderpress' ),
					'description' => esc_html__( 'Select the color line.', 'builderpress' ),
					'group'       => esc_html__( 'Color', 'builderpress' ),
					'dependency'  => array(
						'element' => 'layout',
						'value'   => array(
							'kindergarten-layout-1',
						),
					),
				),

				// Description color
				array(
					'type'        => 'colorpicker',
					'admin_label' => false,
					'heading'     => esc_html__( 'Description color', 'builderpress' ),
					'param_name'  => 'desc_color',
					'description' => esc_html__( 'Select the description color.', 'builderpress' ),
					'dependency'  => array(
						'element'   => 'description',
						'not_empty' => true,
					),
					'group'       => esc_html__( 'Color', 'builderpress' ),
				),

				/* Spacing Group */

				// Title Margin
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Title Margin', 'builderpress' ),
					'param_name'  => 'title_margin',
					'admin_label' => false,
					'description' => esc_html__( '0px 0px 0px 0px', 'builderpress' ),
					'group'       => esc_html__( 'Spacing', 'builderpress' ),
				),
				// Sub Title Margin
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Sub Title Margin', 'builderpress' ),
					'param_name'  => 'sub_title_margin',
					'admin_label' => false,
					'description' => esc_html__( '0px 0px 0px 0px', 'builderpress' ),
					'dependency'  => array(
						'element'   => 'sub_title',
						'not_empty' => true,
					),
					'group'       => esc_html__( 'Spacing', 'builderpress' ),
				),
				// Line Margin
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Line Margin', 'builderpress' ),
					'param_name'  => 'line_margin',
					'admin_label' => false,
					'description' => esc_html__( '0px 0px 0px 0px', 'builderpress' ),
					'group'       => esc_html__( 'Spacing', 'builderpress' ),
				),
				// Description Margin
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Description Margin', 'builderpress' ),
					'param_name'  => 'desc_margin',
					'admin_label' => false,
					'description' => esc_html__( '0px 0px 0px 0px', 'builderpress' ),
					'dependency'  => array(
						'element'   => 'description',
						'not_empty' => true,
					),
					'group'       => esc_html__( 'Spacing', 'builderpress' ),
				),

				array(
					'type'       => 'css_editor',
					'heading'    => __( 'CSS Shortcode', 'js_composer' ),
					'param_name' => 'bp_css',
					'group'      => __( 'Design Options', 'js_composer' ),
				),

				array(
					'type'       => 'css_editor',
					'heading'    => __( 'CSS on Tablet', 'js_composer' ),
					'param_name' => 'bp_css_tablet',
					'group'      => __( 'Design Options', 'js_composer' ),
				),

				array(
					'type'       => 'css_editor',
					'heading'    => __( 'CSS on Mobile', 'js_composer' ),
					'param_name' => 'bp_css_mobile',
					'group'      => __( 'Design Options', 'js_composer' ),
				),

			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_styles() {
			return array(
				'heading' => array(
					'src' => 'heading.css',
				),
			);
		}
	}
}
