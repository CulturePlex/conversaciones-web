<?php
/**
 * Template for displaying default template Call To Action element layout 6.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/call-to-action/layout-6.php.
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
$font_awesome = $params['font_awesome'];
$link_email   = $params['link_email'];

?>
<div class="wrap-element">
    <div class="content">
        <?php if($font_awesome) { ?>
            <i class="<?php echo $font_awesome ?>"></i>
        <?php
            }
        ?>
        <?php
            if($link_email):
        ?>
            <a href="<?php echo esc_url($link_email['url']) ?>"><?php echo esc_html($link_email['title']) ?></a>
        <?php
            endif;
        ?>
    </div>

    <?php
        if($action):
    ?>
        <a href="<?php echo esc_url($action['url']) ?>" class="element-link">
            <?php echo esc_html($action['title']) ?>
        </a>
    <?php
        endif;
    ?>
</div>
