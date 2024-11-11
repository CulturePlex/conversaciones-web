<?php
/**
 * Template for displaying default template Image Box element teeballon-layout-1
 *
 * This template can be overridden by copying it to yourtheme/builderpress/image-box/teeballon-layout-1.php.
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
$img = $params['img'] ? ' style="background-image: url(' . wp_get_attachment_image_url( $params['img'], 'full' ) . ')"' : '';
?>
<div class="wrap-element" <?php echo ent2ncr($img) ?>>
    <div class="content">
        <div class="subtitle">
            <?php echo esc_html( $params['description'] );?>
        </div>

        <h3 class="title">
            <?php echo esc_html( $params['title'] );?>
        </h3>
        <?php if( $params['box_link']['url'] ) {?>
            <a href="<?php echo esc_url( $params['box_link']['url'] ); ?>" class="btn-view btn-small shape-round">
                <?php echo $params['box_link']['title'] ? $params['box_link']['title'] : __( 'View Post', 'builderpress' );?>
            </a>
        <?php }?>
    </div>
</div>