<?php
/**
 * Template for displaying default template register form of Login Form element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/login-form/register.php.
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
?>

<?php if ( get_option( 'users_can_register' ) ) {

	$errors = apply_filters( 'builder-press/login-form/register-errors', array(
		'empty_username'        => esc_html__( 'Please enter a username!', 'builderpress' ),
		'empty_email'           => esc_html__( 'Please type your e-mail address!', 'builderpress' ),
		'username_exists'       => esc_html__( 'This username is already registered. Please choose another one!', 'builderpress' ),
		'email_exists'          => esc_html__( 'This email is already registered. Please choose another one!', 'builderpress' ),
		'invalid_email'         => esc_html__( 'The email address isn\'t correct. Please try again!', 'builderpress' ),
		'invalid_username'      => esc_html__( 'The username is invalid. Please try again!', 'builderpress' ),
		'passwords_not_matched' => esc_html__( 'Passwords must matched!', 'builderpress' )
	) );

	foreach ( $errors as $error => $message ) {
		if ( ! empty( $_GET[ $error ] ) ) { ?>
            <p class="message message-error"><?php echo $message; ?></p>
		<?php }
	} ?>

    <div class="login-form-wrap">
        <h4 class="subtitle"><?php esc_html_e( 'Register', 'builderpress' ); ?></h4>
        <div class="line"></div>
        <h2 class="title"><?php esc_html_e( 'Register to start learning', 'builderpress' ); ?></h2>

        <form name="registerform" id="register-form"
              action="<?php echo esc_url( site_url( 'wp-login.php?action=register', 'login_post' ) ); ?>"
              method="post" novalidate="novalidate">
            <p>
                <input required placeholder="<?php esc_attr_e( 'Username', 'builderpress' ); ?>" type="text"
                       name="user_login" id="user_login" class="input"/>
            </p>

            <p>
                <input required placeholder="<?php esc_attr_e( 'Email Address', 'builderpress' ); ?>"
                       type="email" name="user_email" id="user_email" class="input"/>
            </p>

            <p>
                <input required placeholder="<?php esc_attr_e( 'Password', 'builderpress' ); ?>"
                       type="password" name="password" id="password" class="input"/>
            </p>

            <p>
                <input required placeholder="<?php esc_attr_e( 'Confirm Password', 'builderpress' ); ?>"
                       type="password" name="repeat_password" id="repeat_password" class="input"/>
            </p>

			<?php do_action( 'builder-press/login-form/register-fields' ); ?>

			<?php do_action( 'register_form' ); ?>

            <div class="wrap-fields">


                <p>
                    <?php
                    $register_redirect = get_theme_mod( 'theme_feature_register_redirect', false );
                    if ( empty( $register_redirect ) ) {
                        $register_redirect = add_query_arg( 'result', 'registered', bp_get_login_page_url() );
                    }
                    ?>
                    <input type="hidden" name="redirect_to"
                           value="<?php echo ! empty( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : $register_redirect; ?>"/>
                </p>

                <?php do_action( 'signup_hidden_fields', 'create-another-site' ); ?>

                <p class="submit login-submit">
                    <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large"
                           value="<?php esc_attr_e( 'Sign up', 'builderpress' ); ?>"/>
                </p>

            </div>

        </form>

        <p class="link-bottom"><?php esc_html_e( 'Are you a member? ', 'builderpress' ); ?><a
                    href="<?php echo esc_url( bp_get_login_page_url() ); ?>"><?php esc_html_e( 'Login now', 'builderpress' ); ?></a>
        </p>

        <?php
        // registered successful
        if ( ! empty( $_GET['result'] ) && $_GET['result'] == 'registered' ) { ?>
            <p class="message message-success"><?php esc_html_e( 'Registration is successful. Confirmation will be e-mailed to you.', 'builderpress' ); ?></p>
            <?php return;
        }
        ?>
    </div>

<?php } else { ?>
    <div class="login-form-wrap">
        <h4 class="subtitle"><?php esc_html_e( 'Register', 'builderpress' ); ?></h4>
        <p class="message message-error"><?php esc_html_e( 'Your site does not allow users registration.', 'builderpress' ); ?></p>
    </div>

<?php } ?>