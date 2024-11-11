<?php
/**
 * Template for displaying default template Image Box element layout-gradient.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/image-box/layout-gradient.php.
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
$url_image = wp_get_attachment_image_src( $params['img'], 'full' );

?>
<div class="image-box" style="background-image: url(<?php echo esc_url( $url_image[0] ); ?>);">
    <a href="<?php if(!empty($box_link['url'])){echo $box_link['url'];} ?>">
        <div class="icon-image">
            <?php echo wp_get_attachment_image( $params['img-icon'], 'full' );?>
        </div>

        <div class="content">
            <h3 class="title">
                <?php echo esc_html( $params['title'] );?>
            </h3>

            <div class="description">
                <?php echo esc_html( $params['description'] );?>
            </div>
        </div>
    </a>

</div>