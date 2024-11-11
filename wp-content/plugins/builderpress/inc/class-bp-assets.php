<?php
/**
 * BuilderPress Assets class
 *
 * @version     1.0.0
 * @author      ThimPress
 * @package     BuilderPress/Classes
 * @category    Classes
 * @author      Thimpress, leehld
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'BuilderPress_Assets' ) ) {
	/**
	 * Class BuilderPress_Assets
	 */
	class BuilderPress_Assets {
		/**
		 * BuilderPress_Assets constructor.
		 */
		public function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ), 10 );
			add_action( 'admin_enqueue_scripts', array( $this, 'register_scripts' ), 10 );

			// define ajax url if not exist
			add_action( 'wp_head', array( $this, 'define_ajaxurl' ), 1000 );
		}

		/**
		 * Register scripts.
		 */
		public function register_scripts() {
			// owl carousel
			wp_register_script( 'builder-press-owl-carousel', BUILDER_PRESS_URL . 'assets/libs/owl-carousel/owl.carousel.min.js', array( 'jquery' ), '2.3.4' );
			wp_register_style( 'builder-press-owl-carousel', BUILDER_PRESS_URL . 'assets/libs/owl-carousel/owl.carousel.min.css', '', '2.3.4' );

			//jquery ui
            wp_register_script( 'jquery-ui', BUILDER_PRESS_URL . 'assets/libs/jqueryui/jquery-ui.js' );

			if ( is_admin() ) {

				wp_enqueue_script( 'wp-link' );
				wp_enqueue_style( 'editor-buttons' );

				// datetimepicker
				wp_enqueue_style( 'builder-press-datetimepicker', BUILDER_PRESS_URL . 'assets/libs/datetimepicker/jquery.datetimepicker.min.css' );
				wp_enqueue_script( 'builder-press-datetimepicker', BUILDER_PRESS_URL . 'assets/libs/datetimepicker/jquery.datetimepicker.full.min.js', array( 'jquery' ), '', true );

				// admin script
				wp_enqueue_style( 'builderpress-admin', BUILDER_PRESS_URL . 'assets/css/admin-builderpress.css', array(), BUILDER_PRESS_VER );
				wp_enqueue_script( 'builderpress-admin', BUILDER_PRESS_URL . 'assets/js/admin-builderpress.js', array( 'jquery' ), BUILDER_PRESS_VER );
			} else {

				wp_enqueue_style( 'font-awesome' );
				wp_register_style( 'builder-press-ionicons', BUILDER_PRESS_URL . '/assets/css/fonts/ionicons.css' );
				wp_enqueue_style( 'builder-press-ionicons' );

				// slick slider
                wp_enqueue_script( 'builder-press-slick', BUILDER_PRESS_URL . 'assets/libs/slick/slick.min.js', array( 'jquery' ), '1.8.1' );
				wp_register_style( 'builder-press-slick', BUILDER_PRESS_URL . 'assets/libs/slick/slick.css', '', '1.8.1' );

				// magnific popup
				wp_register_script( 'builder-press-magnific-popup', BUILDER_PRESS_URL . 'assets/libs/magnific-popup/jquery.magnific-popup.min.js', array( 'jquery' ), '1.1.0' );
                wp_register_style( 'builder-press-magnific-popup', BUILDER_PRESS_URL . 'assets/libs/magnific-popup/magnific-popup.css', '', '1.1.0' );

				// isotope
				wp_register_script( 'builder-press-isotope', BUILDER_PRESS_URL . 'assets/libs/isotope/isotope.pkgd.min.js', array( 'jquery' ), '3.0.5' );
                wp_register_script( 'builder-press-packery-mode', BUILDER_PRESS_URL . 'assets/libs/isotope/packery-mode.pkgd.min.js', array( 'builder-press-isotope' ), '2.0.1', true );

				// countdown
				wp_register_script( 'builder-press-jquery-plugin', BUILDER_PRESS_URL . 'assets/libs/countdown/jquery.plugin.min.js', array(), '1.0.1' );
				wp_register_script( 'builder-press-countdown', BUILDER_PRESS_URL . 'assets/libs/countdown/jquery.countdown.min.js', array(), '2.0.2' );
				wp_register_style( 'builder-press-countdown', BUILDER_PRESS_URL . 'assets/libs/countdown/jquery.countdown.css', array(), '2.0.0' );

				// lazyload
                wp_register_script( 'builder-press-lazyload', BUILDER_PRESS_URL . 'assets/libs/lazyload/lazyload.min.js', array( 'jquery' ), '1.1.0' );

                //
                wp_register_script( 'builder-press-jquerymousewheel', BUILDER_PRESS_URL . 'assets/libs/jquerymousewheel/jquery.mousewheel.js', array( 'jquery' ), '3.0.6' );
                wp_register_script( 'builder-press-dragscroll', BUILDER_PRESS_URL . 'assets/libs/dragscroll/dragscroll.js', array( 'jquery' ), '3.0.6' );

                // frontend script
				wp_enqueue_style( 'builderpress-fontend', BUILDER_PRESS_URL . 'assets/css/builderpress.css', array(), BUILDER_PRESS_VER );
				wp_enqueue_script( 'builderpress-fontend', BUILDER_PRESS_URL . 'assets/js/builderpress.js', array( 'jquery','builder-press-slick' ), BUILDER_PRESS_VER );
			}
		}

		/**
		 * Define ajaxurl if not exist
		 */
		public function define_ajaxurl() { ?>
            <script type="text/javascript">
                if (typeof ajaxurl === 'undefined') {
                    /* <![CDATA[ */
                    var ajaxurl = "<?php echo esc_js( admin_url( 'admin-ajax.php' ) ); ?>";
                    /* ]]> */
                }
            </script>
			<?php
		}
	}
}

new BuilderPress_Assets();