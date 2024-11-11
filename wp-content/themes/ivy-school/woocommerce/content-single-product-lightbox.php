<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly
global $product;
global $post;
 ?>
<div id="content" class="quickview woocommerce product-lightbox">
 	<div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" class="product-info">
		<div class="left col-sm-5">
            <?php
            if ( has_post_thumbnail() ) {
                $image            = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
                $image_title      = esc_attr( get_the_title( get_post_thumbnail_id() ) );
                $image_link       = wp_get_attachment_url( get_post_thumbnail_id() );
                $attachment_count = count( $product->get_gallery_attachment_ids() );
                echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '%s', $image ), $post->ID );
            }
            ?>
		</div>
		<div class="right col-sm-7">
			<?php
			/**
			 * woocommerce_single_product_summary hook
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 */
			do_action( 'woocommerce_single_product_summary_quick' );
			?>

		</div>
		<div class="clear"></div>
		<?php echo '<a href="' . esc_attr( get_the_permalink( $product->get_id() ) ) . '" target="_top" class="quick-view-detail">' . esc_html__( 'View Detail', 'ivy-school' ) . '</a><div class="clear"></div>'; ?>
	</div>
	<!-- #product-<?php the_ID(); ?> -->
</div><!-- .quickview -->
