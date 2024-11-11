<?php
/**
 * Section Header Main Menu
 *
 * @package Hair_Salon
 */

thim_customizer()->add_section(
	array(
		'id'       => 'header_main_menu',
		'title'    => esc_html__( 'Main Menu', 'ivy-school' ),
		'panel'    => 'header',
		'priority' => 30,
	)
);

// Select All Fonts For Main Menu
thim_customizer()->add_field(
	array(
		'id'        => 'main_menu_typo',
		'type'      => 'typography',
		'label'     => esc_html__( 'Fonts', 'ivy-school' ),
		'tooltip'   => esc_html__( 'Allows you to select all font font properties for header. ', 'ivy-school' ),
		'section'   => 'header_main_menu',
		'priority'  => 10,
		'default'   => array(
			'font-family'    => 'Roboto',
			'variant'        => '300',
			'font-size'      => '18px',
			'line-height'    => '1.2',
			'letter-spacing' => '0.9px',
			'text-transform' => 'uppercase',
			'color'          => '#ffffff',
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element' => 'body.logged-in #primaryMenu > .menu-item > a',
			),
		),
	)
);

// Text Link Hover
thim_customizer()->add_field(
	array(
		'id'        => 'main_menu_hover_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Text Color Hover', 'ivy-school' ),
		'tooltip'   => esc_html__( 'Allows you to select color for text link when hover text link . ', 'ivy-school' ),
		'section'   => 'header_main_menu',
		'default'   => '#439fdf',
		'priority'  => 16,
		'alpha'     => true,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => 'header#masthead.site-header #primaryMenu >li >a:hover,
                               header#masthead.site-header #primaryMenu >li >span:hover',
				'property' => 'color',
			)
		)
	)
);