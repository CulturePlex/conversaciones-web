<?php
/**
 * Template for displaying default template Categories element layout sidebar.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/categories/layout-sidebar.php.
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
 * @var $categories
 * @var show_post_count
 */
?>
<div class="wrap-element">
    <h3 class="title-categories">
        <?php echo esc_html($title); ?>
    </h3>

    <div class="list-categories">
        <?php
        foreach ($categories as $get_list_categories):
            $categories_id = $get_list_categories->term_id;
            $get_categories = get_term_meta($categories_id, 'thim_cat_image', true);
            ?>
            <a href="<?php echo esc_url(get_term_link($get_list_categories->term_id)) ?>" class="item-category">
                <?php
                    if(!empty($get_categories['url'])):
                ?>
                    <img src="<?php echo esc_url($get_categories['url']) ?>" alt="<?php echo esc_html__('image-categories','builderpress') ?>">
                <?php endif; ?>

                <div class="content">
                    <h3 class="title">
                        <?php echo $get_list_categories->name  ?>
                    </h3>
                </div>
            </a>
        <?php
        endforeach;
        ?>
    </div>
</div>