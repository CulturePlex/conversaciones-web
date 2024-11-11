<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 9.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $post, $product;
$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
$image_title       = get_post_field( 'post_excerpt', $post_thumbnail_id );
$placeholder       = has_post_thumbnail() ? 'with-images' : 'without-images';
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'flexslider'
) );

$gallery = '';

$product_thumbnail = '';
if ( has_post_thumbnail() ) {
	$image_title      = esc_attr( get_the_title( get_post_thumbnail_id() ) );
	$image_link       = wp_get_attachment_url( get_post_thumbnail_id() );
	$image            = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
		'title' => $image_title
	) );
	$attachment_count = count( $product->get_gallery_image_ids() );

	if ( $attachment_count > 0 ) {
		$gallery = '[product-gallery]';
	}

	list( $magnifier_url, $magnifier_width, $magnifier_height ) = wp_get_attachment_image_src( get_post_thumbnail_id(), "shop_single" );

	$product_variations_thumbnail = '';
	echo '<div class="images product_variations_image hide">';

	$product_thumbnail            = apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', esc_url( $image_link ), esc_attr( $image_title ), $image ), $post->ID );
	$product_variations_thumbnail = apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" title="%s" style="">%s</a>', esc_url( $image_link ), esc_attr( $image_title ), $image ), $post->ID );

	echo ent2ncr( $product_variations_thumbnail );
	echo '</div>';
}

$attachment_ids = $product->get_gallery_image_ids();
$loop           = 0;
if($attachment_ids == null) {
	$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
		''
	) );
}
?>
<div id="slider" class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>">
	<ul class="slides">
		<?php
		if($attachment_ids == null) {
			echo '<li>';
			echo ent2ncr($product_thumbnail);
			echo '</li>';
		} else {
			if(count($attachment_ids) == 1) {
				echo '<li>';
				echo ent2ncr($product_thumbnail);
				echo '</li>';
			}
			foreach ( $attachment_ids as $attachment_id ) {
				$image_link = wp_get_attachment_url( $attachment_id );
				if ( ! $image_link ) {
					continue;
				}
				$classes[]   = 'image-' . $attachment_id;
				$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
				$image_class = esc_attr( implode( ' ', $classes ) );
				$image_title = esc_attr( get_the_title( $attachment_id ) );
				echo '<li>';
				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', esc_url( $image_link ), esc_attr( $image_title ), $image ), $post->ID );
				echo '</li>';
				$loop ++;
			}
		}

		?>
	</ul>
</div>
