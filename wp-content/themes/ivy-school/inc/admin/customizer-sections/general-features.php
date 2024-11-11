<?php
/**
 * Section Advance features
 * 
 * @package Thim_Starter_Theme
 */

thim_customizer()->add_section(
	array(
		'id'       => 'advanced',
		'panel'    => 'general',
		'priority' => 90,
		'title'    => esc_html__( 'Extra Features', 'ivy-school' ),
	)
);

// Feature: Footer custom class
thim_customizer()->add_field(
    array(
        'type'     => 'text',
        'id'       => 'main-content_custom_class',
        'label'    => esc_html__( 'Main Content Custom Class', 'ivy-school' ),
        'tooltip'  => esc_html__( 'Enter main content custom class.', 'ivy-school' ),
        'section'  => 'advanced',
        'priority' => 9,
    )
);

// Feature: RTL
thim_customizer()->add_field( 
	array(
		'type'     => 'switch',
		'id'       => 'feature_rtl_support',
		'label'    => esc_html__( 'RTL Support', 'ivy-school' ),
		'section'  => 'advanced',
		'default'  => false,
		'priority' => 10,
		'choices'  => array(
			true  => esc_html__( 'On', 'ivy-school' ),
			false => esc_html__( 'Off', 'ivy-school' ),
		),
	) 
);

// Feature: Smoothscroll
thim_customizer()->add_field( 
	array(
		'type'     => 'switch',
		'id'       => 'feature_smoothscroll',
		'label'    => esc_html__( 'Smooth Scrolling', 'ivy-school' ),
		'tooltip'  => esc_html__( 'Turn on to enable smooth scrolling.', 'ivy-school' ),
		'section'  => 'advanced',
		'default'  => false,
		'priority' => 20,
		'choices'  => array(
			true  => esc_html__( 'On', 'ivy-school' ),
			false => esc_html__( 'Off', 'ivy-school' ),
		),
	) 
);

// Feature: Open Graph Meta
thim_customizer()->add_field( 
	array(
		'type'     => 'switch',
		'id'       => 'feature_open_graph_meta',
		'label'    => esc_html__( 'Open Graph Meta Tags', 'ivy-school' ),
		'tooltip'  => esc_html__( 'Turn on to enable open graph meta tags which is mainly used when sharing pages on social networking sites like Facebook.', 'ivy-school' ),
		'section'  => 'advanced',
		'default'  => true,
		'priority' => 30,
		'choices'  => array(
			true  => esc_html__( 'On', 'ivy-school' ),
			false => esc_html__( 'Off', 'ivy-school' ),
		),
	) 
);

// Feature: Back To Top
thim_customizer()->add_field( 
	array(
		'type'     => 'switch',
		'id'       => 'feature_backtotop',
		'label'    => esc_html__( 'Back To Top', 'ivy-school' ),
		'tooltip'  => esc_html__( 'Turn on to enable the Back To Top script which adds the scrolling to top functionality.', 'ivy-school' ),
		'section'  => 'advanced',
		'default'  => true,
		'priority' => 40,
		'choices'  => array(
			true  => esc_html__( 'On', 'ivy-school' ),
			false => esc_html__( 'Off', 'ivy-school' ),
		),
	) 
);

// set size header
thim_customizer()->add_field(
    array(
        'id'       => 'position_back_to_top',
        'type'     => 'select',
        'label'    => esc_html__( 'Set Position Back To Top By', 'ivy-school' ),
        'section'  => 'advanced',
        'priority' => 42,
        'multiple' => 0,
        'default'  => 'default',
        'choices'  => array(
            'default' => esc_html__( 'Default', 'ivy-school' ),
            'back_to_top_container' => esc_html__( 'Container', 'ivy-school' ),
        ),
    )
);

// Feature: Toolbar Color For Android
thim_customizer()->add_field( 
	array(
		'type'     => 'switch',
		'id'       => 'feature_google_theme',
		'label'    => esc_html__( 'Google Theme', 'ivy-school' ),
		'tooltip'  => esc_html__( 'Turn on to set the toolbar color in Chrome for Android.', 'ivy-school' ),
		'section'  => 'advanced',
		'default'  => false,
		'priority' => 50,
		'choices'  => array(
			true  => esc_html__( 'On', 'ivy-school' ),
			false => esc_html__( 'Off', 'ivy-school' ),
		),
	) 
);

// Feature: Google Theme Color
thim_customizer()->add_field( 
	array(
		'type'            => 'color',
		'id'              => 'feature_google_theme_color',
		'label'           => esc_html__( 'Google Theme Color', 'ivy-school' ),
		'section'         => 'advanced',
		'default'         => '#333333',
		'priority'        => 60,
		'alpha'           => true,
		'active_callback' => array(
			array(
				'setting'  => 'feature_google_theme',
				'operator' => '==',
				'value'    => true,
			),
		),
	) 
);

