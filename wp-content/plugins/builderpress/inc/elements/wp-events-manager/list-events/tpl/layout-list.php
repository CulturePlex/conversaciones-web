<?php
/**
 * Template for displaying default template WP Events Manager List Events element layout list.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/list-events/layout-list.php.
 *
 * @author      ThimPress
 * @package     BuilderPress/Templates
 * @version     1.0.0
 * @author      Thimpress, leehld
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

/**
 * @var $events array
 */
$number_items = $params['number_items'];
$featured     = reset( $events );
global $post;
?>

<div class="wrap-list-events">
    <div class="list-events">
        <?php foreach ( $events as $event ) { ?>
            <?php if ( $event != $featured ) { ?>
                <div class="item-event">
                    <div class="date-event">
                        <span class="day"><?php echo esc_html( $event['date_show'] ); ?></span> <?php echo esc_html( $event['month_show'] ); ?>, <?php echo esc_html( $event['year_show'] ); ?>
                    </div>
                    <div class="info-event">
                        <div class="title-event">
                            <a href="<?php echo esc_url( $event['url'] ); ?>"><?php echo esc_html( $event['title'] ); ?></a>
                        </div>
                        <div class="meta-event">
                            <span>
                                <i class="ion ion-android-alarm-clock"></i>
                                <?php echo esc_html( $event['time_start'] ) . ' - ' . esc_html( $event['time_end'] ); ?>
                            </span>
                            <span>
                                <i class="ion ion-ios-location-outline"></i>
                                <?php echo ent2ncr( $event['location'] ); ?>
                            </span>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</div>

<?php
    if(get_post_meta( get_the_ID(), 'tp_event_status', true ) === 'expired'){
        $class = "d-none";
    }else{
        $class = "";
    }
?>
    <div class="wrap-special-event">
        <div class="special-event <?php echo $class; ?>">
            <?php $post = get_post( $featured['ID'] );
            setup_postdata( $post );
            $size = apply_filters( 'builder-press/wp-events-manager/layout-1.php/image-size', '604x534' );
            builder_press_get_attachment_image( get_post_thumbnail_id( $featured['ID'] ), $size ); ?>

            <div class="info-event">

                <div class="countdown-event">
                    <?php do_action( 'tp_event_loop_event_countdown' ); ?>
                </div>

                <div class="title-event">
                    <a href="<?php echo esc_url( $featured['url'] ); ?>"><?php echo esc_html( $featured['title'] ); ?></a>
                </div>

                <div class="meta-event">
                    <span>
                        <i class="ion ion-android-alarm-clock"></i>
                        <?php echo esc_html( $featured['time_start'] ) . ' - ' . esc_html( $featured['time_end'] ); ?>
                    </span>
                    <span>
                        <i class="ion ion-android-calendar"></i>
                        <?php echo esc_html( $featured['month_show'] ); ?> <?php echo esc_html( $featured['date_show'] ); ?>, <?php echo esc_html( $featured['year_show'] ); ?>
                    </span>
                    <span>
                        <i class="ion ion-ios-location"></i>
                        <?php echo ent2ncr( $featured['location'] ); ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
