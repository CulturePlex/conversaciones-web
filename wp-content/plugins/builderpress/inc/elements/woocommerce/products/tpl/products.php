<?php
/**
 * Template for displaying default template Products element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/products/products.php.
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
$template_path   = $params['template_path'];

$layout      = isset( $params['layout'] ) ? $params['layout'] : 'vblog-layout-list-1';
$title       = $params['title'];
$number_items_mobile = !empty($params['number_items_mobile']) ? $params['number_items_mobile'] : $params['number_items'];
$number_items    = ( bp_detect_device() == 'mobile' ) ? $number_items_mobile : $params['number_items'];
$category        = $params['category'];
$product_popular = !empty($params['product_popular']) ? $params['product_popular'] : '';
$sort_product    = !empty($params['sort_product']) ? $params['sort_product'] : 'date';
$order_product   = !empty($params['order_product']) ? $params['order_product'] : 'DESC';
$style_layout = !empty($params['style_layout']) ? $params['style_layout'] : '';
$el_class    = $params['el_class'];
$el_id       = $params['el_id'];
$bp_css      = $params['bp_css'];
$bp_css_tablet = $params['bp_css_tablet'];
$bp_css_mobile = $params['bp_css_mobile'];
$data_tablet = $bp_css_tablet ? 'data-class-tablet="' . bp_custom_css_class_shortcode($bp_css_tablet) . '"' : '';
$data_mobile = $bp_css_mobile ? 'data-class-mobile="' . bp_custom_css_class_shortcode($bp_css_mobile) . '"' : '';

$meta_query = array(
    'relation' => 'OR',
    array(
        'key'           => $product_popular,
        'value'         => 0,
        'compare'       => '>',
        'type'          => 'numeric'
    ),
);

$tax_query[] = array(
    'taxonomy' => 'product_visibility',
    'field'    => 'name',
    'terms'    => $product_popular,
    'operator' => 'IN',
);

if($product_popular == 'featured') {
    $query = array(
        'post_type'      => 'product',
        'posts_per_page' => $number_items,
        'tax_query'      => $tax_query,
        'orderby'             => $sort_product,
        'order'               => $order_product,
    );
} elseif ($product_popular == '_sale_price') {
    $query = array(
        'post_type'      => 'product',
        'posts_per_page' => $number_items,
        'meta_query'     => $meta_query,
        'orderby'             => $sort_product,
        'order'               => $order_product,
    );
} elseif($product_popular == '_wc_average_rating'){
    $query = array(
        'post_type'      => 'product',
        'posts_per_page' => $number_items,
        'meta_key'       => $product_popular,
        'orderby'        => $sort_product,
        'order'          => $order_product,

    );
} else {
    $query = array(
        'post_type'      => 'product',
        'posts_per_page' => $number_items,
        'orderby'        => $sort_product,
        'order'          => $order_product,
    );
}
if ( $category <> ' ' ) {
    $query['product_cat'] = $category;
}
// query products
$products = new WP_Query( apply_filters( 'builder-press/products-query', $query ) );
?>

<div class="bp-element bp-element-products <?php echo esc_attr( $el_class ); ?> <?php echo esc_attr( $layout ); ?> <?php echo esc_attr($style_layout); ?> <?php echo is_plugin_active('js_composer/js_composer.php') ? vc_shortcode_custom_css_class( $bp_css ) : '';?>" <?php echo $el_id ? " id='" . esc_attr( $el_id ) . "'" : '' ?> <?php echo $data_tablet;?> <?php echo $data_mobile;?>>
    <?php builder_press_get_template( $layout,
        array(
            'title'      => $title,
            'params'      => $params,
            'products'    => $products,
        ),
        $template_path );
    ?>
</div>
<?php wp_reset_postdata(); ?>