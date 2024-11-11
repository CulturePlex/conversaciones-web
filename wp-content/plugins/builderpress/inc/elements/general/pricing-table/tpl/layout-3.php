<?php
/**
 * Template for displaying template Pricing table layout 3.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/our-team/layout-1.php.
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

$class = 12 / $number_columns;
?>
<div class="wrap-element">
    <div class="row">
        <?php foreach ( $packages as $package ) { ?>
            <div class="col-sm-6 <?php echo 'col-lg-' . esc_attr( $class ); ?>">
                <div class="pricing-item">
                    <div class="back-ground"></div>
                    <div class="symbol">
                        <?php $image = wp_get_attachment_image_src( $package['image'], 'full' ); ?>
                        <img src="<?php echo esc_attr( $image[0] ); ?>"
                             width="<?php echo esc_attr( $image[1] ); ?>"
                             height="<?php echo esc_attr( $image[2] ); ?>"
                             alt="<?php echo esc_attr__( 'icon', 'builderpress' ); ?>">
                    </div>

                    <?php if ( ! empty( $package['name'] ) ) { ?>
                        <h4 class="title">
                            <?php echo ent2ncr( $package['name'] ); ?>
                        </h4>
                    <?php } ?>

                    <?php if ( ! empty( $package['price'] ) ) { ?>
                        <div class="price">
                            <span class="number"><?php echo ent2ncr( $package['price'] ); ?>/</span><?php echo ent2ncr( $package['unit'] ); ?>
                        </div>
                    <?php } ?>
                    <?php if ( ! empty( $package['description'] ) ) { ?>
                        <div class="description">
                            <?php echo ent2ncr( $package['description'] ); ?>
                        </div>
                    <?php } ?>

                    <?php if ( ! empty( $package['link'] ) ) {
                        $link = $package['link'];
                        if ( $link['title'] ) { ?>
                            <a href="<?php echo esc_url( $link['url'] ); ?>" class="btn-get-start">
                                <?php echo esc_html( $link['title'] ); ?>
                            </a>
                        <?php }
                    } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
