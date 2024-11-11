<?php
/**
 * Template for displaying default template Countdown element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/countdown/countdown.php.
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

if ( ! $params['countdown-date'] ) {
	return false;
}
$layout      = isset( $params['layout'] ) ? $params['layout'] : 'layout-1';

$title          = $params['title'];
$countdown_date = $params['countdown-date'];
$text_year      = $params['text_year'] ? $params['text_year'] : __( 'Year', 'builderpress' );
$text_month     = $params['text_month'] ? $params['text_month'] : __( 'Month', 'builderpress' );
$text_week      = $params['text_week'] ? $params['text_week'] : __( 'Week', 'builderpress' );
$text_day       = $params['text_day'] ? $params['text_day'] : __( 'Day', 'builderpress' );
$text_hour      = $params['text_hour'] ? $params['text_hour'] : __( 'Hour', 'builderpress' );
$text_minute    = $params['text_minute'] ? $params['text_minute'] : __( 'Minute', 'builderpress' );
$text_second    = $params['text_second'] ? $params['text_second'] : __( 'Second', 'builderpress' );
$style_layout   = !empty($params['style_layout']) ? $params['style_layout'] : '';
$el_class       = $params['el_class'];
$el_id          = $params['el_id'];
$bp_css         = $params['bp_css'];
?>

<div class="bp-element bp-element-countdown <?php echo is_plugin_active('js_composer/js_composer.php') ? vc_shortcode_custom_css_class( $bp_css ) : '';?> <?php echo esc_attr( $el_class ); ?> <?php echo esc_attr( $layout ); ?> <?php echo esc_attr($style_layout) ?>" <?php echo $el_id ? "id='" . esc_attr( $el_id ) . "'" : '' ?>>
    <?php builder_press_get_template( $layout,
        array(
            'params'         => $params,
            'title'          => $title,
            'countdown_date' => $countdown_date,
            'text_year'      => $text_year,
            'text_month'     => $text_month,
            'text_week'      => $text_week,
            'text_day'       => $text_day,
            'text_hour'      => $text_hour,
            'text_minute'    => $text_minute,
            'text_second'    => $text_second,
        ),
        $template_path );
    ?>
</div>