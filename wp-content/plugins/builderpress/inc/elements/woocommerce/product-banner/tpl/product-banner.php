<?php
/**
 * Template for displaying default template Product-isotope element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/product-isotope/product-isotope.php.
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


$template_path = $params['template_path'];

$layout      = isset( $params['layout'] ) ? $params['layout'] : 'layout-1';
$images      = isset( $params['images'] ) ? $params['images'] : '';
$images_2    = isset( $params['images-2'] ) ? $params['images-2'] : '';
$images_3    = isset( $params['images-3'] ) ? $params['images-3'] : '';
$style_layout = !empty($params['style_layout']) ? $params['style_layout'] : '';
$bn_size            = isset( $params['size'] ) ? $params['size'] : '';;
$bn_text_line       = $params['bn_text_line'];
$bn_title_bottom    = $params['bn_title_bottom'];
$bn_title_large     = $params['bn_title_large'];
$bn_title_top       = $params['bn_title_top'];
$bn_description     = $params['bn_description'];
$bn_link            = $params['bn_link'];

$el_class    = $params['el_class'];
$el_id       = $params['el_id'];

?>

<div class="bp-element bp-element-product-banner woocommerce <?php echo esc_attr( $layout ); ?> <?php echo esc_attr($style_layout); ?> <?php echo esc_attr( $el_class ); ?>" <?php echo $el_id ? "id='" . esc_attr( $el_id ) . "'" : '' ?>>

    <?php builder_press_get_template( $layout, array(
        'params'      => $params,
        'images'      => $images,
        'images-2'    => $images_2,
        'images-3'    => $images_3,
        'size'        => $bn_size,
        'bn_text_line'    => $bn_text_line,
        'bn_title_bottom' => $bn_title_bottom,
        'bn_title_large'  => $bn_title_large,
        'bn_title_top'    => $bn_title_top,
        'bn_description'  => $bn_description,
        'bn_link'         => $bn_link,
    ), $template_path ); ?>

</div>