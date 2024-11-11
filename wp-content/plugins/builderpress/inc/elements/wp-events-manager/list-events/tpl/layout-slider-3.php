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
$img = $params['background'] ? ' style="background-image: url(' . wp_get_attachment_image_url( $params['background'], 'full' ) . ')"' : '';
?>

<div class="background" <?php echo ent2ncr($img);?>>
    <div class="overlay"></div>
</div>

<div class="slide-events js-call-slick-col" data-numofslide="3" data-numofscroll="1" data-loopslide="1" data-autoscroll="0" data-speedauto="6000" data-respon="[3, 1], [3, 1], [2, 1], [2, 1], [1, 1]">
    <div class="wrap-arrow-slick">
        <div class="arow-slick prev-slick">
            <i class="ion ion-ios-arrow-thin-left"></i>
        </div>

        <div class="arow-slick next-slick">
            <i class="ion ion-ios-arrow-thin-right"></i>
        </div>
    </div>

    <div class="slide-slick">
        <?php $i=0; foreach ( $events as $event ) { $i++; ?>
        <div class="item-slick">
            <div class="event-item">
                <div class="date">
                    <span class="number"><?php echo esc_html( $event['date_show'] ); ?></span> <?php echo esc_html( $event['month_show'] ); ?>
                </div>

                <div class="info">
                    <h3 class="title">
                        <a href="<?php echo esc_url( $event['url'] ); ?>">
                            <?php echo esc_html( $event['title'] ); ?>
                        </a>
                    </h3>

                    <div class="time">
                        <i class="ion ion-android-time"></i>
                        <?php echo esc_html( $event['time_start'] ) . ' - ' . esc_html( $event['time_end'] ); ?>
                    </div>

                    <div class="address">
                        <i class="ion ion-android-pin"></i>
                        <?php echo ent2ncr( $event['location'] ); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>