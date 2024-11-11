<?php
/**
 * BuilderPress Features config class
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

if ( ! class_exists( 'BuilderPress_Config_Features' ) ) {
	/**
	 * Class BuilderPress_Config_Features
	 */
	class BuilderPress_Config_Features extends BuilderPress_Abstract_Config {
		/**
		 * BuilderPress_Config_Features constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'features';
			$this->name = __( 'Features', 'builderpress' );
			$this->desc = __( 'Display features list', 'builderpress' );

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
                        'marketing-layout-list-2' => $this->assets_url . 'images/layouts/marketing-layout-list-2.png',
					),
					'std'        => 'layout-1'
				),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Title', 'builderpress' ),
                    'param_name' => 'title',
                    'dependency' => array(
                        'element' => 'layout',
                        'value'   => array( 'marketing-layout-list-2' )
                    ),
                ),
				array(
					'type'       => 'param_group',
					'value'      => '',
					'param_name' => 'features',
					'params'     => array_merge(
						$this->_icon_options(),
						array(
							array(
								'type'       => 'textfield',
								'heading'    => __( 'Name', 'builderpress' ),
								'param_name' => 'name',
							),
							array(
								'type'       => 'textarea',
								'heading'    => __( 'Description', 'builderpress' ),
								'param_name' => 'description'
							),
							array(
								'type'       => 'vc_link',
								'heading'    => __( 'Link', 'builderpress' ),
								'param_name' => 'link'
							)
						)
					)
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
				// Name size
				array(
					'type'        => 'dropdown',
					'admin_label' => false,
					'heading'     => esc_html__( 'Name size', 'builderpress' ),
					'param_name'  => 'title_tag',
					'value'       => $this->_setting_tags(),
					'group'       => esc_html__( 'Typography', 'builderpress' )
				),

				// Custom name font size
				array(
					'type'             => 'number',
					'admin_label'      => false,
					'heading'          => esc_html__( 'Name font size', 'builderpress' ),
					'param_name'       => 'title_font_size',
					'std'              => '14',
					'description'      => esc_html__( 'Custom title font size. Unit is pixel', 'builderpress' ),
					'edit_field_class' => 'vc_col-sm-6',
					'group'            => esc_html__( 'Typography', 'builderpress' )
				),

				// Custom name font weight
				array(
					'type'        => 'dropdown',
					'admin_label' => false,
					'heading'     => esc_html__( 'Name font weight', 'builderpress' ),
					'param_name'  => 'title_font_weight',
					'description' => esc_html__( 'Select custom title font weight', 'builderpress' ),
					'value'       => $this->_setting_font_weights(),
					'group'       => esc_html__( 'Typography', 'builderpress' )
				),

				// Description font weight
				array(
					'type'        => 'dropdown',
					'admin_label' => false,
					'heading'     => esc_html__( 'Description font weight', 'builderpress' ),
					'param_name'  => 'desc_font_weight',
					'description' => esc_html__( 'Select custom description font weight', 'builderpress' ),
					'value'       => $this->_setting_font_weights(),
					'group'       => esc_html__( 'Typography', 'builderpress' )
				),

				// Description font size
				array(
					'type'             => 'number',
					'admin_label'      => false,
					'heading'          => esc_html__( 'Description font size', 'builderpress' ),
					'param_name'       => 'desc_font_size',
					'description'      => esc_html__( 'Custom description font size. Unit is pixel', 'builderpress' ),
					'std'              => '14',
					'edit_field_class' => 'vc_col-sm-6',
					'group'            => esc_html__( 'Typography', 'builderpress' )
				),

                array(
                    'type'             => 'number',
                    'admin_label'      => false,
                    'heading'          => esc_html__( 'Icon font size', 'builderpress' ),
                    'param_name'       => 'icon_font_size',
                    'description'      => esc_html__( 'Custom icon font size. Unit is pixel', 'builderpress' ),
                    'std'              => '',
                    'group'            => esc_html__( 'Typography', 'builderpress' )
                ),

				// Icon color
				array(
					'type'             => 'colorpicker',
					'admin_label'      => false,
					'heading'          => esc_html__( 'Icon color', 'builderpress' ),
					'param_name'       => 'icon_color',
					'value'            => esc_html__( '', 'builderpress' ),
					'edit_field_class' => 'vc_col-sm-4',
					'group'            => esc_html__( 'Color', 'builderpress' )
				),

				// Icon border color
				array(
					'type'             => 'colorpicker',
					'admin_label'      => false,
					'heading'          => esc_html__( 'Icon border color', 'builderpress' ),
					'param_name'       => 'icon_border_color',
					'edit_field_class' => 'vc_col-sm-4',
					'group'            => esc_html__( 'Color', 'builderpress' )
				),

				// Icon background color
				array(
					'type'             => 'colorpicker',
					'admin_label'      => false,
					'heading'          => esc_html__( 'Icon background color', 'builderpress' ),
					'param_name'       => 'icon_background_color',
					'group'            => esc_html__( 'Color', 'builderpress' ),
					'edit_field_class' => 'vc_col-sm-4'
				),

				// Link color
				array(
					'type'             => 'colorpicker',
					'admin_label'      => false,
					'heading'          => esc_html__( 'Link color', 'builderpress' ),
					'param_name'       => 'link_color',
					'group'            => esc_html__( 'Color', 'builderpress' ),
					'edit_field_class' => 'vc_col-sm-4'
				),

				// Link color
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
					'heading'     => esc_html__( 'Name color', 'builderpress' ),
					'param_name'  => 'title_color',
					'group'       => esc_html__( 'Color', 'builderpress' )
				),

				// Description color
				array(
					'type'        => 'colorpicker',
					'admin_label' => false,
					'heading'     => esc_html__( 'Description color', 'builderpress' ),
					'param_name'  => 'desc_color',
					'group'       => esc_html__( 'Color', 'builderpress' )
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
				'features' => array(
					'src' => 'features.css'
				)
			);
		}
	}
}
