<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 */
$single_style = get_theme_mod('single_style', 'default');
if ( isset($_GET['single']) ) {
$single_style = $_GET['single'];
}

get_header();

do_action( 'thim_wrapper_loop_start' );
?>

<div class="page-content  <?php echo esc_attr($single_style); ?>">
    <?php
    while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'templates/template-parts/content', 'single' ); ?>
    <?php endwhile; // end of the loop. ?>
</div>
<?php

do_action( 'thim_wrapper_loop_end' );

get_footer();
