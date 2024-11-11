<?php
/**
 * Section Header Layout
 *
 * @package Thim_Starter_Theme
 */

thim_customizer()->add_section(
	array(
		'id'       => 'header_layout',
		'title'    => esc_html__( 'Layouts', 'ivy-school' ),
		'panel'    => 'header',
		'priority' => 20,
	)
);

// Select Header Layout
thim_customizer()->add_field(
	array(
		'id'       => 'header_style',
		'type'     => 'radio-image',
		'label'    => esc_html__( 'Header Layouts', 'ivy-school' ),
		'tooltip'  => esc_html__( 'Allows you can select header layout for header on your site. ', 'ivy-school' ),
		'section'  => 'header_layout',
		'default'  => 'header_v1',
		'priority' => 10,
		'choices'  => array(
			'header_v1' => THIM_URI . 'assets/images/header/classic.png',
			'header_v2' => THIM_URI . 'assets/images/header/header-2.png',
            'header_v3' => THIM_URI . 'assets/images/header/header-3.png',
            'header_v4' => THIM_URI . 'assets/images/header/header-2.png',
            'header_v5' => THIM_URI . 'assets/images/header/classic.png',
		),
	)
);

// Header v1 style
/*thim_customizer()->add_field(
	array(
		'id'              => 'header_v1_type',
		'type'            => 'select',
		'label'           => esc_html__( 'Header Styles', 'ivy-school' ),
		'tooltip'         => esc_html__( 'Using for Header Layout 1', 'ivy-school' ),
		'section'         => 'header_layout',
		'priority'        => 15,
		'multiple'        => 0,
		'default'         => 'transparent',
		'choices'         => array(
			'transparent' => esc_html__( 'Transparent', 'ivy-school' ),
			'colored'     => esc_html__( 'Colored', 'ivy-school' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'header_style',
				'operator' => '==',
				'value'    => 'header_v1',
			),
		)
	)
);*/

// Background Header
thim_customizer()->add_field(
	array(
		'id'        => 'header_background_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Background Color', 'ivy-school' ),
		'tooltip'   => esc_html__( 'Allows you can choose background color for your header. ', 'ivy-school' ),
		'section'   => 'header_layout',
		'default'   => '#ffffff',
		'priority'  => 15,
		'alpha'     => true,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => 'body #masthead.site-header',
				'property' => 'background-color',
			)
		)
	)
);

// Select Header Position
thim_customizer()->add_field(
	array(
		'id'       => 'header_position',
		'type'     => 'select',
		'label'    => esc_html__( 'Header Positions', 'ivy-school' ),
		'tooltip'  => esc_html__( 'Allows you can select position layout for header layout. ', 'ivy-school' ),
		'section'  => 'header_layout',
		'priority' => 20,
		'multiple' => 0,
		'default'  => 'default',
		'choices'  => array(
			'default' => esc_html__( 'Default', 'ivy-school' ),
			'overlay' => esc_html__( 'Overlay', 'ivy-school' ),
		),
	)
);

// Padding Top Header
thim_customizer()->add_field(
	array(
		'id'        => 'header_padding_top',
		'type'      => 'dimension',
		'label'     => esc_html__( 'Header Padding Top', 'ivy-school' ),
		'tooltip'   => esc_html__( 'Change padding top for your header. ', 'ivy-school' ),
		'section'   => 'header_layout',
		'default'   => '17px',
		'priority'  => 25,
		'choices'   => array(
			'min'  => 0,
			'max'  => 200,
			'step' => 1,
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'padding-top',
				'element'  => 'body #masthead.site-header',
				'property' => 'padding-top',
			),
		)
	)
);
// Padding Bottom Header
thim_customizer()->add_field(
	array(
		'id'        => 'header_padding_bottom',
		'type'      => 'dimension',
		'label'     => esc_html__( 'Header Padding Bottom', 'ivy-school' ),
		'tooltip'   => esc_html__( 'Change padding bottom for your header. ', 'ivy-school' ),
		'section'   => 'header_layout',
		'default'   => '17px',
		'priority'  => 30,
		'choices'   => array(
			'min'  => 0,
			'max'  => 200,
			'step' => 1,
		),
		'alpha'     => true,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'padding-bottom',
				'element'  => 'body #masthead.site-header',
				'property' => 'padding-bottom',
			),
		)
	)
);

// Main menu height
thim_customizer()->add_field(
	array(
		'id'              => 'main_menu_height',
		'type'            => 'dimension',
		'label'           => esc_html__( 'Main Menu Height', 'ivy-school' ),
		'tooltip'         => esc_html__( 'Set height for main menu - Header layout 2', 'ivy-school' ),
		'section'         => 'header_layout',
		'default'         => '70px',
		'priority'        => 35,
		'choices'         => array(
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		),
		'transport'       => 'postMessage',
		'js_vars'         => array(
			array(
				'element'  => 'body .header_v2 .top-menu-navigation, body .header_v2 .bp-sc-search .search-button, body .header_v2 .bp-sc-button .btn',
				'property' => 'height',
			),
			array(
				'element'  => 'body .header_v2 .bp-sc-search .search-button, body .header_v2 .bp-sc-button .btn',
				'property' => 'line-height'
			)
		),
		'active_callback' => array(
			array(
				'setting'  => 'header_style',
				'operator' => '===',
				'value'    => 'header_v2',
			),
		),
	)
);

// Search feature
thim_customizer()->add_field(
	array(
		'id'              => 'header_search_display',
		'type'            => 'switch',
		'label'           => esc_html__( 'Show Search', 'ivy-school' ),
		'tooltip'         => esc_html__( 'Allows you to enable or disable Search feature.', 'ivy-school' ),
		'section'         => 'header_layout',
		'default'         => false,
		'priority'        => 40,
		'choices'         => array(
			true  => esc_html__( 'On', 'ivy-school' ),
			false => esc_html__( 'Off', 'ivy-school' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'header_style',
				'operator' => '===',
				'value'    => 'header_v2',
			),
		),
	)
);
// set size header
thim_customizer()->add_field(
    array(
        'id'       => 'size_header',
        'type'     => 'select',
        'label'    => esc_html__( 'Header Size ', 'ivy-school' ),
        'section'  => 'header_layout',
        'priority' => 41,
        'multiple' => 0,
        'default'  => 'default',
        'choices'  => array(
            'default' => esc_html__( 'Default', 'ivy-school' ),
            'header_small' => esc_html__( 'Small', 'ivy-school' ),
            'header_large' => esc_html__( 'Large', 'ivy-school' ),
        ),
    )


);