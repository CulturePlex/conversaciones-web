<?php
/**
 * Template for displaying default template Image Box element vblog-layout-2
 *
 * This template can be overridden by copying it to yourtheme/builderpress/image-box/vblog-layout-2.php.
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
$size = apply_filters( 'builder-press/image-box/vblog-layout-2/image-size', '819x469' );
$img = $params['img'] ? ' style="background-image: url(' . wp_get_attachment_image_url( $params['img'], $size ) . ')"' : '';
?>
<div class="wrap-element" <?php echo ent2ncr($img) ?>>
    <div class="content">
        <h3 class="subtitle">
            <?php echo esc_html( $params['description'] );?>
        </h3>

        <div class="title">
            <?php echo esc_html( $params['title'] );?>
        </div>
    </div>

    <?php if( $params['box_link'] ) {?>
        <a href="<?php echo esc_url( $params['box_link']['url'] ); ?>" class="btn-view btn-small shape-round">
            <?php echo $params['box_link']['title'] ? $params['box_link']['title'] : __( ' VIEW POST', 'builderpress' );?>
        </a>
    <?php }?>
</div>
