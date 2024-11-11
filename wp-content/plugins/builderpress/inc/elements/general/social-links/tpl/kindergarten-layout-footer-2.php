<?php

/**
 * Template for displaying default template Social links element layout default.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/social-links/default.php.
 *
 * @author      ThimPress
 * @package     BuilderPress/Templates
 * @version     1.0.0
 * @author      Thimpress, vinhnq
 */

/**
 * Prevent loading this file directly
 */
defined('ABSPATH') || exit;

/**
 * @var $links
 * @var $title
 */
?>

<?php if ($title) { ?>
    <h4 class="title"><?php echo esc_html($title); ?></h4>
<?php } ?>

<div class="wrap-element">
    <?php foreach ($links as $link) {
        if (!empty($link['icon']) || !empty($link['icon_upload'])) {
            $icon = $link['icon'];
            $slug = str_replace('fa fa-', '', $icon); ?>

            <a target="_blank" href="<?php echo esc_url($link['url']); ?>" class="social-item">
                <?php if ($icon) {
                    if ($link['icon'] == 'fa fa-twitter') {
                        $icon = "fa fa-x-twitter";
                    }
                ?>
                    <i class="social-icon <?php echo esc_attr($icon); ?>"></i>
                <?php  } ?>
            </a>
    <?php }
    } ?>
</div>