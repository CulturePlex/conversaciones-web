<?php
/**
 * Template for displaying archive collection content.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/addons/collection/archive-collection.php.
 *
 * @author  ThimPress
 * @package LearnPress/Collections/Templates
 * @version 4.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if ( ! wp_is_block_theme() ) {
	do_action( 'learn-press/template-header' );
}


do_action( 'thim_wrapper_loop_start' );
?>

<?php do_action( 'learn_press_before_main_content' ); ?>

<?php do_action( 'learn_press_collections_archive_description' ); ?>

<?php if ( have_posts() ) : ?>

	<?php do_action( 'learn_press_collections_before_loop' ); ?>

	<div id="lp-archive-courses" class="lp-archive-courses">
		<div class="list-collections row">
            <?php while ( have_posts() ) : the_post();?>

                <?php learn_press_collections_get_template( 'content-collection.php' ); ?>

            <?php endwhile; ?>
        </div>
	</div>

	<?php do_action( 'learn_press_collections_after_loop' ); ?>

<?php endif; ?>

<?php do_action( 'learn_press_after_main_content' ); ?>

<?php
global $wp_query;
if ( $wp_query->max_num_pages <= 1 ) {
	return;
}
?>
<nav class="learn-press-pagination loop-pagination">
	<?php
	echo paginate_links( apply_filters( 'learn_press_pagination_args', array(
		'base'      => esc_url_raw( str_replace( 999999999, '%#%', get_pagenum_link( 999999999, false ) ) ),
		'format'    => '',
		'add_args'  => '',
		'current'   => max( 1, get_query_var( 'paged' ) ),
		'total'     => $wp_query->max_num_pages,
		'prev_text' => '<',
		'next_text' => '>',
		'type'      => 'list',
		'end_size'  => 3,
		'mid_size'  => 3
	) ) );
	?>
</nav>
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
