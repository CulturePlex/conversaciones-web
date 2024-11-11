<?php
/**
 * Section Header Sub Menu
 * 
 * @package Thim_Starter_Theme
 */

thim_customizer()->add_section(
    array(
        'id'             => 'header_sub_menu',
        'title'          => esc_html__( 'Sub Menu', 'ivy-school' ),
        'panel'			 => 'header',
        'priority'       => 50,
    )
);

// Background Header
thim_customizer()->add_field(
    array(
        'id'          => 'sub_menu_background_color',
        'type'        => 'color',
        'label'       => esc_html__( 'Background Color', 'ivy-school' ),
        'tooltip'     => esc_html__( 'Allows you can select a color make background color sub menu on header  . ', 'ivy-school' ),
        'section'     => 'header_sub_menu',
        'default'     => '#ffffff',
        'priority'    => 16,
        'alpha'       => true,
        'transport' => 'postMessage',
        'js_vars'   => array(
            array(
                'choice'   => 'color',
                'element'  => 'header#masthead.site-header #primaryMenu .sub-menu',
                'property' => 'background-color',
            )
        )
    )
);

// Text Color
thim_customizer()->add_field(
    array(
        'id'          => 'sub_menu_text_color',
        'type'        => 'color',
        'label'       => esc_html__( 'Text Color', 'ivy-school' ),
        'tooltip'     => esc_html__( 'Allows you can select a color make text color sub menu on header. ', 'ivy-school' ),
        'section'     => 'header_sub_menu',
        'default'     => '#333333',
        'priority'    => 17,
        'alpha'       => true,
        'transport' => 'postMessage',
        'js_vars'   => array(
            array(
                'choice'   => 'color',
                'element'  => 'header#masthead.site-header .navigation #primaryMenu .sub-menu a,
                               header#masthead.site-header .navigation #primaryMenu .sub-menu span',
                'property' => 'color',
            )
        )
    )
);

// Text Hover Color
thim_customizer()->add_field(
    array(
        'id'          => 'sub_menu_text_color_hover',
        'type'        => 'color',
        'label'       => esc_html__( 'Text Hover Color', 'ivy-school' ),
        'tooltip'     => esc_html__( 'Allows you can select color for text link when hover text link sub menu on header. ', 'ivy-school' ),
        'section'     => 'header_sub_menu',
        'default'     => '#439fdf',
        'priority'    => 18,
        'alpha'       => true,
        'transport' => 'postMessage',
        'js_vars'   => array(
            array(
                'choice'   => 'color',
                'element'  => 'header#masthead.site-header .navigation #primaryMenu .sub-menu a:hover,
                               header#masthead.site-header .navigation #primaryMenu .sub-menu span:hover',
                'property' => 'color',
            )
        )
    )
);


