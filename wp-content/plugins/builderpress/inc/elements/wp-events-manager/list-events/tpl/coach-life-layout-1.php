<?php
/**
 * Template for displaying default template WP Events Manager List Events element coach-life-layout-1.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/list-events/coach-life-layout-1.php.
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

<div class="wrap-element">
    <div class="slide-events js-call-slick-col" data-numofslide="1" data-numofscroll="1" data-loopslide="1" data-autoscroll="0" data-speedauto="6000" data-respon="[1, 1], [1, 1], [1, 1], [1, 1], [1, 1]">
        <div class="slide-slick">
            <?php
                foreach ($events as $event):
            ?>
                <div class="item-slick">
                    <div class="item-event">
                        <a href="<?php echo esc_url( $event['url'] ); ?>" class="image-event">
                            <?php
                                $size = apply_filters( 'builder-press/wp-events-manager/coach-life-layout-1/size-small/image-size', '511x592' );
                                builder_press_get_attachment_image( get_post_thumbnail_id($event['ID'] ), $size ); ?>
                        </a>

                        <div class="date-event">
                            <span class="number-date"><?php echo esc_html( $event['date_show'] ); ?></span> <?php echo esc_html( $event['month_show'] ); ?>, <?php echo esc_html( $event['year_show'] ); ?>
                        </div>

                        <div class="text-event">
                            <h4 class="title-event">
                                <a href="<?php echo esc_url( $event['url'] ); ?>">
                                    <?php echo esc_html( $event['title'] ); ?>
                                </a>
                            </h4>

                            <ul class="info-event">
                                <li>
                                    <i class="ion ion-android-alarm-clock"></i>
                                    <?php echo esc_html( $event['time_start'] ) . ' - ' . esc_html( $event['time_end'] ); ?>
                                </li>

                                <li>
                                    <i class="ion ion-ios-location-outline"></i>
                                    <?php echo ent2ncr( $event['location'] ); ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php
                endforeach;
            ?>
        </div>

        <div class="wrap-arrow-slick">
            <div class="arow-slick prev-slick">
                <i class="ion ion-ios-arrow-thin-left"></i>
            </div>

            <div class="arow-slick next-slick">
                <i class="ion ion-ios-arrow-thin-right"></i>
            </div>
        </div>
    </div>
</div>
