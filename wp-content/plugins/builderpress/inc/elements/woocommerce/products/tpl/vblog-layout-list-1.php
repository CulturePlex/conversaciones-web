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
        <div class="list-products">
            <?php while ( $products->have_posts() ) :
                $products->the_post();
                global $product;
                ?>
                <div class="product-item">
                    <a href="#" class="pic">
                        <?php
                        $size = apply_filters( 'builder-press/products-list/image-size', '90x100' );
                        builder_press_get_attachment_image( $product->get_id(), $size, 'post' ); ?>
                    </a>

                    <div class="text">
                        <h4 class="title">
                            <a href="<?php the_permalink();?>">
                                <?php the_title();?>
                            </a>
                        </h4>

                        <div class="price">
                            <?php echo( $product->get_price_html() ); ?>
                        </div>
                    </div>
                </div>
            <?php
            endwhile;?>
        </div>
    <?php }?>

</div>
