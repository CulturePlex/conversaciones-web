<?php
/**
 * Plugin Name: BuilderPress
 * Plugin URI: http://thimpress.com/
 * Description: Full of features for page builders: Visual Composer, Site Origin, Elementor
 * Author: ThimPress
 * Version: 2.0.3
 * Requires PHP: 7.0
 * Text Domain: builderpress
 * Author URI: http://thimpress.com
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'BuilderPress' ) ) {
	/**
	 * Class BuilderPress
	 */
	final class BuilderPress {

		/**
		 * @var null
		 */
		private static $_instance = null;

		/**
		 * @var string
		 */
		public $_version = '1.2.8';

		/**
		 * BuilderPress constructor.
		 */
		public function __construct() {

			if ( ! function_exists( 'is_plugin_active' ) ) {
				include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			}

			// Depend on Visual Composer
			if ( ! ( is_plugin_active( 'js_composer/js_composer.php' ) || is_plugin_active( 'elementor/elementor.php' ) || is_plugin_active( 'siteorigin-panels/siteorigin-panels.php' ) ) ) {
				add_action( 'admin_notices', array( $this, 'admin_notices' ) );
			} else {
				$this->define_constants();
				$this->includes();
				$this->init_hooks();
			}
		}

		/**
		 * Define constants.
		 */
		private function define_constants() {
			define( 'BUILDER_PRESS_FILE', __FILE__ );
			define( 'BUILDER_PRESS_PATH', dirname( __FILE__ ) . '/' );
			define( 'BUILDER_PRESS_URL', plugins_url( '', __FILE__ ) . '/' );
			define( 'BUILDER_PRESS_INC', BUILDER_PRESS_PATH . 'inc/' );
			define( 'BUILDER_PRESS_VER', $this->_version );
			define( 'BUILDER_PRESS_PREMIUM', 'https://thimpress.com/' );
		}

		/**
		 * Include files.
		 */
		private function includes() {

			require_once( BUILDER_PRESS_INC . 'admin/class-bp-admin.php' );

			require_once( BUILDER_PRESS_INC . 'aq_resizer.php' );
			require_once( BUILDER_PRESS_INC . 'class-bp-assets.php' );

			require_once( BUILDER_PRESS_INC . 'abstracts/class-bp-abstract-config.php' );

			require_once( BUILDER_PRESS_INC . 'builders/class-bp-builders.php' );

			// visual composer
			if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
				require_once( BUILDER_PRESS_INC . 'builders/visual-composer/class-bp-vc.php' );
			}

			// siteorigin
			if ( is_plugin_active( 'siteorigin-panels/siteorigin-panels.php' ) ) {
				require_once( BUILDER_PRESS_INC . 'builders/siteorigin/class-bp-so.php' );
			}

			// elementor
			if ( is_plugin_active( 'elementor/elementor.php' ) ) {
				require_once( BUILDER_PRESS_INC . 'builders/elementor/class-bp-el.php' );
			}

			require_once( BUILDER_PRESS_INC . 'functions.php' );
		}

		/**
		 * Init hook.
		 */
		public function init_hooks() {

			// plugin links in admin list plugins
			add_filter( 'plugin_action_links_builderpress/builderpress.php', array( __CLASS__, 'plugin_links' ) );

			add_action( 'plugins_loaded', array( $this, 'init_elements' ) );
		}

		/**
		 * Init elements config.
		 */
		public function init_elements() {
			$elements = self::get_elements();

			if ( ! is_array( $elements ) ) {
				return;
			}

			foreach ( $elements as $plugin => $group ) {
				foreach ( $group as $element ) {

					$file_config = BUILDER_PRESS_INC . "elements/$plugin/$element/config.php";

					if ( file_exists( $file_config ) ) {
						require_once $file_config;
					}
				}
			}
		}

		/**
		 * Get all features.
		 *
		 * @return mixed
		 */
		public static function get_elements() {
			$elements = array(
				'general'                  => array(
					'brands',
					'heading',
					'counter-box',
					'counters',
					'services',
					'our-team',
					'features',
					'pricing-table',
					'testimonials',
					'call-to-action',
					'social-links',
					'google-map',
					'google-maps',
					'video-box',
					'button',
					'login-popup',
					'search-posts',
					'icon-box',
					'posts',
					'twitter',
					'grid-images',
					'tabs',
					'countdown',
					'steps',
					'accordion',
					'login-form',
					'test',
					'image-box',
					'images-slide',
					'slide-image-box',
					'slide',
					'gallery-images',
					'newsletter',
					'categories',
					'banner',
				),
				'woocommerce'              => array(
					'product-carousel',
					'product-filter',
					'product-banner',
					'product-search',
					'products',
					'product-login',
				),
				'learnpress'               => array(
					'course-details',
					'list-courses',
					'list-instructors',
					'course-categories',
					'search-courses',
				),
				'learnpress-course-review' => array(
					'course-reviews',
				),
				'learnpress-collections'   => array(
					'course-collections',
				),
				'learnpress-co-instructor' => array(
					'list-instructors',
				),
				'wp-events-manager'        => array(
					'list-events',
					'event-calendar',
					'event-categories',
				),
				'Stellar-video-player'     => array(
					'st-list-videos',
					'st-list-categories',
					'st-search-videos',
				),
			);

			// disable elements when depends plugin not active
			foreach ( $elements as $plugin => $_elements ) {
				if ( $plugin == 'Stellar-video-player' ) {
					if ( ! is_plugin_active( 'Stellar-video-player/video-player.php' ) ) {
						unset( $elements[ $plugin ] );
					}
				} else {
					if ( $plugin != 'general' && ! is_plugin_active( "$plugin/$plugin.php" ) ) {
						unset( $elements[ $plugin ] );
					}
				}
			}

			return apply_filters( 'builder-press/elements', $elements );
		}

		/**
		 * @param $links
		 *
		 * @return array
		 */
		public static function plugin_links( $links ) {
			$links[] = '<a href="' . BUILDER_PRESS_PREMIUM . '" target="_blank" class="buildpress-premium-link">' . __( 'Upgrade to premium', 'builderpress' ) . '</a>';

			return $links;
		}

		/**
		 * Admin notice
		 */
		public function admin_notices() {
			?>
			<div class="notice notice-error">
				<p>
					<?php
					echo wp_kses(
						__( '<strong>BuilderPress</strong> plugin supports for <strong>Visual Composer, Siteorigin or Elementor</strong>. Please install and activate one of the page builders.', 'builderpress' ),
						array(
							'strong' => array(),
						)
					);
					?>
				</p>
			</div>
			<?php
		}

		/**
		 * @return null|BuilderPress
		 */
		public static function instance() {
			if ( ! self::$_instance ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}
	}
}

if ( ! function_exists( 'BuilderPress' ) ) {
	/**
	 * @return null|BuilderPress
	 */
	function BuilderPress() {
		return BuilderPress::instance();
	}
}

$GLOBALS['BuilderPress'] = BuilderPress();
