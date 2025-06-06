<?php

namespace LPImportExport\Migration\Helpers;

/**
 * Class Debug
 * @package LPImportExport\Migration\Helpers
 */
class Debug {
	/**
	 * @return bool
	 */
	public static function is_debug(): bool {
		return true;
	}

	/**
	 * @param mixed $variable
	 * @param string $file_path
	 * @param string $line
	 *
	 * @return void
	 */
	public static function var_dump( $variable, string $file_path = '', string $line = '' ) {
		echo '<pre>' . print_r( Validation::sanitize_params_submitted( $variable ), true ) . '</pre>';
		echo 'FILE:' . esc_html( $file_path ) . '<br> LINE:' . esc_html( $line );
	}
}
