<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php if( has_post_thumbnail() ):  ?>

	<div class="entry-thumbnail">
		<?php if( ! is_singular( 'tp_event' ) || ! in_the_loop() ): ?>
			<a href="<?php the_permalink() ?>">
                <?php echo thim_feature_image( get_post_thumbnail_id( get_the_ID()), 417, 226, false );?>
            </a>
		<?php else: ?>
            <?php the_post_thumbnail( ); ?>
		<?php endif; ?>
	</div>

<?php endif; ?>