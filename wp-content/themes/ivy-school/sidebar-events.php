<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 */

if ( ! is_active_sidebar( 'sidebar-events' ) || ( isset( $_GET['layout'] ) && ( $_GET['layout'] === 'no-sidebar' ) ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area col-lg-3 col-xl-3 sticky-sidebar sidebar-events">
    <?php dynamic_sidebar( 'sidebar-events' ); ?>
</aside><!-- #secondary -->