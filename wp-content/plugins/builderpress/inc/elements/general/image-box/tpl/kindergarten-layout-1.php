<?php
/**
 * Template for displaying default template Image Box element kindergarten-layout-1
 *
 * This template can be overridden by copying it to yourtheme/builderpress/image-box/kindergarten-layout-1.php.
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
$size = apply_filters( 'builder-press/image-box/kindergarten-layout-1/image-size', '183x166' );
?>
<div class="wrap-element">
    <div class="heading-image">
        <?php  builder_press_get_attachment_image( $params['img'], $size ); ?>
    </div>

    <div class="heading-text">
        <h3 class="title">
            <?php echo esc_html( $params['title'] );?>
        </h3>

        <div class="description">
            <?php echo esc_html( $params['description'] );?>
        </div>
    </div>
</div>
