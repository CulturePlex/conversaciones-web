<?php
/**
 * Template for displaying default template WP Events Manager List Events element layout slider.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/list-events/layout-slider.php.
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
?>

<div class="slide-events js-call-slick-col" data-verticalslide="1" data-verticalswipe="1" data-numofslide="3"
     data-numofscroll="1" data-loopslide="1" data-autoscroll="0" data-speedauto="6000"
     data-respon="[3, 1], [3, 1], [3, 1], [3, 1], [3, 1]">
    <div class="wrap-arrow-slick">
        <div class="arow-slick prev-slick"><i class="ion ion-ios-arrow-left"></i></div>
        <div class="arow-slick next-slick"><i class="ion ion-ios-arrow-right"></i></div>
    </div>

    <div class="slide-slick">
		<?php foreach ( $events as $event ) { ?>
            <div class="item-slick">
                <div class="item-event">
                    <div class="date-event">
                        <span class="day"><?php echo esc_html( $event['date_show'] ); ?></span> <?php echo esc_html( $event['month_show'] ); ?>
                        , <?php echo esc_html( $event['year_show'] ); ?>
                    </div>

                    <div class="info-event">
                        <div class="title-event">
                            <a href="<?php echo esc_url( $event['url'] ); ?>">
								<?php echo esc_html( $event['title'] ); ?>
                            </a>
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
            </div>
		<?php } ?>
    </div>
</div>
