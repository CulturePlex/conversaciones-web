<?php
/**
 * Template for displaying default template product banner element layout 3.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/product-banner/layout-3.php.
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

if ( ! $params['images-3'] ) {
    return;
}

$entry_css = $overlay = '';

if ( $params['overlay'] ) {
    $overlay = 'overlay';
}

?>

<div class="group-banner clearfix">
    <?php
    $loop = 1;

    foreach ( $params['images-3'] as $image ) {

        if ( isset($image['link']) ) {
            $link =  $image['link']['url'];
        } else {
            $link = '#';
        }

        if ( $params['height'] ) {
            $entry_css  = 'height: ' . $params['height'] . 'px;';
        }

        ?>
        <?php
        $url_image = wp_get_attachment_image_src($image['img'], 'full');
        if ( $url_image) : ?>
            <div class="item">
                <div class="content <?php echo esc_attr( $overlay )?>" style="<?php echo esc_attr( $entry_css )?>">
                    <?php
                    if ( $params['overlay'] ) { ?>
                        <a href="<?php echo esc_url( $link )?>" class="link-overlay"></a>
                    <?php  }
                    ?>

                    <a href="<?php echo esc_url( $link )?>" class="thumb">
                        <?php builder_press_get_attachment_image( $image['img'], 'full' ); ?>
                    </a>

                    <div class="text">
                        <?php if ( isset($image['title']) ) { ?>
                            <h3 class="title"><?php echo esc_attr( $image['title'] ) ?></h3>
                        <?php } ?>

                        <?php if ( isset($image['description']) ) { ?>
                            <div class="description"><?php echo esc_attr( $image['description'] ) ?></div>
                        <?php } ?>
                        <?php if ( isset($image['price']) ) { ?>
                            <div class="all-price">
                                <?php if ( isset($image['price_sale']) ) { ?>
                                    <span class="sale-price"><?php echo esc_attr( $image['price_sale'] ) ?></span>
                                <?php } ?>
                                <span class="price"><?php echo esc_attr( $image['price'] ) ?></span>
                            </div>
                        <?php } ?>

                        <?php if ($image['link'] ) { ?>
                            <div class="order"><a class="bp-btn" href="<?php echo esc_url( $image['link']['url'] )?>"><?php echo esc_attr( $image['link']['title'] ) ?></a></div>
                        <?php } ?>

                    </div>

                </div>
            </div>
        <?php endif; ?>
        <?php
        if ($loop++ > 3) break;
    }?>

</div>


