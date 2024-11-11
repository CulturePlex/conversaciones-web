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

<div class="slide-events js-call-slick-col"
     data-numofslide="4" data-numofscroll="1" data-loopslide="0" data-autoscroll="0" data-speedauto="6000"
     data-respon="[4, 1], [3, 1], [3, 1], [2, 1], [1, 1]">
    <div class="wrap-arrow-slick">
        <div class="arow-slick prev-slick">
            <i class="ion ion-ios-arrow-thin-right"></i>
        </div>

        <div class="arow-slick next-slick">
            <i class="ion ion-ios-arrow-thin-left"></i>
        </div>
    </div>

    <div class="wrap-arrow-slick-clone">
        <div class="arow-slick next-slick"></div>
    </div>

    <div class="slide-slick">
		<?php $i=0; foreach ( $events as $event ) { $i++; ?>
            <div class="item-slick">
                <div class="event-item <?php echo ($i%2==0) ? 'color-1' : 'color-2';?>">
                    <div class="pic">
                        <?php $size = apply_filters( 'builder-press/wp-events-manager/layout-slider-2/image-size', '600x400' );
                        builder_press_get_attachment_image( get_post_thumbnail_id( $event['ID'] ), $size ); ?>
                    </div>

                    <div class="date">
                        <span><?php echo esc_html( $event['date_show'] ); ?></span> <?php echo esc_html( $event['month_show'] ); ?>
                    </div>

                    <div class="text">
                        <div class="time">
                            <?php echo esc_html( $event['time_start'] ) . ' - ' . esc_html( $event['time_end'] ); ?>
                        </div>

                        <h3 class="title">
                            <a href="<?php echo esc_url( $event['url'] ); ?>">
                                <?php echo esc_html( $event['title'] ); ?>
                            </a>
                        </h3>

                        <div class="author">
                            <div class="ava">
                                <img src="<?php echo esc_url( $event['author_avata'] );?>" alt="IMG">
                            </div>

                            <div class="info">
                                <div class="name">
                                    By <a href="<?php echo esc_url( $event['author_link'] );?>"><?php echo esc_html( $event['author_name'] );?></a>
                                </div>

                                <div class="address">
                                    <?php echo ent2ncr( $event['location'] ); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		<?php } ?>
    </div>
</div>
