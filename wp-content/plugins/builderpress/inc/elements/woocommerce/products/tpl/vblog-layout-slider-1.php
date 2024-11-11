<?php
/**
 * Template for displaying default template Products element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/products/vblog-layout-list-1.php.
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
global $post;
?>
<div class="wrap-element">
    <div class="slide-products js-call-slick-col" data-numofslide="4" data-numofscroll="4" data-loopslide="1" data-autoscroll="0" data-speedauto="6000" data-respon="[4, 4], [4, 4], [3, 3], [2, 2], [1, 1]">
        <?php if ( $products->have_posts() ) { ?>
            <div class="slide-slick">
                <?php while ( $products->have_posts() ) :
                    $products->the_post();
                    global $product;
                    $product = wc_get_product( $post->ID );
                    $name_produces = $product->get_meta( 'thim_name_produces' );
                ?>
                    <div class="item-slick">
                        <div class="product-item">
                            <div class="pic">
                                <a href="<?php the_permalink(); ?>">
                                    <?php
                                    $size = apply_filters( 'builder-press/products-slider/image-size', '122x129' );
                                    builder_press_get_attachment_image( $product->get_id(), $size, 'post' ); ?>
                                </a>

                                <div class="price">
                                    <?php echo( $product->get_price_html() ); ?>
                                </div>
                            </div>

                            <div class="text">
                                <?php
                                    if($name_produces):
                                ?>
                                    <div class="subtitle">
                                        <?php echo esc_html__('in','builderpress');?> <?php echo esc_html($name_produces); ?>
                                    </div>
                                <?php endif; ?>

                                <h4 class="title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h4>
                            </div>
                        </div>
                    </div>
                <?php
                endwhile;?>
            </div>
        <?php } ?>
        <div class="wrap-dot-slick show-line"></div>
    </div>
</div>
