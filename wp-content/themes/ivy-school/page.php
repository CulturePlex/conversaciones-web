<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */
get_header();

do_action( 'thim_wrapper_loop_start' );

while ( have_posts() ) : the_post(); ?>

	<?php get_template_part( 'templates/template-parts/content', 'page' ); ?>

	<?php
	// If comments are open or we have at least one comment, load up the comment template
	if ( ( comments_open() || get_comments_number() ) && ! thim_plugin_active( 'thim-core' ) ) :
		comments_template();
	endif;
	?>

<?php endwhile; // end of the loop.  

do_action( 'thim_wrapper_loop_end' );

get_footer();

