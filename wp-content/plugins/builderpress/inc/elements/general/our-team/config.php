<?php
/**
 * BuilderPress Our Team config class
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

if ( ! class_exists( 'BuilderPress_Config_Our_Team' ) ) {
	/**
	 * Class BuilderPress_Config_Our_Team
	 */
	class BuilderPress_Config_Our_Team extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_Our_Team constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'our-team';
			$this->name = __( 'Our Team', 'builderpress' );
			$this->desc = __( 'Display team members', 'builderpress' );

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
							'layout-1'                     => $this->assets_url . 'images/layout-1.png',
							'layout-2'                     => $this->assets_url . 'images/layout-2.png',
							'layout-3'                     => $this->assets_url . 'images/layout-3.png',
							'layout-4'                     => $this->assets_url . 'images/layout-4.png',
							'layout-5'                     => $this->assets_url . 'images/layout-5.png',
							'kindergarten-layout-slider-1' => $this->assets_url . 'images/kindergarten-layout-slider-1.png',
							'kindergarten-layout-slider-2' => $this->assets_url . 'images/kindergarten-layout-slider-2.jpg',
							'kindergarten-layout-slider-3' => $this->assets_url . 'images/kindergarten-layout-slider-3.jpg',
							'marketing-layout-1'           => $this->assets_url . 'images/marketing-layout-1.jpg',
						),
						'std'         => 'layout-1',
						'description' => __( 'Select type of style.', 'builderpress' ),
					),
					array(
						'type'       => 'param_group',
						'heading'    => __( 'Team', 'builderpress' ),
						'param_name' => 'members',
						'value'      => '',
						'params'     => array(
							array(
								'type'       => 'textfield',
								'heading'    => __( 'Name', 'builderpress' ),
								'param_name' => 'name',
								'std'        => __( 'John Doe', 'builderpress' ),
							),
							array(
								'type'       => 'textfield',
								'heading'    => __( 'Profession', 'builderpress' ),
								'param_name' => 'job',
								'std'        => __( 'Senior specialist', 'builderpress' ),
							),
							array(
								'type'       => 'textarea',
								'heading'    => __( 'Description', 'builderpress' ),
								'param_name' => 'description',
								//'std'      => __( 'Senior specialist', 'builderpress' )
							),
							array(
								'type'             => 'attach_image',
								'heading'          => __( 'Photo', 'builderpress' ),
								'param_name'       => 'photo',
								'edit_field_class' => 'vc_col-sm-6',
							),
							array(
								'type'             => 'textfield',
								'heading'          => __( 'URL', 'builderpress' ),
								'param_name'       => 'link',
								'std'              => '#',
								'edit_field_class' => 'vc_col-sm-6',
							),

							array(
								'type'             => 'colorpicker',
								'heading'          => __( 'Background', 'builderpress' ),
								'param_name'       => 'background',
								'edit_field_class' => 'vc_col-sm-6',
								'dependency'       => array(
									'element' => 'layout',
									'value'   => array(
										'kindergarten-layout-slider-2',
									),
								),
							),

							array(
								'type'         => 'param_group',
								'heading'      => __( 'Contact', 'builderpress' ),
								'param_name'   => 'contacts',
								'max_el_items' => 5,
								'params'       => array(
									array(
										'type'        => 'dropdown', 
										'heading'     => __( 'Select type of icon', 'builderpress' ),
										'param_name'  => 'icon',
										'admin_label' => true,
										'value'       => array(
											__( 'Font Awesome icon', 'builderpress' ) => 'font_awesome',
										),
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
											'type'         => 'fontawesome',
										),
										'dependency'       => array(
											'element' => 'icon',
											'value'   => array( 'font_awesome' ), 
										),
										'edit_field_class' => 'vc_col-sm-6',
									),

									array(
										'type'             => 'textfield',
										'admin_label'      => true,
										'heading'          => __( 'URL', 'builderpress' ),
										'param_name'       => 'url',
										'value'            => '#',
										'edit_field_class' => 'vc_col-sm-6',
									),

									array(
										'type'             => 'colorpicker',
										'admin_label'      => false,
										'heading'          => esc_html__( 'Icon color', 'builderpress' ),
										'param_name'       => 'icon_color',
										'value'            => esc_html__( '', 'builderpress' ),
										'edit_field_class' => 'vc_col-sm-6',
										'dependency'       => array(
											'element' => 'layout',
											'value'   => array(
												'kindergarten-layout-slider-1',
											),
										),
									),

								),
							),
						),
					),
					array(
						'type'             => 'dropdown',
						'admin_label'      => false,
						'heading'          => esc_html__( 'Background color style', 'builderpress' ),
						'param_name'       => 'background_color',
						'description'      => __( 'Position of icon relative to content.', 'builderpress' ),
						'value'            => array(
							esc_html__( 'Default', 'builderpress' )  => 'background-default',
							esc_html__( 'Gradient', 'builderpress' ) => 'background-gradient',
						),
						'dependency'       => array(
							'element' => 'layout',
							'value'   => array(
								'layout-2',
							),
						),
						'std'              => 'background-gradient',
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
					array(
						'type'       => 'css_editor',
						'heading'    => __( 'CSS Shortcode', 'js_composer' ),
						'param_name' => 'bp_css',
						'group'      => __( 'Design Options', 'js_composer' ),
					),
				),
				// config slider number items
				$this->_number_items_options(
					array( 'items_visible' => 3 ),
					array(
						'element' => 'layout',
						'value'   => array( 'layout-1', 'layout-2', 'layout-3' ),
					)
				)
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_styles() {
			return array(
				'our-team' => array(
					'src'  => 'our-team.css',
					'deps' => array(
						'builder-press-owl-carousel',
					),
				),
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'our-team' => array(
					'src'  => 'our-team.js',
					'deps' => array(
						'jquery',
						'builder-press-owl-carousel',
					),
				),
			);
		}
	}
}
