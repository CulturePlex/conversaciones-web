<?php
/**
 * Template for displaying default template Grid Images element marketing layout 1.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/slide-images-box/marketing-layout-1.php.
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
?>

<div class="wrap-element">
    <?php
    if(!empty($image_box_link['title'])){
        $link_title = $image_box_link['title'];
    }
    $title      =  $link_title ? $link_title : __('View More Works','builderpress');
    if(isset($image_box_link['url'])):
        ?>
        <a href="<?php echo esc_url($image_box_link['url']) ?>" class="link-element">
            <?php echo esc_html($title); ?>
        </a>
    <?php endif; ?>

    <div class="slide-image js-call-slick-col" data-numofslide="2" data-numofscroll="1" data-loopslide="1" data-autoscroll="0" data-speedauto="6000" data-respon="[2, 1], [2, 1], [1, 1], [1, 1], [1, 1]">

        <div class="wrap-arrow-slick">
            <div class="arow-slick prev-slick">
                <i class="ion ion-ios-arrow-thin-left"></i>
            </div>

            <div class="arow-slick next-slick">
                <i class="ion ion-ios-arrow-thin-right"></i>
            </div>
        </div>

        <div class="slide-slick">
            <?php
            foreach ($slide_image_box as $get_list_slide_image_box):
                if(!empty($get_list_slide_image_box['link']['url'])){
                    $link = $get_list_slide_image_box['link']['url'];
                }else {
                    $link = '#';
                }
                ?>
                <div class="item-slick">
                    <div class="item-image">
                        <?php
                        if(isset($get_list_slide_image_box['main_image'])):
                            $main_image = (int) $get_list_slide_image_box['main_image'];
                            $size       = apply_filters( 'builder-press/slide-image-box/image-size', '562x493' );
                            ?>
                            <?php
                            builder_press_get_attachment_image($main_image,$size);
                            ?>
                        <?php
                        endif;
                        ?>

                        <a href="<?php echo $link ?>" class="overlay-image">
                            <h3 class="title-image">
                                <?php echo $get_list_slide_image_box['title'] ?>
                            </h3>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="wrap-dot-slick"></div>
    </div>
</div>