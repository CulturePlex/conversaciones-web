<?php
/**
 * Template for displaying default template login form of Login Form element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/login-form/login.php.
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
 * @var $wp_query WP_Query
 */
// get id page added shortcode "Thim: Login Form"
update_option( 'thim_login_page', get_the_ID() );

global $wp_query;
$theme_options_data = get_theme_mods();
?>

<div class="login-form-wrap">
<?php
        // reset password message
        if ( ! empty( $_GET['result'] ) && $_GET['result'] == 'reset' ) { ?>
            <p class="message message-success"><?php esc_html_e( 'Check your email to get a link to create a new password.', 'builderpress' ); ?></p>
            <?php return;
        }
        ?>
    <h4 class="subtitle"><?php esc_html_e( 'Login', 'builderpress' ); ?></h4>
    <div class="line"></div>
    <h2 class="title"><?php esc_html_e( 'Login with your site account', 'builderpress' ); ?></h2>

	<?php $login_redirect = get_theme_mod( 'theme_feature_login_redirect', false );
	if ( empty( $login_redirect ) ) {
		$login_redirect = apply_filters( 'thim_default_login_redirect', home_url() );
	}
	$redirect = ! empty( $_REQUEST['redirect_to'] ) ? esc_url( $_REQUEST['redirect_to'] ) : $login_redirect; ?>

    <form name="loginform" id="loginform" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>"
          method="post" novalidate="novalidate">
        <p class="login-username">
            <input required type="text" name="log"
                   placeholder="<?php esc_html_e( 'Username or email *', 'builderpress' ); ?>" id="user_login"
                   class="input" value="" size="20"/>
        </p>
        <p class="login-password">
            <input required type="password" name="pwd"
                   placeholder="<?php esc_html_e( 'Password *', 'builderpress' ); ?>" id="user_pass" class="input"
                   value="" size="20"/>
            <span id="show_pass"><i class="fa fa-eye"></i></span>
        </p>

		<?php do_action( 'login_form' ); ?>

        <p class="forgetmenot login-remember">
            <label for="rememberme"><input name="rememberme" type="checkbox" id="rememberme"
                                           value="forever"/> <?php esc_html_e( 'Remember Me', 'builderpress' ); ?>
            </label>
        </p>

        <div class="wrap-fields">
            <p class="submit login-submit">
                <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large"
                       value="<?php esc_attr_e( 'Login', 'builderpress' ); ?>"/>
                <input type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect ); ?>"/>
                <!--<input type="hidden" name="testcookie" value="1"/>-->
            </p>
			<?php echo '<a class="lost-pass-link" href="' . thim_get_lost_password_url() . '" title="' . esc_attr__( 'Lost Password', 'builderpress' ) . '">' . esc_html__( 'Lost your password?', 'builderpress' ) . '</a>'; ?>
        </div>



    </form>

	<?php $registration_enabled = get_option( 'users_can_register' );
	if ( $registration_enabled ) {
		echo '<p class="link-bottom">' . esc_html__( 'Not a member yet? ', 'builderpress' ) . '<a href="' . esc_url( thim_get_register_url() ) . '">' . esc_html__( 'Register now', 'builderpress' ) . '</a></p>';
	} ?>

    <?php
    // action failed notice
    if ( isset( $_GET['result'] ) && $_GET['result'] == 'failed' ) { ?>
        <p class="message message-error"><?php esc_html_e( 'Invalid username or password. Please try again!', 'builderpress' ); ?></p>
    <?php }
    ?>
</div>