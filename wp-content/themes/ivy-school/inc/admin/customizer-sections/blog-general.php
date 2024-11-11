<?php
/**
 * Section Blog General
 *
 * @package Hair_Salon
 */

thim_customizer()->add_section(
    array(
        'id'       => 'blog_general_archive',
        'panel'    => 'blog',
        'title'    => esc_html__( 'Archive Settings', 'ivy-school' ),
        'priority' => 10,
    )
);


thim_customizer()->add_section(
    array(
        'id'       => 'blog_general_single',
        'panel'    => 'blog',
        'title'    => esc_html__( 'Single Settings', 'ivy-school' ),
        'priority' => 11,
    )
);

// Blog Archive Group
thim_customizer()->add_group( array(
        'id'       => 'blog_archive_setting_group',
        'section'  => 'blog_general_archive',
        'priority' => 10,
        'groups'   => array(
            array(
                'id'     => 'blog_archive_page_group',
                'label'  => esc_html__( 'Archive Page', 'ivy-school' ),
                'fields' => array(
                    // Enable or Disable Page Title
                    array(
                        'id'       => 'blog_archive_hide_page_title',
                        'type'     => 'switch',
                        'label'    => esc_html__( 'Hidden Page Title', 'ivy-school' ),
                        'tooltip'  => esc_html__( 'Allows you can hidden or show page title on heading top. ', 'ivy-school' ),
                        'default'  => false,
                        'priority' => 2,
                        'choices'  => array(
                            true  => esc_html__( 'On', 'ivy-school' ),
                            false => esc_html__( 'Off', 'ivy-school' ),
                        ),
                    ),
                    // Enable or Disable Breadcrumb
                    array(
                        'id'          => 'blog_archive_hide_breadcrumb',
                        'type'        => 'switch',
                        'label'       => esc_html__( 'Hide Breadcrumb', 'ivy-school' ),
                        'tooltip'     => esc_html__( 'Allows you can HIDE breadcrumb on page title bar. ', 'ivy-school' ),
                        'default'     => false,
                        'priority'    => 3,
                        'choices'     => array(
                            true  	  => esc_html__( 'On', 'ivy-school' ),
                            false	  => esc_html__( 'Off', 'ivy-school' ),
                        ),
                    ),
                    // Blog Archive Background Image
                    array(
                        'id'       => 'blog_archive_heading_background_image',
                        'type'     => 'image',
                        'label'    => esc_html__( 'Background Image', 'ivy-school' ),
                        'tooltip'  => esc_html__( 'You can upload image make to background image for page title on heading top. ', 'ivy-school' ),
                        'priority' => 4,
                        'js_vars'  => array(
                            array(
                                'element'  => '.main-top',
                                'function' => 'css',
                                'property' => 'background-image',
                            ),
                        ),
                        'default'  => THIM_URI . "assets/images/page-title.jpg",
                    ),
                    // Blog Archive Background Color
                    array(
                        'id'        => 'blog_archive_heading_background_color',
                        'type'      => 'color',
                        'label'     => esc_html__( 'Background Color', 'ivy-school' ),
                        'tooltip'   => esc_html__( 'If you do not use background image, then can use background color for page title on heading top. ', 'ivy-school' ),
                        'default'   => '#222222',
                        'priority'  => 5,
                        'alpha'     => true,
                        'transport' => 'postMessage',
                        'js_vars'   => array(
                            array(
                                'choice'   => 'color',
                                'element'  => '.page-title .main-top .overlay-top-header',
                                'property' => 'background',
                            )
                        )
                    ),
                    // Blog Archive Background Color opacity
                    array(
                        'id'        => 'blog_archive_background_opacity',
                        'type'      => 'text',
                        'label'     => esc_html__( 'Background Color Opacity', 'ivy-school' ),
                        'section'   => 'page_title_styling',
                        'default'   => '0.5',
                        'priority'  => 35,
                        'alpha'     => true,
                        'transport' => 'postMessage',
                        'js_vars'   => array(
                            array(
                                'choice'   => 'text',
                                'element'  => '.page-title .main-top .overlay-top-header',
                                'property' => 'opacity',
                            )
                        )
                    ),
                    //Blog Style
                    array(
                        'type'     => 'select',
                        'id'       => 'archive_style',
                        'label'    => esc_html__( 'Blog Style', 'ivy-school' ),
                        'tooltip'  => esc_html__( 'Choose the style for archive post.', 'ivy-school' ),
                        'default'  => 'default',
                        'priority' => 9,
                        'multiple' => 0,
                        'choices'  => array(
                            'default'     => esc_html__( 'Default', 'ivy-school' ),
                            'masonry'     => esc_html__( 'Masonry', 'ivy-school' ),
                            'blog_list_3' => esc_html__( 'Blog List 3', 'ivy-school' ),

                        ),
                        'std'      => 'default'
                    ),
                    //Blog Columns
                    array(
                        'type'            => 'select',
                        'id'              => 'archive_post_column',
                        'label'           => esc_html__( 'Blog Number Column', 'ivy-school' ),
                        'tooltip'         => esc_html__( 'Choose the number of columns for archive post.', 'ivy-school' ),
                        'default'         => '1',
                        'priority'        => 10,
                        'multiple'        => 0,
                        'choices'         => array(
                            '1' => esc_html__( '1', 'ivy-school' ),
                            '2' => esc_html__( '2', 'ivy-school' ),
                        ),
                        'active_callback' => array(
                            array(
                                'setting'  => 'archive_style',
                                'operator' => '==',
                                'value'    => 'default',
                            ),
                        ),
                    ),
                    //Blog Columns
                    array(
                        'type'            => 'select',
                        'id'              => 'archive_masonry_column',
                        'label'           => esc_html__( 'Blog Masonry Number Columns', 'ivy-school' ),
                        'tooltip'         => esc_html__( 'Choose the number of columns for archive masonry.', 'ivy-school' ),
                        'default'         => '4',
                        'priority'        => 11,
                        'multiple'        => 0,
                        'choices'         => array(
                            '2' => esc_html__( '2', 'ivy-school' ),
                            '3' => esc_html__( '3', 'ivy-school' ),
                            '4' => esc_html__( '4', 'ivy-school' ),
                        ),
                        'active_callback' => array(
                            array(
                                'setting'  => 'archive_style',
                                'operator' => '==',
                                'value'    => 'masonry',
                            ),
                        ),
                    ),
                    //show button Read More
                    array(
                        'id'              => 'archive_read_more',
                        'type'            => 'switch',
                        'label'           => esc_html__( 'Show Read More', 'ivy-school' ),
                        'tooltip'         => esc_html__( 'Allows you to show button real more to display at single post page.', 'ivy-school' ),
                        'default'         => true,
                        'priority'        => 11.5,
                        'choices'         => array(
                            true  => esc_html__( 'Show', 'ivy-school' ),
                            false => esc_html__( 'Hide', 'ivy-school' ),
                        ),
                        'active_callback' => array(
                            array(
                                'setting'  => 'archive_style',
                                'operator' => 'in',
                                'value'    => array( 'blog_list_3', 'default'),
                            ),
                        ),
                    ),

                    // Excerpt Content
                    array(
                        'id'       => 'excerpt_archive_content',
                        'type'     => 'slider',
                        'label'    => esc_html__( 'Excerpt Length', 'ivy-school' ),
                        'tooltip'  => esc_html__( 'Choose the number of words you want to cut from the content to be the excerpt of search and archive', 'ivy-school' ),
                        'priority' => 20,
                        'default'  => 20,
                        'choices'  => array(
                            'min'  => '10',
                            'max'  => '100',
                            'step' => '5',
                        ),
                    ),
                    //show meta tags
                    array(
                        'id'       => 'archive_meta_tags',
                        'type'     => 'switch',
                        'label'    => esc_html__( 'Show Tags', 'ivy-school' ),
                        'tooltip'  => esc_html__( 'Allows you to show tags meta tags to display at single post page.', 'ivy-school' ),
                        'default'  => true,
                        'priority' => 33,
                        'choices'  => array(
                            true  => esc_html__( 'Show', 'ivy-school' ),
                            false => esc_html__( 'Hide', 'ivy-school' ),
                        ),
                    ),
                ),
            ),
        ),
    )
);