// Feature: Google Analytics
thim_customizer()->add_field(
    array(
        'type'     => 'text',
        'id'       => 'theme_feature_analytics',
        'label'    => esc_html__( 'Google Analytics', 'ivy-school' ),
        'tooltip'  => esc_html__( 'Enter your ID Google Analytics.', 'ivy-school' ),
        'section'  => 'advanced',
        'priority' => 65,
    )
);

// Feature: Facebook Pixel
thim_customizer()->add_field(
    array(
        'type'     => 'text',
        'id'       => 'theme_feature_facebook_pixel',
        'label'    => esc_html__( 'Facebook Pixel', 'ivy-school' ),
        'tooltip'  => esc_html__( 'Enter your ID Facebook Pixel.', 'ivy-school' ),
        'section'  => 'advanced',
        'priority' => 66,
    )
);

// Feature: Login Redirect
thim_customizer()->add_field(
    array(
        'type'     => 'text',
        'id'       => 'theme_feature_login_redirect',
        'label'    => esc_html__( 'Login Redirect', 'ivy-school' ),
        'tooltip'  => esc_html__( 'Enter url login redirect.', 'ivy-school' ),
        'section'  => 'advanced',
        'priority' => 67,
    )
);

// Feature: Login Redirect
thim_customizer()->add_field(
    array(
        'type'     => 'text',
        'id'       => 'theme_feature_register_redirect',
        'label'    => esc_html__( 'Register Redirect', 'ivy-school' ),
        'tooltip'  => esc_html__( 'Enter url register redirect.', 'ivy-school' ),
        'section'  => 'advanced',
        'priority' => 68,
    )
);

// Feature: Logout Redirect
thim_customizer()->add_field(
    array(
        'type'     => 'text',
        'id'       => 'theme_feature_logout_redirect',
        'label'    => esc_html__( 'Logout Redirect', 'ivy-school' ),
        'tooltip'  => esc_html__( 'Enter url logout redirect.', 'ivy-school' ),
        'section'  => 'advanced',
        'priority' => 69,
    )
);

// Feature: Preload
thim_customizer()->add_field( array(
	'type'     => 'radio-image',
	'id'       => 'theme_feature_preloading',
	'section'  => 'advanced',
	'label'    => esc_html__( 'Preloading', 'ivy-school' ),
	'default'  => 'off',
	'priority' => 70,
	'choices'  => array(
		'off'             => THIM_URI . 'assets/images/preloading/off.jpg',
		'chasing-dots'    => THIM_URI . 'assets/images/preloading/chasing-dots.gif',
		'circle'          => THIM_URI . 'assets/images/preloading/circle.gif',
		'cube-grid'       => THIM_URI . 'assets/images/preloading/cube-grid.gif',
		'double-bounce'   => THIM_URI . 'assets/images/preloading/double-bounce.gif',
		'fading-circle'   => THIM_URI . 'assets/images/preloading/fading-circle.gif',
		'folding-cube'    => THIM_URI . 'assets/images/preloading/folding-cube.gif',
		'rotating-plane'  => THIM_URI . 'assets/images/preloading/rotating-plane.gif',
		'spinner-pulse'   => THIM_URI . 'assets/images/preloading/spinner-pulse.gif',
		'three-bounce'    => THIM_URI . 'assets/images/preloading/three-bounce.gif',
		'wandering-cubes' => THIM_URI . 'assets/images/preloading/wandering-cubes.gif',
		'wave'            => THIM_URI . 'assets/images/preloading/wave.gif',
		'custom-image'    => THIM_URI . 'assets/images/preloading/custom-image.jpg',
	),
) );

// Feature: Preload Image Upload
thim_customizer()->add_field( array(
	'type'            => 'kirki-image',
	'id'              => 'theme_feature_preloading_custom_image',
	'label'           => esc_html__( 'Preloading Custom Image', 'ivy-school' ),
	'section'         => 'advanced',
	'priority'        => 80,
	'active_callback' => array(
		array(
			'setting'  => 'theme_feature_preloading',
			'operator' => '===',
			'value'    => 'custom-image',
		),
	),
) );

// Feature: Preload Colors
thim_customizer()->add_field( array(
	'type'      => 'multicolor',
	'id'        => 'theme_feature_preloading_style',
	'label'     => esc_html__( 'Preloading Color', 'ivy-school' ),
	'section'   => 'advanced',
	'priority'  => 90,
	'choices'   => array(
		'background' => esc_html__( 'Background color', 'ivy-school' ),
		'color'      => esc_html__( 'Icon color', 'ivy-school' ),
	),
	'default'   => array(
		'background' => '#ffffff',
		'color'      => '#333333',
	),
	'active_callback' => array(
		array(
			'setting'  => 'theme_feature_preloading',
			'operator' => '!=',
			'value'    => 'off',
		),
	),
) );