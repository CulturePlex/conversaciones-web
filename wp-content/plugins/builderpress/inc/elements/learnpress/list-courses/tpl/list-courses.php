<?php
/**
 * Template for displaying default template Learnpress List Courses element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/list-courses/list-courses.php.
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

$layout       = $params['layout'];
$filter_by    = $params['filter_by'];
$category     = $params['category'];
$number_items = $params['number_items'];
$style_layout = !empty($params['style_layout']) ? $params['style_layout'] : '';
$button       = $params['button'];
$el_class     = $params['el_class'];
$el_id        = $params['el_id'];
$bp_css       = $params['bp_css'];

$query = array(
	'post_type'           => 'lp_course',
	'posts_per_page'      => $number_items,
	'post_status'         => 'publish',
	'order_by'            => 'DESC',
	'ignore_sticky_posts' => true
);

if ( $filter_by == 'popular' ) {
	global $wpdb;
	$the_query = $wpdb->get_col( $wpdb->prepare(
		"
		SELECT pm.post_id, pm.meta_value + COUNT(pm.post_id) - IF (uc.course_id, 0, 1) as students 
		FROM `$wpdb->postmeta` AS pm
		LEFT JOIN `$wpdb->learnpress_user_courses` AS uc ON pm.post_id = uc.course_id
		WHERE pm.meta_key = %s
		GROUP BY pm.post_id
		ORDER BY students DESC",
		'_lp_students'
	) );

	$condition['post__in'] = $the_query;
	$condition['orderby']  = 'post__in';
}

if ( $filter_by == 'category' && $category ) {
	$query['tax_query'] = array(
	        array(
                'taxonomy' => 'course_category',
                'field'    => 'slug',
                'terms'    => $category,
            )
	);
}
$courses = new WP_Query( apply_filters( 'builder-press/list-courses-query', $query ) );

if ( ! $courses->post_count ) {
	return;
} ?>

    <div class="bp-element bp-element-list-courses <?php echo esc_attr($style_layout); ?> <?php echo is_plugin_active('js_composer/js_composer.php') ? vc_shortcode_custom_css_class( $bp_css ) : '';?> <?php echo esc_attr( $el_class ); ?> <?php echo esc_attr( $layout ); ?>" <?php echo $el_id ? "id='" . esc_attr( $el_id ) . "'" : '' ?>>

        <?php if( isset($params['title']) && !empty($params['title']) ) {?>
            <h3 class="title"><?php echo esc_html( $params['title'] ); ?></h3>
        <?php }?>

		<?php builder_press_get_template( $layout, array(
			'params'  => $params,
			'button'  => $button,
			'courses' => $courses,
		), $template_path ); ?>

    </div>

<?php wp_reset_postdata();
