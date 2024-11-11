<?php
/**
 * Section Blog Layouts
 *
 * @package Hair_Salon
 */

thim_customizer()->add_section(
	array(
		'id'             => 'blog_layout',
		'panel'			 => 'blog',
		'title'          => esc_html__( 'Layouts', 'ivy-school' ),
		'priority'       => 5,
	)
);

//-------------------------------------------------Archive---------------------------------------------//

// Select Blog Archive Layout
thim_customizer()->add_field(
	array(
		'id'            => 'blog_archive_layout',
		'type'          => 'radio-image',
		'label'         => esc_html__( 'Blog Archive Layouts', 'ivy-school' ),
		'tooltip'       => esc_html__( 'Allows you to choose a layout to display for all blog archive, blog category page on your site.', 'ivy-school' ),
		'section'       => 'blog_layout',
		'priority'      => 12,
		'choices'       => array(
			'sidebar-left'     => THIM_URI . 'assets/images/layout/sidebar-left.jpg',
			'no-sidebar'       => THIM_URI . 'assets/images/layout/body-full.jpg',
			'sidebar-right'    => THIM_URI . 'assets/images/layout/sidebar-right.jpg',
			'full-sidebar'     => THIM_URI . 'assets/images/layout/body-left-right.jpg'
		),
	)
);

// Select Sidebar To Display In Sidebar Left For Full Sidebar Layout
thim_customizer()->add_field(
	array(
		'id'          => 'blog_archive_layout_sidebar_left',
		'type'        => 'select',
		'label'       => esc_html__( 'Sidebar Left For Blog Archive Layout ', 'ivy-school' ),
		'tooltip'     => esc_html__( 'Allows you to select a sidebar to display in sidebar left when you used Full sidebar layout on Blog archive layout.', 'ivy-school' ),
		'section'     => 'blog_layout',
		'priority'    => 13,
		'multiple'    => 1,
		'default'     => 'sidebar',
		'choices'     => thim_get_list_sidebar(),
		'active_callback' => array(
			array(
				'setting'  => 'blog_archive_layout',
				'operator' => '===',
				'value'    => 'full-sidebar',
			),
		),
	)
);

// Select Sidebar To Display In Sidebar Right For Full Sidebar Layout
thim_customizer()->add_field(
	array(
		'id'          => 'blog_archive_layout_sidebar_right',
		'type'        => 'select',
		'label'       => esc_html__( 'Sidebar Right For Blog Archive Layout', 'ivy-school' ),
		'tooltip'     => esc_html__( 'Allows you to select a sidebar to display in sidebar right when you used Full sidebar layout on Archive layout.', 'ivy-school' ),
		'section'     => 'blog_layout',
		'priority'    => 14,
		'multiple'    => 1,
		'default'     => 'sidebar',
		'choices'     => thim_get_list_sidebar(),
		'active_callback' => array(
			array(
				'setting'  => 'blog_archive_layout',
				'operator' => '===',
				'value'    => 'full-sidebar',
			),
		),
	)
);

//-------------------------------------------------Single---------------------------------------------//

// Select Single Layout
thim_customizer()->add_field(
	array(
		'id'            => 'blog_single_layout',
		'type'          => 'radio-image',
		'label'         => esc_html__( 'Blog Single Layouts', 'ivy-school' ),
		'tooltip'       => esc_html__( 'Allows you to choose a layout to display for only blog single page on your site.', 'ivy-school' ),
		'section'       => 'blog_layout',
		'priority'      => 20,
		'choices'       => array(
			'sidebar-left'     => THIM_URI . 'assets/images/layout/sidebar-left.jpg',
			'no-sidebar'       => THIM_URI . 'assets/images/layout/body-full.jpg',
			'sidebar-right'    => THIM_URI . 'assets/images/layout/sidebar-right.jpg',
			'full-sidebar'     => THIM_URI . 'assets/images/layout/body-left-right.jpg'
		),
	)
);

// Select Sidebar To Display In Sidebar Left For Full Sidebar Layout
thim_customizer()->add_field(
	array(
		'id'          => 'blog_single_layout_sidebar_left',
		'type'        => 'select',
		'label'       => esc_html__( 'Sidebar Left For Post Layout', 'ivy-school' ),
		'tooltip'     => esc_html__( 'Allows you to select a sidebar to display in sidebar left when you used Full sidebar layout on Post layout.', 'ivy-school' ),
		'section'     => 'blog_layout',
		'priority'    => 21,
		'multiple'    => 1,
		'choices'     => thim_get_list_sidebar(),
		'active_callback' => array(
			array(
				'setting'  => 'blog_single_layout',
				'operator' => '===',
				'value'    => 'full-sidebar',
			),
		),
	)
);

// Select Sidebar To Display In Sidebar Right For Full Sidebar Layout
thim_customizer()->add_field(
	array(
		'id'          => 'blog_single_layout_sidebar_right',
		'type'        => 'select',
		'label'       => esc_html__( 'Sidebar Right For Post Layout', 'ivy-school' ),
		'tooltip'     => esc_html__( 'Allows you to select a sidebar to display in sidebar right when you used Full sidebar layout on Post layout.', 'ivy-school' ),
		'section'     => 'blog_layout',
		'priority'    => 22,
		'multiple'    => 1,
		'choices'     => thim_get_list_sidebar(),
		'active_callback' => array(
			array(
				'setting'  => 'blog_single_layout',
				'operator' => '===',
				'value'    => 'full-sidebar',
			),
		),
	)
);