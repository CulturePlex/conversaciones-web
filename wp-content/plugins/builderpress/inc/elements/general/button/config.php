<?php
/**
 * BuilderPress Button config class
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

if ( ! class_exists( 'BuilderPress_Config_Button' ) ) {
	/**
	 * Class BuilderPress_Config_Button
	 */
	class BuilderPress_Config_Button extends BuilderPress_Abstract_Config {
		/**
		 * BuilderPress_Config_Button constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'button';
			$this->name = __( 'Button', 'builderpress' );
			$this->desc = __( 'Display a button', 'builderpress' );

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
						'type'        => 'vc_link',
						'heading'     => esc_html__( 'Link', 'builderpress' ),
						'param_name'  => 'link',
						'description' => esc_html__( 'Add link to button.', 'builderpress' ),
					),

                    array(
                        'type'             => 'dropdown',
                        'heading'          => __( 'Style', 'builderpress' ),
                        'param_name'       => 'style',
                        'value'            => array(
                            __( 'Normal', 'builderpress' )   => '',
                            __( 'Gradient', 'builderpress' ) => 'style-gradient',
                        ),
                        'std'              => '',
                    ),

					array(
						'type'             => 'dropdown',
						'heading'          => esc_html__( 'Size', 'builderpress' ),
						'param_name'       => 'size',
						'value'            => array(
							esc_html__( 'Small', 'builderpress' )  => 'sm',
							esc_html__( 'Normal', 'builderpress' ) => 'normal',
							esc_html__( 'Large', 'builderpress' )  => 'lg'
						),
						'description'      => esc_html__( 'Select button display size.', 'builderpress' ),
						'edit_field_class' => 'vc_col-sm-6',
						'std'              => 'normal'
					),

					array(
						'type'             => 'dropdown',
						'heading'          => esc_html__( 'Shape', 'builderpress' ),
						'param_name'       => 'shape',
						'value'            => array(
							esc_html__( 'Square', 'builderpress' ) => 'square',
							esc_html__( 'Round', 'builderpress' )  => 'round'
						),
						'edit_field_class' => 'vc_col-sm-6',
						'std'              => 'square'
					),

                    // Border width
                    array(
                        'type'        => 'number',
                        'heading'     => __( 'Border Width', 'builderpress' ),
                        'param_name'  => 'button_border_width',
                        'admin_label' => false,
                        'std'         => 0,
                    ),

                    // show line
                    array(
                        'type'             => 'checkbox',
                        'heading'          => esc_html__( 'Show line', 'builderpress' ),
                        'description'      => __( 'Line separates title and description', 'builderpress' ),
                        'param_name'       => 'show_line',
                        'std'              => false,
                        'admin_label'      => true,
                        'edit_field_class' => 'vc_col-xs-6'
                    ),

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

                    /* Typography */
                    // Custom Button font size
                    array(
                        'type'             => 'number',
                        'admin_label'      => false,
                        'heading'          => esc_html__( 'Button font size', 'builderpress' ),
                        'param_name'       => 'button_font_size',
                        'description'      => esc_html__( 'Custom Button font size. Unit is pixel', 'builderpress' ),
                        'edit_field_class' => 'vc_col-sm-6',
                        'group'            => esc_html__( 'Typography', 'builderpress' )
                    ),

                    // Custom heading font weight
                    array(
                        'type'        => 'dropdown',
                        'admin_label' => false,
                        'heading'     => esc_html__( 'Button font weight', 'builderpress' ),
                        'param_name'  => 'button_font_weight',
                        'description' => esc_html__( 'Select custom Button font weight', 'builderpress' ),
                        'value'       => $this->_setting_font_weights(),
                        'group'       => esc_html__( 'Typography', 'builderpress' )
                    ),

                    /* Color Group */
                    array(
                        'type'             => 'colorpicker',
                        'heading'          => esc_html__( 'Background Color', 'builderpress' ),
                        'param_name'       => 'bg_color',
                        'description'      => esc_html__( 'Select custom background color for your element.', 'builderpress' ),
                        'edit_field_class' => 'vc_col-sm-6',
                        'group'            => esc_html__( 'Color', 'builderpress' )
                    ),
                    array(
                        'type'             => 'colorpicker',
                        'heading'          => esc_html__( 'Text Color', 'builderpress' ),
                        'param_name'       => 'text_color',
                        'description'      => esc_html__( 'Select custom text color for your element.', 'builderpress' ),
                        'edit_field_class' => 'vc_col-sm-6',
                        'group'            => esc_html__( 'Color', 'builderpress' )
                    ),
                    array(
                        'type'             => 'colorpicker',
                        'heading'          => esc_html__( 'Background Hover Color', 'builderpress' ),
                        'param_name'       => 'bg_hover_color',
                        'description'      => esc_html__( 'Select custom background hover color for your element.', 'builderpress' ),
                        'edit_field_class' => 'vc_col-sm-6',
                        'group'            => esc_html__( 'Color', 'builderpress' )
                    ),
                    array(
                        'type'             => 'colorpicker',
                        'heading'          => esc_html__( 'Text Hover Color', 'builderpress' ),
                        'param_name'       => 'text_hover_color',
                        'description'      => esc_html__( 'Select custom text hover color for your element.', 'builderpress' ),
                        'edit_field_class' => 'vc_col-sm-6',
                        'group'            => esc_html__( 'Color', 'builderpress' )
                    ),
                    array(
                        'type'             => 'colorpicker',
                        'heading'          => esc_html__( 'Border Color', 'builderpress' ),
                        'param_name'       => 'border_color',
                        'description'      => esc_html__( 'Select custom background border color for your element.', 'builderpress' ),
                        'edit_field_class' => 'vc_col-sm-6',
                        'group'            => esc_html__( 'Color', 'builderpress' )
                    ),
                    array(
                        'type'             => 'colorpicker',
                        'heading'          => esc_html__( 'Border Hover Color', 'builderpress' ),
                        'param_name'       => 'border_hover_color',
                        'description'      => esc_html__( 'Select custom border hover color for your element.', 'builderpress' ),
                        'edit_field_class' => 'vc_col-sm-6',
                        'group'            => esc_html__( 'Color', 'builderpress' )
                    ),

                    /* Spacing Group */
                    // Button Margin
                    array(
                        'type'        => 'textfield',
                        'heading'     => __( 'Button Margin', 'builderpress' ),
                        'param_name'  => 'button_margin',
                        'admin_label' => false,
                        'description' => esc_html__( '0px 0px 0px 0px', 'builderpress' ),
                        'group'       => esc_html__( 'Spacing', 'builderpress' )
                    ),
                    // Button Padding
                    array(
                        'type'        => 'textfield',
                        'heading'     => __( 'Button Padding', 'builderpress' ),
                        'param_name'  => 'button_padding',
                        'admin_label' => false,
                        'description' => esc_html__( '0px 0px 0px 0px', 'builderpress' ),
                        'group'       => esc_html__( 'Spacing', 'builderpress' )
                    ),
                    // Button Line Height
                    array(
                        'type'        => 'number',
                        'heading'     => __( 'Button Line Height', 'builderpress' ),
                        'param_name'  => 'button_line_height',
                        'admin_label' => false,
                        'group'       => esc_html__( 'Spacing', 'builderpress' )
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

				),

				$this->_icon_options(),

				array(
					array(
						'type'             => 'dropdown',
						'heading'          => esc_html__( 'Icon Alignment', 'builderpress' ),
						'param_name'       => 'icon_alignment',
						'value'            => array(
							esc_html__( 'Left', 'builderpress' )  => 'left',
							esc_html__( 'Right', 'builderpress' ) => 'right'
						),
						'description'      => esc_html__( 'Select button alignment.', 'builderpress' ),
						'edit_field_class' => 'vc_col-sm-6',
						'dependency'       => array(
							'element' => 'i_type',
							'value'   => array( 'image' ),
						),
						'std'              => 'left'
					)
				)
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_styles() {
			return array(
				'button' => array(
					'src' => 'button.css'
				)
			);
		}
	}
}
