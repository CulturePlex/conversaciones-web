<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 */
get_header();

do_action( 'thim_wrapper_loop_start' );
?>

<section class="error-404 not-found">
    <div class="page-content">
        <h2 class="title"><?php esc_html_e( '404', 'ivy-school' ); ?></h2>
        <h3 class="intro"><?php esc_html_e( 'Page not found!', 'ivy-school' ); ?></h3>
        <p class="message"><?php echo wp_kses( sprintf( __( "Sorry, we can't find the page you are looking for. Please go to  <a href='%s'>Home.</a>", 'ivy-school' ), esc_url( home_url( '/' ) ) ), array(
                'a' => array(
                    'href'  => array(),
                    'title' => array()
                )
            ) ); ?></p>
    </div><!-- .page-content -->
</section><!-- .error-404 -->

<?php

do_action( 'thim_wrapper_loop_end' );

get_footer();
