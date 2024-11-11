<?php
/**
 * Template for displaying default template Counter Box element layout 1.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/countdown/layout-1.php.
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
<h3><?php echo esc_html( $title ); ?></h3>

<?php $date = new DateTime( date( 'Y-m-d H:i', strtotime( $countdown_date ) ) ); ?>
<div class="wrap-countdown">
    <div class="countdown" data-time="<?php echo esc_attr( $date->format( 'M j, Y H:i:s O' ) ) ?>"
         data-text-year="<?php echo esc_attr( $text_year ); ?>"
         data-text-month="<?php echo esc_attr( $text_month ); ?>"
         data-text-week="<?php echo esc_attr( $text_week ); ?>"
         data-text-day="<?php echo esc_attr( $text_day ); ?>" data-text-hour="<?php echo esc_attr( $text_hour ); ?>"
         data-text-minute="<?php echo esc_attr( $text_minute ); ?>"
         data-text-second="<?php echo esc_attr( $text_second ); ?>">
    </div>
</div>
