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
$number_event_slider = $params['number_event_slider'];
$featured     = reset( $events );
$size = apply_filters( 'builder-press/wp-events-manager/list-event/layout-list-2/image-size', '94x94' );
$image  = $params['image'];
global $post;
?>
<div class="wrap-element">
    <div class="background">
       <?php
            $image = wp_get_attachment_image_src( $image, 'full' );
       ?>
        <img src="<?php echo esc_attr($image[0]) ?>"
             width="<?php echo esc_attr(($image[1])) ?>"
             height="<?php echo esc_attr(($image[2])) ?>"
             alt="<?php echo  esc_attr__('background','builderpress') ?>"
        />
    </div>

    <div class="event-slider">
        <div class="slide-events js-call-slick-col" data-numofslide="1" data-numofscroll="1" data-loopslide="1" data-autoscroll="0" data-speedauto="6000" data-respon="[1, 1], [1, 1], [1, 1], [1, 1], [1, 1]">
            <div class="slide-slick">
                <?php
                    $i = 0;
                    foreach ( $events as $event ) {
                        if($i < $number_event_slider) {

                            ?>
                            <div class="item-slick">
                                <div class="event-item-feature">
                                    <div class="event-image">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php
                                            builder_press_get_attachment_image(get_post_thumbnail_id($event['ID']), '580x605');
                                            ?>
                                        </a>
                                    </div>

                                    <div class="event-text">
                                        <div class="date">
                                            <div class="date-wrap">
                                                <span class="number"><?php echo esc_html($event['date_show']); ?></span> <?php echo esc_html($event['month_show']); ?>
                                                , <?php echo esc_html($event['year_show']); ?>
                                            </div>
                                        </div>

                                        <div class="content">
                                            <h4 class="title">
                                                <a href="<?php echo esc_url($event['url']); ?>">
                                                    <?php echo $event['title']; ?>
                                                </a>
                                            </h4>

                                            <div class="info">
                                                <?php echo ent2ncr($event['location']) ?>
                                                - <?php echo esc_html($event['time_start']); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        $i++;
                    }
                ?>
            </div>

            <div class="wrap-arrow-slick">
                <div class="arow-slick prev-slick">
                    <i class="ion ion-ios-arrow-left"></i>
                </div>

                <div class="arow-slick next-slick">
                    <i class="ion ion-ios-arrow-right"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="event-list">
        <?php
            $i = 0;
            foreach ( $events as $event ) {
                if($i >= $number_event_slider ){
                ?>
                <div class="event-item">
                    <div class="date">
                        <div class="date-wrap">
                            <span class="number"><?php echo esc_html( $event['date_show'] ); ?></span> <?php echo esc_html( $event['month_show'] ); ?>, <?php echo esc_html( $event['year_show'] ); ?>
                        </div>
                    </div>

                    <div class="event-image">
                        <a href="<?php the_permalink() ?>">
                            <?php
                                builder_press_get_attachment_image(get_post_thumbnail_id($event['ID']), $size);
                            ?>
                        </a>
                    </div>

                    <div class="content">
                        <h4 class="title">
                            <a href="<?php echo esc_url($event['url']) ?>">
                                <?php
                                    echo $event['title'];
                                ?>
                            </a>
                        </h4>

                        <div class="info">
                            <?php echo ent2ncr($event['location']) ?> - <?php echo esc_html( $event['time_start'] ); ?>
                        </div>
                    </div>
                </div>

        <?php
            }
            $i++;
            }
            ?>
    </div>
</div>


