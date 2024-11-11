<?php
/**
 * BuilderPress Social Links config class
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

if ( ! class_exists( 'BuilderPress_Config_Social_Links' ) ) {
 	/**
	 * Class BuilderPress_Config_Social_Links
	 */
	class BuilderPress_Config_Social_Links extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_Social_Links constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'social-links';
			$this->name = __( 'Social Links', 'builderpress' );
			$this->desc = __( 'Display a list of social accounts linked with your site', 'builderpress' );

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
                    'type'        => 'radio_image',
                    'heading'     => __( 'Layout', 'builderpress' ), 
                    'param_name'  => 'layout',
                    'options'     => array(
                        'default' => $this->assets_url . 'images/layout/default.jpg',
                        'vblog-layout-header-1' => $this->assets_url . 'images/layout/vblog-layout-1.jpg',
                        'vblog-layout-header-2' => $this->assets_url . 'images/layout/vblog-layout-header-2.jpg',
                        'vblog-layout-footer' => $this->assets_url . 'images/layout/vblog-layout-footer.jpg',
                        'vblog-layout-footer-2' => $this->assets_url . 'images/layout/vblog-layout-footer-2.jpg',
                        'vblog-layout-sidebar' => $this->assets_url . 'images/layout/vblog-layout-sidebar.png',
                        'kindergarten-layout-footer-1' => $this->assets_url . 'images/layout/kindergarten-layout-footer-1.jpg',
                        'kindergarten-layout-footer-2' => $this->assets_url . 'images/layout/kindergarten-layout-footer-2.jpg',
                        'kindergarten-layout-footer-3' => $this->assets_url . 'images/layout/kindergarten-layout-footer-3.jpg',
                    ),
                    'std'         => 'default',
                    'admin_label' => true,
                    'description' => __( 'Select type of style.', 'builderpress' )
                ),
				array(
					'type'       => 'textfield',
					'heading'    => __( 'Title', 'builderpress' ),
					'param_name' => 'title',
				),
				array(
					'type'       => 'param_group',  
					'value'      => '',
					'param_name' => 'links',
					'params'     => array(
						array(
							'type'             => 'iconpicker', 
							'heading'          => __( 'Icon', 'builderpress' ),
							'param_name'       => 'icon',
							'description'      => __( 'Select icon from library.', 'builderpress' ),
							'value'            => 'fa fa-facebook',
							'settings'         => array(
								'emptyIcon'    => false,
								'iconsPerPage' => 50,
								'type'         => 'fontawesomes'
							),
							'edit_field_class' => 'vc_col-sm-6'
						),
						// Upload icon image
						array(
							'type'             => 'textfield',
							'heading'          => __( 'Link', 'builderpress' ),
							'param_name'       => 'url',
							'std'              => '#',
							'edit_field_class' => 'vc_col-sm-6'
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
                array(
                    'type' => 'css_editor',
                    'heading' => __( 'CSS Shortcode', 'js_composer' ),
                    'param_name' => 'bp_css',
                    'group' => __( 'Design Options', 'js_composer' ),
                )
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_styles() {
			return array(
				'social-links' => array(
					'src' => 'social-links.css'
				)
			);
		}
	}
}
