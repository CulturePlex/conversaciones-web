<?php
/**
 * Section Header Sticky Menu
 * 
 * @package Thim_Starter_Theme
 */

thim_customizer()->add_section(
	array(
		'id'             => 'header_sticky_menu',
		'title'          => esc_html__( 'Sticky Menu', 'ivy-school' ),
		'panel'			 => 'header',
		'priority'       => 55,
	)
);

// Enable or Disable
thim_customizer()->add_field(
	array(
		'id'          => 'show_sticky_menu',
		'type'        => 'switch',
		'label'       => esc_html__( 'Sticky On Scroll', 'ivy-school' ),
		'tooltip'     => esc_html__( 'Allows you can show or hide sticky header menu on your site . ', 'ivy-school' ),
		'section'     => 'header_sticky_menu',
		'default'     => true,
		'priority'    => 10,
		'choices'     => array(
			true  	  => esc_html__( 'On', 'ivy-school' ),
			false	  => esc_html__( 'Off', 'ivy-school' ),
		),
	)
);

// Padding Top Header
thim_customizer()->add_field(
    array(
        'id'        => 'header_sticky_padding_top',
        'type'      => 'dimension',
        'label'     => esc_html__( 'Header Padding Top', 'ivy-school' ),
        'tooltip'   => esc_html__( 'Change padding top for your header. ', 'ivy-school' ),
        'section'   => 'header_sticky_menu',
        'default'   => '17px',
        'priority'  => 15,
        'choices'   => array(
            'min'  => 0,
            'max'  => 200,
            'step' => 1,
        ),
        'transport' => 'postMessage',
        'js_vars'   => array(
            array(
                'choice'   => 'padding-top',
                'element'  => 'body #masthead.site-header.affix',
                'property' => 'padding-top',
            ),
        )
    )
);
// Padding Bottom Header
thim_customizer()->add_field(
    array(
        'id'        => 'header_sticky_padding_bottom',
        'type'      => 'dimension',
        'label'     => esc_html__( 'Header Padding Bottom', 'ivy-school' ),
        'tooltip'   => esc_html__( 'Change padding bottom for your header. ', 'ivy-school' ),
        'section'   => 'header_sticky_menu',
        'default'   => '17px',
        'priority'  => 20,
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
                'element'  => 'body #masthead.site-header.affix',
                'property' => 'padding-bottom',
            ),
        )
    )
);

// Select Style
thim_customizer()->add_field(
	array(
		'id'          => 'sticky_menu_style',
		'type'        => 'select',
		'label'       => esc_html__( 'Select style', 'ivy-school' ),
		'tooltip'     => esc_html__( 'Allows you can select sticky menu style for your header . ', 'ivy-school' ),
		'section'     => 'header_sticky_menu',
		'default'     => 'same',
		'priority'    => 25,
		'multiple'    => 0,
		'choices'     => array(
			'same' 	  => esc_html__( 'The same with main menu', 'ivy-school' ),
			'custom'  => esc_html__( 'Custom', 'ivy-school' )
		),
	)
);

// Background Header
thim_customizer()->add_field(
	array(
		'id'          => 'sticky_menu_background_color',
		'type'        => 'color',
		'label'       => esc_html__( 'Background Color', 'ivy-school' ),
		'tooltip'     => esc_html__( 'Allows you can select a color make background color for header sticky menu . ', 'ivy-school' ),
		'section'     => 'header_sticky_menu',
		'default'     => '#ffffff',
		'priority'    => 30,
		'alpha'       => true,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => 'body header#masthead.site-header.custom-sticky.affix',
				'property' => 'background-color',
			)
		),
		'active_callback' => array(
			array(
				'setting'  => 'sticky_menu_style',
				'operator' => '===',
				'value'    => 'custom',
			),
		),
	)
);

// Text Color
thim_customizer()->add_field(
	array(
		'id'          => 'sticky_menu_text_color',
		'type'        => 'color',
		'label'       => esc_html__( 'Text Color', 'ivy-school' ),
		'tooltip'     => esc_html__( 'Allows you can select a color make text color on header sticky menu . ', 'ivy-school' ),
		'section'     => 'header_sticky_menu',
		'default'     => '#333333',
		'priority'    => 35,
		'alpha'       => true,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => 'body header#masthead.site-header.affix.custom-sticky #primaryMenu >li >a,
                               header#masthead.site-header.affix.custom-sticky #primaryMenu >li >span',
				'property' => 'color',
			)
		),
		'active_callback' => array(
			array(
				'setting'  => 'sticky_menu_style',
				'operator' => '===',
				'value'    => 'custom',
			),
		),
	)
);

// Text Hover Color
thim_customizer()->add_field(
	array(
		'id'          => 'sticky_menu_text_color_hover',
		'type'        => 'color',
		'label'       => esc_html__( 'Text Hover Color', 'ivy-school' ),
		'tooltip'     => esc_html__( 'Allows you can select color for text link when hover text link on header sticky menu. ', 'ivy-school' ),
		'section'     => 'header_sticky_menu',
		'default'     => '#439fdf',
		'priority'    => 40,
		'alpha'       => true,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => 'body header#masthead.site-header.affix.custom-sticky #primaryMenu >li >a:hover,
                               body header#masthead.site-header.affix.custom-sticky #primaryMenu >li >span:hover',
				'property' => 'color',
			)
		),
		'active_callback' => array(
			array(
				'setting'  => 'sticky_menu_style',
				'operator' => '===',
				'value'    => 'custom',
			),
		),
	)
);