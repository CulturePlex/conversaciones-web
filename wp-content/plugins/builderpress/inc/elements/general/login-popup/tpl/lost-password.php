<?php
/**
 * Template for displaying default template lost password of Login Popup element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/login-popup/login.php.
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
$text_register = $params['text_register'];
$text_login    = $params['text_login'];
$image         = wp_get_attachment_image_src( $params['popup_image'], 'full' );
$popup_image = '';
if(!empty($image)){
  $popup_image   = $image[0];
}
?>

<div class="login-popup box-lostpass">
    <div class="media-content" style="background-image: url(<?php echo( $popup_image ); ?>)">
    </div>

    <div class="inner-login">

        <h3 class="title">
			<?php if ( get_option( 'users_can_register' ) && $text_register ) { ?>
                <span><a href="#register" class="display-box"
                         data-display=".box-register"><?php echo esc_html( $text_register ); ?></a></span>
			<?php } ?>

			<?php if ( $text_login ) { ?>
                <span class="current-title"><?php esc_html_e( 'Reset Password', 'builderpress' ); ?></span>
			<?php } ?>
        </h3>

        <div class="form-row">
            <form name="lostpasswordform" id="lostpasswordform"
                  action="<?php echo esc_url( network_site_url( 'wp-login.php?action=lostpassword', 'login_post' ) ); ?>"
                  method="post">
                <p class="description"><?php esc_html_e( 'Please enter your username or email address. You will receive a link to create a new password via email.', 'builderpress' ); ?></p>
                <p class="login-username">
                    <input placeholder="<?php esc_attr_e( 'Username or email', 'builderpress' ); ?>"
                           type="text" name="user_login" id="user_login_lostpass"
                           class="input"/>
                </p>
                <input type="hidden" name="redirect_to"
                       value="<?php echo esc_attr( add_query_arg( 'result', 'reset', bp_get_login_page_url() ) ); ?>"/>
                <p>
                    <input type="submit" name="wp-submit-lostpass" id="wp-submit-lostpass"
                           class="button button-primary button-large"
                           value="<?php esc_attr_e( 'Reset password', 'builderpress' ); ?>"/>
                </p>

				<?php do_action( 'lostpassword_form' ); ?>

                <p class="link-bottom"><?php esc_html_e( 'Are you a member? ', 'builderpress' ); ?>
                    <a href="#login" class="display-box"
                       data-display=".box-login"><?php esc_html_e( 'Sign in now', 'builderpress' ); ?></a>
                </p>
            </form>
        </div>
    </div>
</div>