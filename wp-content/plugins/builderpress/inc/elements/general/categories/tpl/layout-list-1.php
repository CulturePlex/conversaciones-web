<?php
/**
 * Template for displaying default template Categories element layout footer.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/categories/layout-footer.php.
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
    <h3 class="title">
        <?php echo esc_html($title); ?>
    </h3>

    <ul class="list-categories">
        <?php
        foreach ($categories as $get_list_categories):
            ?>
            <li class="cat-item">
                <a href="<?php echo esc_url(get_term_link($get_list_categories->term_id)) ?>"><?php echo $get_list_categories->name  ?></a>
                <?php
                if($show_post_count) {
                    ?>
                    <span class="count"><?php echo $get_list_categories->count ?></span>
                    <?php
                }
                ?>
            </li>
        <?php
        endforeach;
        ?>
    </ul>
</div>