<?php
/**
 * Template for displaying template Testimonials element marketing layout 2.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/testimonials/marketing-layout-2.php.
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
$rtl_att = (get_theme_mod( 'feature_rtl_support', false ) || is_rtl()) ? ' data-rtl="1" dir="rtl"' : '';

?>
<div class="wrap-element">
    <div class="container">
        <?php
            if(!empty($title)):
        ?>
                <h4 class="element-title"><?php echo esc_html($title); ?></h4>
        <?php
            endif;
        ?>
        <div class="row">
            <div class="col-md-6">
                <div class="slide-image js-call-slick-col-vblog"<?php echo $rtl_att;?> data-numofslide="1" data-numofscroll="1" data-loopslide="1" data-autoscroll="<?php echo $auto_slide;?>" data-speedauto="<?php echo $speed_auto;?>" data-responsive="[1, 1], [1, 1], [1, 1], [1, 1], [1, 1]" data-navfor="#text-testimonial-01" data-modecenter="1" data-paddingcenter="0px" data-speedslide="1000">
                    <div class="wrap-arrow-slick">
                        <div class="arow-slick prev-slick"></div>
                    </div>
                    <div id="image-testimonial-01" class="slide-slick">
                        <?php foreach ( $testimonials as $testimonial ) { ?>
                            <div class="item-slick">
                                <div class="item-image">
                                    <?php
                                    $thumbnail_id = (int) $testimonial['image'];
                                    $size         = apply_filters( 'builder-press/testimonial/marketing-layout-2/image-size', '360x487' );
                                    builder_press_get_attachment_image( $thumbnail_id, $size );
                                    ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="slide-text js-call-slick-col-vblog"<?php echo $rtl_att;?> data-numofslide="1" data-numofscroll="1" data-loopslide="1" data-autoscroll="0" data-speedauto="6000" data-responsive="[1, 1], [1, 1], [1, 1], [1, 1], [1, 1]" data-fade="1" data-navfor="#image-testimonial-01" data-speedslide="1000">
                    <div id="text-testimonial-01" class="slide-slick">
                        <?php foreach ( $testimonials as $testimonial ) { ?>
                            <div class="item-slick">
                                <div class="item-text">
                                    <?php
                                        if(isset($testimonial['content'])):
                                    ?>
                                        <div class="content-testimonial">
                                            <?php echo esc_html( $testimonial['content'] ) ?>
                                        </div>
                                        <?php endif; ?>
                                    <div class="author-testimonial">
                                        <span class="name"><?php echo esc_html( $testimonial['name'] ); ?></span> <?php echo esc_html( $testimonial['works'] ); ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="wrap-arrow-slick">
                        <div class="arow-slick prev-slick">
                            <i class="ion ion-ios-arrow-thin-left"></i>
                        </div>
                        <div class="arow-slick next-slick">
                            <i class="ion ion-ios-arrow-thin-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>