<?php
/**
 * BuilderPress Countdown config class
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

if ( ! class_exists( 'BuilderPress_Config_Countdown' ) ) {
	/**
	 * Class BuilderPress_Config_Countdown
	 */
	class BuilderPress_Config_Countdown extends BuilderPress_Abstract_Config {

		/**
		 * BuilderPress_Config_Countdown constructor.
		 */
		public function __construct() {
			// info
			$this->base = 'countdown';
			$this->name = __( 'Countdown', 'builderpress' );
			$this->desc = __( 'Display countdown', 'builderpress' );

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
                        'kindergarten-layout-1' => $this->assets_url . 'images/kindergarten-layout-1.png',
                    ),
                    'std'        => 'layout-1'
                ),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Title', 'builderpress' ),
					'param_name' => 'title',
					//'std'        => __( 'This is title', 'builderpress' ),
				),
				array(
					'type'       => 'datetimepicker',
					'heading'    => esc_html__( 'Date', 'builderpress' ),
					'param_name' => 'countdown-date'
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Text year', 'builderpress' ),
					'param_name'       => 'text_year',
					'std'              => __( 'Year(s)', 'builderpress' ),
					'edit_field_class' => 'vc_col-xs-4',
					'group'            => __( 'Advance', 'builderpress' )
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Text month', 'builderpress' ),
					'param_name'       => 'text_month',
					'std'              => __( 'Month(s)', 'builderpress' ),
					'edit_field_class' => 'vc_col-xs-4',
					'group'            => __( 'Advance', 'builderpress' )
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Text week', 'builderpress' ),
					'param_name'       => 'text_week',
					'std'              => __( 'Week(s)', 'builderpress' ),
					'edit_field_class' => 'vc_col-xs-4',
					'group'            => __( 'Advance', 'builderpress' )
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Text day', 'builderpress' ),
					'param_name'       => 'text_day',
					'std'              => __( 'Day(s)', 'builderpress' ),
					'edit_field_class' => 'vc_col-xs-4',
					'group'            => __( 'Advance', 'builderpress' )
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Text hour', 'builderpress' ),
					'param_name'       => 'text_hour',
					'std'              => __( 'Hour(s)', 'builderpress' ),
					'edit_field_class' => 'vc_col-xs-4',
					'group'            => __( 'Advance', 'builderpress' )
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Text minute', 'builderpress' ),
					'param_name'       => 'text_minute',
					'std'              => __( 'Minute(s)', 'builderpress' ),
					'edit_field_class' => 'vc_col-xs-4',
					'group'            => __( 'Advance', 'builderpress' )
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Text second', 'builderpress' ),
					'param_name'       => 'text_second',
					'std'              => __( 'Second(s)', 'builderpress' ),
					'edit_field_class' => 'vc_col-xs-4',
					'group'            => __( 'Advance', 'builderpress' )
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
				'countdown' => array(
					'src'  => 'countdown.css',
					'deps' => array(
						'builder-press-countdown'
					)
				)
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'countdown' => array(
					'src'  => 'countdown.js',
					'deps' => array(
						'jquery',
						'builder-press-jquery-plugin',
						'builder-press-countdown'
					)
				)
			);
		}
	}
}
