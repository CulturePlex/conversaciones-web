<?php
/**
 * Panel and Group Typography
 *
 * @package Hair_Salon
 */

thim_customizer()->add_section(
    array(
        'id'       => 'typography',
        'panel'    => 'general',
        'priority' => 60,
        'title'    => esc_html__( 'Typography', 'ivy-school' ),
    )
);

// Body_Typography_Group
thim_customizer()->add_group( array(
    'id'       => 'body_typography',
    'section'  => 'typography',
    'priority' => 10,
    'groups'   => array(
        array(
            'id'     => 'body_group',
            'label'  => esc_html__( 'Body', 'ivy-school' ),
            'fields' => array(
                array(
                    'id'        => 'font_body',
                    'label'     => esc_html__( 'Body Font', 'ivy-school' ),
                    'tooltip'  => esc_html__( 'Allows you to select all font properties of body tag for your site', 'ivy-school' ),
                    'type'      => 'typography',
                    'priority'    => 10,
                    'default'     => array(
                        'font-family'    => 'Roboto',
                        'variant'        => '400',
                        'font-size'      => '15px',
                        'line-height'    => '1.6em',
                        'letter-spacing' => '0',
                        'color'          => '#777777',
                        'text-transform' => 'none',
                    ),
                    'transport' => 'postMessage',
                    'js_vars'   => array(
                        array(
                            'choice'   => 'font-family',
                            'element'  => 'body',
                            'property' => 'font-family',
                        ),
                        array(
                            'choice'   => 'variant',
                            'element'  => 'body',
                            'property' => 'font-weight',
                        ),
                        array(
                            'choice'   => 'font-size',
                            'element'  => 'body',
                            'property' => 'font-size',
                        ),
                        array(
                            'choice'   => 'line-height',
                            'element'  => 'body',
                            'property' => 'line-height',
                        ),
                        array(
                            'choice'   => 'letter-spacing',
                            'element'  => 'body',
                            'property' => 'letter-spacing',
                        ),
                        array(
                            'choice'   => 'color',
                            'element'  => 'body',
                            'property' => 'color',
                        ),
                        array(
                            'choice'   => 'text-transform',
                            'element'  => 'body',
                            'property' => 'text-transform',
                        ),
                    )
                ),
            ),
        ),
    )
) );