<?php
/**
 * Created by PhpStorm.
 * User: khoapq
 * Date: 1/17/2017
 * Time: 11:31 AM
 */
thim_customizer()->add_panel(
	array(
		'id'       => 'nav_menus',
		'priority' => 90,
		'title'    => esc_html__( 'Menus', 'ivy-school' ),
		'icon'     => 'dashicons-menu'
	)
);
