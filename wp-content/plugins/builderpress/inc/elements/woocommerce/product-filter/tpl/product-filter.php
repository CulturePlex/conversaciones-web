<?php
/**
 * Template for displaying default template Product filter element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/product-filter/product-filter.php.
 *
 * @author      ThimPress
 * @package     BuilderPress/Templates
 * @version     1.0.0
 * @author      Thimpress, bobby
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

$template_path = $params['template_path'];

global $post;
$el_id = uniqid( 'bp_' ) .' ';

$layout      = $params['layout'];
$category    = $params['category'];
$filter_by   = $params['filter_by'];
$number      = $params['number'];
$columns     = $params['columns'];
$label       = $params['label'];
$add_cart    = $params['add_cart'];
$rating      = $params['rating'];
$price       = $params['price'];
$description = $params['description'];
$img_size    = $params['img_size'];
$hide_all    = $params['hide_all'];
$filter      = $params['hide_all_filter'];
$link        = $params['link'];
$icon_size   = $params['size'];
$el_class    = $params['el_class'];
$el_id      .= $params['el_id'];
$style_layout = !empty($params['style_layout']) ? $params['style_layout'] : '';

$current_page           = max( 1, get_query_var( 'paged' ) );
$params['current_page'] = $current_page;

$arg = array(
    'post_type'           => 'product',
    'paged'               => $current_page,
    'posts_per_page'      => $number,
);

if ( $params['category'] != ' ' ) {
    if ( $params['hide_all'] == true ) {
        $parent_cat = get_category_by_slug( $params['category'] );
        $parent_cat = isset( $parent_cat->term_id ) ? $parent_cat->term_id : 0;
        $categories = get_categories( array( 'hide_empty' => true, 'parent' => $parent_cat, 'taxonomy' => 'product_cat' ) );
        if ( $categories ) {
            $arg['product_cat'] = $categories[0]->slug;
        }
    } else {
        $arg['product_cat'] = $params['category'];
    }
}

if ( $filter_by ) {
    switch ( $filter_by ) {
        case 'featured':
            $arg['tax_query'] = array(
                array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'name',
                    'terms'    => 'featured',
                )
            );
            break;

        case 'average_rating':
            $arg['meta_key'] = '_wc_average_rating';
            $arg['orderby']  = 'meta_value_num';
            break;

        case 'total_sales':
            $arg['meta_key'] = 'total_sales';
            $arg['orderby']  = 'meta_value_num';
            break;
    }
}

$query = new WP_Query( apply_filters( 'builder-press/product-filter-query', $arg ) );


?>

<?php $sc_id = uniqid( 'thim_' ); ?>

<div class="bp-element bp-element-product-filter woocommerce <?php echo esc_attr($style_layout); ?> columns-<?php echo esc_attr( $params['columns'] ); ?> <?php echo esc_attr( $params['layout'] ); ?> <?php echo esc_attr( $params['el_class'] ); ?>"
     data-max-page="<?php echo esc_attr( $query->max_num_pages ); ?>"
     data-params='<?php echo json_encode( $params ); ?>' id="<?php echo esc_attr( $sc_id ); ?>"
>
    <?php
    if ( $filter == false ) {
        builder_press_get_template( 'filter', array( 'params' => $params ), $params['template_path'] );
    }
    ?>

    <?php if ( $query->have_posts() ) : ?>
        <div class="loop-wrapper">
            <?php builder_press_get_template( $layout, array(
                'params'      => $params,
                'query'       => $query,
                'columns'     => $columns,
                'add_cart'    => $add_cart,
                'label'       => $label,
                'rating'      => $rating,
                'description' => $description,
                'price'       => $price,
                'img_size'    => $img_size
            ), $template_path ); ?>
        </div>

        <?php if ( $link ) {
            $button_classes = $icon_size ? 'btn-' . $icon_size . ' ' : '';
            $title = $link['title'] ? $link['title'] : __( 'Load More', 'builderpress' ); ?>
            <div class="bp-element-button load-more">
                <a class="bp-btn btn-loadmore <?php echo esc_attr( $button_classes ); ?>" href="<?php echo esc_url( $link['url'] ); ?>"><?php echo ent2ncr( $title )?></a>
            </div>
        <?php } ?>

    <?php endif; ?>

    <div class="bp-loading">
        <div class="sk-chasing-dots">
            <div class="sk-child sk-dot1"></div>
            <div class="sk-child sk-dot2"></div>
        </div><!-- .sk-chasing-dots -->
    </div>

</div>

