<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 */

function thim_admin_notice_active( $arg ) {
    $array       = explode( '-', $arg );
    $length      = array_pop( $array );
    $option_name = implode( '-', $array );
    $db_record   = get_site_transient( $option_name );
    if ( 'forever' == $db_record ) {
        return false;
    } elseif ( absint( $db_record ) >= time() ) {
        return false;
    } else {
        return true;
    }
}

/**
 * Handles Ajax request to persist notices dismissal.
 * Uses check_ajax_referer to verify nonce.
 */
add_action( 'wp_ajax_thim_dismiss_admin_notice', 'thim_dismiss_admin_notice' );
function thim_dismiss_admin_notice() {
    $option_name        = sanitize_text_field( $_POST['option_name'] );
    $dismissible_length = sanitize_text_field( $_POST['dismissible_length'] );
    $transient          = 0;
    if ( 'forever' != $dismissible_length ) {
        $transient          = absint( $dismissible_length ) * DAY_IN_SECONDS;
        $dismissible_length = strtotime( absint( $dismissible_length ) . ' days' );
    }
    check_ajax_referer( 'dismissible-notice', 'nonce' );
    $dismiss = set_site_transient( $option_name, $dismissible_length, $transient );
    wp_die( $dismiss );
}

/**
 * Enqueue javascript and variables.
 */
add_action( 'admin_enqueue_scripts', 'thim_admin_load_script' );
function thim_admin_load_script() {
    wp_enqueue_script(
        'dismissible-notices',
        THIM_URI . 'inc/admin/assets/scripts.js',
        array( 'jquery', 'common' ),
        false,
        true
    );
    wp_localize_script(
        'dismissible-notices',
        'dismissible_notice',
        array(
            'nonce' => wp_create_nonce( 'dismissible-notice' ),
        )
    );
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function thim_body_classes( $classes ) {
    // Adds a class of group-blog to blogs with more than 1 published author.
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }

    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    $classes[] = 'bg-type-' . get_theme_mod( 'background_boxed_type', 'color' );

    if ( get_theme_mod( 'enable_responsive', true ) ) {
        $classes[] = 'responsive';
    } else {
        $classes[] = 'disable-responsive';
    }

    if ( get_theme_mod( 'auto_login', false ) ) {
        $classes[] = 'dis-auto-login';
    } else {
        $classes[] = 'auto-login';
    }

    if ( get_theme_mod( 'enable_box_shadow', true ) ) {
        $classes[] = 'box-shadow';
    }

    if ( is_active_sidebar( 'footer-top' ) ) {
        $classes[] = 'have-footer-top';
    }

    $classes[] = get_theme_mod('layout_courses','default_courses');
	$classes[] = 'nofixcss';
    return $classes;
}

add_filter( 'body_class', 'thim_body_classes' );

/**
 * Primary menu
 */
function thim_primary_menu() {
    if ( has_nav_menu( 'primary' ) ) {
        wp_nav_menu( array(
            'theme_location' => 'primary',
            'container'      => false,
            'items_wrap'     => '%3$s'
        ) );
    } else {
        wp_nav_menu( array(
            'theme_location' => '',
            'container'      => false,
            'items_wrap'     => '%3$s'
        ) );
    }
}

/**
 * Display the classes for the #wrapper-container element.
 *
 * @param string|array $class One or more classes to add to the class list.
 */
function thim_wrapper_container_class( $class = '' ) {
    // Separates classes with a single space, collates classes for body element
    echo 'class="' . join( ' ', thim_get_wrapper_container_class( $class ) ) . '"';
}

/**
 * Retrieve the classes for the #wrapper-container element as an array.
 *
 * @param string|array $class One or more classes to add to the class list.
 *
 * @return array Array of classes.
 */
