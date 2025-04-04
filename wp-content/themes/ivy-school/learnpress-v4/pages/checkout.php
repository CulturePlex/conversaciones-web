<?php
/**
 * Template for displaying content of page for processing checkout feature.
 *
 * @author   ThimPress
 * @package  LearnPress/Templates
 * @version  4.0.2
 */

defined( 'ABSPATH' ) or die;

if ( ! wp_is_block_theme() ) {
	do_action( 'learn-press/template-header' );
}

do_action( 'thim_wrapper_loop_start' );


do_action( 'learn-press/before-main-content' );
do_action( 'learnpress/template/pages/checkout/before-content' );
?>

	<div id="learn-press-checkout" class="lp-content-wrap">

		<h2><?php the_title(); ?></h2>

		<?php
		/**
		 * LP Hook
		 *
		 * @since 4.0.0
		 */
		do_action( 'learn-press/before-checkout-page' );

		// Shortcode for displaying checkout form
		echo do_shortcode( '[learn_press_checkout]' );

		/**
		 * LP Hook
		 *
		 * @since 4.0.0
		 */
		do_action( 'learn-press/after-checkout-page' );
		?>

	</div>

<?php
do_action( 'learnpress/template/pages/checkout/after-content' );
do_action( 'learn-press/after-main-content' );

do_action( 'thim_wrapper_loop_end' );

if ( ! wp_is_block_theme() ) {
	do_action( 'learn-press/template-footer' );
}

