<?php
/**
 * Template for displaying collection content within the loop.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/addons/collection/content-collection.php.
 *
 * @author  ThimPress
 * @package LearnPress/Collections/Templates
 * @version 4.0.0
 */

/**
 * Prevent loading this file directly
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div id="post-<?php the_ID(); ?>" class="col-sm-4 col-xs-12 text-center">

	<?php do_action( 'learn_press_collections_before_loop_item' ); ?>

	<?php
	if ( has_post_thumbnail() ) {
        echo thim_feature_image( get_post_thumbnail_id( get_the_ID()), 300, 200, false );
	}
	?>
	<a class="collection-wrapper" href="<?php echo esc_url( get_the_permalink() ); ?>">
		<?php do_action( 'learn_press_collections_loop_item_title' ); ?>
		<?php //Thim_SC_Courses_Collection::course_number( get_the_ID() ); ?>
	</a>

	<?php do_action( 'learn_press_collections_after_loop_item' ); ?>

</div>
