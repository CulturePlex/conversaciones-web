<?php
/**
 * Template for displaying default template Login Form element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/login-form/login-form.php.
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

// global params
$template_path = $params['template_path'];
$style_layout = !empty($params['style_layout']) ? $params['style_layout'] : '';
$el_class = $params['el_class'];
$el_id    = $params['el_id'];
$bp_css   = $params['bp_css'];
?>

<div class="bp-element bp-element-login-form <?php echo esc_attr($style_layout); ?> <?php echo is_plugin_active('js_composer/js_composer.php') ? vc_shortcode_custom_css_class( $bp_css ) : '';?> <?php echo esc_attr( $el_class ); ?>" <?php echo $el_id ? "id='" . esc_attr( $el_id ) . "'" : '' ?>>

	<?php if ( is_user_logged_in() ) { ?>
        <div class="user-logged-in">
            <p class="message message-success">
				<?php echo sprintf( wp_kses( __( 'You have logged in. <a href="%s">Sign Out</a>', 'builderpress' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( wp_logout_url( apply_filters( 'builder-press/login-form/logout-redirect', home_url() ) ) ) ); ?>
            </p>
        </div>
		<?php return;
	} ?>

    <?php if ( isset( $_GET['result'] ) && $_GET['result'] == 'changed' ) : ?>
        <?php echo '<p class="message message-success">' . wp_kses( __( 'Password changed. You can login now.', 'eduma' ) ) . '</p>'; ?>
        <p></p>
    <?php endif; ?>

	<?php
	if ( isset( $_GET['result'] ) || isset( $_GET['action'] ) ) {

		// register action
		if ( ! empty( $_GET['action'] ) && $_GET['action'] == 'register' ) {
			builder_press_get_template( 'register', array( 'params' => $params ), $template_path );

			return;
		}

		// lost password action
		if ( ! empty( $_GET['action'] ) && $_GET['action'] == 'lostpassword' ) {
			builder_press_get_template( 'lost-password', array( 'params' => $params ), $template_path );

			return;
		}

		// reset password action
        if ( ! empty( $_GET['action'] ) && $_GET['action'] == 'rp' ) {
			builder_press_get_template( 'reset-password', array( 'params' => $params ), $template_path );

			return;
		}






	}

	// login action
	builder_press_get_template( 'login', array( 'params' => $params ), $template_path );
	?>

</div>