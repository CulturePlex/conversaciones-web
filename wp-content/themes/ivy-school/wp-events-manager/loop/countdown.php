<?php
/**
 * The Template for displaying countdown in single event page.
 *
 * Override this template by copying it to yourtheme/wp-events-manager/loop/countdown.php
 *
 * @author        ThimPress, leehld
 * @package       WP-Events-Manager/Template
 * @version       2.1.7
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$current_time = current_time( 'Y-m-d H:i' );
$time         = wpems_get_time( 'Y-m-d H:i', null, false );

 if ( $time > $current_time ) { ?>
		<?php $date = new DateTime( date( 'Y-m-d H:i', strtotime( $time ) ) ); ?>
        <div class="entry-countdown"><div class="tp_event_counter" data-time="<?php echo esc_attr( $date->format( 'M j, Y H:i:s O' ) ) ?>"></div></div>
	<?php } ?> 