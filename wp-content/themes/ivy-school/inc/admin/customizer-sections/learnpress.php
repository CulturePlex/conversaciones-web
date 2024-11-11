<?php
/**
 * Panel Learnpress plugin
 *
 * @package Eduma
 */

thim_customizer()->add_panel(
	array(
		'id'       => 'learnpress',
		'priority' => 50,
		'title'    => esc_html__( 'Learnpress', 'ivy-school' ),
		'icon'     => 'dashicons-groups',
	)
);