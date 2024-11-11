<?php
/**
 * Template for displaying default template Twitter element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/twitter/twitter.php.
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

/**
 * @var $params array - shortcode params
 */
$layout   = $params['layout'];
$title    = $params['title'];
$username = $params['username'];
$number   = $params['number'];
$style_layout = !empty($params['style_layout']) ? $params['style_layout'] : '';
$el_class = $params['el_class'];
$el_id    = $params['el_id'];
$bp_css   = $params['bp_css'];

$config = apply_filters( 'builder-press/twitter/config', array(
	'consumer_key'        => 'fCuXeJBzIhikOjNFmh7FC7Cpz',
	'consumer_secret'     => 'tLefeE8nyARq1aIAJF7GSIhAoAxQiAMU9aX0RE79F6IVAcfA7J',
	'access_token'        => '3546925700-hzs7KwBYCqsZxP6sYRtjIS4V1TIMgh0zY0Hlhb5',
	'access_token_secret' => 'TmI0MW7QH7KTfdePVX1Swsie7i2K1RziunVc46y0wOALn'
) );

/**
 * @var $consumer_key
 * @var $consumer_secret
 * @var $access_token
 * @var $access_token_secret
 */
extract( $config );

if ( $username && $number && $consumer_key && $consumer_secret && $access_token && $access_token_secret ) {

	$twitter_config = get_option( 'bp_element_twitter', $config );

	$transient_name = 'list_tweets_' . $username;

	$data   = get_transient( $transient_name );
	$tweets = json_decode( $data, true );

	if ( false === $data || isset( $twitter['errors'] ) ) {
		$token_name = 'twitter_token_' . $username;
		$token      = ! empty( $twitter_config[ $token_name ] ) ? $twitter_config[ $token_name ] : false;
		if ( ! $token ) {
			// preparing credentials
			$credentials = $consumer_key . ':' . $consumer_secret;
			$toSend      = base64_encode( $credentials );

			// http post arguments
			$args_twitter = array(
				'method'      => 'POST',
				'httpversion' => '1.1',
				'blocking'    => true,
				'headers'     => array(
					'Authorization' => 'Basic ' . $toSend,
					'Content-Type'  => 'application/x-www-form-urlencoded;charset=UTF-8'
				),
				'body'        => array( 'grant_type' => 'client_credentials' )
			);

			add_filter( 'https_ssl_verify', '__return_false' );
			$response = wp_remote_post( 'https://api.twitter.com/oauth2/token', $args_twitter );

			$keys = json_decode( wp_remote_retrieve_body( $response ) );

			if ( $keys ) {
				// saving token to wp_options table
				$token                         = $keys->access_token;
				$twitter_config[ $token_name ] = $token;
				update_option( 'bp_element_twitter', $twitter_config );
			}
		}
		// we have bearer token whether we obtained it from API or from options
		$args_twitter = array(
			'httpversion' => '1.1',
			'blocking'    => true,
			'headers'     => array(
				'Authorization' => "Bearer $token"
			)
		);

		add_filter( 'https_ssl_verify', '__return_false' );
		$api_url  = 'https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=' . $username . '&count=' . $number;
		$response = wp_remote_get( $api_url, $args_twitter );
		set_transient( $transient_name, wp_remote_retrieve_body( $response ), 600 );
	}

	$tweets = json_decode( get_transient( $transient_name ), true );

} ?>

<?php if ( ! empty( $tweets ) ) { ?>
    <div class="bp-element bp-element-twitter <?php echo is_plugin_active('js_composer/js_composer.php') ? vc_shortcode_custom_css_class( $bp_css ) : '';?> <?php echo esc_attr( $el_class ); ?> <?php echo esc_attr( $layout ); ?>  <?php echo esc_attr($style_layout); ?>" <?php echo $el_id ? "id='" . esc_attr( $el_id ) . "'" : '' ?>>
		<?php builder_press_get_template( $layout, array(
			'title'  => $title,
			'tweets' => $tweets
		), $template_path ); ?>
    </div>
<?php } ?>
