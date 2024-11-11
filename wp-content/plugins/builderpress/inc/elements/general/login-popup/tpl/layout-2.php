<?php
/**
 * Template for displaying default template Login Popup element layout 2.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/login-popup/layout-2.php.
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
$color_label = '';
$color_label .= $params['color_label'] ? 'color:' . $params['color_label'] . '; ' : '';
$color_label = $color_label ? ' style="' . $color_label . '"' : '';
?>
<?php if ( is_user_logged_in() ) { ?>
    <?php
        do_action('thim_current_user');
    ?>
    <a class="logout" title="<?php echo esc_attr__( 'Logout', 'builderpress' ) ?>"
       href="javascript:void(0)">
        <i class="ion-android-person"></i>

        <span class="text-logout"<?php echo $color_label; ?>><?php echo esc_html__('Account', 'builderpress' );?></span>
    </a>
    <?php
        do_action('thim_menu_account');
    ?>
<?php } else { ?>
    <a class="login" data-active=".box-login" data-effect="mfp-zoom-in"
       title="<?php echo esc_attr( $params['text_login'] ) ?>"
       href="#bp-popup-login"<?php echo $color_label; ?>><i class="ion-android-person"></i></a>
<?php } ?>