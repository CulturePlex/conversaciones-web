<?php
/**
 * Template for displaying default template Learnpress Course Collections element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/course-collections/course-collections.php.
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

$layout       = isset( $params['layout'] ) ? $params['layout'] : 'layout-slider';
$type_get     = isset( $params['type_get'] ) ? $params['type_get'] : 'default';
$number_items = $params['number_items'];
$course_link  = !empty($params['course_link']) ? $params['course_link'] : '#';
$style_layout = !empty($params['style_layout']) ? $params['style_layout'] : '';
$el_class     = $params['el_class'];
$el_id        = $params['el_id'];
$bp_css       = $params['bp_css'];

if($type_get == 'custom'){
	$collections_id  = isset( $params['collections_id'] ) ? $params['collections_id'] : '';
	$collections_array = explode(", ", $collections_id);
	$query = array(
		'post_type'      => 'lp_collection',
		'post_status'    => 'publish',
		'post__in' => $collections_array,
		'orderby' => 'post__in'
	);
}else{
	$query = array(
		'post_type'      => 'lp_collection',
		'posts_per_page' => $number_items,
		'post_status'    => 'publish',
	);
}

$collections = new WP_Query( apply_filters( 'builder-press/course-collections-query', $query ) );

if ( $collections->have_posts() ) { ?>

    <div class="bp-element bp-element-course-collections <?php echo is_plugin_active('js_composer/js_composer.php') ? vc_shortcode_custom_css_class( $bp_css ) : '';?> <?php echo esc_attr( $el_class ); ?> <?php echo esc_attr( $layout ); ?> <?php echo esc_attr($style_layout); ?>" <?php echo $el_id ? "id='" . esc_attr( $el_id ) . "'" : '' ?>>

		<?php builder_press_get_template( $layout, array(
			'collections' => $collections,
			'params'      => $params,
		), $template_path ); ?>

    </div>

	<?php wp_reset_postdata();
}
