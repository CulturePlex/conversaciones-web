<?php
/**
 * Template for displaying default template Posts element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/posts/categories.php.
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

// global params
//$template_path = $params['template_path'];

/**
 * @var $params array - shortcode params
 */
$template_path        = isset($params['template_path']) ? $params['template_path'] : 'layout-list-1' ;
$category             = $params['category'];
$layout               = $params['layout'];
$number               = $params['number'];
$show_post_count      = $params['show_post_count'];
$title                = $params['title'];
$style_layout         = !empty($params['style_layout']) ? $params['style_layout'] : '';
$el_class             = $params['el_class'];
$el_id                = $params['el_id'];
$bp_css               = $params['bp_css'];
$cat = get_category_by_slug($category);
$cat_id = $cat ? $cat->term_id : 0;
$args = array(
    'type'          => 'post',
    'hide_empty'    => 0,
    'parent'        => $cat_id,
    'number'        => $number,
);
$categories = get_categories($args);
?>

<div class="bp-element bp-element-categories <?php echo is_plugin_active('js_composer/js_composer.php') ? vc_shortcode_custom_css_class( $bp_css ) : '';?> <?php echo esc_attr( $el_class ); ?> <?php echo esc_attr( $layout ); ?> <?php echo esc_attr($style_layout); ?>" <?php echo $el_id ? "id='" . esc_attr( $el_id ) . "'" : '' ?>>
    <?php

	builder_press_get_template( $layout, array(
        'categories'           => $categories,
        'title'                => $title,
        'show_post_count'      => $show_post_count,
    ), $template_path );

	?>
</div>

