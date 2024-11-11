<?php
/**
 * Template for displaying default template Image Box element vblog-layout-4
 *
 * This template can be overridden by copying it to yourtheme/builderpress/image-box/vblog-layout-4.php.
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
$size = apply_filters( 'builder-press/image-box/vblog-layout-4/image-size', '360x206' );
?>

<?php if( $params['box_link'] ) {?>
    <a href="<?php echo esc_url( $params['box_link']['url'] ); ?>" class="wrap-element">
        <?php  builder_press_get_attachment_image( $params['img'], $size ); ?>
        <div class="content">
            <h3 class="title">
                <?php echo esc_html( $params['title'] );?>
            </h3>
        </div>
    </a>
<?php }?>
