<?php
/**
 * BuilderPress Call To Action config class
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

if ( ! class_exists( 'BuilderPress_Config_Call_To_Action' ) ) {
	/**
	 * Class BuilderPress_Config_Call_To_Action
	 */
	class BuilderPress_Config_Call_To_Action extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_Call_To_Action constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'call-to-action';
			$this->name = __( 'Call To Action', 'builderpress' );
			$this->desc = __( 'Display call to action box.', 'builderpress' );

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
                        'vblog-layout-1' => $this->assets_url . 'images/layouts/vblog-layout-1.jpg',
                        'vblog-layout-2' => $this->assets_url . 'images/layouts/vblog-layout-2.jpg',
                        'marketing-layout-1' => $this->assets_url . 'images/layouts/marketing-layout-1.jpg',
					),
					'std'        => 'layout-1'
				),
				array(
					'type'       => 'attach_image',
					'heading'    => __( 'Image', 'builderpress' ),
					'param_name' => 'image',
					'dependency' => array(
						'element' => 'layout',
						'value'   => array(
							'layout-1',
							'layout-2',
                            'vblog-layout-1',
                            'vblog-layout-2',
                            'kindergarten-layout-1'
						),
					),
				),
				array(
					'type'       => 'textfield',
					'heading'    => __( 'Title', 'builderpress' ),
					'param_name' => 'title',
					'std'        => __( 'Contact us today', 'builderpress' ),
                    'dependency' => array(
                        'element' => 'layout',
                        'value'   => array(
                            'layout-1',
                            'layout-2',
                            'layout-3',
                            'layout-4',
                            'layout-5',
                            'vblog-layout-1',
                            'vblog-layout-2',
                            'kindergarten-layout-1',
                            'marketing-layout-1'
                        )
                    )
				),

				array(
					'type'       => 'textarea',
					'heading'    => __( 'Description', 'builderpress' ),
					'param_name' => 'description',
					'std'        => __( 'Your treatment will be performed by licensed therapist. Schedule your appointment now.', 'builderpress' ),
					'dependency' => array(
						'element' => 'layout',
						'value'   => array(
							'layout-2',
							'layout-3',
							'layout-4',
                            'kindergarten-layout-1'
						)
					)
				),

                //style layout
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

                // Fontawesome Picker
                array(
                    'type'             => 'iconpicker',
                    'heading'          => __( 'Font Awesome', 'builderpress' ),
                    'param_name'       => 'font_awesome',
                    'value'            => 'fa fa-facebook',
                    'settings'         => array(
                        'emptyIcon'    => false,
                        'iconsPerPage' => 50,
                        'type'         => 'fontawesome'
                    ),
                    'dependency'       => array(
                        'element' => 'layout',
                        'value'   => array(
                            'layout-6',
                        )
                    ),
                    'edit_field_class' => 'vc_col-sm-6'
                ),
                array(
                    'type'       => 'vc_link',
                    'heading'    => __( 'Email', 'builderpress' ),
                    'param_name' => 'link_email',
                    'dependency' => array(
                        'element' => 'layout',
                        'value'   => array(
                            'layout-6'
                        )
                    ),
                    'edit_field_class' => 'vc_col-sm-6'
                ),

				array(
					'type'       => 'vc_link',
					'heading'    => __( 'Action', 'builderpress' ),
					'param_name' => 'link'
				),
				array(
					'type'       => 'vc_link',
					'heading'    => __( 'Action secondary', 'builderpress' ),
					'param_name' => 'link_secondary',
					'dependency' => array(
						'element' => 'layout',
						'value'   => array(
							'layout-4',
                            'layout-5'
						)
					)
				),

				/* Typography Group */
				// Title size
				array(
					'type'        => 'dropdown',
					'admin_label' => false,
					'heading'     => esc_html__( 'Title size', 'builderpress' ),
					'param_name'  => 'title_tag',
					'value'       => $this->_setting_tags(),
					'std'         => 'h3',
					'group'       => esc_html__( 'Typography', 'builderpress' )
				),

				// Title font size
				array(
					'type'             => 'number',
					'admin_label'      => false,
					'heading'          => esc_html__( 'Title font size', 'builderpress' ),
					'param_name'       => 'title_font_size',
					'std'              => '',
					'description'      => esc_html__( 'Custom title font size. Unit is pixel', 'builderpress' ),
					'edit_field_class' => 'vc_col-sm-6',
					'group'            => esc_html__( 'Typography', 'builderpress' )
				),

				// Custom Title font weight
				array(
					'type'        => 'dropdown',
					'admin_label' => false,
					'heading'     => esc_html__( 'Title font weight', 'builderpress' ),
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
					'std'              => '',
					'edit_field_class' => 'vc_col-sm-6',
					'group'            => esc_html__( 'Typography', 'builderpress' )
				),

				/* Color Group */
				// Title Color
				array(
					'type'             => 'colorpicker',
					'heading'          => __( 'Title color', 'builderpress' ),
					'param_name'       => 'color_title',
					'edit_field_class' => 'vc_col-sm-4',
					'group'            => esc_html__( 'Color', 'builderpress' )
				),
				// Description Color
				array(
					'type'             => 'colorpicker',
					'heading'          => __( 'Description color', 'builderpress' ),
					'param_name'       => 'color_desc',
					'edit_field_class' => 'vc_col-sm-4',
					'group'            => esc_html__( 'Color', 'builderpress' )
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

                // background gradient
                array(
                    'type'             => 'dropdown',
                    'admin_label'      => false,
                    'heading'          => esc_html__( 'Background color style', 'builderpress' ),
                    'param_name'       => 'background_color',
                    'description'      => __( 'Position of icon relative to content.', 'builderpress' ),
                    'value'            => array(
                        esc_html__('Default', 'builderpress')  => 'background-default',
                        esc_html__( 'Gradient', 'builderpress' )    => 'background-gradient',
                    ),
                    'dependency' => array(
                        'element' => 'layout',
                        'value'   => array(
                            'layout-3',
                        )
                    ),
                    'std'              => 'background-default',
                    'edit_field_class' => 'vc_col-sm-6'
                ),

			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_styles() {
			return array(
				'call-to-action' => array(
					'src' => 'call-to-action.css'
				)
			);
		}
	}
}
