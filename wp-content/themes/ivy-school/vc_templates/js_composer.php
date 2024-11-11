<?php
/*
 * Modify Gallery type file - Images Gallery Shortcode
 * */
add_action( 'vc_after_init', 'thim_vc_after_init_actions' );

function thim_vc_after_init_actions() {

	$vc_gallery_type_field_modify = array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Gallery type', 'ivy-school' ),
			'param_name'  => 'type',
			'value'       => array(
                esc_html__( 'Flex slider fade', 'ivy-school' )  => 'flexslider_fade',
                esc_html__( 'Flex slider slide', 'ivy-school' ) => 'flexslider_slide',
                esc_html__( 'Nivo slider', 'ivy-school' )       => 'nivo',
                esc_html__( 'Image grid', 'ivy-school' )        => 'image_grid',
                esc_html__( 'Thim slider', 'ivy-school' )       => 'thim_slider'
			),
			'description' => esc_html__( 'Select gallery type.', 'ivy-school' ),
		),
	);

	vc_add_params( 'vc_gallery', $vc_gallery_type_field_modify );
}
