<?php
/**
 * Template for displaying default template Image Box element coach-life-layout-1
 *
 * This template can be overridden by copying it to yourtheme/builderpress/image-box/coach-life-layout-1.php.
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
    <div class="image-element">
        <?php
            $main_image = (int) $params['img'];
            echo wp_get_attachment_image($main_image,'full');
        ?>
    </div>
</div>
