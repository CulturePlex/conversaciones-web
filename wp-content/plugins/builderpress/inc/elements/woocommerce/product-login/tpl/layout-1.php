<?php
/**
 * Template for displaying default template product Login element layout 1.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/product-login/layout-1.php.
 *
 * @author      ThimPress
 * @package     BuilderPress/Templates
 * @version     1.0.0
 * @author      Thimpress, leehld
 */

/**
 * Prevent loading this file directly
 */
defined('ABSPATH') || exit;

/**
 * @var $params array - shortcode params
 */
?>
<?php if ( is_user_logged_in() ) { ?>
    <div class="login-links">
        <a href="javascript:void(0)" class="logout"><span><?php echo esc_html($text_logout); ?></span></a>
        <?php do_action('thim_woo_account') ?>
    </div>
<?php }else{ ?>
    <div class="login-links">
        <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="login"><span><?php echo esc_html($text_login); ?></span></a>
    </div>
<?php } ?>