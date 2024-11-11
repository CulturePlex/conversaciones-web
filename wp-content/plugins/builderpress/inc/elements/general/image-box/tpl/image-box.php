<?php
/**
 * Template for displaying default template Image Box element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/image-box/image-box.php.
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

$el_class      = $params['el_class'];
$el_id         = $params['el_id'];
$box_link      = $params['box_link'];
$layout        = isset( $params['layout'] ) ? $params['layout'] : 'layout-gradient';
$style_layout  = !empty($params['style_layout']) ? $params['style_layout'] : '';
$style_image   = isset($params['style_image']) ? $params['style_image'] : '';
$image_alignment  = isset($params['image_alignment']) ? 'image-'.$params['image_alignment'] : '';
$background_color = isset($params['background-color']) ? $params['background-color'] : '';
$bp_css        = $params['bp_css'];
?>

<div class="bp-element bp-element-image-box  <?php echo $style_layout; ?> <?php echo is_plugin_active('js_composer/js_composer.php') ? vc_shortcode_custom_css_class( $bp_css ) : '';?> <?php echo esc_attr( $el_class ); ?>
<?php echo esc_attr( $style_image ); ?> <?php echo esc_attr($image_alignment); ?> <?php echo esc_attr( $background_color );?> <?php echo esc_attr( $layout ); ?>" <?php echo $el_id ? "id='" . esc_attr( $el_id ) . "'" : '' ?>>
    <?php builder_press_get_template( $layout,
        array(
            'params'       => $params,
            'box_link'     => $box_link,
        ), $template_path );
    ?>
</div>