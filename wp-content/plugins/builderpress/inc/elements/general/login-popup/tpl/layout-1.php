<?php
/**
 * Template for displaying default template Login Popup element layout 1.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/login-popup/layout-1.php.
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
    <?php if(isset($params['user_menu']) && $params['user_menu']) {?>
        <?php
        do_action('thim_current_user');
        ?>
        <a class="logout" title="<?php echo esc_attr__( 'Logout', 'builderpress' ) ?>"
           href="javascript:void(0)">
            <span class="text-logout"<?php echo $color_label; ?>>
                <?php echo esc_html( $params['text_logout'] ); ?>
            </span>
        </a>
        <?php
        do_action('thim_menu_account');
        ?>
    <?php } else {?>
        <a class="logout" title="<?php echo esc_attr__( 'Logout', 'builderpress' ) ?>"
           href="<?php echo esc_url(wp_logout_url(( ! empty( $_SERVER['HTTPS'] ) ? "https" : "http" ) . '://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]));?>">
            <span class="text-logout"<?php echo $color_label; ?>>
                <?php echo esc_html( $params['text_logout'] ); ?>
            </span>
        </a>
    <?php }?>
<?php } else { ?>
    <a class="login" data-active=".box-login" data-effect="mfp-zoom-in"
       title="<?php echo esc_attr( $params['text_login'] ) ?>"
       href="#bp-popup-login"<?php echo $color_label; ?>><?php echo esc_html( $params['text_login'] ); ?></a>
    <?php if ( get_option( 'users_can_register' ) && $params['text_register'] != '' ) { ?>
        <span class="line"> / </span>
        <a class="register" data-active=".box-register" data-effect="mfp-zoom-in"
           title="<?php echo esc_attr( $params['text_register'] ) ?>"
           href="#bp-popup-login"<?php echo $color_label; ?>><?php echo esc_html( $params['text_register'] ); ?></a>
    <?php } ?>
<?php } ?>