<?php
/**
 * Template for displaying default template Product-isotope element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/product-isotope/product-isotope.php.
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

$template_path = $params['template_path'];

global $post;

$layout      = $params['layout'];
$category    = $params['category'];
$number      = $params['number'];
$columns     = $params['columns'];
$label       = $params['label'];
$rating      = $params['rating'];
$price       = $params['price'];
$description = $params['description'];
$img_size    = $params['img_size'];
$el_class    = $params['el_class'];
$el_id       = $params['el_id'];
$style_layout = !empty($params['style_layout']) ? $params['style_layout'] : '';

$arg = array(
    'post_type'           => 'product',
    'posts_per_page'      => $number,
);

if ( $category ) {
    $arg['product_cat'] = $category;
}

$query = new WP_Query( apply_filters( 'builder-press/product-isotope-query', $arg ) );

?>
<?php if ( $query->have_posts() ) {
    $categories = array();
    $class = '';


    ?>

    <div class="bp-element bp-element-product-isotope woocommerce <?php echo esc_attr( $layout ); ?> <?php echo esc_attr($style_layout); ?> <?php echo esc_attr( $el_class ); ?>" data-max-page="<?php echo esc_attr( $query->max_num_pages ); ?>" data-params='<?php echo json_encode( $params ); ?>' data-number="<?php echo esc_attr( $number ); ?>" <?php echo $el_id ? "id='" . esc_attr( $el_id ) . "'" : '' ?>>


        <?php
        foreach ( $query->posts as $q ) {
            $post_taxs = wp_get_post_terms( $q->ID, 'product_cat', array(
                'fields' => 'all',
            ) );
            if ( is_array( $post_taxs ) && ! empty( $post_taxs ) ) {
                foreach ( $post_taxs as $post_tax ) {
                    $product_taxs[ urldecode( $post_tax->slug ) ] = $post_tax->name;
                }
            }
        }
        ?>

        <?php if ( ! empty( $product_taxs ) ) : ?>
            <div class="product-tabs-wrapper filters">
                <ul class="product-tabs">
                    <li><a href="javascript:;" class="filter active" data-filter="*"><?php echo esc_html__( 'All', 'course-builder' ); ?></a>
                    </li>
                    <?php foreach ( $product_taxs as $product_tax_slug => $product_tax_name ) : ?>
                        <li>
                            <a class="filter" href="javascript:;" data-filter=".<?php echo $product_tax_slug; ?>"><?php echo $product_tax_name; ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php builder_press_get_template( $layout, array(
            'params'      => $params,
            'query'       => $query,
            'columns'     => $columns,
            'label'       => $label,
            'rating'      => $rating,
            'description' => $description,
            'price'       => $price,
            'img_size'    => $img_size
        ), $template_path ); ?>

        <?php if ( $query->max_num_pages > 1 ): ?>
            <div class="pagination-loadmore">
                <span class="title"><?php esc_attr_e( 'Load More', 'pizza-hut' ); ?></span>
            </div>
        <?php endif; ?>

    </div>

<?php } ?>

<?php wp_reset_postdata(); ?>