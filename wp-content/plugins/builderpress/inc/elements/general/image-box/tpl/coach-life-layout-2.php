<?php
/**
 * Template for displaying default template Image Box element coach-life-layout-2
 *
 * This template can be overridden by copying it to yourtheme/builderpress/image-box/coach-life-layout-2.php.
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
$size = apply_filters( 'builder-press/image-box/coach-life-layout-2/image-size', '477x550' );
?>
<div class="wrap-element">
    <div class="image-element">
        <?php  builder_press_get_attachment_image( $params['img'], $size ); ?>
    </div>

    <div class="text-element">
        <span class="number"><?php echo esc_html( $params['title'] );?></span>  <?php echo esc_html( $params['description'] );?>
    </div>
</div>
