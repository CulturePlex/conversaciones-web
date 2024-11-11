<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( wpems_get_option( 'allow_register_event' ) == 'no' ) {
	return;
}

$event    = new WPEMS_Event( get_the_ID() );
$user_reg = $event->booked_quantity( get_current_user_id() );

if ( absint( $event->qty ) == 0) {
	return;
}
?>

<div class="contact">
    <div class="list-contact">
        <div class="contact-item">
            <div class="title">
                <?php echo esc_html__( 'Date & Time', 'ivy-school' ); ?>
            </div>

            <div class="description">
                <span>
                    <i class="ion ion-android-alarm-clock"></i>
                    <?php echo wpems_event_start( 'H:i', null, false );?> -  <?php echo wpems_event_end( 'H:i', null, false );?>
                    </span>
                <span>
                    <i class="ion ion-android-calendar"></i>
                    <?php echo wpems_event_start( 'M d, Y', null );?>
                </span>
            </div>
        </div>

        <div class="contact-item">
            <div class="title">
                <?php echo esc_html__( 'Venue', 'ivy-school' ); ?>:
            </div>

            <div class="description">
                <span>
                    <i class="ion ion-android-pin"></i>
                    <?php echo wpems_event_location();?>
                </span>
            </div>
        </div>

        <div class="contact-item">
            <div class="title">
                <?php echo esc_html__( 'Slot', 'ivy-school' ); ?>:
            </div>

            <div class="description">
                <span>
                    <i class="ion ion-android-person"></i>
                    <?php echo esc_html__( 'Total Slot:', 'ivy-school' ) ?> <?php echo esc_html( absint( $event->qty ) ) ?>
                </span>
                <span>
                    <i class="ion ion-android-lock"></i>
                    <?php echo esc_html__( 'Booked Slot:', 'ivy-school' ) ?> <?php echo esc_html( absint( $event->booked_quantity() ) ) ?>
                </span>
                <span>
                    <i class="ion ion-cash"></i>
                    <?php echo esc_html__( 'Cost:', 'ivy-school' ) ?> <?php printf( '%s', $event->is_free() ? esc_html__( 'Free', 'ivy-school' ) : wpems_format_price( $event->get_price() ) ) ?>
                </span>
            </div>
        </div>

    </div>

    <?php if ( is_user_logged_in() ) { ?>
        <?php
        $registered_time = $event->booked_quantity( get_current_user_id() );
        if ( $registered_time && wpems_get_option( 'email_register_times' ) === 'once' && $event->is_free() ) { ?>
            <p><?php echo esc_html__( 'You have registered this event before.', 'ivy-school' ); ?></p>
        <?php } elseif (get_post_meta( get_the_ID(), 'tp_event_status', true ) === 'expired') { ?>
            <p class="message message-error"><?php echo esc_html__( 'This event is expired.', 'ivy-school' ); ?></p>
        <?php } else { ?>
            <a href="" class="event-load-booking-form btn-join btn-normal shape-round"
               data-event="<?php echo esc_attr( get_the_ID() ) ?>" ><?php echo esc_html__( 'Register Now', 'ivy-school' ); ?></a>
        <?php } ?>
    <?php } else { ?>
        <p><?php echo sprintf( __( 'You must <a href="%s">login</a> before register event.', 'ivy-school' ), thim_get_login_page_url_event() ); ?></p>
    <?php } ?>

</div>