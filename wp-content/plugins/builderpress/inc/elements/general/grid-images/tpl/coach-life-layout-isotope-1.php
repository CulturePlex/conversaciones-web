<?php
/**
 * Template for displaying default template Grid Images element coach-life-layout-isotope-1.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/grid-images/coach-life-layout-isotope-1.php.
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

$sizes = apply_filters( 'builder-press/grid-images/coach-life-layout-isotope-1/sizes', array(
    '1x1' => '360x320',
    '2x2' => '360x680',
    '3x2' => '760x320'
) ); ?>

<div class="wrap-element grid-isotope grid gallery-popup">
    <div class="grid-sizer"></div>

    <?php
            $ratio = $images[0]['size'];
            $title = $images[0]['title'];
            $sub_title = $images[0]['sub_title'];
            $size  = apply_filters( 'builder-press/grid-images/coach-life-layout-isotope-1/default-size', '360x320' );
            $url_image = wp_get_attachment_image_src( $images[0]['img'], 'full' );
            if ( array_key_exists( $ratio, $sizes ) ) {
                $size = $sizes[ $ratio ];
            }
            if($ratio === '3x2'){
                $class = "size-2x";
            }else{
                $class = "";
            }
    ?>
            <div class="grid-item <?php echo esc_attr($class); ?>">
                <div class="item-image">
                    <a href="<?php echo esc_url($url_image[0]); ?>" class="wrap-image js-show-gallery">
                        <?php builder_press_get_attachment_image( $images[0]['img'], $size ); ?>
                    </a>

                    <div class="wrap-text">
                        <?php
                            if(!empty($title)):
                        ?>
                            <h4 class="title-item">
                                <?php echo esc_html($title); ?>
                            </h4>
                        <?php
                          endif;
                        ?>

                        <?php
                            if(!empty($sub_title)):
                        ?>
                                <div class="description-item">
                                    <?php echo esc_html($sub_title); ?>
                                </div>
                        <?php
                            endif;
                        ?>
                    </div>
                </div>
            </div>

    <div class="grid-item">
        <div class="item-text">
            <div class="content-item">
                <?php
                    if(!empty($grid_sub_title)):
                ?>
                    <div class="description-item">
                        <?php echo esc_html($grid_sub_title); ?>
                    </div>
                <?php
                    endif;
                ?>

                <?php
                    if(!empty($grid_title)):
                ?>
                    <h4 class="title-item">
                        <?php echo esc_html($grid_title); ?>
                    </h4>
                <?php
                    endif;
                ?>

                <?php
                    if(!empty($grid_img_content)):
                ?>
                    <div class="description-item">
                        <?php echo esc_html($grid_img_content); ?>
                    </div>
                <?php
                    endif;
                ?>

                <?php
                    if ( $link && $link['url']) {
                        $title = $text_link ? $text_link : __( 'Join Now', 'builderpress' );
                        if ( isset ( $params['linktype_title'] ) && !empty($params['linktype_title'])) {
                            $title = $params['linktype_title'];
                        }
                ?>
                        <a href="<?php echo esc_url( $link['url'] ); ?>" class="button-item" <?php echo bp_template_build_link( $link ); ?>>
                            <?php echo ent2ncr( $title ) ?>
                        </a>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php
        global $class;
        $i = 1;
        foreach ($images as $image){
            $i++;
            $ratio = $image['size'];
            $title = $image['title'];
            $sub_title = $image['sub_title'];
            $size  = apply_filters( 'builder-press/grid-images/coach-life-layout-isotope-1/default-size', '360x320' );
            $url_image = wp_get_attachment_image_src( $image['img'], 'full' );
            if ( array_key_exists( $ratio, $sizes ) ) {
                $size = $sizes[ $ratio ];
            }
            if($ratio === '3x2'){
                $class = "size-2x";
            }else{
                $class = "";
            }
            if($i == 2){
                continue;
            }
    ?>
            <div class="grid-item <?php echo $class; ?>">
                <div class="item-image">
                    <a href="<?php echo esc_url($url_image[0]); ?>" class="wrap-image js-show-gallery">
                        <?php builder_press_get_attachment_image( $image['img'], $size ); ?>
                    </a>

                    <div class="wrap-text">
                        <?php
                        if(!empty($title)):
                            ?>
                            <h4 class="title-item">
                                <?php echo esc_html($title); ?>
                            </h4>
                        <?php
                        endif;
                        ?>

                        <?php
                        if(!empty($sub_title)):
                            ?>
                            <div class="description-item">
                                <?php echo esc_html($sub_title); ?>
                            </div>
                        <?php
                        endif;
                        ?>
                    </div>
                </div>
            </div>
    <?php
        }
    ?>
</div>