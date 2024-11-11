<?php
/**
 * BuilderPress Elementor Mapping class
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

if ( ! class_exists( 'BuilderPress_SO_Mapping' ) ) {
	/**
	 * Class BuilderPress_SO_Mapping
	 */
	class BuilderPress_SO_Mapping {

		/**
		 * Mapping Visual Composer type to SiteOrigin
		 *
		 * @param $type
		 *
		 * @return bool|mixed
		 */
		private static function _mapping_types( $type ) {

			$mapping = array(
				'number'            => 'number',
				'textfield'         => 'text',
				'vc_link'           => 'so_link',
				'param_group'       => 'repeater',
				'attach_image'      => 'media',
				'iconpicker'        => 'icon',
				'dropdown'          => 'select',
				'colorpicker'       => 'color',
				'textarea'          => 'textarea',
				'textarea_html'     => 'textarea',
				'textarea_raw_html' => 'textarea_raw_html',
				'radio_image'       => 'radioimage',
				'datetimepicker'       => 'sobp_datetime',
				'loop'              => '',
				'checkbox'          => 'checkbox'
			);

			if ( ! array_key_exists( $type, $mapping ) ) {
				return false;
			}

			return apply_filters( 'builder-press/so-mapping-types', $mapping[ $type ], $type );
		}

		/**
		 * @param $params
		 *
		 * @return array
		 */
		public static function mapping_options( $params ) {

			if ( ! is_array( $params ) ) {
				return array();
			}

			// mapping result
			$options = array();

			foreach ( $params as $param ) {

				$type  = $param['type'];
				$field = array();

				// get mapping field
				$field['type'] = self::_mapping_types( $type );

				// add params
				switch ( $type ) {
					// common structure field
					case 'number':
					case 'textfield':
					case 'vc_link':
					case 'attach_image':
					case 'iconpicker':
					case 'colorpicker':
						break;
					case 'param_group':
						// repeat options
						$fields = self::mapping_options( $param['params'] );

						$field = array_merge( $field, array(
							'item_name' => __( 'Item', 'builderpress' ),
							'fields'    => $fields
						) );
						break;
					case 'dropdown':
						$field['options'] = array_flip( $param['value'] );
						break;
					case 'radio_image':
						$field['options'] = $param['options'];
						break;
					default:
						$field = array_merge( $field, apply_filters( 'builder-press/field-so-param', array(), $type ) );
						break;
				}

				// general fields
				$field['label']       = isset( $param['heading'] ) ? $param['heading'] : '';
				$field['description'] = isset( $param['description'] ) ? $param['description'] : '';
				if ( isset( $param['std'] ) ) {
					$field['default'] = $param['std'];
				}

//				$field['class']       = isset( $param['edit_field_class'] ) ? $param['edit_field_class'] : '';

				// handle dependency to state_emitter
				if ( isset( $param['dependency'] ) ) {
					$dependency = $param['dependency'];

					if ( array_key_exists( $dependency['element'], $options ) ) {

						// for parent option
						if ( ! isset( $options[ $dependency['element'] ]['state_emitter'] ) ) {
							$options[ $dependency['element'] ]['state_emitter'] = array(
								'callback' => 'select',
								'args'     => array( $dependency['element'] . '_deps' )
							);
						}

						// for child options
						$state_handler = array();
						if ( isset( $options[ $dependency['element'] ]['options'] ) ) {
							$_parent_options = $options[ $dependency['element'] ]['options'];
							if ( is_array( $_parent_options ) ) {
								foreach ( $_parent_options as $key => $value ) {
									$state_handler[ $dependency['element'] . '_deps[' . $key . ']' ] = array( in_array( $key, (array) ( $dependency['value'] ) ) ? 'show' : 'hide' );
								}
							} else {
								$state_handler[ $dependency['element'] . '_deps[' . $_parent_options . ']' ] = array( in_array( $_parent_options, (array) ( $dependency['value'] ) ) ? 'show' : 'hide' );
							}
						}

						$field['state_handler'] = $state_handler;
					}
				}

				// handle group to section
				if ( isset( $param['group'] ) ) {
					$section_title = $param['group'];

					$section_option = str_replace( ' ', '_', strtolower( $section_title ) );

					if ( ! array_key_exists( $section_option, $options ) ) {
						$options[ $section_option ] = array(
							'type'   => 'section',
							'label'  => $section_title,
							'hide'   => true,
							'fields' => array()
						);
					}
					$options[ $section_option ]['fields'][ $param['param_name'] ] = $field;

				} else {
					$options[ $param['param_name'] ] = $field;
				}
			}

			return $options;
		}
	}
}

new BuilderPress_SO_Mapping();