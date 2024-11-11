<?php
/**
 * Section Styling
 *
 * @package Hair_Salon
 */

thim_customizer()->add_section(
	array(
		'id'       => 'general_styling',
		'panel'    => 'general',
		'title'    => esc_html__( 'Styling', 'ivy-school' ),
		'priority' => 30,
	)
);

// Select Theme Primary Colors
thim_customizer()->add_field(
	array(
		'id'            => 'body_primary_color',
		'type'          => 'color',
		'label'         => esc_html__( 'Primary Color', 'ivy-school' ),
		'tooltip'       => esc_html__( 'Allows you to choose a primary color for your site.', 'ivy-school' ),
		'section'       => 'general_styling',
		'priority'      => 10,
		'alpha'       => true,
		'default'     => '#439fdf',
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'hover',
				'element'  => '
                    body #sb_instagram .sbi_follow_btn a strong,
                    body .thim-primary-color, body .thim-color,
                    body .thim-sc-heading .heading-button a,
                    body .thim-sc-heading .heading-button a:hover,
                    body .thim-sc-posts.site-content .blog-content article .entry-meta a:hover
                    body #secondary ul li a:hover,
                    body .site-content .blog-content article .entry-title a:hover, 
                    body .site-content .page-content article .entry-title a:hover,
                    body .site-content .blog-content article .entry-title:before, 
                    body .site-content .page-content article .entry-title:before, 
                    body .site-content .blog-content article .entry-meta a:hover, 
                    body .site-content .page-content article .entry-meta a:hover,
                    body #comments .comment-list li .content-comment .author span .comment-edit-link,
                    body #comments .comment-list li .content-comment .author span .comment-reply-link,
                    body ul.product-grid li.product .wrapper .quick-view span, 
                    body ul.product-list li.product .wrapper .quick-view span
                    ',
				'property' => 'color',
			),
			array(
				'choice'   => 'background-color',
				'element'  => 'body .main-top .overlay-top-header,
                               body .mc4wp-form input[type=submit]:hover,
                               body #back-to-top,
                               body .thim-testimonial-slider:after',
				'property' => 'background-color',
			),
		),
	)
);

// Select Theme Primary Colors
thim_customizer()->add_field(
	array(
		'id'            => 'body_primary2_color',
		'type'          => 'color',
		'label'         => esc_html__( 'Secondary Primary Color', 'ivy-school' ),
		'tooltip'       => esc_html__( 'Allows you to choose a secondary primary color for your site.', 'ivy-school' ),
		'section'       => 'general_styling',
		'priority'      => 15,
		'alpha'       => true,
		'default'     => '#011d53'
	)
);

