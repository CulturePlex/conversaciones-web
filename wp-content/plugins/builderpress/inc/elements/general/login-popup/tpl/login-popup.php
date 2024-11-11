<?php
/**
 * Template for displaying default template Login Popup element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/login-popup.php.
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

$layout   = isset( $params['layout'] ) ? $params['layout'] : 'layout-1';
$el_class = $params['el_class'];
$el_id    = $params['el_id'];
$bp_css   = $params['bp_css'];
$show_icon = ( isset( $params['show_icon'] ) && $params['show_icon'] != '' ) ? ' show-icon' : '';
$style_layout = !empty($params['style_layout']) ? $params['style_layout'] : '';
?>

<div class="bp-element bp-element-login-popup <?php echo is_plugin_active('js_composer/js_composer.php') ? vc_shortcode_custom_css_class( $bp_css ) : '';?>  <?php echo esc_attr( $el_class ); ?> <?php echo esc_attr( $layout ); ?> <?php echo esc_attr($style_layout); ?>" <?php echo $el_id ? "id='" . esc_attr( $el_id ) . "'" : '' ?>>
    <div class="login-links<?php echo $show_icon;?>">

		<?php builder_press_get_template( $layout, array( 'params' => $params, ), $template_path ); ?>

    </div>

	<?php if ( ! is_user_logged_in() ) { ?>
        <div id="bp-popup-login"
             class="white-popup mfp-with-anim mfp-hide <?php echo ( ! empty( $params['shortcode'] ) ) ? 'has-shortcode' : ''; ?>">

            <div class="loginwrapper">
                <!--                register-->
				<?php if ( get_option( 'users_can_register' ) ) {
					builder_press_get_template( 'register', array( 'params' => $params ), $template_path );
				} ?>

                <!--login-->
				<?php builder_press_get_template( 'login', array( 'params' => $params ), $template_path ); ?>

                <!--                lost password-->
				<?php builder_press_get_template( 'lost-password', array( 'params' => $params ), $template_path ); ?>
            </div>

        </div>
	<?php } ?>
</div>