function thim_get_wrapper_container_class( $class = '' ) {
    $classes = array();

    if ( ! empty( $class ) ) {
        if ( ! is_array( $class ) ) {
            $class = preg_split( '#\s+#', $class );
        }
        $classes = array_merge( $classes, $class );
    } else {
        // Ensure that we always coerce class to being an array.
        $class = array();
    }

    $classes = array_map( 'esc_attr', $classes );

    /**
     * Filter the list of CSS #wrapper-container classes
     *
     * @param array $classes An array of #wrapper-container classes.
     * @param array $class   An array of additional classes added to the #wrapper-container.
     */
    $classes = apply_filters( 'thim_wrapper_container_class', $classes, $class );

    return array_unique( $classes );
}


/**
 * Adds custom classes to the array of #wrapper-container classes.
 *
 * @param array $classes Classes for the #wrapper-container element.
 *
 * @return array
 */
function thim_wrapper_container_classes( $classes ) {
    $classes[] = 'content-pusher';

    if ( get_theme_mod( 'box_content_layout' ) == 'boxed' ) {
        $classes[] = 'boxed-area';
    }

    if ( get_theme_mod( 'mobile_menu_position' ) == 'creative-left' ) {
        $classes[] = 'creative-left';
    } else {
        $classes[] = 'creative-right';
    }

    $classes[] = 'bg-type-' . get_theme_mod( 'background_main_type', 'color' );

    return $classes;
}

add_filter( 'thim_wrapper_container_class', 'thim_wrapper_container_classes' );


/**
 * Add lang to html tag
 *
 * @return @string
 */
if ( ! function_exists( 'thim_language_attributes' ) ) {
    function thim_language_attributes() {
        echo 'lang="' . get_bloginfo( 'language' ) . '"';
    }

//    add_filter( 'language_attributes', 'thim_language_attributes', 10 );
}


/**
 * Optimize: Remove Emoji scripts
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/**
 *
 * Coming soon mode
 *
 * @return mixed|void
 */
add_filter( 'rwmb_meta_boxes', 'thim_extra_metabox' );

