<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $css
 * @var $el_id
 * @var $equal_height
 * @var $content_placement
 * @var $content - shortcode content
 * Shortcode class
 * @var $this    WPBakeryShortCode_VC_Row_Inner
 */
$el_class        = $equal_height = $content_placement = $overlay_color = $background_position = $background_size = $css = $el_id = $bp_css_tablet = $bp_css_mobile = '';
$disable_element = $overlay_html = '';
$output          = $after_output = '';
$atts            = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class    = $this->getExtraClass( $el_class );
$css_classes = array(
	'vc_row',
	'wpb_row',
	//deprecated
	'vc_inner',
	'vc_row-fluid',
	$el_class,
    vc_shortcode_custom_css_class( $css ),
);

/**
 * @thim custom
 * background overlay
 */
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

if ( 'yes' === $disable_element ) {
	if ( vc_is_page_editable() ) {
		$css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
	} else {
		return '';
	}
}

if ( vc_shortcode_custom_css_has_property( $css, array(
	'border',
	'background',
) ) ) {
	$css_classes[] = 'vc_row-has-fill';
}

if ( ! empty( $atts['gap'] ) ) {
	$css_classes[] = 'vc_column-gap-' . $atts['gap'];
}

if ( ! empty( $equal_height ) ) {
	$flex_row      = true;
	$css_classes[] = 'vc_row-o-equal-height';
}

if ( ! empty( $atts['rtl_reverse'] ) ) {
	$css_classes[] = 'vc_rtl-columns-reverse';
}

if ( ! empty( $content_placement ) ) {
	$flex_row      = true;
	$css_classes[] = 'vc_row-o-content-' . $content_placement;
}

if ( ! empty( $flex_row ) ) {
	$css_classes[] = 'vc_row-flex';
}

$wrapper_attributes = array();
// responsive data
if ( ! empty( $bp_css_tablet ) ) {
    $wrapper_attributes[] = 'data-class-tablet="' . esc_attr( vc_shortcode_custom_css_class( $bp_css_tablet ) ) . '"';
}
if ( ! empty( $bp_css_mobile ) ) {
    $wrapper_attributes[] = 'data-class-mobile="' . esc_attr( vc_shortcode_custom_css_class( $bp_css_mobile ) ) . '"';
}
// build attributes for wrapper
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

$css_class            = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( array_unique( $css_classes ) ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= $overlay_html;
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
$output .= $after_output;

echo $output;
