<?php
/**
 * Template for displaying default template Posts element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/posts/categories.php.
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
$title                = $params['title'];
$sub_title            = !empty($params['sub_title']) ? $params['sub_title'] : '';
$category             = $params['category'];
$number               = $params['number'];
$show_date            = $params['show_date'];
$show_author          = $params['show_author'];
$show_number_comments = $params['show_number_comments'];
$show_excerpt         = $params['show_excerpt'];
$show_readmore        = $params['show_readmore'];
$show_number_favorite = $params['show_number_favorite'];
$style_layout         = !empty($params['style_layout']) ? $params['style_layout'] : '';
$el_class             = $params['el_class'];
$el_id                = $params['el_id'];
$post_link            = $params['post_link'];
$sort_post            = !empty($params['sort_post']) ? $params['sort_post'] : 'date';
$order_post           = !empty($params['order_post']) ? $params['order_post'] : 'DESC';
$bp_css   = $params['bp_css'];
$show_image           = !empty($params['show_image']) ? $params['show_image'] : '';
if(!$show_image) {
    $class_image = 'no-image';
}else {
    $class_image = '';
}

$cat = get_category_by_slug($category);
$cat_id = $cat ? $cat->term_id : 0;
$query = array(
	'posts_per_page'      => $number,
	'no_found_rows'       => true,
	'post_status'         => 'publish',
	'ignore_sticky_posts' => true,
    'orderby'             => $sort_post,
    'order'               => $order_post,
);

if ( $cat_id ) {
	$query['cat'] = $cat_id;
}

$query = new WP_Query( apply_filters( 'builder-press/posts-query', $query ) );

?>

<?php if ( $query->have_posts() ) { ?>

    <div class="bp-element bp-element-posts <?php echo is_plugin_active('js_composer/js_composer.php') ? vc_shortcode_custom_css_class( $bp_css ) : '';?> <?php echo esc_attr( $el_class ); ?> <?php echo esc_attr( $layout ); ?> <?php echo esc_attr($style_layout); ?> <?php echo esc_attr($class_image); ?>" <?php echo $el_id ? "id='" . esc_attr( $el_id ) . "'" : '' ?>>

		<?php builder_press_get_template( $layout, array(
			'query'                => $query,
			'title'                => $title,
			'sub_title'            => $sub_title,
			'show_date'            => $show_date,
			'show_author'          => $show_author,
            'post_link'            => $post_link,
			'show_number_comments' => $show_number_comments,
			'show_excerpt'         => $show_excerpt,
			'show_readmore'        => $show_readmore,
			'show_number_favorite' => $show_number_favorite,
            'show_image'           => $show_image,
		), $template_path ); ?>
    </div>

    <?php wp_reset_postdata(); ?>

<?php } ?>