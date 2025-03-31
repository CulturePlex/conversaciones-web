<?php

namespace LPImportExport\Migration\Helpers;

use LPImportExport\Migration\Helpers\Forms\FloorPlan;
use LPImportExport\Migration\Helpers\Fields\FileUpload;

/**
 * Class Validation
 * @package LPImportExport\Migration\Helpers
 */
class Validation {
	/**
	 * @param $value
	 * @param $cb
	 *
	 * @return array|mixed|string
	 */
	public static function sanitize_params_submitted( $value, $type_content = 'text' ) {
		$value = wp_unslash( $value );

		if ( is_string( $value ) ) {
			$value = trim( $value );
			switch ( $type_content ) {
				case 'html':
					$value = General::ksesHTML( $value );
					break;
				case 'textarea':
					$value = implode( '\n', array_map( 'sanitize_textarea_field', explode( '\n', $value ) ) );
					break;
				case 'key':
					$value = sanitize_key( $value );
					break;
				default:
					$value = sanitize_text_field( $value );
			}
		} elseif ( is_array( $value ) ) {
			return array_map( array( __CLASS__, 'sanitize_params_submitted' ), $value );
		}

		return $value;
	}

	/**
	 * @param $value
	 * @param $field
	 *
	 * @return float|int|mixed|string
	 */
	public static function validate_number( $value, $field ) {

		if ( is_numeric( $value ) ) {
			if ( isset( $field['min'] ) ) {
				if ( ! is_numeric( $field['min'] ) || $value < $field['min'] ) {
					return '';
				}
			}

			if ( isset( $field['max'] ) ) {
				if ( ! is_numeric( $field['max'] ) || $value > $field['max'] ) {
					return '';
				}
			}
		}

		return $value;
	}

	/**
	 * @param $value
	 * @param $field
	 * @param $user_id
	 *
	 * @return mixed|string
	 */
	public static function validate_file_upload( $value, $field, $user_id ) {
		if ( $field['type'] instanceof FileUpload ) {
			if ( empty( $field['multiple'] ) ) {
				if ( ! empty( $field['max_file_size'] ) ) {
					$is_valid_max_file_size = self::is_valid_max_file_size( $value, $field['max_file_size'] );
					if ( ! $is_valid_max_file_size ) {
						$value = '';
					}
				}

				if ( isset( $field['max_size'] ) && ! empty( $field['max_size'] ) ) {
					$is_valid_max_size = self::is_valid_max_size( $value, $field['max_size'] );
					if ( ! $is_valid_max_size ) {
						$value = '';
					}
				}

				$attachment = get_post( $value );
				if ( $attachment === null || is_wp_error( $attachment ) ) {
					return '';
				}

				if ( ! current_user_can( 'administrator' ) ) {
					if ( intval( $attachment->post_author ) !== intval( $user_id ) ) {
						return '';
					}
				}
			} else {
				$value          = explode( ',', $value );
				$attachment_ids = array();
				foreach ( $value as $attachment_id ) {

					if ( ! empty( $field['max_file_size'] ) ) {
						$is_valid_max_file_size = self::is_valid_max_file_size( $attachment_id, $field['max_file_size'] );
						if ( ! $is_valid_max_file_size ) {
							continue;
						}
					}

					if ( ! empty( $field['max_size'] ) ) {
						$is_valid_max_size = self::is_valid_max_size( $attachment_id, $field['max_size'] );
						if ( ! $is_valid_max_size ) {
							continue;
						}
					}
					if ( ! current_user_can( 'administrator' ) ) {
						$attachment = get_post( $attachment_id );
						if ( $attachment === null || is_wp_error( $attachment ) ) {
							continue;
						}

						if ( intval( $attachment->post_author ) !== intval( $user_id ) ) {
							continue;
						}
					}
					$attachment_ids[] = $attachment_id;
				}

				$value = implode( ',', $attachment_ids );
			}
		}

		return $value;
	}
}
