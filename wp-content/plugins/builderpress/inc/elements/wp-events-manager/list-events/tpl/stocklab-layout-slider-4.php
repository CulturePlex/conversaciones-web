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

<div class="slide-events js-call-slick-col" data-numofslide="3" data-numofscroll="1" data-loopslide="0" data-autoscroll="0" data-speedauto="6000" data-respon="[3, 1], [3, 1], [3, 1], [2, 1], [1, 1]">
	<div class="slide-slick">
		<?php foreach ( $events as $event ) { ?>
			<div class="item-slick">
				<div class="event-item">
					<div class="pic">
						<?php $size = apply_filters( 'builder-press/wp-events-manager/stocklab-layout-slider-4/image-size', '600x400' );
						builder_press_get_attachment_image( get_post_thumbnail_id( $event['ID'] ), $size ); ?>
					</div>

					<div class="date">
						<span><?php echo esc_html( $event['date_show'] ); ?></span> <?php echo esc_html( $event['month_show'] ); ?>
					</div>

					<div class="text">
						<h3 class="title">
							<a href="<?php echo esc_url( $event['url'] ); ?>">
								<?php echo esc_html( $event['title'] ); ?>
							</a>
						</h3>

						<div class="time">
							<i class="ion-android-alarm-clock"></i>
							<?php echo esc_html( $event['time_start'] ) . ' - ' . esc_html( $event['time_end'] ); ?>
						</div>

						<div class="address">
							<i class="ion-ios-location-outline"></i>
							<?php echo ent2ncr( $event['location'] ); ?>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
