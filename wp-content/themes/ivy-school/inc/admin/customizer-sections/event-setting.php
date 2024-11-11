<?php
/**
 * Section Thim Our Team plugin
 *
 */

thim_customizer()->add_section(
	array(
		'id'       => 'event_setting',
		'panel'    => 'event',
		'title'    => esc_html__( 'Settings', 'ivy-school' ),
		'priority' => 15,
	)
);

thim_customizer()->add_field(
	array(
		'type'     => 'slider',
		'id'       => 'number_feature',
		'label'    => esc_html__( 'Amount Events Feature', 'ivy-school' ),
		'tooltip'  => esc_html__( 'Choose the number of event on feature box.', 'ivy-school' ),
		'section'  => 'event_setting',
		'priority' => 5,
		'default'  => 3,
		'choices'  => array(
			'min'  => '1',
			'max'  => '10',
			'step' => '1',
		),
	)
);