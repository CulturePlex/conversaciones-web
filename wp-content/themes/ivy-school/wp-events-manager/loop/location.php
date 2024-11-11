<?php

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php if ( wpems_get_location_map() ): ?>
    <div class="map">
		<?php wpems_get_location_map(); ?>
    </div>
<?php else:
 	/**
		 * tp_event_single_event_thumbnail hook
		 */
		echo '<div class="tp-event-top map">';
		do_action( 'tp_event_single_event_thumbnail' );

		/**
		 * tp_event_loop_event_countdown
		 */
		do_action( 'tp_event_loop_event_countdown' );
		echo '</div>';
endif; ?>