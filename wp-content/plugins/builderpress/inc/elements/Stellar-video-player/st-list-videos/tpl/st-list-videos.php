<?php
/**
 * Template for displaying default template St-list-videos element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/st-list-videos/st-list-videos.php.
 *
 * @author      ThimPress
 * @package     BuilderPress/Templates
 * @version     1.0.0
 * @author      Thimpress, vinhnq
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

// global params
$template_path = $params['template_path'];

$layout      = isset( $params['layout'] ) ? $params['layout'] : 'vblog-layout-1';

$el_class    = $params['el_class'];
$title       = $params['title'];
$number      = $params['number'];
$category    = $params['category'];
$type    = (!empty($params['type']) && $params['type'] != ' ') ? $params['type'] : '';
$filter_categories = $params['filter_categories'];
$style_layout = !empty($params['style_layout']) ? $params['style_layout'] : '';
$el_id       = $params['el_id'];
$bp_css      = $params['bp_css'];
$bp_css_tablet = $params['bp_css_tablet'];
$bp_css_mobile = $params['bp_css_mobile'];
$data_tablet = $bp_css_tablet ? 'data-class-tablet="' . bp_custom_css_class_shortcode($bp_css_tablet) . '"' : '';
$data_mobile = $bp_css_mobile ? 'data-class-mobile="' . bp_custom_css_class_shortcode($bp_css_mobile) . '"' : '';

// Show filter categories
$cat_parent = get_category_by_slug($category);
$parent_id = $cat_parent ? $cat_parent->term_id : 0;
$arg_cats = array(
    'number' => 5,
    'parent'  => $parent_id,
);
$cats_filter = get_categories( $arg_cats );

$query = array(
    'posts_per_page'      => $number,
    'no_found_rows'       => true,
    'post_status'         => 'publish',
    'ignore_sticky_posts' => true,
    'tax_query' => array( array(
        'taxonomy' => 'post_format',
        'field' => 'slug',
        'terms' => array('post-format-video'),
    ) )
);
if ( $category ) {
    $query['cat'] = $parent_id;
}
if ( $type ) {
    $query['tax_query'] = array( array(
        'taxonomy' => 'type',
        'field' => 'slug',
        'terms' => array($type),
    ) );
}
$query = new WP_Query( apply_filters( 'builder-press/st-list-videos-query', $query ) );
?>
<?php if ( $query->have_posts() ) { ?>
    <div class="bp-element bp-element-st-list-videos <?php echo esc_attr( $el_class ); ?> <?php echo esc_attr( $layout ); ?> <?php echo esc_attr($style_layout); ?> <?php echo is_plugin_active('js_composer/js_composer.php') ? vc_shortcode_custom_css_class( $bp_css ) : '';?>" <?php echo $el_id ? " id='" . esc_attr( $el_id ) . "'" : '' ?> <?php echo $data_tablet;?> <?php echo $data_mobile;?>>
        <?php builder_press_get_template( $layout,
            array(
                    'title'       => $title,
                    'params'      => $params,
                    'filter_categories' => $filter_categories,
                    'cats_filter' => $cats_filter,
                    'query'       => $query,
            ),
            $template_path );
        ?>
    </div>
    <?php wp_reset_postdata(); ?>
<?php }?>