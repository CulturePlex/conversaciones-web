<?php
/**
 * Section Blog Archive
 *
 * @package Hair_Salon
 */

thim_customizer()->add_section(
    array(
        'id'       => 'blog_meta',
        'panel'    => 'blog',
        'title'    => esc_html__( 'Meta Tags', 'ivy-school' ),
        'priority' => 20,
    )
);

// Enable or Disable Author Meta Tags
thim_customizer()->add_field(
    array(
        'id'          => 'show_author_meta_tags',
        'type'        => 'switch',
        'label'       => esc_html__( 'Show Author', 'ivy-school' ),
        'tooltip'     => esc_html__( 'Allows you to show author meta tags to display at all blog page.', 'ivy-school' ),
        'section'     => 'blog_meta',
        'default'     => true,
        'priority'    => 30,
        'choices'     => array(
            true  	  => esc_html__( 'Show', 'ivy-school' ),
            false	  => esc_html__( 'Hide', 'ivy-school' ),
        ),
    )
);

// Enable or Disable Date Meta Tags
thim_customizer()->add_field(
    array(
        'id'          => 'show_date_meta_tags',
        'type'        => 'switch',
        'label'       => esc_html__( 'Show Date', 'ivy-school' ),
        'tooltip'     => esc_html__( 'Allows you to show date meta tags to display at all blog page.', 'ivy-school' ),
        'section'     => 'blog_meta',
        'default'     => true,
        'priority'    => 31,
        'choices'     => array(
            true  	  => esc_html__( 'Show', 'ivy-school' ),
            false	  => esc_html__( 'Hide', 'ivy-school' ),
        ),
    )
);

// Enable or Disable Category Meta Tags
thim_customizer()->add_field(
    array(
        'id'          => 'show_category_meta_tags',
        'type'        => 'switch',
        'label'       => esc_html__( 'Show Category', 'ivy-school' ),
        'tooltip'     => esc_html__( 'Allows you to show category meta tags to display at single post page.', 'ivy-school' ),
        'section'     => 'blog_meta',
        'default'     => false,
        'priority'    => 32,
        'choices'     => array(
            true  	  => esc_html__( 'Show', 'ivy-school' ),
            false	  => esc_html__( 'Hide', 'ivy-school' ),
        ),
    )
);

// Enable or Disable Tags Meta Tags
thim_customizer()->add_field(
    array(
        'id'          => 'show_tags_meta_tags',
        'type'        => 'switch',
        'label'       => esc_html__( 'Show Tags', 'ivy-school' ),
        'tooltip'     => esc_html__( 'Allows you to show tags meta tags to display at single post page.', 'ivy-school' ),
        'section'     => 'blog_meta',
        'default'     => true,
        'priority'    => 33,
        'choices'     => array(
            true  	  => esc_html__( 'Show', 'ivy-school' ),
            false	  => esc_html__( 'Hide', 'ivy-school' ),
        ),
    )
);

// Enable or Disable Comments Meta Tags
thim_customizer()->add_field(
    array(
        'id'       => 'show_comment_meta_tags',
        'type'     => 'switch',
        'label'    => esc_html__( 'Show Comment Number', 'ivy-school' ),
        'tooltip'  => esc_html__( 'Allows you to show comment meta tags to display at single post page.', 'ivy-school' ),
        'section'  => 'blog_meta',
        'default'  => true,
        'priority' => 33,
        'choices'  => array(
            true  	  => esc_html__( 'Show', 'ivy-school' ),
            false	  => esc_html__( 'Hide', 'ivy-school' ),
        ),
    )
);