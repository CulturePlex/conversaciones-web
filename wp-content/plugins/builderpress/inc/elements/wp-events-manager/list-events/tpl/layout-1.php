<?php
/**
 * Template for displaying default template WP Events Manager List Events element layout 1.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/list-events/layout-1.php.
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

<?php foreach ( $events as $event ) { ?>
    <div class="item">
		<?php $size = apply_filters( 'builder-press/wp-events-manager/layout-1/image-size', '423x481' );
		builder_press_get_attachment_image( get_post_thumbnail_id( $event['ID'] ), $size ); ?>

        <div class="date">
            <span><?php echo esc_html( $event['date_show'] ); ?></span>
            <span><?php echo esc_html( $event['month_show'] ); ?>, <?php echo esc_html( $event['year_show'] ); ?></span>
        </div>
        <div class="content">
            <h4 class="title">
                <a href="<?php echo esc_html( $event['url'] ); ?>">
					<?php echo esc_html( $event['title'] ); ?>
                </a>
            </h4>
            <div class="info">
                <span class="time">
					<i class="ion ion-android-alarm-clock"></i>
	                <?php echo esc_html( $event['time_start'] ); ?>
				</span>
                <span class="address">
					<i class="ion ion-ios-location-outline"></i>
					<?php echo esc_html( $event['location'] ); ?>
				</span>
            </div>
        </div>
    </div>
<?php } ?>
