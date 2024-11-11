<?php
/**
 * Template for displaying default template St-list-categories element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/st-list-categories/st-list-categories.php.
 *
 * @author      ThimPress
 * @package     BuilderPress/Templates
 * @version     1.0.0
 * @author      Thimpress, vinhnq
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

// global params
$template_path = $params['template_path'];

$layout      = isset( $params['layout'] ) ? $params['layout'] : 'vblog-layout-slider-2';

$el_class    = $params['el_class'];
$title = $params['title'];
$sub_title = $params['sub_title'];
$parent_category = $params['parent_category'];
$type_category = $params['type_category'];
$number = $params['number'];
$el_id       = $params['el_id'];
$bp_css      = $params['bp_css'];
$bp_css_tablet = $params['bp_css_tablet'];
$bp_css_mobile = $params['bp_css_mobile'];
$data_tablet = $bp_css_tablet ? 'data-class-tablet="' . bp_custom_css_class_shortcode($bp_css_tablet) . '"' : '';
$data_mobile = $bp_css_mobile ? 'data-class-mobile="' . bp_custom_css_class_shortcode($bp_css_mobile) . '"' : '';
$style_layout = !empty($params['style_layout']) ? $params['style_layout'] : '';
$cat_parent = get_category_by_slug($parent_category);
$parent_id = !empty($cat_parent) ? $cat_parent->term_id : 0;

$arg_cats = array(
    'hide_empty' => 0,
   'number' => $number,
    'parent'  => $parent_id,
);
if( $type_category == 'trending' ) {
    $arg_cats['meta_key'] = 'thim_cat_trending';
    $arg_cats['meta_value'] = 'on';
}


$categories = get_categories( $arg_cats );
?>

<div class="bp-element bp-element-st-list-categories <?php echo esc_attr( $el_class ); ?> <?php echo esc_attr( $layout ); ?>  <?php echo esc_attr($style_layout); ?> <?php echo is_plugin_active('js_composer/js_composer.php') ? vc_shortcode_custom_css_class( $bp_css ) : '';?>" <?php echo $el_id ? " id='" . esc_attr( $el_id ) . "'" : '' ?> <?php echo $data_tablet;?> <?php echo $data_mobile;?>>
    <?php builder_press_get_template( $layout,
        array(
            'params'      => $params,
            'title'      => $title,
            'sub_title' => $sub_title,
            'categories' => $categories
        ),
        $template_path );
    ?>
</div>