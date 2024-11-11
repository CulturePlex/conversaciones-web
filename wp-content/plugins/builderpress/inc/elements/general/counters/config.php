<?php
/**
 * BuilderPress Counter Box config class
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

if ( ! class_exists( 'BuilderPress_Config_Counters' ) ) {
	/**
	 * Class BuilderPress_Config_Counters
	 */
	class BuilderPress_Config_Counters extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_Counters constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'counters';
			$this->name = __( 'Counters', 'builderpress' );
			$this->desc = __( 'Display a counters', 'builderpress' );

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
						'layout-1' => $this->assets_url . 'images/layout-1.png',
					),
					'std'        => 'layout-1',
				),

				array(
					'type'       => 'param_group',
					'value'      => '',
					'param_name' => 'counters',
					'params'     => array(
						array(
							'type'             => 'number',
							'heading'          => __( 'Quantity', 'builderpress' ),
							'param_name'       => 'number',
							'std'              => '1000',
							'description'      => __( 'Choose number', 'builderpress' ),
							'edit_field_class' => 'vc_col-sm-4',
						),

						array(
							'type'             => 'textfield',
							'heading'          => __( 'Unit', 'builderpress' ),
							'param_name'       => 'unit',
							'description'      => __( 'Unit of quantify', 'builderpress' ),
							'edit_field_class' => 'vc_col-sm-4',
						),

						array(
							'type'             => 'dropdown',
							'heading'          => esc_html__( 'Separator', 'builderpress' ),
							'param_name'       => 'separator',
							'value'            => array(
								esc_html__( 'None', 'builderpress' )  => '',
								esc_html__( 'Comma', 'builderpress' ) => ',',
								esc_html__( 'Dot', 'builderpress' )   => '.',
								esc_html__( 'Space', 'builderpress' ) => ' ',
							),
							'description'      => __( 'Thousand separator', 'builderpress' ),
							'edit_field_class' => 'vc_col-sm-4',
							'std'              => '',
						),

						array(
							'type'       => 'textfield',
							'heading'    => __( 'Title', 'builderpress' ),
							'param_name' => 'title',
							'std'        => __( 'Point Counter', 'builderpress' ),
						),

						array(
							'type'       => 'textfield',
							'heading'    => __( 'Description', 'builderpress' ),
							'param_name' => 'desc',
							'std'        => '',
						),
					),
				),

				array(
					'type'             => 'dropdown',
					'heading'          => __( 'Style Layout', 'builderpress' ),
					'param_name'       => 'style_layout',
					'value'            => array(
						__( '', 'builderpress' )        => '',
						__( 'Style Default', 'builderpress' ) => 'default',
						__( 'Style 1', 'builderpress' ) => 'default-1',
					),
					'std'              => '',
					'edit_field_class' => 'vc_col-sm-6',
				),
				/* Icon Group */
				array(
					'type'             => 'dropdown',
					'heading'          => esc_attr__( 'Icon type', 'builderpress' ),
					'param_name'       => 'icon_type',
					'admin_label'      => true,
					'value'            => array(
						esc_attr__( 'None', 'builderpress' )         => 'none',
						esc_attr__( 'Font Awesome', 'builderpress' ) => 'icon_fontawesome',
						esc_attr__( 'Ionicon', 'builderpress' )      => 'icon_ionicon',
						esc_attr__( 'Upload Image', 'builderpress' ) => 'icon_upload',
					),
					'std'              => 'none',
					'group'            => esc_html__( 'Icon', 'builderpress' ),
					'edit_field_class' => 'vc_col-sm-6',
				),

				// Fontawesome Picker
				array(
					'type'             => 'iconpicker',
					'heading'          => esc_attr__( 'Font Awesome', 'builderpress' ),
					'param_name'       => 'icon_fontawesome',
					'value'            => 'fa fa-heart',
					'settings'         => array(
						'emptyIcon'    => false,
						'iconsPerPage' => 50,
						'type'         => 'fontawesome',
					),
					'dependency'       => array(
						'element' => 'icon_type',
						'value'   => array( 'icon_fontawesome' ),
					),
					'edit_field_class' => 'vc_col-sm-6',
					'group'            => esc_html__( 'Icon', 'builderpress' ),
					'description'      => esc_html__( 'Font awesome library.', 'builderpress' ),
				),

				// Ionicon Picker
				array(
					'type'             => 'iconpicker',
					'heading'          => esc_attr__( 'Ionicon', 'builderpress' ),
					'param_name'       => 'icon_ionicon',
					'value'            => 'ion-android-add-circle',
					'settings'         => array(
						'emptyIcon'    => false,
						'iconsPerPage' => 50,
						'type'         => 'ionicon',
					),
					'dependency'       => array(
						'element' => 'icon_type',
						'value'   => array( 'icon_ionicon' ),
					),
					'edit_field_class' => 'vc_col-sm-6',
					'group'            => esc_html__( 'Icon', 'builderpress' ),
					'description'      => esc_html__( 'Font awesome library.', 'builderpress' ),
				),

				// Upload icon image
				array(
					'type'             => 'attach_image',
					'heading'          => esc_attr__( 'Upload icon', 'builderpress' ),
					'param_name'       => 'icon_upload',
					'admin_label'      => true,
					'description'      => esc_attr__( 'Select an image to upload', 'builderpress' ),
					'dependency'       => array(
						'element' => 'icon_type',
						'value'   => array( 'icon_upload' ),
					),
					'edit_field_class' => 'vc_col-sm-6',
					'group'            => esc_html__( 'Icon', 'builderpress' ),

				),

				/* Typography Group */
				// Title size
				array(
					'type'        => 'dropdown',
					'admin_label' => false,
					'heading'     => esc_html__( 'Title size', 'builderpress' ),
					'param_name'  => 'title_tag',
					'value'       => $this->_setting_tags(),
					'std'         => '',
					'group'       => esc_html__( 'Typography', 'builderpress' ),
				),

				// Title font size
				array(
					'type'             => 'number',
					'admin_label'      => false,
					'heading'          => esc_html__( 'Title font size', 'builderpress' ),
					'param_name'       => 'title_font_size',
					'std'              => ' ',
					'description'      => esc_html__( 'Custom title font size. Unit is pixel', 'builderpress' ),
					'edit_field_class' => 'vc_col-sm-6',
					'group'            => esc_html__( 'Typography', 'builderpress' ),
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

				// Custom Number font size
				array(
					'type'             => 'number',
					'admin_label'      => false,
					'heading'          => esc_html__( 'Number font size', 'builderpress' ),
					'param_name'       => 'number_font_size',
					'std'              => '',
					'description'      => esc_html__( 'Custom title font size. Unit is pixel', 'builderpress' ),
					'edit_field_class' => 'vc_col-sm-6',
					'group'            => esc_html__( 'Typography', 'builderpress' ),
				),

				// Custom Number font weight
				array(
					'type'        => 'dropdown',
					'admin_label' => false,
					'heading'     => esc_html__( 'Number font weight', 'builderpress' ),
					'param_name'  => 'number_font_weight',
					'description' => esc_html__( 'Select custom title font weight', 'builderpress' ),
					'value'       => $this->_setting_font_weights(),
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
					'std'              => '14',
					'edit_field_class' => 'vc_col-sm-6',
					'group'            => esc_html__( 'Typography', 'builderpress' ),
				),

				// Icon font weight
				array(
					'type'        => 'dropdown',
					'admin_label' => false,
					'heading'     => esc_html__( 'Icon font weight', 'builderpress' ),
					'param_name'  => 'icon_font_weight',
					'description' => esc_html__( 'Select custom icon font weight', 'builderpress' ),
					'value'       => $this->_setting_font_weights(),
					'group'       => esc_html__( 'Typography', 'builderpress' ),
				),

				// Icon font size
				array(
					'type'             => 'number',
					'admin_label'      => false,
					'heading'          => esc_html__( 'Icon font size', 'builderpress' ),
					'param_name'       => 'icon_font_size',
					'description'      => esc_html__( 'Custom icon font size. Unit is pixel', 'builderpress' ),
					'std'              => '14',
					'edit_field_class' => 'vc_col-sm-6',
					'group'            => esc_html__( 'Typography', 'builderpress' ),
				),

				/* Color Group */
				// Number Color
				array(
					'type'             => 'colorpicker',
					'heading'          => __( 'Color Number', 'builderpress' ),
					'param_name'       => 'color_number',
					'std'              => '',
					'edit_field_class' => 'vc_col-sm-4',
					'group'            => esc_html__( 'Color', 'builderpress' ),
				),
				// Title Color
				array(
					'type'             => 'colorpicker',
					'heading'          => __( 'Color Title', 'builderpress' ),
					'param_name'       => 'color_title',
					'std'              => '',
					'edit_field_class' => 'vc_col-sm-4',
					'group'            => esc_html__( 'Color', 'builderpress' ),
				),
				array(
					'type'             => 'colorpicker',
					'heading'          => __( 'Color Icon', 'builderpress' ),
					'param_name'       => 'color_icon',
					'std'              => '',
					'edit_field_class' => 'vc_col-sm-4',
					'group'            => esc_html__( 'Color', 'builderpress' ),
				),
				// Description Color
				array(
					'type'             => 'colorpicker',
					'heading'          => __( 'Color Description', 'builderpress' ),
					'param_name'       => 'desc_color',
					'std'              => '',
					'edit_field_class' => 'vc_col-sm-4',
					'group'            => esc_html__( 'Color', 'builderpress' ),
				),

				/* Spacing Group */
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Box Align', 'builderpress' ),
					'param_name'  => 'align',
					'save_always' => true,
					'value'       => array(
						esc_html__( 'Select', 'builderpress' )        => 'select',
						esc_html__( 'Align Left', 'builderpress' )    => 'left',
						esc_html__( 'Align Center', 'builderpress' )  => 'center',
						esc_html__( 'Align Right', 'builderpress' )   => 'right',
					),
					'group'       => esc_html__( 'Spacing & Align', 'builderpress' ),
					'std'         => 'select',
				),

				// Title Margin
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Title Margin', 'builderpress' ),
					'param_name'  => 'title_margin',
					'std'         => '',
					'admin_label' => false,
					'description' => esc_html__( '0px 0px 0px 0px', 'builderpress' ),
					'group'       => esc_html__( 'Spacing & Align', 'builderpress' ),
				),
				// Number Margin
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Number Margin', 'builderpress' ),
					'param_name'  => 'number_margin',
					'std'         => '',
					'admin_label' => false,
					'description' => esc_html__( '0px 0px 0px 0px', 'builderpress' ),
					'group'       => esc_html__( 'Spacing & Align', 'builderpress' ),
				),
				// Icon Margin
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Icon Margin', 'builderpress' ),
					'param_name'  => 'icon_margin',
					'std'         => '',
					'admin_label' => false,
					'description' => esc_html__( '0px 0px 0px 0px', 'builderpress' ),
					'group'       => esc_html__( 'Spacing & Align', 'builderpress' ),
				),
				// Description Margin
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Description Margin', 'builderpress' ),
					'param_name'  => 'desc_margin',
					'std'         => '',
					'admin_label' => false,
					'description' => esc_html__( '0px 0px 0px 0px', 'builderpress' ),
					'group'       => esc_html__( 'Spacing & Align', 'builderpress' ),
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
				'counters' => array(
					'src' => 'counters.css',
				),
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'counters' => array(
					'src'      => 'counters.js',
					'deps'     => array(
						'jquery',
						'waypoints',
					),
					'deps_src' => array(
						'waypoints' => BUILDER_PRESS_URL . '/assets/libs/waypoints/jquery.waypoints.min.js',
					),
				),
			);
		}
	}
}
