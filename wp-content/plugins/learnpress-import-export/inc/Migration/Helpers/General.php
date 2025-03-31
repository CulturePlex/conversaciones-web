<?php

namespace LPImportExport\Migration\Helpers;

class General {
	public static function get_default_image() {
		return LP_MT_ASSETS_URL . 'images/no-image.jpg';
	}

	public static function get_logo() {
		return LP_MT_ASSETS_URL . 'images/logo.png';
	}

	public static function ksesHTML( $content ) {
		$allowed_html = wp_kses_allowed_html( 'post' );

		$allowed_html['iframe'] = array(
			'src'         => 1,
			'width'       => 1,
			'height'      => 1,
			'style'       => 1,
			'class'       => array( 'embed-responsive-item' ),
			'frameborder' => 1,
		);

		$allowed_html['input'] = array(
			'src'         => 1,
			'width'       => 1,
			'height'      => 1,
			'type'        => array(),
			'placeholder' => 1,
			'value'       => 1,
			'class'       => array( 'embed-responsive-item' ),
			'frameborder' => 1,
			'name'        => 1,
			'min'         => 1,
			'max'         => 1,
		);

		$allowed_html['form'] = array(
			'class' => 1,
			'style' => 1,
		);

		$allowed_html['textarea'] = array(
			'placeholder' => 1,
			'cols'        => 1,
			'rows'        => 1,
			'name'        => 1,
		);

		$allowed_html['select'] = array(
			'placeholder' => 1,
			'cols'        => 1,
			'rows'        => 1,
			'name'        => 1,
			'title'       => 1,
		);

		$allowed_html['option'] = array(
			'selected' => 1,
		);

		$allowed_html['svg'] = array(
			'width' => true,
			'height' => true,
			'viewBox' => true,
			'fill' => true,
			'xmlns' => true,
			'clip-path' => true,
			'xlink' => true,
			'version' => true,
			'id' => true,
		);

		$allowed_html['path'] = array(
			'd' => true,
			'fill' => true,
		);

		$allowed_html['g'] = array(
			'clip-path' => true,
		);

		$allowed_html['defs'] = array();

		$allowed_html['clipPath'] = array(
			'id' => true,
		);

		$allowed_html['rect'] = array(
			'width' => true,
			'height' => true,
			'fill' => true,
			'transform' => true,
		);


		return wp_kses( wp_unslash( $content ), $allowed_html );
	}

	/**
	 * @param $length
	 *
	 * @return string
	 */
	public static function get_unique_id($length = 12) {
		return substr(md5(uniqid('', true)), 0, $length);
	}
}
