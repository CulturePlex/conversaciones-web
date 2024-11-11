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
                        
                    </div>

                    <div class="product_content">

                        <h3 class="title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h3>

                        <?php if ( $params['description'] ) { ?>
                            <div class="excerpt"><?php echo wp_trim_words( get_the_excerpt(), 12, '...' ); ?></div>
                        <?php } ?>

                    </div>

                    <?php if ( $params['price'] ) { ?>
                        <div class="price"><?php echo( $product->get_price_html() ); ?></div>
                    <?php } ?>
                </div>
            </div>

           <?php
        endwhile;

        wp_reset_postdata();
        
    endif;

    ?>

</div>
