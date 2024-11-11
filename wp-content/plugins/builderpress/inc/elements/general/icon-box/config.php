<?php
/**
 * BuilderPress Icon Box config class
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

if ( ! class_exists( 'BuilderPress_Config_Icon_Box' ) ) {
	/**
	 * Class BuilderPress_Config_Icon_Box
	 */
	class BuilderPress_Config_Icon_Box extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_Icon_Box constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'icon-box';
			$this->name = __( 'Icon Box', 'builderpress' );
			$this->desc = __( 'Display an Icon box', 'builderpress' );

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
						'type'       => 'text',
						'heading'    => __( 'Link Title', 'builderpress' ),
						'param_name' => 'linktype_title',
					),
					array(
						'type'        => 'radio_image',
						'heading'     => __( 'Layout', 'builderpress' ),
						'param_name'  => 'layout',
						'options'     => array(
							'layout-1'               => $this->assets_url . 'images/layouts/layout-1.png',
							'layout-2'               => $this->assets_url . 'images/layouts/layout-2.png',
							'layout-3'               => $this->assets_url . 'images/layouts/layout-3.png',
							'layout-4'               => $this->assets_url . 'images/layouts/layout-4.png',
							'layout-5'               => $this->assets_url . 'images/layouts/layout-5.png',
							'layout-6'               => $this->assets_url . 'images/layouts/layout-6.png',
							'kindergarten-layout-1'  => $this->assets_url . 'images/layouts/kindergarten-layout-1.png',
							'kindergarten-layout-2'  => $this->assets_url . 'images/layouts/kindergarten-layout-2.png',
							'kindergarten-layout-8'  => $this->assets_url . 'images/layouts/kindergarten-layout-8.png',
							'kindergarten-layout-4'  => $this->assets_url . 'images/layouts/kindergarten-layout-4.png',
							'kindergarten-layout-5'  => $this->assets_url . 'images/layouts/kindergarten-layout-5.jpg',
							'kindergarten-layout-6'  => $this->assets_url . 'images/layouts/kindergarten-layout-6.jpg',
							'kindergarten-layout-7'  => $this->assets_url . 'images/layouts/kindergarten-layout-7.jpg',
							'kindergarten-layout-10' => $this->assets_url . 'images/layouts/kindergarten-layout-10.jpg',
							'marketing-layout-1'     => $this->assets_url . 'images/layouts/marketing-layout-1.jpg',
							'marketing-layout-2'     => $this->assets_url . 'images/layouts/marketing-layout-2.jpg',
							'marketing-layout-3'     => $this->assets_url . 'images/layouts/marketing-layout-3.jpg',
						),
						'std'         => 'layout-1',
						'description' => __( 'Select type of style.', 'builderpress' ),
					),
				),
				$this->_icon_options(),
				array(
					array(
						'type'             => 'attach_image',
						'heading'          => __( 'Image hover', 'builderpress' ),
						'param_name'       => 'image',
						'dependency'       => array(
							'element' => 'layout',
							'value'   => array(
								'marketing-layout-2',
							),
						),
						'edit_field_class' => 'vc_col-sm-6',
					),
					// Icon shape
					array(
						'type'             => 'dropdown',
						'admin_label'      => false,
						'heading'          => esc_html__( 'Icon shape', 'builderpress' ),
						'param_name'       => 'icon_shape',
						'value'            => array(
							esc_html__( 'None', 'builderpress' )   => '',
							esc_html__( 'Circle', 'builderpress' ) => 'circle',
						),
						'edit_field_class' => 'vc_col-sm-6',
					),

					array(
						'type'             => 'dropdown',
						'admin_label'      => false,
						'heading'          => esc_html__( 'Icon position', 'builderpress' ),
						'param_name'       => 'icon_position',
						'description'      => __( 'Position of icon relative to content.', 'builderpress' ),
						'value'            => array(
							esc_html__( 'Default', 'builderpress' )  => 'icon-default',
							esc_html__( 'Top', 'builderpress' )    => 'icon-top',
							esc_html__( 'Left', 'builderpress' )   => 'icon-left',
							esc_html__( 'Left Center', 'builderpress' )   => 'icon-left-center',
							esc_html__( 'Right', 'builderpress' )  => 'icon-right',
							esc_html__( 'Bottom', 'builderpress' ) => 'icon-bottom',
						),
						'edit_field_class' => 'vc_col-sm-6',
					),

					// style layout icon-box
					array(
						'type'             => 'dropdown',
						'admin_label'      => false,
						'heading'          => esc_html__( 'Icon style', 'builderpress' ),
						'param_name'       => 'icon_style',
						'value'            => array(
							esc_html__( 'Left rotating square', 'builderpress' )    => 'style-1',
							esc_html__( 'Right rotating square', 'builderpress' )   => 'style-2',
							esc_html__( 'Circle', 'builderpress' )   => 'style-3',
							esc_html__( 'Triangular', 'builderpress' )   => 'style-4',
						),
						'dependency'       => array(
							'element' => 'layout',
							'value'   => array(
								'kindergarten-layout-7',
							),
						),
						'edit_field_class' => 'vc_col-sm-6',
					),

					// style layout icon-box
					array(
						'type'        => 'dropdown',
						'admin_label' => false,
						'heading'     => esc_html__( 'Style Layout 6', 'builderpress' ),
						'param_name'  => 'style_layout_6',
						'std'         => 'layout-6-default',
						'value'       => array(
							esc_html__( 'Default', 'builderpress' )    => 'layout-6-default',
							esc_html__( 'Style 1', 'builderpress' )    => 'layout-6-1',
							esc_html__( 'Style 2', 'builderpress' )   => 'layout-6-2',
							esc_html__( 'Style 3', 'builderpress' )   => 'layout-6-3',
						),
						'dependency'  => array(
							'element' => 'layout',
							'value'   => array(
								'layout-6',
							),
						),
					),

					// link for icon
					array(
						'type'       => 'vc_link',
						'heading'    => esc_attr__( 'Link', 'builderpress' ),
						'param_name' => 'box_link',
					),

					// Heading
					array(
						'type'        => 'textfield',
						'admin_label' => false,
						'heading'     => esc_html__( 'Heading', 'builderpress' ),
						'std'         => __( 'Icon box heading', 'builderpress' ),
						'param_name'  => 'title',
						'description' => esc_html__( 'Provide the title for this icon box.', 'builderpress' ),
					),

					// Description
					array(
						'type'        => 'textarea',
						'heading'     => esc_attr__( 'Description', 'builderpress' ),
						'param_name'  => 'description',
						'admin_label' => false,
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

					// Custom box icon width
					array(
						'type'             => 'dropdown',
						'admin_label'      => false,
						'heading'          => esc_html__( 'Text align', 'builderpress' ),
						'param_name'       => 'text_align',
						'value'            => array(
							esc_html__( 'Select', 'builderpress' )   => 'text-default',
							esc_html__( 'Left', 'builderpress' )   => 'text-left',
							esc_html__( 'Right', 'builderpress' )  => 'text-right',
							esc_html__( 'Center', 'builderpress' ) => 'text-center',
						),
						'std'              => '',
						'edit_field_class' => 'vc_col-xs-6',
					),

					// Size icon-box
					array(
						'type'             => 'dropdown',
						'heading'          => __( 'Size', 'builderpress' ),
						'param_name'       => 'icon_size',
						'value'            => array(
							__( 'Normal', 'builderpress' ) => 'normal',
							__( 'Larger', 'builderpress' ) => 'larger',
						),
						'dependency'       => array(
							'element' => 'layout',
							'value'   => array(
								'kindergarten-layout-2',
							),
						),
						'description'      => __( 'Choose Size', 'builderpress' ),
						'edit_field_class' => 'vc_col-xs-6',
					),

					// show line
					array(
						'type'             => 'checkbox',
						'heading'          => esc_html__( 'Show line', 'builderpress' ),
						'description'      => __( 'Line separator on the right', 'builderpress' ),
						'param_name'       => 'show_line',
						'std'              => false,
						'admin_label'      => true,
						'dependency'       => array(
							'element' => 'layout',
							'value'   => array(
								'layout-1',
								'layout-4',
								'kindergarten-layout-1',
								'kindergarten-layout-4',
							),
						),
						'edit_field_class' => 'vc_col-xs-6',
					),

					// Custom box icon width
					array(
						'type'             => 'number',
						'admin_label'      => false,
						'heading'          => esc_html__( 'Box Icon width', 'builderpress' ),
						'param_name'       => 'box_icon_width',
						'description'      => esc_html__( 'Custom width for box icon. Unit is pixel', 'builderpress' ),
						'edit_field_class' => 'vc_col-sm-6',
						'group'            => esc_html__( 'Typography', 'builderpress' ),
					),

					// Custom box icon height
					array(
						'type'             => 'number',
						'admin_label'      => false,
						'heading'          => esc_html__( 'Box Icon height', 'builderpress' ),
						'param_name'       => 'box_icon_height',
						'description'      => esc_html__( 'Custom height for box icon. Unit is pixel', 'builderpress' ),
						'edit_field_class' => 'vc_col-sm-6',
						'group'            => esc_html__( 'Typography', 'builderpress' ),
					),

					// Heading size
					array(
						'type'        => 'dropdown',
						'admin_label' => false,
						'heading'     => esc_html__( 'Heading size', 'builderpress' ),
						'param_name'  => 'title_tag',
						'value'       => $this->_setting_tags(),
						'group'       => esc_html__( 'Typography', 'builderpress' ),
					),

					// Custom heading font size
					array(
						'type'             => 'number',
						'admin_label'      => false,
						'heading'          => esc_html__( 'Heading font size', 'builderpress' ),
						'param_name'       => 'title_font_size',
						'std'              => '',
						'description'      => esc_html__( 'Custom title font size. Unit is pixel', 'builderpress' ),
						'edit_field_class' => 'vc_col-sm-6',
						'group'            => esc_html__( 'Typography', 'builderpress' ),
					),

					// Custom heading font weight
					array(
						'type'        => 'dropdown',
						'admin_label' => false,
						'heading'     => esc_html__( 'Heading font weight', 'builderpress' ),
						'param_name'  => 'title_font_weight',
						'description' => esc_html__( 'Select custom title font weight', 'builderpress' ),
						'value'       => $this->_setting_font_weights(),
						'group'       => esc_html__( 'Typography', 'builderpress' ),
					),

					// Icon font size
					array(
						'type'        => 'number',
						'admin_label' => false,
						'heading'     => esc_html__( 'Icon font size', 'builderpress' ),
						'param_name'  => 'icon_font_size',
						'description' => esc_html__( 'Custom icon font size. Unit is pixel', 'builderpress' ),
						'std'         => '',
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
						'group'       => esc_html__( 'Typography', 'builderpress' ),
					),

					// Description font size
					array(
						'type'             => 'number',
						'admin_label'      => false,
						'heading'          => esc_html__( 'Description font size', 'builderpress' ),
						'param_name'       => 'desc_font_size',
						'description'      => esc_html__( 'Custom description font size. Unit is pixel', 'builderpress' ),
						'std'              => '',
						'edit_field_class' => 'vc_col-sm-6',
						'group'            => esc_html__( 'Typography', 'builderpress' ),
					),

					// Icon color
					array(
						'type'             => 'colorpicker',
						'admin_label'      => false,
						'heading'          => esc_html__( 'Icon color', 'builderpress' ),
						'param_name'       => 'icon_color',
						'value'            => esc_html__( '', 'builderpress' ),
						'edit_field_class' => 'vc_col-sm-4',
						'dependency'       => array(
							'element' => 'icon_type',
							'value'   => array( 'icon_fontawesome', 'icon_ionicon' ),
						),
						'group'            => esc_html__( 'Color', 'builderpress' ),
					),

					// Icon border color
					array(
						'type'             => 'colorpicker',
						'admin_label'      => false,
						'heading'          => esc_html__( 'Icon border color', 'builderpress' ),
						'param_name'       => 'icon_border_color',
						'edit_field_class' => 'vc_col-sm-4',
						'group'            => esc_html__( 'Color', 'builderpress' ),
					),

					// Icon background color
					array(
						'type'             => 'colorpicker',
						'admin_label'      => false,
						'heading'          => esc_html__( 'Icon background color', 'builderpress' ),
						'param_name'       => 'icon_background_color',
						'group'            => esc_html__( 'Color', 'builderpress' ),
						'edit_field_class' => 'vc_col-sm-4',
					),

					// Link color
					array(
						'type'             => 'colorpicker',
						'admin_label'      => false,
						'heading'          => esc_html__( 'Link color', 'builderpress' ),
						'param_name'       => 'link_color',
						'group'            => esc_html__( 'Color', 'builderpress' ),
						'edit_field_class' => 'vc_col-sm-4',
					),

					// Icon hover border color
					array(
						'type'             => 'colorpicker',
						'admin_label'      => false,
						'heading'          => esc_html__( 'Icon hover border color', 'builderpress' ),
						'param_name'       => 'icon_hover_border_color',
						'edit_field_class' => 'vc_col-sm-4',
						'group'            => esc_html__( 'Color', 'builderpress' ),
					),

					// Icon hover background color
					array(
						'type'             => 'colorpicker',
						'admin_label'      => false,
						'heading'          => esc_html__( 'Icon hover background color', 'builderpress' ),
						'param_name'       => 'icon_hover_background_color',
						'group'            => esc_html__( 'Color', 'builderpress' ),
						'edit_field_class' => 'vc_col-sm-4',
					),

					// Link hover color
					array(
						'type'             => 'colorpicker',
						'admin_label'      => false,
						'heading'          => esc_html__( 'Link hover', 'builderpress' ),
						'param_name'       => 'link_hover_color',
						'group'            => esc_html__( 'Color', 'builderpress' ),
						'edit_field_class' => 'vc_col-sm-4',
					),

					// Heading color
					array(
						'type'        => 'colorpicker',
						'admin_label' => false,
						'heading'     => esc_html__( 'Heading color', 'builderpress' ),
						'param_name'  => 'title_color',
						'group'       => esc_html__( 'Color', 'builderpress' ),
					),

					// line color
					array(
						'type'        => 'colorpicker',
						'admin_label' => false,
						'heading'     => esc_html__( 'Line color', 'builderpress' ),
						'param_name'  => 'line_color',
						'value'       => esc_html__( '', 'builderpress' ),
						'description' => esc_html__( 'Select the line color.', 'builderpress' ),
						'group'       => esc_html__( 'Color', 'builderpress' ),
					),

					// Description color
					array(
						'type'        => 'colorpicker',
						'admin_label' => false,
						'heading'     => esc_html__( 'Description color', 'builderpress' ),
						'param_name'  => 'desc_color',
						'group'       => esc_html__( 'Color', 'builderpress' ),
					),

					// Button color
					array(
						'type'             => 'colorpicker',
						'admin_label'      => false,
						'heading'          => esc_html__( 'Button color', 'builderpress' ),
						'param_name'       => 'button_text_color',
						'group'            => esc_html__( 'Color', 'builderpress' ),
						'edit_field_class' => 'vc_col-sm-4',
					),

					/* Spacing Group */
					// Icon Margin
					array(
						'type'        => 'textfield',
						'heading'     => __( 'Icon Margin', 'builderpress' ),
						'param_name'  => 'icon_margin',
						'std'         => '',
						'admin_label' => false,
						'description' => esc_html__( '0px 0px 0px 0px', 'builderpress' ),
						'group'       => esc_html__( 'Spacing', 'builderpress' ),
					),
					// Title Margin
					array(
						'type'        => 'textfield',
						'heading'     => __( 'Title Margin', 'builderpress' ),
						'param_name'  => 'title_margin',
						'std'         => '',
						'admin_label' => false,
						'description' => esc_html__( '0px 0px 0px 0px', 'builderpress' ),
						'group'       => esc_html__( 'Spacing', 'builderpress' ),
					),
					array(
						'type'        => 'textfield',
						'heading'     => __( 'Title Custom CSS', 'builderpress' ),
						'param_name'  => 'title_custom_css',
						'admin_label' => false,
						'description' => esc_html__( 'Input custom css', 'builderpress' ),
						'group'       => esc_html__( 'Spacing', 'builderpress' ),
					),
					// Description Margin
					array(
						'type'        => 'textfield',
						'heading'     => __( 'Description Margin', 'builderpress' ),
						'param_name'  => 'desc_margin',
						'std'         => '',
						'admin_label' => false,
						'description' => esc_html__( '0px 0px 0px 0px', 'builderpress' ),
						'dependency'  => array(
							'element'   => 'description',
							'not_empty' => true,
						),
						'group'       => esc_html__( 'Spacing', 'builderpress' ),
					),
					array(
						'type'        => 'textfield',
						'heading'     => __( 'Description Custom CSS', 'builderpress' ),
						'param_name'  => 'desc_custom_css',
						'admin_label' => false,
						'description' => esc_html__( 'Input custom css', 'builderpress' ),
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
				)
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_styles() {
			return array(
				'icon-box' => array(
					'src'      => 'icon-box.css',
					'deps'     => array(
						'builder-press-ionicons',
					),
					'deps_src' => array(
						'builder-press-ionicons' => BUILDER_PRESS_URL . '/assets/css/fonts/ionicons.css',
					),
				),
			);
		}
	}
}
