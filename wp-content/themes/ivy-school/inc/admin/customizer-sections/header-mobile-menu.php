<?php
/**
 * Section Header Mobile Menu
 */

thim_customizer()->add_section(
	array(
		'id'       => 'header_mobile_menu',
		'title'    => esc_html__( 'Mobile Menu', 'ivy-school' ),
		'panel'    => 'header',
		'priority' => 50,
	)
);

// Topbar background color
thim_customizer()->add_field(
	array(
		'id'        => 'bg_mobile_menu_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Background Color', 'ivy-school' ),
		'tooltip'   => esc_html__( 'Allows you to choose a background color for mobile menu.', 'ivy-school' ),
		'section'   => 'header_mobile_menu',
		'default'   => '#232323',
		'priority'  => 20,
		'choices' => array ('alpha'     => true),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'function' => 'css',
				'element'  => '.mobile-menu-container',
				'property' => 'background-color',
			)
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'mobile_menu_text_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Text Color', 'ivy-school' ),
		'tooltip'   => esc_html__( 'Allows you to choose a text color.', 'ivy-school' ),
		'section'   => 'header_mobile_menu',
		'default'   => '#777',
		'priority'  => 25,
		'choices' => array ('alpha'     => true),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'function' => 'css',
				'element'  => '
								.mobile-menu-container ul li > a,
								.mobile-menu-container ul li > span
								',
				'property' => 'color',
			),
			array(
				'function' => 'css',
				'element'  => '
								.menu-mobile-effect span,
								.mobile-menu-container .navbar-nav .sub-menu:before,
								.mobile-menu-container .navbar-nav .sub-menu li:before
								',
				'property' => 'background-color',
			)
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'mobile_menu_text_hover_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Text Hover Color', 'ivy-school' ),
		'tooltip'   => esc_html__( 'Allows you to choose a text hover color.', 'ivy-school' ),
		'section'   => 'header_mobile_menu',
		'default'   => '#fff',
		'priority'  => 25,
		'choices' => array ('alpha'     => true),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'function' => 'style',
				'element'  => '
								.mobile-menu-container ul li > a:hover,
								.mobile-menu-container ul li > span:hover,
								.mobile-menu-container ul li.current-menu-item > a,
								.mobile-menu-container ul li.current-menu-item > span
								',
				'property' => 'background-color',
			)
		)
	)
);