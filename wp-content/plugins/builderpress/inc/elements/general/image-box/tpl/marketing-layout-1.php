<?php
/**
 * Template for displaying default template Image Box element marketing-layout-1
 *
 * This template can be overridden by copying it to yourtheme/builderpress/image-box/marketing-layout-1.php.
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

/**
 * @var $params array - shortcode params
 */

?>

<div class="wrap-element">
    <div class="row">
        <div class="col-lg-6">
            <div class="pic-element">
                <?php
                    $size = apply_filters( 'builder-press/image-box/marketing-layout-1/image-size', '454x556' );
                     builder_press_get_attachment_image( $params['img'], $size );
                ?>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="text-element">
                <div class="icon-image">
                    <?php echo wp_get_attachment_image( $params['img-icon'], 'full' );?>
                </div>

                <div class="content">
                    <h3 class="title">
                        <?php echo esc_html( $params['title'] );?>
                    </h3>

                    <div class="description">
                        <?php echo $params['description'];?>
                    </div>
                </div>
            </div>

            <?php if( $params['box_link'] ) {?>
                <div class="buttons-element">
                    <a href="<?php echo esc_url( $params['box_link']['url'] ); ?>" class="link-readmore">
                        <?php echo $params['box_link']['title'] ? $params['box_link']['title'] : __( 'Read More', 'builderpress' );?>
                    </a>
                </div>
            <?php }?>
        </div>
    </div>
</div>