// Blog Single Group
thim_customizer()->add_group( array(
    'id'       => 'blog_single_setting_group',
    'section'  => 'blog_general_single',
    'priority' => 20,
    'groups'   => array(
        array(
            'id'     => 'blog_single_page_group',
            'label'  => esc_html__( 'Single Page', 'ivy-school' ),
            'fields' => array(
                // Show Feature Image
                array(
                    'type'     => 'switch',
                    'id'       => 'blog_single_feature_image',
                    'label'    => esc_html__( 'Featured Image', 'ivy-school' ),
                    'tooltip'  => esc_html__( 'Turn on to display featured images on single blog posts..', 'ivy-school' ),
                    'default'  => true,
                    'priority' => 10,
                    'choices'  => array(
                        true  => esc_html__( 'On', 'ivy-school' ),
                        false => esc_html__( 'Off', 'ivy-school' ),
                    ),
                ),
                // Turn On Comments
                array(
                    'type'     => 'switch',
                    'id'       => 'blog_single_comment',
                    'label'    => esc_html__( 'Comments Form', 'ivy-school' ),
                    'tooltip'  => esc_html__( 'Turn on to display comments.', 'ivy-school' ),
                    'default'  => true,
                    'priority' => 20,
                    'choices'  => array(
                        true  => esc_html__( 'On', 'ivy-school' ),
                        false => esc_html__( 'Off', 'ivy-school' ),
                    ),
                ),
                // Turn On Related Post
                array(
                    'type'     => 'switch',
                    'id'       => 'blog_single_related_post',
                    'label'    => esc_html__( 'Related Posts', 'ivy-school' ),
                    'tooltip'  => esc_html__( 'Turn on to display related posts.', 'ivy-school' ),
                    'default'  => true,
                    'priority' => 30,
                    'choices'  => array(
                        true  => esc_html__( 'On', 'ivy-school' ),
                        false => esc_html__( 'Off', 'ivy-school' ),
                    ),
                ),
                // Select Post Numbers For Related Post
                array(
                    'type'            => 'slider',
                    'id'              => 'blog_single_related_post_number',
                    'label'           => esc_html__( 'Numbers of Related Post', 'ivy-school' ),
                    'default'         => 3,
                    'priority'        => 40,
                    'choices'         => array(
                        'min'  => 1,
                        'max'  => 20,
                        'step' => 1,
                    ),
                    'active_callback' => array(
                        array(
                            'setting'  => 'blog_single_related_post',
                            'operator' => '==',
                            'value'    => true,
                        ),
                    ),
                ),
                // Select Post Column Numbers For Related Post
                array(
                    'type'            => 'slider',
                    'id'              => 'blog_single_related_post_column',
                    'label'           => esc_html__( 'Columns of Related Post', 'ivy-school' ),
                    'default'         => 3,
                    'priority'        => 50,
                    'choices'         => array(
                        'min'  => 1,
                        'max'  => 12,
                        'step' => 1,
                    ),
                    'active_callback' => array(
                        array(
                            'setting'  => 'blog_single_related_post',
                            'operator' => '==',
                            'value'    => true,
                        ),
                    ),
                ),
            ),
        ),
    )
) );
