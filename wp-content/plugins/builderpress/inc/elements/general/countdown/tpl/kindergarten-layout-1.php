<?php
/**
 * Template for displaying default template Counter Box element kindergarten-layout-1.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/countdown/kindergarten-layout-1.php.
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
<?php $date = new DateTime( date( 'Y-m-d H:i', strtotime( $countdown_date ) ) ); ?>
<div class="wrap-element">
    <div class="tp_event_counter" data-time="<?php echo esc_attr( $date->format( 'M j, Y H:i:s O' ) ) ?>"
         data-text-year="<?php echo esc_attr( $text_year ); ?>"
         data-text-month="<?php echo esc_attr( $text_month ); ?>"
         data-text-week="<?php echo esc_attr( $text_week ); ?>"
         data-text-day="<?php echo esc_attr( $text_day ); ?>"
         data-text-hour="<?php echo esc_attr( $text_hour ); ?>"
         data-text-minute="<?php echo esc_attr( $text_minute ); ?>"
         data-text-second="<?php echo esc_attr( $text_second ); ?>">
        <div class="countdown-row">
            <div class="countdown-section">
                <div class="background"></div>
                <span class="countdown-amount"><?php echo esc_attr( $date->format('d') ); ?></span>
                <span class="countdown-period">
                    <?php echo esc_html__('Days','builderpress'); ?>
                </span>
            </div>

            <div class="countdown-section">
                <span class="countdown-amount"><?php echo esc_attr( $date->format('H') ); ?></span>
                <span class="countdown-period">
                    <?php echo esc_html__('Hours','builderpres')?>
                </span>
            </div>

            <div class="countdown-section">
                <span class="countdown-amount"><?php echo esc_attr( $date->format('i') ); ?></span>
                <span class="countdown-period">
                    <?php echo esc_html__('Minutes','builderpres')?>
                </span>
            </div>

            <div class="countdown-section">
                <span class="countdown-amount"><?php echo esc_attr( $date->format('s') ); ?></span>
                <span class="countdown-period">
                    <?php echo esc_html__('Seconds','builderpres') ?>
                </span>
            </div>
        </div>
    </div>
</div>
