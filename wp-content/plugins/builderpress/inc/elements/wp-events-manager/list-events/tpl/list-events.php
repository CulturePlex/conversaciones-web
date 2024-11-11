<?php
/**
 * Template for displaying default template WP Events Manager List Events element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/list-events/list-events.php.
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
$template_path= $params['template_path'];
$layout       = isset($params['layout'])? $params['layout']: 'layout-1' ;
$status       = $params['status'];
$category     = $params['category'];
$number_items = $params['number_items'];
$image        = $params['image'];
$style_layout = !empty($params['style_layout']) ? $params['style_layout'] : '';
$el_class     = $params['el_class'];
$el_id        = $params['el_id'];
$bp_css       = $params['bp_css'];

$query = array(
	'post_type'           => 'tp_event',
	'posts_per_page'      => $number_items,
	'post_status'         => 'publish',
	'order_by'            => 'DESC',
	'ignore_sticky_posts' => true
);


if ( $status ) {
	$query['meta_query'] = array(
		array(
			'key'     => 'tp_event_status',
			'value'   => $status,
			'compare' => 'IN',
		)
	);
}

if ( $category ) {
	$query['tax_query'] = array(
        array(
            'taxonomy' => 'tp_event_category',
            'field'    => 'slug',
            'terms'    => $category
        )
    );
}

$events = new WP_Query( apply_filters( 'builder-press/list-events-query', $query ) );

if ( ! $events->post_count ) {
	return;
}

$list = array();
$list_events_number_slider = array();
if ( $events->have_posts() ) {
	while ( $events->have_posts() ) {
		$events->the_post();
		$list[ strtotime( wpems_get_time() ) ] = apply_filters( 'builder-press/list-events-get-meta', array(
			'ID'         => get_the_ID(),
			'author_name' => get_the_author(),
            'author_avata' => get_avatar_url( get_the_author_meta( 'ID' ) ),
			'author_link' => get_author_posts_url( get_the_author_meta( 'ID' ) ),
			'time_start' => wpems_event_start( 'h a', null, false ),
			'time_end'   => wpems_event_end( 'h a', null, false ),
			'date_show'  => wpems_event_start( 'd' ),
			'month_show' => wpems_event_start( 'M' ),
			'year_show'  => wpems_event_start( 'Y' ),
			'location'   => wpems_event_location(),
			'title'      => get_the_title(),
			'qty'        => get_post_meta( get_the_ID(), 'tp_event_qty', true ),
			'price'      => get_post_meta( get_the_ID(), 'tp_event_price', true ),
			'url'        => get_permalink( get_the_ID() ),
			'image_id'   => get_post_thumbnail_id(),
			'excerpt'    => get_the_excerpt()
		) );
	}
}

// sorting list events
ksort( $list );
?>
    <div class="bp-element bp-element-list-events <?php echo esc_attr($style_layout); ?> <?php echo is_plugin_active('js_composer/js_composer.php') ? vc_shortcode_custom_css_class( $bp_css ) : '';?> <?php echo esc_attr( $el_class ); ?> <?php echo esc_attr( $layout ); ?>" <?php echo $el_id ? "id='" . esc_attr( $el_id ) . "'" : '' ?>>
		<?php builder_press_get_template( $layout, array(
			'params' => $params,
			'events' => $list,
		), $template_path ); ?>

    </div>

<?php wp_reset_postdata();
