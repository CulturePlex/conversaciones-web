<?php
/**
 * Template for displaying default template Services element layout marketing-layout-1.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/services/marketing-layout-1.php.
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
$rtl_att = ( get_theme_mod( 'feature_rtl_support', false ) || is_rtl() ) ? ' data-rtl="1" dir="rtl"' : '';
?>
<div class="wrap-element">
    <div class="main-slide js-call-slick-col"<?php echo $rtl_att;?> data-numofslide="1" data-numofscroll="1" data-loopslide="1" data-autoscroll="1" data-speedauto="60000" data-respon="[1, 1], [1, 1], [1, 1], [1, 1], [1, 1]">
        <div class="slide-slick">
            <?php
                foreach ($slide_image as $slide_images):
            ?>
                <div class="item-slick">
                    <div class="item-slide">
                        <div class="inner-slider">
                                <div class="row justify-content-lg-start justify-content-center">
                                    <div class="col-md-10 col-lg-5">
                                        <div class="content-slider">
                                            <?php
                                            if(isset($slide_images['sub_title'])):
                                                ?>
                                                <div class="subtitle-slider">
                                                    <?php echo $slide_images['sub_title']; ?>
                                                </div>
                                            <?php endif; ?>

                                            <?php
                                            if(isset($slide_images['title'])):
                                                ?>
                                                <h1 class="title-slider">
                                                    <?php echo $slide_images['title'] ?>
                                                </h1>
                                            <?php endif; ?>

                                            <?php
                                            if(isset($slide_images['description'])):
                                                ?>
                                                <div class="description-slider">
                                                    <?php echo $slide_images['description']; ?>
                                                </div>
                                            <?php endif; ?>
                                             <?php
                                                if(isset($slide_images['style'])) {
                                                    $class =  $slide_images['style'];
                                                }else{
                                                    $class = '';
                                                }
                                             ?>

                                            <?php
                                                if(!empty($slide_images['link'])):
                                                    $link_title = $slide_images['link']['title'];
                                                    $title = $link_title ? $link_title : __( 'Read More', 'builderpress' );
                                                    if ( isset ( $slide_images['link_item_title'] ) && $slide_images['link_item_title'] != '' ) {
                                                        $title = $slide_images['link_item_title'];
                                                    }
                                                    $link_url = $slide_images['link']['url'];
                                                endif;
                                                if(!empty($link_url)):
                                            ?>
                                                <div class="wrap-btn-slider <?php echo esc_attr($class); ?> ">
                                                    <a href="<?php echo esc_url($link_url); ?>" class="btn-slider">
                                                        <?php echo esc_html($title); ?>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                            <div class="right-image">
                                <?php
                                $thumbnail_id = (int) $slide_images['main_image'];
                                $size         = apply_filters( 'builder-press/slide/image-size', '870x554' );
                                builder_press_get_attachment_image( $thumbnail_id, $size );
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
            if(!$hidden_dot):
        ?>
            <div class="wrap-dot-slick container"></div>
        <?php endif; ?>
    </div>

    <?php
        if($show_button == true):
            if(!empty($link_button['url'])):
    ?>
                <a href="<?php echo esc_url($link_button['url']); ?>" class="btn-go-down js-call-menu-scroll">
                    <i class="ion ion-ios-arrow-thin-down"></i>
                </a>
    <?php
            endif;
        endif;
    ?>
</div>
