<?php
/**
 * Section Breadcrumb
 * 
 * @package Thim_Starter_Theme
 */

thim_customizer()->add_section(
    array(
        'id'       => 'breadcrumb',
        'panel'    => 'page_title_bar',
        'title'    => esc_html__( 'Breadcrumbs', 'ivy-school' ),
        'priority' => 20,
    )
);

// Enable or Disable Breadcrumb
thim_customizer()->add_field(
    array(
        'id'          => 'disable_breadcrumb',
        'type'        => 'switch',
        'label'       => esc_html__( 'Hide Breadcrumb', 'ivy-school' ),
        'tooltip'     => esc_html__( 'Allows you can HIDE breadcrumb on page title bar. ', 'ivy-school' ),
        'section'     => 'breadcrumb',
        'default'     => false,
        'priority'    => 10,
        'choices'     => array(
            true  	  => esc_html__( 'On', 'ivy-school' ),
            false	  => esc_html__( 'Off', 'ivy-school' ),
        ),
    )
);

// Enter Icon To Show In Breadcrumb
$link_icon = 'http://fontawesome.io/icons/';

thim_customizer()->add_field(
    array(
        'id'          => 'breadcrumb_icon',
        'type'        => 'text',
        'label'       => esc_html__( 'Breadcrumb Icon', 'ivy-school' ),
        'description' => sprintf('Enter any one character from the keyboard or <a href="' . esc_url($link_icon) . '" target="_blank" >FontAwesome</a> icon name. For example: 	&lt;i class="fa fa-angle-right"&gt; &lt;&#47i&gt; ,...','ivy-school'),
        'section'     => 'breadcrumb',
        'default'     => '/',
        'priority'    => 20,
    )
);

thim_customizer()->add_field(
    array(
        'id'        => 'font_breadcrumb',
        'type'      => 'typography',
        'label'     => esc_html__( 'Breadcrumb Fonts', 'ivy-school' ),
        'tooltip'   => esc_html__( 'Allows you can select fonts property for breadcrumb. ', 'ivy-school' ),
        'section'   => 'breadcrumb',
        'priority'    => 30,
        'default'   => array(
            'font-size'      => '16px',
            'color'          => '#fff',
        ),
        'transport' => 'postMessage',
        'js_vars'   => array(
            array(
                'choice'   => 'font-size',
                'element'  => '.breadcrumb-content #breadcrumbs li a,
                               .breadcrumb-content #breadcrumbs li span,
                               .breadcrumb-content #breadcrumbs li i',
                'property' => 'font-size',
            ),
            array(
                'choice'   => 'color',
                'element'  => '.breadcrumb-content #breadcrumbs li a,
                               .breadcrumb-content #breadcrumbs li span,
                               .breadcrumb-content #breadcrumbs li i',
                'property' => 'color',
            ),
        )
    )
);
