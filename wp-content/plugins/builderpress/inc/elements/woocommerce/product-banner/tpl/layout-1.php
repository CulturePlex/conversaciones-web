<?php
/**
 * Template for displaying default template product banner element layout 1.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/product-banner/layout-1.php.
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

if ( ! $params['images'] ) {
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
    foreach ( $params['images'] as $image ) {

        if ( isset($image['link']) ) {
            $link =  $image['link']['url'];
        } else {
            $link = '#';
        }

        if ( $params['height'] ) {
            $he = (int)$params['height']/2 - 15;

            if ( $loop != 1 ) {
                $entry_css  = 'height: ' . $he . 'px;';

            } else {
                $entry_css  = 'height: ' . $params['height'] . 'px;';
            }
        }

        ?>
        <?php
        $url_image = wp_get_attachment_image_src($image['img'], 'full');
        if ( $url_image) : ?>
            <div class="item rank-<?php echo esc_attr( $loop )?>">
                <div class="content <?php echo esc_attr( $overlay )?>" style="<?php echo esc_attr( $entry_css )?>">
                    <?php
                        if ( $params['overlay'] ) { ?>
                            <a href="<?php echo esc_url( $link )?>" class="link-overlay"></a>
                       <?php  }
                    ?>

                    <a href="<?php echo esc_url( $link )?>" class="thumb">
                        <?php builder_press_get_attachment_image( $image['img'], 'full' ); ?>
                    </a>
                    <?php if ( isset($image['flag_title']) || isset($image['flag_price']) ) { ?>
                        <div class="flag">
                            <div class="flag-content">
                                <?php if ( isset($image['flag_title']) ) { ?>
                                    <span class="text"><?php echo esc_attr( $image['flag_title'] ) ?></span>
                                <?php } ?>

                                <?php if ( isset($image['flag_price_sale']) ) { ?>
                                    <span class="sale-price"><?php echo esc_attr( $image['flag_price_sale'] ) ?></span>
                                <?php } ?>
                                <?php if ( isset($image['flag_price']) ) { ?>
                                    <span class="price"><?php echo esc_attr( $image['flag_price'] ) ?></span>
                                <?php } ?>
                            </div>

                        </div>
                    <?php } ?>
                    <?php if ($image['banner_title'] ) { ?>
                        <h3 class="title"><a href="<?php echo esc_url( $link )?>"><?php echo esc_attr( $image['banner_title'] ) ?></a></h3>
                    <?php } ?>
                </div>
            </div>
        <?php endif; ?>
        <?php
        if ($loop++ > 3) break;
    }?>

</div>


