<?php
/**
 * Template for displaying default template Woocommerce Product Carousel element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/product-carousel/product-carousel.php.
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

$category     = $params['category'];
$filter_by    = $params['filter_by'];
$number_items = $params['number_items'];
$rows         = $params['rows'];
$show_label   = $params['show_label'];
$show_nav     = $params['show_nav'];
$show_rating  = $params['show_rating'];
$img_size     = $params['img_size'];
$style_layout = !empty($params['style_layout']) ? $params['style_layout'] : '';
$items_visible = $params['items_visible'];
$items_tablet  = $params['items_tablet'];
$items_mobile  = $params['items_mobile'];

$el_class = $params['el_class'];
$el_id    = $params['el_id'];

$query = array(
	'post_type'      => 'product',
	'posts_per_page' => $number_items,
);

if ( $category <> ' ' ) {
	$query['product_cat'] = $category;
}

if ( $filter_by ) {
	switch ( $filter_by ) {
		case 'featured':
			$query['tax_query'] = array(
				array(
					'taxonomy' => 'product_visibility',
					'field'    => 'name',
					'terms'    => 'featured',
				)
			);
			break;

		case 'average_rating':
			$query['meta_key'] = '_wc_average_rating';
			$query['orderby']  = 'meta_value_num';
			break;

		case 'total_sales':
			$query['meta_key'] = 'total_sales';
			$query['orderby']  = 'meta_value_num';
			break;
	}
}

// query products
$products = new WP_Query( apply_filters( 'builder-press/product-carousel-query', $query ) );
$i        = 1;
?>

<div class="bp-element bp-element-product-carousel woocommerce <?php echo esc_attr($style_layout); ?> <?php echo esc_attr( $el_class ); ?>" <?php echo $el_id ? "id='" . esc_attr( $el_id ) . "'" : '' ?>
     data-items="<?php echo esc_attr( $number_items ); ?>"
     data-items-visible="<?php echo esc_attr( $items_visible ); ?>"
     data-items-tablet="<?php echo esc_attr( $items_tablet ); ?>"
     data-items-mobile="<?php echo esc_attr( $items_mobile ); ?>"
     data-nav="<?php echo esc_attr( $show_nav ); ?>">

	<?php if ( $products->have_posts() ) { ?>
        <div class="owl-carousel owl-themes">
			<?php if ( $rows >= 2 && $i < $number_items ) { ?>

            <div class="item-wrapper">
				<?php }

				while ( $products->have_posts() ) :
				$products->the_post();
				/**
				 * @var $product WC_Product
				 */
				global $product, $post;
				?>
                <div class="item-col">
                    <div class="content_product">
                        <div class="product_thumb">
                            <a class="feature-img" href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>"
                               title="<?php echo esc_attr( $product->get_title() ); ?>">
								<?php
								$size = apply_filters( 'builder-press/product-carousel/image-size', esc_attr($params['img_size']) );
								builder_press_get_attachment_image( $product->get_id(), $size, 'post' ); ?>
                            </a>

                            <?php if ( $show_label ) { ?>
                                <div class="product-label">
                                    <?php if ( $product->is_featured() ) { ?>
                                        <div class="burst-12 featured"><span><?php esc_html_e( 'New', 'builderpress' ); ?></span></div>
                                    <?php }
                                    if ( $product->is_on_sale() ) { ?>
                                        <div class="burst-12 onsale"><span><?php esc_html_e( 'Sale', 'builderpress' ); ?></span></div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="product_content">

                            <h3 class="title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h3>

                            <?php if ( $show_rating ) { ?>
                                <div class="ratings"><?php echo wc_get_rating_html( $product->get_average_rating() ); ?></div>
                            <?php } ?>

                            <div class="price"><?php echo( $product->get_price_html() ); ?></div>

                            <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

                        </div>
                    </div>
                </div>

				<?php if ( $rows >= 2 && $i < $number_items ) {
				if ( $i % $rows == 0 && ( $products->found_posts != $i ) ) { ?>
            </div>

            <div class="item-wrapper">
				<?php }
				$i ++;
				}
				endwhile; // end of the loop.
				?>
				<?php if ( $rows >= 2 ) { ?>
            </div>
		<?php } ?>
        </div>
	<?php } ?>

</div>

<?php wp_reset_postdata(); ?>
