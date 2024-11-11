<?php
/**
 * Template for displaying template Pricing table layout marketing.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/pricing-table/marketing-layout-1.php.
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
            <div class="<?php echo 'col-lg-' . esc_attr( $class ); ?>">
                <div class="item-pricing">
                    <?php if(! empty($package['sub_title'])) { ?>
                        <div class="label"><?php echo ent2ncr( $package['sub_title'] ); ?></div>
                    <?php  } ?>
                    <?php if ( ! empty( $package['price'] ) ) { ?>
                        <div class="price">
                            <span class="number"><?php echo ent2ncr( $package['price'] ); ?></span>

                            <?php if ( ! empty( $package['unit'] ) ) { ?>
                                <span class="unit"><?php echo ent2ncr( $package['unit'] ); ?></span>
                            <?php } ?>

                            <?php if ( ! empty( $package['original_price'] ) ) { ?>
                                <span class="original"><?php echo ent2ncr( $package['original_price'] ); ?></span>
                            <?php } ?>
                        </div>
                    <?php } ?>

                    <?php if ( ! empty( $package['name'] ) ) { ?>
                        <div class="title"><?php echo ent2ncr( $package['name'] ); ?></div>
                    <?php } ?>

                    <ul class="list-info">
                        <?php
                        $features = $package['features'];
                        if ( is_string( $features ) ) {
                            $el_features = explode('|', $features);
                            $features = array();
                            $i = 0;
                            while ( $i < $el_features[0] ) {
                                $i++;
                                $fields_feature = explode( ',', $el_features[1] );
                                $feature_item = array();
                                foreach ( $fields_feature as $value_c ) {
                                    $key = $value_c.$i;
                                    if ( isset( $package[$value_c.$i] ) ){
                                        $feature_item[$value_c] = $package[$value_c.$i];
                                    }
                                }
                                $features[] = $feature_item;
                            }
                        }
                        foreach ( $features as $feature ) {
                            if ( ! empty( $feature['title'] ) ) { ?>
                                <?php if(! empty($feature['show_icon_features'])){ ?>
                                    <li>
                                        <i class="ion ion-android-checkbox-outline"
                                           aria-hidden="true"></i><span><?php echo esc_html( $feature['title'] ); ?> </span>
                                    </li>
                                <?php }else{ ?>
                                    <li>
                                        <i class="ion-android-checkbox-outline-blank"></i><span><?php echo esc_html( $feature['title'] ); ?> </span>
                                    </li>
                                <?php } ?>
                            <?php }
                        } ?>
                    </ul>

                    <?php if ( ! empty( $package['link'] ) ) {
                        $link = $package['link'];
                        $link_url = $link['url'];
                        $title = $link['title'] ? $link['title'] : __( 'Buy Now', 'builderpress' );
                        if ( $link_url ) { ?>
                            <a href="<?php echo esc_url( $link_url ); ?>" class="btn-buy" <?php echo bp_template_build_link( $link ); ?>>
                                <?php echo esc_html( $title ); ?>
                            </a>
                        <?php }
                    } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
