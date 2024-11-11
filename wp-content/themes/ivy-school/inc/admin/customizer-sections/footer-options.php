<?php
/**
 * Section Footer Settings
 *
 */

// Add Section Footer Options
thim_customizer()->add_section(
	array(
		'id'       => 'footer_options',
		'title'    => esc_html__( 'Settings', 'ivy-school' ),
		'panel'    => 'footer',
		'priority' => 10,
	)
);

// Feature: Footer custom class
thim_customizer()->add_field(
    array(
        'type'     => 'text',
        'id'       => 'footer_custom_class',
        'label'    => esc_html__( 'Footer Custom Class', 'ivy-school' ),
        'tooltip'  => esc_html__( 'Enter footer custom class.', 'ivy-school' ),
        'section'  => 'footer_options',
        'priority' => 15,
    )
);

// Enable or Disable Footer Widgets
thim_customizer()->add_field(
	array(
		'type'     => 'switch',
		'id'       => 'footer_widgets',
		'label'    => esc_html__( 'Show Footer Widgets', 'ivy-school' ),
		'tooltip'  => esc_html__( 'Turn on to display footer widgets.', 'ivy-school' ),
		'section'  => 'footer_options',
		'default'  => true,
		'priority' => 20,
		'choices'  => array(
			true  => esc_html__( 'On', 'ivy-school' ),
			false => esc_html__( 'Off', 'ivy-school' ),
		),
	)
);

// Footer Column Numbers
thim_customizer()->add_field(
	array(
		'type'            => 'slider',
		'id'              => 'footer_columns',
		'label'           => esc_html__( 'Sidebar Number', 'ivy-school' ),
		'tooltip'         => esc_html__( 'Controls the number of columns in the footer.', 'ivy-school' ),
		'section'         => 'footer_options',
		'default'         => 4,
		'priority' 		  => 30,
		'choices'         => array(
			'min'  => '1',
			'max'  => '6',
			'step' => '1',
		),
		'active_callback' => array(
			array(
				'setting'  => 'footer_widgets',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

// Footer Background Color
thim_customizer()->add_field(
	array(
		'type'      => 'color',
		'id'        => 'footer_background_color',
		'label'     => esc_html__( 'Background Color', 'ivy-school' ),
		'section'   => 'footer_options',
		'default'   => '#242d5b',
		'priority'  => 40,
		'alpha'     => true,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => 'footer#colophon .footer',
				'function' => 'css',
				'property' => 'background-color',
			),
		),
	)
);

// Footer Text Color
thim_customizer()->add_field(
	array(
		'type'      => 'multicolor',
		'id'        => 'footer_color',
		'label'     => esc_html__( 'Colors', 'ivy-school' ),
		'section'   => 'footer_options',
		'priority'  => 50,
		'choices'   => array(
			'title' => esc_html__( 'Title', 'ivy-school' ),
			'text'  => esc_html__( 'Text', 'ivy-school' ),
			'link'  => esc_html__( 'Link', 'ivy-school' ),
			'hover' => esc_html__( 'Hover', 'ivy-school' ),
		),
		'default'   => array(
			'title' => '#ffffff',
			'text'  => '#cccccc',
			'link'  => '#cccccc',
			'hover' => '#c48981',
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'title',
				'element'  => 'footer#colophon h1, footer#colophon h2, footer#colophon h3, footer#colophon h4, footer#colophon h5, footer#colophon h6',
				'property' => 'color',
			),
			array(
				'choice'   => 'text',
				'element'  => 'footer#colophon',
				'property' => 'color',
			),
			array(
				'choice'   => 'link',
				'element'  => 'footer#colophon a',
				'property' => 'color',
			),
			array(
				'choice'   => 'hover',
				'element'  => 'footer#colophon a:hover',
				'property' => 'color',
			),
		),
	)
);