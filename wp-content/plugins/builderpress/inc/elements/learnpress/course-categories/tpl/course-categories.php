<?php
/**
 * Template for displaying default template Course Categories element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/course-categories/course-categories.php.
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

$show_count     = $params['show_count'] ? 1 : 0;
$show_hierarchy = $params['show_hierarchy'] ? 1 : 0;
$style_layout = !empty($params['style_layout']) ? $params['style_layout'] : '';
$el_class       = $params['el_class'];
$el_id          = $params['el_id'];
$bp_css         = $params['bp_css'];

$query = array(
	'taxonomy'   => 'course_category',
	'orderby'    => 'name',
    'hide_empty' => false,
	'show_count' => $show_count,
	'hierarchy'  => $show_hierarchy
);

$categories = get_categories( apply_filters( 'builder-press/course-categories-query', $query ) );
?>

<div class="bp-element bp-element-course-categories <?php echo esc_attr($style_layout); ?> <?php echo is_plugin_active('js_composer/js_composer.php') ? vc_shortcode_custom_css_class( $bp_css ) : '';?> <?php echo esc_attr( $el_class ); ?>" <?php echo $el_id ? "id='" . esc_attr( $el_id ) . "'" : '' ?>>
    <?php if( isset($params['title']) ) {?>
        <h3 class="title"><?php echo esc_html( $params['title'] ); ?></h3>
    <?php }?>
    <ul>
        <?php foreach ($categories as $category) {?>
        <li class="cat-item">
            <a href="<?php echo esc_url( get_category_link( $category->term_id ) );?>"><?php echo esc_html($category->name);?></a>
            <?php if( $params['show_count'] ) {?>
            <span class="count"><?php echo esc_html($category->count);?></span>
            <?php }?>
        </li>
        <?php }?>
    </ul>
</div>