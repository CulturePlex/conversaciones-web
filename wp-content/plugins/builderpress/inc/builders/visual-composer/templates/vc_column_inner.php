<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $el_id
 * @var $width
 * @var $css
 * @var $offset
 * @var $content - shortcode content
 * Shortcode class
 * @var $this    WPBakeryShortCode_VC_Column_Inner
 */
$bp_css_tablet = $bp_css_mobile = $overlay_color = $background_position = $background_size = $el_class = $width = $el_id = $css = $offset = $tablet_padding = $mobile_padding = $overlay_html = '';
$output        = '';
$atts          = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$width = wpb_translateColumnWidthToSpan( $width );
$width = vc_column_offset_class_merge( $offset, $width );


$css_classes = array(
	$this->getExtraClass( $el_class ),
	'wpb_column',
	'vc_column_container',
	$width,
);

if ( vc_shortcode_custom_css_has_property(
	$css, array(
	'border',
	'background',
)
) ) {
	$css_classes[] = 'vc_col-has-fill';
}

if ( $overlay_color ) {
	$css_classes[] = 'bp-row-background-overlay';
	$overlay_html  .= '<div class="overlay" style="background-color: ' . esc_attr( $overlay_color ) . '"></div>';
}
if ( $background_position ) {
	$css_classes[] = 'bp-background-position-' . $background_position;
}
if ( $background_size ) {
	$css_classes[] = 'bp-background-size-' . $background_size;
}


$wrapper_attributes = $wrapper_inner_attributes = array();

// responsive data
if ( ! empty( $bp_css_tablet ) ) {
	$wrapper_inner_attributes[] = 'data-class-tablet="' . esc_attr( vc_shortcode_custom_css_class( $bp_css_tablet ) ) . '"';
}
if ( ! empty( $bp_css_mobile ) ) {
	$wrapper_inner_attributes[] = 'data-class-mobile="' . esc_attr( vc_shortcode_custom_css_class( $bp_css_mobile ) ) . '"';
}

$css_class            = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

$output           .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$innerColumnClass = 'vc_column-inner ' . esc_attr( trim( vc_shortcode_custom_css_class( $css ) ) );
$output           .= '<div class="' . trim( $innerColumnClass ) . '" ' . implode( ' ', $wrapper_inner_attributes ) . '>';
$output           .= '<div class="wpb_wrapper">';
$output           .= wpb_js_remove_wpautop( $content );
$output           .= '</div>';
$output           .= '</div>';
$output           .= '</div>';

echo $output;
