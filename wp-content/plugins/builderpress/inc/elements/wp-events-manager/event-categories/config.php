<?php
/**
 * BuilderPress Event Categories config class
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

if ( ! class_exists( 'BuilderPress_Config_Event_Categories' ) ) {
	/**
	 * Class BuilderPress_Config_Event_Categories
	 */
	class BuilderPress_Config_Event_Categories extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_Event_Categories constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'event-categories';
			$this->name = __( 'Event Categories', 'builderpress' );
			$this->desc = __( 'Display event categories', 'builderpress' );

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
                    'type'        => 'textfield',
                    'heading'     => __( 'Title', 'builderpress' ),
                    'param_name'  => 'title',
                    'admin_label' => true,
				//	'std'              => __( 'This is title', 'builderpress' ),
                ),
				array(
					'type'             => 'checkbox',
					'heading'          => esc_html__( 'Show course counts', 'builderpress' ),
					'param_name'       => 'show_count',
					'std'              => true,
					'admin_label'      => true,
					'edit_field_class' => 'vc_col-xs-6'
				),
				array(
					'type'             => 'checkbox',
					'heading'          => esc_html__( 'Show hierarchy', 'builderpress' ),
					'param_name'       => 'show_hierarchy',
					'std'              => true,
					'admin_label'      => true,
					'edit_field_class' => 'vc_col-xs-6'
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
				'event-categories' => array(
					'src' => 'event-categories.css'
				)
			);
		}
	}
}
