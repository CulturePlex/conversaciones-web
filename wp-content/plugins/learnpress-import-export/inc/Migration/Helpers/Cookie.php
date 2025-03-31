<?php

namespace LPImportExport\Migration\Helpers;

class Cookie {

	private static function get_domain() {
		return parse_url( home_url( '/' ), PHP_URL_HOST );
	}

	public static function set_cookie( $name, $value, $exprire_time ) {
		if ( isset( $_COOKIE[ $name ] ) ) {
			self::delete_cookie( $name );
		}
		setcookie(
			$name,
			$value,
			$exprire_time,
			'/',
			self::get_domain(),
			is_ssl(),
			true
		);
	}

	/**
	 * @param $name
	 *
	 * @return mixed|string
	 */
	public static function get_cookie( $name ) {
		return $_COOKIE[ $name ] ?? '';
	}

	public static function delete_cookie( $cookie ) {
		unset( $_COOKIE[ $cookie ] );
		setcookie( $cookie, 'delete', time() - 3600, '/', self::get_domain(), is_ssl(), true );
	}
}