// Body Background Group
thim_customizer()->add_group( array(
	'id'       => 'general_background_group',
	'section'  => 'general_styling',
	'priority' => 20,
	'groups'   => array(
		array(
			'id'     => 'main_background_group',
			'label'  => esc_html__( 'Main Content Background', 'ivy-school' ),
			'fields' => array(
				array(
					'type'     => 'radio-buttonset',
					'id'       => 'background_main_type',
					'label'    => esc_html__( 'Select Background Type', 'ivy-school' ),
					'tooltip'  => esc_html__( 'Allows you to select a background for body tag content on your site', 'ivy-school' ),
					'default'  => 'color',
					'priority' => 10,
					'choices'  => array(
						'color'   => esc_html__( 'Color', 'ivy-school' ),
						'image'   => esc_html__( 'Image', 'ivy-school' ),
						'pattern' => esc_html__( 'Pattern', 'ivy-school' ),
					),

				),
				array(
					'type'            => 'color',
					'id'              => 'background_main_color',
					'label'           => esc_html__( 'Background Color', 'ivy-school' ),
					'default'         => '#f7f7f7',
					'priority'        => 20,
					'alpha'           => true,
					'transport'       => 'postMessage',
					'js_vars'         => array(
						array(
							'element'  => 'body #main-content.bg-type-color',
							'function' => 'css',
							'property' => 'background-color',
						),
					),
					'active_callback' => array(
						array(
							'setting'  => 'background_main_type',
							'operator' => '===',
							'value'    => 'color',
						),
					),
				),
				array(
					'type'            => 'kirki-image',
					'id'              => 'background_main_image',
					'label'           => esc_html__( 'Background image', 'ivy-school' ),
					'priority'        => 30,
					'transport'       => 'postMessage',
					'js_vars'         => array(
						array(
							'element'  => 'body #main-content.bg-type-image',
							'function' => 'css',
							'property' => 'background-image',
						),
					),
					'active_callback' => array(
						array(
							'setting'  => 'background_main_type',
							'operator' => '===',
							'value'    => 'image',
						),
					),
				),
				array(
					'type'            => 'select',
					'id'              => 'background_main_image_repeat',
					'label'           => esc_html__( 'Background Repeat', 'ivy-school' ),
					'default'         => 'no-repeat',
					'priority'        => 40,
					'choices'         => array(
						'repeat'    => esc_html__( 'Tile', 'ivy-school' ),
						'repeat-x'  => esc_html__( 'Tile Horizontally', 'ivy-school' ),
						'repeat-y'  => esc_html__( 'Tile Vertically', 'ivy-school' ),
						'no-repeat' => esc_html__( 'No Repeat', 'ivy-school' ),
					),
					'transport'       => 'postMessage',
					'js_vars'         => array(
						array(
							'element'  => 'body #main-content.bg-type-image',
							'function' => 'css',
							'property' => 'background-repeat',
						)
					),
					'active_callback' => array(
						array(
							'setting'  => 'background_main_type',
							'operator' => '===',
							'value'    => 'image',
						),
					),
				),
				array(
					'type'            => 'select',
					'id'              => 'background_main_image_position',
					'label'           => esc_html__( 'Background Position', 'ivy-school' ),
					'default'         => 'center',
					'priority'        => 50,
					'choices'         => array(
						'left'   => esc_html__( 'Left', 'ivy-school' ),
						'center' => esc_html__( 'Center', 'ivy-school' ),
						'right'  => esc_html__( 'Right', 'ivy-school' ),
					),
					'transport'       => 'postMessage',
					'js_vars'         => array(
						array(
							'element'  => 'body #main-content.bg-type-image',
							'function' => 'css',
							'property' => 'background-position',
						)
					),
					'active_callback' => array(
						array(
							'setting'  => 'background_main_type',
							'operator' => '===',
							'value'    => 'image',
						),
					),
				),
				array(
					'type'            => 'select',
					'id'              => 'background_main_image_attachment',
					'label'           => esc_html__( 'Background Attachment', 'ivy-school' ),
					'default'         => 'fixed',
					'priority'        => 60,
					'choices'         => array(
						'scroll' => esc_html__( 'Scroll', 'ivy-school' ),
						'fixed'  => esc_html__( 'Fixed', 'ivy-school' ),
					),
					'transport'       => 'postMessage',
					'js_vars'         => array(
						array(
							'element'  => 'body #main-content.bg-type-image',
							'function' => 'css',
							'property' => 'background-attachment',
						)
					),
					'active_callback' => array(
						array(
							'setting'  => 'background_main_type',
							'operator' => '===',
							'value'    => 'image',
						),
					),
				),
				array(
					'type'            => 'radio-image',
					'id'              => 'background_main_pattern_image',
					'label'           => esc_html__( 'Select a Background Pattern', 'ivy-school' ),
					'default'         => THIM_URI . 'assets/images/patterns/pattern1.png',
					'priority'        => 70,
					'choices'         => array(
						THIM_URI . 'assets/images/patterns/pattern1.png'  => THIM_URI . 'assets/images/patterns/pattern1_icon.png',
						THIM_URI . 'assets/images/patterns/pattern2.png'  => THIM_URI . 'assets/images/patterns/pattern2_icon.png',
						THIM_URI . 'assets/images/patterns/pattern3.png'  => THIM_URI . 'assets/images/patterns/pattern3_icon.png',
						THIM_URI . 'assets/images/patterns/pattern4.png'  => THIM_URI . 'assets/images/patterns/pattern4_icon.png',
						THIM_URI . 'assets/images/patterns/pattern5.png'  => THIM_URI . 'assets/images/patterns/pattern5_icon.png',
						THIM_URI . 'assets/images/patterns/pattern6.png'  => THIM_URI . 'assets/images/patterns/pattern6_icon.png',
						THIM_URI . 'assets/images/patterns/pattern7.png'  => THIM_URI . 'assets/images/patterns/pattern7_icon.png',
						THIM_URI . 'assets/images/patterns/pattern8.png'  => THIM_URI . 'assets/images/patterns/pattern8_icon.png',
						THIM_URI . 'assets/images/patterns/pattern9.png'  => THIM_URI . 'assets/images/patterns/pattern9_icon.png',
						THIM_URI . 'assets/images/patterns/pattern10.png' => THIM_URI . 'assets/images/patterns/pattern10_icon.png',
						THIM_URI . 'assets/images/patterns/pattern11.png' => THIM_URI . 'assets/images/patterns/pattern11_icon.png',
						THIM_URI . 'assets/images/patterns/pattern12.png' => THIM_URI . 'assets/images/patterns/pattern12_icon.png',
						THIM_URI . 'assets/images/patterns/pattern13.png' => THIM_URI . 'assets/images/patterns/pattern13_icon.png',
						THIM_URI . 'assets/images/patterns/pattern14.png' => THIM_URI . 'assets/images/patterns/pattern14_icon.png',
						THIM_URI . 'assets/images/patterns/pattern15.png' => THIM_URI . 'assets/images/patterns/pattern15_icon.png',
						THIM_URI . 'assets/images/patterns/pattern16.png' => THIM_URI . 'assets/images/patterns/pattern16_icon.png',
						THIM_URI . 'assets/images/patterns/pattern17.png' => THIM_URI . 'assets/images/patterns/pattern17_icon.png',
						THIM_URI . 'assets/images/patterns/pattern18.png' => THIM_URI . 'assets/images/patterns/pattern18_icon.png',
						THIM_URI . 'assets/images/patterns/pattern19.png' => THIM_URI . 'assets/images/patterns/pattern19_icon.png',
						THIM_URI . 'assets/images/patterns/pattern20.png' => THIM_URI . 'assets/images/patterns/pattern20_icon.png',
						THIM_URI . 'assets/images/patterns/pattern21.png' => THIM_URI . 'assets/images/patterns/pattern21_icon.png',
					),
					'transport'       => 'postMessage',
					'js_vars'         => array(
						array(
							'element'  => 'body #main-content.bg-type-pattern',
							'function' => 'css',
							'property' => 'background-image',
						)
					),
					'active_callback' => array(
						array(
							'setting'  => 'background_main_type',
							'operator' => '===',
							'value'    => 'pattern',
						),
					),
				)
			),
		),
	)
) );