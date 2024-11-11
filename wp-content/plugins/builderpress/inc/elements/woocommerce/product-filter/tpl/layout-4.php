<?php
$classes = '';
$column_product = 12 / $params['columns'];
$classes = 'col-xs-6 col-md-' . $column_product . ' col-sm-6';

?>

<div class="sc-loop row">
    <?php

    if ( $query->have_posts() ) :
        while ( $query->have_posts() ) : $query->the_post();
            global $product, $post;
            ?>

            <div <?php post_class( $classes ); ?> >
                <div class="content_product">
                    <div class="product_thumb">
                        <a class="feature-img" href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>"
                           title="<?php echo esc_attr( $product->get_title() ); ?>">
                            <?php
                            $size = apply_filters( 'builder-press/product-filter/image-size', esc_attr($params['img_size']) );
                            builder_press_get_attachment_image( $product->get_id(), $size, 'post' ); ?>
                        </a>

                        <?php if ( $params['label'] ) { ?>
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

                        <?php if ( $params['rating'] ) { ?>
                            <div class="ratings"><?php echo wc_get_rating_html( $product->get_average_rating() ); ?></div>
                        <?php } ?>

                        <?php if ( $params['description'] ) { ?>
                            <div class="excerpt"><?php echo wp_trim_words( get_the_excerpt(), 12, '...' ); ?></div>
                        <?php } ?>

                        <?php if ( $params['price'] ) { ?>
                            <div class="price"><?php echo( $product->get_price_html() ); ?></div>
                        <?php } ?>

                        <?php if ( $params['add_cart'] ) {
                            do_action( 'woocommerce_after_shop_loop_item' );
                        } ?>

                        
                    </div>
                </div>
            </div>

        <?php
        endwhile;

        wp_reset_postdata();
    endif;

    ?>

</div>