function thim_extra_metabox( $meta_boxes ) {
    $prefix = 'thim_comingsoon_';

    $meta_boxes[] = array(
        'id'         => $prefix . 'mode',
        'title'      => esc_html__( 'Coming Soon Mode - Settings', 'ivy-school' ),
        'post_types' => array( 'page' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'show'       => array(
            'template' => array( 'templates/comingsoon.php' ),
        ),
        'fields'     => array(
            array(
                'name'             => esc_html__( 'Logo', 'ivy-school' ),
                'id'               => $prefix . 'logo',
                'type'             => 'image_advanced',
                'max_file_uploads' => 1,
            ),
            array(
                'id'   => $prefix . 'text',
                'name' => esc_html__( 'Heading', 'ivy-school' ),
                'type' => 'text',
            ),
            array(
                'name' => esc_html__( 'Date', 'ivy-school' ),
                'id'   => $prefix . 'date',
                'type' => 'datetime',
            ),
            array(
                'name'             => esc_html__( 'Background', 'ivy-school' ),
                'id'               => $prefix . 'background',
                'type'             => 'image_advanced',
                'max_file_uploads' => 1,
            ),
        ),
    );

    $prefix   = 'thim_ot_';

    $meta_boxes[] = array(
        'id' => $prefix . 'extra_meta_box',
        'title' => esc_html__( 'Extra Information', 'ivy-school' ),
        'post_types' => array('our_team'),
        'fields' => array(
            array(
                'id'         => $prefix . 'extra_info',
                'type'       => 'group',
                'clone'      => true,
                'sort_clone' => true,
                'fields'     => array(
                    array(
                        'name' => 'Title',
                        'id'   => $prefix . 'heading',
                        'type' => 'text'
                    ),
                    array(
                        'name' => 'Content',
                        'id'   => $prefix . 'description',
                        'type' => 'textarea'
                    )
                )
            )
        )
    );

    $prefix = 'thim_icon_';
    $meta_boxes[] = array(
        'id'        => $prefix . 'extra',
        'title'     => esc_html__('Icon Service','ivy-school'),
        'post_types'=> array( 'page' ),
        'context'   => 'normal',
        'priority'  => 'high',
        'show'      => array(
            'template'  => array('templates/archive-service.php'),
        ),
        'fields'    => array(
            array(
                'name'      => esc_html__('Icon Upload','ivy-school'),
                'id'        => $prefix . 'name',
                'type'      => 'image_advanced'
            ),
        )
    );
    return $meta_boxes;
}

/**
 * Display Settings
 * Page
 */
add_filter( 'thim_metabox_display_settings', 'thim_metabox_page_display_settings', 15 );

function thim_metabox_page_display_settings( ) {
    $prefix                = 'thim_';
    $page_id               = isset( $_GET['post'] ) ? $_GET['post'] : '';
    $custom_description    = get_theme_mod( 'page_title_custom_description' ) ? get_theme_mod( 'page_title_custom_description' ) : '';


    $metabox = array(
        'title'      => esc_attr__( 'Display settings', 'ivy-school' ),
        'post_types' => array( 'page', 'post', 'lp_course', 'tp_event', 'product' ),
        'tabs'       => array(
            'page_title' => array(
                'label' => esc_attr__( 'Page Title', 'ivy-school' ),
                'icon'  => 'dashicons-admin-appearance',
            ),
            'layout'     => array(
                'label' => esc_attr__( 'Layout', 'ivy-school' ),
                'icon'  => 'dashicons-align-left',
            ),
        ),
        'tab_style'  => 'box',

        'tab_wrapper' => true,
        'fields'      => array(
            /**
             * Custom Settings
             */
            array(
                'name' => esc_attr__( 'Custom Page Title', 'ivy-school' ),
                'id'   => $prefix . 'enable_custom_title',
                'type' => 'checkbox',
                'std'  => 0,
                'tab'  => 'page_title',
            ),

            array(
                'type'   => 'divider',
                'tab'    => 'page_title',
                'hidden' => array( $prefix . 'enable_custom_title', '=', 0 ),
            ),

            array(
                'id'     => $prefix . 'group_custom_title',
                'type'   => 'group',
                'tab'    => 'page_title',
                'hidden' => array( $prefix . 'enable_custom_title', '=', false ),
                'fields' => array(
                    array(
                        'name'   => esc_attr__( 'Hide All Page Title', 'ivy-school' ),
                        'id'     => $prefix . 'group_custom_title_hide_page_title',
                        'type'   => 'checkbox',
                        'std'    => 0,
                        'hidden' => array( $prefix . 'enable_custom_title', '=', 0 ),
                        'tab'    => 'page_title',
                    ),

                    array(
                        'type'   => 'heading',
                        'name'   => esc_attr__( 'Title & Breadcrumb', 'ivy-school' ),
                        'desc'   => 'Optional description',
                        'tab'    => 'page_title',
                        'hidden' => array( $prefix . 'enable_custom_title', '=', 0 ),
                    ),

                    array(
                        'name'   => esc_attr__( 'Hide Title', 'ivy-school' ),
                        'id'     => $prefix . 'group_custom_title_hide_title',
                        'type'   => 'checkbox',
                        'std'    => 0,
                        'hidden' => array( $prefix . 'group_custom_title_hide_page_title', '=', 1 ),
                        'tab'    => 'page_title',
                    ),

                    array(
                        'name'        => esc_attr__( 'Custom Title', 'ivy-school' ),
                        'id'          => $prefix . 'group_custom_title_new_title',
                        'type'        => 'text',
                        'desc'        => 'Leave empty to use current post title',
                        'std'         => get_the_title( $page_id ),
                        'placeholder' => get_the_title( $page_id ),
                        'hidden'      => array( $prefix . 'group_custom_title_hide_title', '=', 1 ),
                        'tab'         => 'page_title',
                    ),

                    array(
                        'name'   => esc_attr__( 'Hide Sub Title & Description', 'ivy-school' ),
                        'id'     => $prefix . 'group_custom_title_hide_sub_title',
                        'type'   => 'checkbox',
                        'std'    => 0,
                        'hidden' => array( $prefix . 'group_custom_title_hide_page_title', '=', 1 ),
                        'tab'    => 'page_title',
                    ),

                    array(
                        'name'   => esc_attr__( 'Custom Sub Title & Description', 'ivy-school' ),
                        'id'     => $prefix . 'group_custom_title_custom_sub_title',
                        'type'   => 'textarea',
                        'std'    => $custom_description,
                        'hidden' => array( $prefix . 'group_custom_title_hide_sub_title', '=', 1 ),
                        'tab'    => 'page_title',
                    ),

                    array(
                        'name'   => esc_attr__( 'Hide Breadcrumbs', 'ivy-school' ),
                        'id'     => $prefix . 'group_custom_title_hide_breadcrumbs',
                        'type'   => 'checkbox',
                        'std'    => 0,
                        'hidden' => array( $prefix . 'group_custom_title_hide_page_title', '=', 1 ),
                        'tab'    => 'page_title',
                    ),
                )
            ),

            array(
                'id'     => $prefix . 'group_custom_background',
                'name'   => esc_html__( 'Background', 'ivy-school' ),
                'type'   => 'group',
                'tab'    => 'page_title',
                'hidden' => array( $prefix . 'enable_custom_title', '!=', true ),
                'fields' => array(
                    array(
                        'type'   => 'heading',
                        'name'   => esc_attr__( 'Background', 'ivy-school' ),
                        'desc'   => 'Optional description',
                        'tab'    => 'page_title',
                        'hidden' => array( $prefix . 'enable_custom_title', '=', 0 ),
                    ),

                    array(
                        'name'             => esc_attr__( 'Background Image', 'ivy-school' ),
                        'id'               => $prefix . 'group_custom_title_bg_img',
                        'type'             => 'image_advanced',
                        'max_file_uploads' => 1,
                        'force_delete'     => false,
                        'hidden'           => array( $prefix . 'group_custom_title_hide_page_title', '=', 1 ),
                        'tab'              => 'page_title',
                    ),

                    array(
                        'name'          => esc_attr__( 'Background Color Overlay', 'ivy-school' ),
                        'id'            => $prefix . 'group_custom_title_bg_color',
                        'type'          => 'color',
                        'alpha_channel' => true,
                        'hidden'        => array( $prefix . 'group_custom_title_hide_page_title', '=', 1 ),
                        'tab'           => 'page_title',
                    ),
                )

            ),


            /**
             * Custom layout
             */
            array(
                'name' => esc_attr__( 'Custom Layout', 'ivy-school' ),
                'id'   => $prefix . 'enable_custom_layout',
                'type' => 'checkbox',
                'tab'  => 'layout',
                'std'  => false,
            ),
            array(
                'name'    => esc_attr__( 'Select Layout', 'ivy-school' ),
                'id'      => $prefix . 'custom_layout',
                'type'    => 'image_select',
                'options' => array(
                    'sidebar-left'  => THIM_URI . 'assets/images/layout/sidebar-left.jpg',
                    'no-sidebar'    => THIM_URI . 'assets/images/layout/body-full.jpg',
                    'sidebar-right' => THIM_URI . 'assets/images/layout/sidebar-right.jpg',
                    'full-sidebar'  => THIM_URI . 'assets/images/layout/body-left-right.jpg'
                ),
                'tab'     => 'layout',
                'hidden'  => array( $prefix . 'enable_custom_layout', '=', false ),
                'std'     => 'sidebar-left',
            ),
            array(
                'name'   => esc_attr__( 'No Padding', 'ivy-school' ),
                'id'     => $prefix . 'no_padding_content',
                'type'   => 'checkbox',
                'std'    => false,
                'hidden' => array( $prefix . 'enable_custom_layout', '=', false ),
                'tab'    => 'layout',
            ),
            array(
                'name'   => esc_attr__( 'Hidden Footer Top', 'ivy-school' ),
                'id'     => $prefix . 'footer_top',
                'type'   => 'checkbox',
                'tab'    => 'layout',
                'std'    => 0,
            ),

        ),
    );

    return $metabox;
}
