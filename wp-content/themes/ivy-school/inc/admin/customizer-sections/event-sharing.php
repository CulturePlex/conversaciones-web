<?php
/**
 * Section Sharing
 *
 * @package Hair_Salon
 */

thim_customizer()->add_section(
    array(
        'id'       => 'event-sharing',
        'panel'    => 'event',
        'title'    => esc_html__( 'Social Share', 'ivy-school' ),
        'priority' => 21,
    )
);

// Enable or Disable Author Meta Tags
thim_customizer()->add_field(
    array(
        'id'          => 'event_show_sharing',
        'type'        => 'switch',
        'label'       => esc_html__( 'Show Sharing', 'ivy-school' ),
        'tooltip'     => esc_html__( 'Allows you to show Sharing on single post.', 'ivy-school' ),
        'section'     => 'event-sharing',
        'default'     => false,
        'priority'    => 10,
        'choices'     => array(
            true  	  => esc_html__( 'Show', 'ivy-school' ),
            false	  => esc_html__( 'Hide', 'ivy-school' ),
        ),
    )
);

thim_customizer()->add_group( array(
    'id'       => 'event_share_group',
    'section'  => 'event-sharing',
    'priority' => 10,
    'groups'   => array(
        array(
            'id'     => 'event_share_group_single',
            'label'  => esc_html__( 'Single', 'ivy-school' ),
            'fields' => array(
                array(
                    'id'       => 'event_single_group_sharing',
                    'type'     => 'sortable',
                    'label'    => esc_html__( 'Sortable Buttons Sharing', 'ivy-school' ),
                    'tooltip'  => esc_html__( 'Click on eye icon to show or hide social icon. Drag and drop to change the order of social icons.', 'ivy-school' ),
                    'section'  => 'event-sharing',
                    'priority' => 10,
                    'default'  => array(
                        'facebook',
                        'twitter',
                        'pinterest',
                        'google'
                    ),
                    'choices'  => array(
                        'facebook'  => esc_html__( 'Facebook', 'ivy-school' ),
                        'twitter'   => esc_html__( 'Twitter', 'ivy-school' ),
                        'pinterest' => esc_html__( 'Pinterest', 'ivy-school' ),
                        'google'    => esc_html__( 'Google', 'ivy-school' ),
                    ),
                )
            ),
        ),
    )
) );


