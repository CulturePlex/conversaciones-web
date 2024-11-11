<?php
/**
 * Template for displaying default template St-search-videos element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/st-search-videos/layout-2.php.
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
$show_filter_category = !empty($params['show_filter_category']) ? $params['show_filter_category'] : false;
$parent_category = !empty($params['parent_category']) ? $params['parent_category'] : 0;
$cat_parent = get_category_by_slug($parent_category);
$parent_id = $cat_parent->term_id;
$arg_cats = array(
    'hide_empty' => 0,
    'parent'  => $parent_id,
);
$categories = get_categories( $arg_cats );
?>

<div class="wrap-element">
    <form class="search-form">
        <?php if( $show_filter_category ) {?>
        <label class="wrap-select2" data-style="vblog-search">
            <select name="cat_filter" class='js-select2' >
                <option value=""><?php echo esc_html__('Category','builderpress');?></option>
                <?php foreach( $categories as $category ) { ?>
                <option value="<?php echo esc_html( $category->term_id );?>"><?php echo esc_html( $category->name );?></option>
                <?php }?>
            </select>
        </label>
        <?php }?>

        <input type="search" class="search-field" name="search" placeholder="<?php echo esc_html__( 'Seach for a Movie...', 'builderpress' );?>" autocomplete="off">

        <button class="btn-search">
            <i class="ion ion-android-search"></i>
        </button>
    </form>
    <ul class="list-search-videos list-unstyled"></ul>
</div>
