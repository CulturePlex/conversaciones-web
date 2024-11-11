<?php
/**
 * Template for displaying default template Products element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/products/tee-layout-list-1.php.
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
<div class="wrap-element">
    <?php if ( $products->have_posts() ) { ?>
        <?php if($title) {?>
            <div class="heading-products">
                <h3 class="title">
                    <?php echo esc_html($title);?>
                </h3>
            </div>
        <?php }?>
        <div class="row no-gutters">
            <?php while ( $products->have_posts() ) :
                $products->the_post();
                global $product;
                $trending = get_post_meta( $product->get_id(), 'thim_product_is_trending', true );
                //$product->is_purchasable() ? 'add_to_cart_button' : '';
                ?>
                <div class="col-6 col-md-6 col-lg-3">
                    <div class="item-product">
                        <div class="image-product">
                            <?php if( $trending ) {?>
                            <span class="trending"><?php echo esc_html__('Trending', 'teeballon');?></span>
                            <?php }?>
                            <a href="<?php the_permalink();?>">
                                <?php
                                $size = apply_filters( 'builder-press/products-list/image-size', 'woocommerce_thumbnail' );
                                builder_press_get_attachment_image( $product->get_id(), $size, 'post' ); ?>
                            </a>
                        </div>

                        <div class="text-product">
                            <div class="title-product">
                                <a href="<?php the_permalink();?>">
                                    <?php the_title();?>
                                </a>
                            </div>

                            <div class="price">
                                <?php echo( $product->get_price_html() ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            endwhile;?>
        </div>
    <?php }?>

</div>
