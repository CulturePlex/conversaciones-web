<?php
/**
 * Template for displaying default template Products element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/products/tee-layout-list-2.php.
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
?>
<?php if ( $products->have_posts() ) { ?>
    <div class="wrap-element">
        <div class="slide-product slide_slick_col_products" data-numofshow="4" data-numofscroll="1" data-loopslide="0" data-autoscroll="0" data-speedauto="6000" data-responsive="[4, 1], [4, 1], [3, 1], [2, 1], [2, 1], [1, 1]" data-numofrows="2">

            <div class="wrap-arrow-slick">
                <div class="arow-slick prev-slick">
                    <i class="ion ion-ios-arrow-left"></i>
                </div>

                <div class="arow-slick next-slick">
                    <i class="ion ion-ios-arrow-right"></i>
                </div>
            </div>

            <div class="slide-slick">
                <?php while ( $products->have_posts() ) :
                    $products->the_post();
                    global $product;
                    $trending = get_post_meta( $product->get_id(), 'thim_product_is_trending', true );
                    ?>
                    <div class="item-slick">
                        <div class="item-product">
                            <div class="image-product">
                                <?php if( $trending ) {?>
                                    <span class="trending"><?php echo esc_html__('Trending', 'teeballon');?></span>
                                <?php }?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php
                                    $size = apply_filters( 'builder-press/products-list/layout-list-2/image-size', 'woocommerce_thumbnail' );
                                    builder_press_get_attachment_image( $product->get_id(), $size, 'post' ); ?>
                                </a>
                            </div>

                            <div class="text-product">
                                <div class="title-product">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title();?>
                                    </a>
                                </div>

                                <div class="price">
                                    <?php echo( $product->get_price_html() ); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
<?php } ?>
