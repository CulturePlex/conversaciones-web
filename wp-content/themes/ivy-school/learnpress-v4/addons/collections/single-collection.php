<?php
/**
 * The template for displaying single collection.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/addons/collection/single-collection.php.
 *
 * @author  ThimPress
 * @package LearnPress/Collections/Templates
 * @version 4.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();
if ( ! wp_is_block_theme() ) {
	do_action( 'learn-press/template-header' );
}


do_action( 'thim_wrapper_loop_start' );
?>

<?php do_action( 'learn_press_before_main_content' ); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php learn_press_collections_get_template( 'content-single-collection.php' ); ?>

<?php endwhile; ?>

<?php do_action( 'learn_press_after_main_content' ); ?>

<?php
do_action( 'thim_wrapper_loop_end' );

/**
 * @since 4.0.0
 *
 * @see   LP_Template_General::template_footer()
 */
if ( ! wp_is_block_theme() ) {
	do_action( 'learn-press/template-footer' );
}
?>
