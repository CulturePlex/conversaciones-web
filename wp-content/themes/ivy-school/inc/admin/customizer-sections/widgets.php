<?php
/**
 * Created by PhpStorm.
 * User: khoapq
 * Date: 1/17/2017
 * Time: 11:36 AM
 */
thim_customizer()->add_panel(
	array(
		'id'       => 'widgets',
		'priority' => 100,
		'title'    => esc_html__( 'Widgets', 'ivy-school' ),
		'icon'     => 'dashicons-welcome-widgets-menus'
	)
);