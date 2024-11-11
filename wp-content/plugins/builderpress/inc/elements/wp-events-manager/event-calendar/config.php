<?php
/**
 * BuilderPress Event Calendar config class
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

if ( ! class_exists( 'BuilderPress_Config_Event_Calendar' ) ) {
	/**
	 * Class BuilderPress_Config_Event_Calendar
	 */
	class BuilderPress_Config_Event_Calendar extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_Event_Calendar constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'event-calendar';
			$this->name = __( 'Event Calendar', 'builderpress' );
			$this->desc = __( 'Display event calendar', 'builderpress' );

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
					//'std'              => __( 'This is title', 'builderpress' ),
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
                    'param_name' => 'at_css',
                    'group' => __( 'Design Options', 'js_composer' ),
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
				'event-calendar' => array(
					'src' => 'event-calendar.css'
				)
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'event-calendar' => array(
					'src'  => 'event-calendar.js',
					'deps' => array(
						'jquery',
                        'jquery-ui'
					)
				)
			);
		}
	}
}
