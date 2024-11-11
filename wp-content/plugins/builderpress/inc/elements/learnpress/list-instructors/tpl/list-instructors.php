<?php
/**
 * Template for displaying default template Learnpress List Instructors element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/list-instructors/list-instructors.php.
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
$layout   = isset($params['layout']) ? $params['layout'] : 'layout-grid';
$number   = $params['number'];
$title    = ( !empty($params['title_instructors'])) ? $params['title_instructors'] : 'Our Instructors' ;
$style_layout = !empty($params['style_layout']) ? $params['style_layout'] : '';
$el_class = $params['el_class'];
$el_id    = $params['el_id'];
$bp_css   = $params['bp_css'];

$instructors = get_users( array( 'role' => 'lp_teacher', 'number' => $number ) );
?>

<div class="bp-element bp-element-list-instructors <?php echo is_plugin_active('js_composer/js_composer.php') ? vc_shortcode_custom_css_class( $bp_css ) : '';?> <?php echo esc_attr( $layout ); ?> <?php echo esc_attr($style_layout); ?> <?php echo esc_attr( $el_class ); ?>" <?php echo $el_id ? "id='" . esc_attr( $el_id ) . "'" : '' ?>>

	<?php builder_press_get_template( $layout, array(
		'instructors' => $instructors,
		'params'      => $params
	), $template_path ); ?>

</div>

<?php wp_reset_postdata(); ?>
