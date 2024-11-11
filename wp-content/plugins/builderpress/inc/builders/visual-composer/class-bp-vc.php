<?php
/**
 * BuilderPress handler class
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

if ( ! class_exists( 'BuilderPress_VC' ) ) {
	/**
	 * Class BuilderPress_VC
	 */
	class BuilderPress_VC {
		/**
		 * BuilderPress_VC constructor.
		 */
		public function __construct() {

			require_once( BUILDER_PRESS_INC . 'builders/visual-composer/class-bp-vc-shortcode.php' );
			require_once( BUILDER_PRESS_INC . 'builders/visual-composer/class-bp-vc-font.php' );

			// init
			add_action( 'init', array( $this, 'init' ) );

			// register extra params
			add_action( 'vc_before_init', array( $this, 'register_extra_params' ) );

			// load shortcodes
			add_action( 'vc_before_init', array( $this, 'load_shortcodes' ) );

			// Override default shortcodes template dir
			add_action( 'vc_before_init', array( $this, 'override_template_dir' ) );
		}

		/**
		 * Add custom attributes to vc_row, vc_column
		 */
		public function init() {
			if ( ! class_exists( 'Vc_Manager' ) ) {
				return;
			}

			$row_background_overlay = apply_filters( 'buildpress-vc-design-row', array(
				array(
					'type'       => 'colorpicker',
					'heading'    => __( 'Background Overlay', 'builderpress' ),
					'param_name' => 'overlay_color',
					'value'      => '',
					'group'      => 'Design Options',
                    'edit_field_class' => 'vc_col-sm-4',
				),
                array(
                    'type'       => 'dropdown',
                    'heading'    => __( 'Background Position', 'builderpress' ),
                    'param_name' => 'background_position',
                    'value' => array(
                        'Default' => '',
                        'Left Center' => 'left-center',
                        'Left Top' => 'left-top',
                        'Left Bottom' => 'left-bottom',
                        'Center Center' => 'center-center',
                        'Center Top' => 'center-top',
                        'Center Bottom' => 'center-bottom',
                        'Right Center' => 'right-center',
                        'Right Top' => 'right-top',
                        'Right Bottom' => 'right-bottom',
                    ),
                    'group'      => 'Design Options',
                    'edit_field_class' => 'vc_col-sm-4',
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => __( 'Background Size', 'builderpress' ),
                    'param_name' => 'background_size',
                    'value' => array(
                        'Auto' => 'auto',
                        'Contain' => 'contain',
                        'Cover' => 'cover',
                        'Inherit' => 'inherit',
                        'Initial' => 'initial',
                        'Unset' => 'unset',
                    ),
                    'group'      => 'Design Options',
                    'edit_field_class' => 'vc_col-sm-4',
                )
			) );
            $responsive_atts_row = apply_filters( 'buildpress-responsive-atts-row', array(
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
            ) );

			$row_atts = array_merge( $row_background_overlay, $responsive_atts_row);
			vc_add_params( 'vc_row', $row_atts );
			vc_add_params( 'vc_row_inner', $row_atts );

            vc_add_params( 'vc_column', $row_atts );
			vc_add_params( 'vc_column_inner', $row_atts );
		}

		/**
		 * Override default shortcode template dir
		 */
		public function override_template_dir() {
			// Link your VC elements's folder
			if ( function_exists( 'vc_set_shortcodes_templates_dir' ) ) {
				vc_set_shortcodes_templates_dir( BUILDER_PRESS_INC . 'builders/visual-composer/templates/' );
			}
		}


		/**
		 * Load shortcodes
		 */
		public function load_shortcodes() {

			$shortcodes = builder_press_get_elements();

			foreach ( $shortcodes as $group => $_shortcodes ) {
				foreach ( $_shortcodes as $shortcode ) {
					$file = apply_filters( 'builder-press/vc-shortcode-file', BUILDER_PRESS_INC . "elements/$group/$shortcode/class-vc-$shortcode.php", $shortcode );
					if ( file_exists( $file ) ) {
						include_once $file;
					}
				}
			}
		}

		/**
		 * Register VC extra params.
		 * Register VC extra params.
		 */
		public function register_extra_params() {
			if ( function_exists( 'vc_add_shortcode_param' ) ) {
				vc_add_shortcode_param( 'number', array( $this, '_number_param' ) );
				vc_add_shortcode_param( 'radio_image', array( $this, '_radio_image_param' ) );
				vc_add_shortcode_param( 'datetimepicker', array( $this, '_datetimepicker_param' ) );
				vc_add_shortcode_param( 'dropdown_multiple', array( $this, '_dropdown_multiple_param' ) );

				do_action( 'builder-press/register-extra-params' );
			}
		}

		/**
		 * @param $settings
		 * @param $value
		 *
		 * @return string
		 */
		public function _datetimepicker_param( $settings, $value ) {
			$param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
			$type       = isset( $settings['type'] ) ? $settings['type'] : '';
			$class      = isset( $settings['class'] ) ? $settings['class'] : '';
			$value      = isset( $value ) ? $value : $settings['value'];
			$output     = '<input type="text" name="' . $param_name . '" class="bp-datetimepicker wpb_vc_param_value ' . $param_name . ' ' . $type . '_field ' . $class . '" value="' . $value . '"  />';
			$output     .= '<script>jQuery(\'.bp-datetimepicker\').datetimepicker();</script>';
			$output     .= '';

			return $output;
		}

		/**
		 * @param $settings
		 * @param $value
		 *
		 * @return string
		 */
		public function _number_param( $settings, $value ) {
			$param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
			$type       = isset( $settings['type'] ) ? $settings['type'] : '';
			$min        = isset( $settings['min'] ) ? $settings['min'] : '';
			$max        = isset( $settings['max'] ) ? $settings['max'] : '';
			$suffix     = isset( $settings['suffix'] ) ? $settings['suffix'] : '';
			$class      = isset( $settings['class'] ) ? $settings['class'] : '';
			$value      = isset( $value ) ? $value : $settings['value'];
			$output     = '<input type="number" min="' . $min . '" max="' . $max . '" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="' . $value . '" style="max-width:100px; margin-right: 10px;" />' . $suffix;

			return $output;
		}

		/**
		 * @param $settings
		 * @param $value
		 *
		 * @return string
		 */
		public function _radio_image_param( $settings, $value ) {
			$param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
			$type       = isset( $settings['type'] ) ? $settings['type'] : '';
			$radios     = isset( $settings['options'] ) ? $settings['options'] : '';
			$class      = isset( $settings['class'] ) ? $settings['class'] : '';
			$output     = '<input type="hidden" name="' . $param_name . '" id="' . $param_name . '" class="wpb_vc_param_value ' . $param_name . ' ' . $type . '_field ' . $class . '" value="' . $value . '"  ' . ' />';
			$output     .= '<div id="' . $param_name . '_wrap" class="icon_style_wrap ' . $class . '" >';
			if ( $radios != '' && is_array( $radios ) ) {
				$i = 0;
				foreach ( $radios as $key => $image_url ) {
					$class   = ( $key == $value ) ? ' class="selected" ' : '';
					$image   = '<img id="' . $param_name . $i . '_img' . $key . '" src="' . $image_url . '" ' . $class . '/>';
					$checked = ( $key == $value ) ? ' checked="checked" ' : '';
					$output  .= '<input name="' . $param_name . '_option" id="' . $param_name . $i . '" value="' . $key . '" type="radio" '
					            . 'onchange="document.getElementById(\'' . $param_name . '\').value=this.value;'
					            . 'jQuery(\'#' . $param_name . '_wrap img\').removeClass(\'selected\');'
					            . 'jQuery(\'#' . $param_name . $i . '_img' . $key . '\').addClass(\'selected\');'
					            . 'jQuery(\'#' . $param_name . '\').trigger(\'change\');" '
					            . $checked . ' style="display:none;" />';
					$output  .= '<label for="' . $param_name . $i . '">' . $image . '</label>';
					$i ++;
				}
			}
			$output .= '</div>';

			return $output;
		}

		/**
		 * @param $settings
		 * @param $value
		 *
		 * @return string
		 */
		public function _dropdown_multiple_param( $settings, $value ) {
			$output     = '';
			$css_option = str_replace( '#', 'hash-', vc_get_dropdown_option( $settings, $value ) );
			$output     .= '<select name="'
			               . $settings['param_name']
			               . '" class="wpb_vc_param_value wpb-input wpb-select '
			               . $settings['param_name']
			               . ' ' . $settings['type']
			               . ' ' . $css_option
			               . '" multiple data-option="' . $css_option . '">';
			if ( is_array( $value ) ) {
				$value = isset( $value['value'] ) ? $value['value'] : array_shift( $value );
			}
			if ( ! empty( $settings['value'] ) ) {
				foreach ( $settings['value'] as $index => $data ) {
					if ( is_numeric( $index ) && ( is_string( $data ) || is_numeric( $data ) ) ) {
						$option_label = $data;
						$option_value = $data;
					} elseif ( is_numeric( $index ) && is_array( $data ) ) {
						$option_label = isset( $data['label'] ) ? $data['label'] : array_pop( $data );
						$option_value = isset( $data['value'] ) ? $data['value'] : array_pop( $data );
					} else {
						$option_value = $data;
						$option_label = $index;
					}
					$selected            = '';
					$option_value_string = (string) $option_value;
					$value_string        = (string) $value;
					if ( '' !== $value && $option_value_string === $value_string ) {
						$selected = ' selected="selected"';
					}
					$option_class = str_replace( '#', 'hash-', $option_value );
					$output       .= '<option class="' . esc_attr( $option_class ) . '" value="' . esc_attr( $option_value ) . '" ' . $selected . '>'
					                 . htmlspecialchars( $option_label ) . '</option>';
				}
			}
			$output .= '</select>';

			return $output;
		}
	}
}

new BuilderPress_VC();