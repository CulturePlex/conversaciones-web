<?php
/**
 * Template for displaying default template Steps element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/steps/steps.php.
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

// global params
$template_path = $params['template_path'];

/**
 * @var $params array - shortcode params
 */

$layout               = $params['layout'];
$circle_text          = $params['circle-text'];
$steps                = isset( $params['steps'] ) ? $params['steps'] : '';
$steps_2              = isset( $params['steps-2'] ) ? $params['steps-2'] : '';
$style_layout         = !empty($params['style_layout']) ? $params['style_layout'] : '';
$el_class             = $params['el_class'];
$el_id                = $params['el_id'];

?>

<div class="bp-element bp-element-steps <?php echo esc_attr( $el_class ); ?> <?php echo esc_attr( $layout ); ?> <?php echo esc_attr($style_layout); ?>" <?php echo $el_id ? "id='" . esc_attr( $el_id ) . "'" : '' ?>>

    <?php builder_press_get_template( $layout, array (
        'params'               => $params,
        'circle-text'          => $circle_text,
        'steps'                => $steps,
        'steps-2'              => $steps_2,
    ), $template_path ); ?>

</div>