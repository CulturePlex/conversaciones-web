<?php
/**
 * Panel Thim Our Team plugin
 *
 * @package Ivy-School
 */

thim_customizer()->add_panel(
	array(
		'id'       => 'event',
		'priority' => 50,
		'title'    => esc_html__( 'Events', 'ivy-school' ),
		'icon'     => 'dashicons-groups',
	)
);