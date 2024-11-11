<?php
/**
 * Section Header Top bar
 */

thim_customizer()->add_section(
	array(
		'id'       => 'header_topbar',
		'title'    => esc_html__( 'Top bar', 'ivy-school' ),
		'panel'    => 'header',
		'priority' => 20,
	)
);

// Enable or disable top bar
thim_customizer()->add_field(
	array(
		'id'       => 'header_topbar_display',
		'type'     => 'switch',
		'label'    => esc_html__( 'Show Topbar', 'ivy-school' ),
		'tooltip'  => esc_html__( 'Allows you to enable or disable Top bar.', 'ivy-school' ),
		'section'  => 'header_topbar',
		'default'  => true,
		'priority' => 10,
		'choices'  => array(
			true  => esc_html__( 'On', 'ivy-school' ),
			false => esc_html__( 'Off', 'ivy-school' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'font_topbar',
		'type'      => 'typography',
		'label'     => esc_html__( 'Topbar Typography', 'ivy-school' ),
		'tooltip'   => esc_html__( 'Allows you to select font properties for topbar. ', 'ivy-school' ),
		'section'   => 'header_topbar',
		'priority'  => 15,
		'default'   => array(
			'font-size' => '18px',
			'color'     => '#878787',
		),
		'transport' => 'postMessage',
		'js_vars'    => array(
			array(
				'choice'   => 'font-size',
				'element'  => '#thim-header-topbar,
				               #thim-header-topbar li,
				               #thim-header-topbar span,
                               #thim-header-topbar a,
                               .thim-top-logo,
				               .thim-top-logo li,
				               .thim-top-logo span,
                               .thim-top-logo a',
				'property' => 'font-size',
			),
			array(
				'choice'   => 'color',
				'element'  => '#thim-header-topbar, #thim-header-topbar a',
				'property' => 'color',
			),
		),
	)
);

// Top Bar Height
thim_customizer()->add_field(
	array(
		'id'        => 'topbar_height',
		'type'      => 'dimension',
		'label'     => esc_html__( 'Height', 'ivy-school' ),
		'tooltip'   => esc_html__( 'Enter any valid dimension CSS value', 'ivy-school' ),
		'section'   => 'header_topbar',
		'default'   => '37px',
		'priority'  => 20,
		'transport' => 'postMessage',
		'js_vars'    => array(
			array(
				'element'  => '#thim-header-topbar',
				'property' => 'height'
			)
		)
	)
);

// Topbar background color
thim_customizer()->add_field(
	array(
		'id'        => 'topbar_background_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Background Color', 'ivy-school' ),
		'tooltip'   => esc_html__( 'Allows you to choose a background color for widget on topbar. ', 'ivy-school' ),
		'section'   => 'header_topbar',
		'default'   => '#ffffff',
		'priority'  => 25,
		'alpha'     => true,
		'transport' => 'postMessage',
		'js_vars'    => array(
			array(
				'element'  => '#thim-header-topbar',
				'property' => 'background-color',
			)
		),
	)
);

// Division line color - Topbar vs Header
thim_customizer()->add_field(
	array(
		'id'        => 'topbar_separated_line',
		'type'      => 'color',
		'label'     => esc_html__( 'Separated Line Color', 'ivy-school' ),
		'tooltip'   => esc_html__( 'Separated line Topbar vs Header', 'ivy-school' ),
		'section'   => 'header_topbar',
		'default'   => '#ebebeb',
		'priority'  => 30,
		'alpha'     => true,
		'transport' => 'postMessage',
		'js_vars' => array(
			array(
				'element'  => '#thim-header-topbar',
				'property' => 'border-bottom-color',
			)
		)
	)
);

// size topbar
thim_customizer()->add_field(
        array(
            'id'       => 'size_topbar',
            'type'     => 'select',
            'label'    => esc_html__( 'Top Bar Size ', 'ivy-school' ),
            'section'  => 'header_topbar',
            'priority' => 31,
            'multiple' => 0,
            'default'  => 'default',
            'choices'  => array(
                'default' => esc_html__( 'Default', 'ivy-school' ),
                'topbar_large' => esc_html__( 'Large', 'ivy-school' ),
            ),
        )


);