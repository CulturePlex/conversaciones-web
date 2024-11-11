<?php
/**
 * Template for displaying default template reset password form of Login Form element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/login-form/reset-password.php.
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

$errors = apply_filters( 'builder-press/login-form/reset-password-errors', array(
	'expired_key'      => esc_html__( 'The key is expired. Please try again!', 'builderpress' ),
	'invalid_key'      => esc_html__( 'The key is invalid. Please try again!', 'builderpress' ),
	'invalid_password' => esc_html__( 'The password is invalid. Please try again!', 'builderpress' )
) );

foreach ( $errors as $error => $message ) {
	if ( ! empty( $_GET[ $error ] ) ) { ?>
        <p class="message message-error"><?php echo $message; ?></p>
	<?php }
} ?>

<div class="login-form-wrap">
    <h4 class="subtitle"><?php esc_html_e( 'Change Password', 'builderpress' ); ?></h4>
    <div class="line"></div>
    <h2 class="title"><?php esc_html_e( 'Change password your account', 'builderpress' ); ?></h2>

	<?php
	$errors = new WP_Error();
	$user   = check_password_reset_key( $_GET['key'], $_GET['login'] );
	$rp_cookie       = 'wp-resetpass-' . COOKIEHASH;
	list( $rp_path ) = explode( '?', wp_unslash( $_SERVER['REQUEST_URI'] ) );
	$value = sprintf( '%s:%s', wp_unslash( $_GET['login'] ), wp_unslash( $_GET['key'] ) );
	setcookie( $rp_cookie, $value, 0, $rp_path, COOKIE_DOMAIN, is_ssl(), true );
	if ( is_wp_error( $user ) ) {
		if ( $user->get_error_code() === 'expired_key' ) {
			$errors->add( 'expiredkey', esc_html__( 'Sorry, that key has expired. Please try again.', 'builderpress' ) );
		} else {
			$errors->add( 'invalidkey', esc_html__( 'Sorry, that key does not appear to be valid.', 'builderpress' ) );
		}
	} ?>

    <form name="resetpassform" id="resetpassform" action="<?php echo site_url( 'wp-login.php?action=resetpass' ); ?>"
          method="post" autocomplete="off">
		<?php
		// this prevent automated script for unwanted spam
		if ( function_exists( 'wp_nonce_field' ) ) {
			wp_nonce_field( 'rs_user_reset_password_action', 'rs_user_reset_password_nonce' );
		} ?>
        <input type="hidden" id="user_login" name="login" value="<?php echo isset( $_GET['login'] ) ? esc_attr( $_GET['login'] ) : ''; ?>" autocomplete="off">
        <input type="hidden" id="key" name="key"
               value="<?php echo isset( $_GET['key'] ) ? esc_attr( $_GET['key'] ) : ''; ?>"/>

        <p>
            <input placeholder="<?php esc_attr_e( 'New password *', 'builderpress' ); ?>" type="password" name="password"
                   id="password" class="input" required/>
        </p>

		<?php do_action( 'resetpass_form', $user ); ?>

        <div class="resetpass-submit">
            <input type="submit" name="submit" id="resetpass-button" class="button"
                   value="<?php esc_attr_e( 'Reset Password', 'builderpress' ); ?>"/>
        </div>

        <p class="message-notice"></p>

        <?php
        // reset password message
        if ( ! empty( $_GET['result'] ) && $_GET['result'] == 'reset' ) { ?>
            <p class="message message-success"><?php esc_html_e( 'Check your email to get a link to create a new password.', 'builderpress' ); ?></p>
            <?php return;
        }
        ?>

    </form>

    <p class="link-bottom"><?php echo wp_get_password_hint(); ?></p>
</div>