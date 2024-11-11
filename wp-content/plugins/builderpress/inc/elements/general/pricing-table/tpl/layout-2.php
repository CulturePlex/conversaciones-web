<?php
/**
 * Template for displaying template Pricing table layout 2.
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
<div class="row">
    <?php foreach ( $packages as $package ) { ?>

    <div class="package-wrap <?php echo 'col-md-' . esc_attr( $class ); ?> <?php echo esc_attr($background_color); ?> <?php echo ( isset( $package['featured'] ) && $package['featured'] ) ? 'featured' : ''; ?>">
        <div class="package">

            <div class="package-head" style="background-color: <?php echo  $package['background_color'];?> ">
                <?php if ( ! empty( $package['price'] ) ) { ?>
                    <div class="price">
                        <span class="current-price"><?php echo ent2ncr( $package['price'] ); ?></span>

                        <?php if ( ! empty( $package['unit'] ) ) { ?>
                            <span class="package-unit"><?php echo ent2ncr( $package['unit'] ); ?></span>
                        <?php } ?>

                        <?php if ( ! empty( $package['original_price'] ) ) { ?>
                            <span class="original-price"><?php echo ent2ncr( $package['original_price'] ); ?></span>
                        <?php } ?>
                    </div>
                <?php } ?>

                <?php if ( ! empty( $package['name'] ) ) { ?>
                    <h4 class="title"><?php echo ent2ncr( $package['name'] ); ?></h4>
                <?php } ?>

                <?php if(! empty($package['sub_title'])) { ?>
                    <p class="subtitle"><span><?php echo ent2ncr( $package['sub_title'] ); ?></span></p>
                <?php  } ?>
                <?php if ( ! empty( $package['description'] ) ) { ?>
                    <p class="description"><?php echo ent2ncr( $package['description'] ); ?></p>
                <?php } ?>
            </div>

            <?php if ( ! empty( $package['features'] ) ) { ?>
                <div class="package-main">
                    <ul class="features">
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
                                        <i class="fa fa-check-square-o"
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
                </div>
            <?php } ?>


            <div class="package-footer">
                <?php if ( ! empty( $package['link'] ) ) {
                    $link = $package['link'];
                    if ( $link['title'] ) { ?>
                        <div class="button">
                            <a class="readmore" href="<?php echo esc_url( $link['url'] ); ?>"
                                <?php echo bp_template_build_link( $link ); ?>>
                                <?php echo esc_html( $link['title'] ); ?>
                            </a>
                        </div>
                    <?php }
                } ?>
            </div>
        </div>
    </div>
<?php } ?>
</div>
