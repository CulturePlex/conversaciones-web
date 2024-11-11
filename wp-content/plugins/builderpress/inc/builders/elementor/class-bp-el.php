<?php
/**
 * BuilderPress Elementor class
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

if ( ! class_exists( 'BuilderPress_El' ) ) {
	/**
	 * Class BuilderPress_El
	 */
	class BuilderPress_El {

		/**
		 * @var null
		 */
		private static $instance = null;

		/**
		 * BuilderPress_El constructor.
		 */
		protected function __construct() {

			// mapping params
			require_once( BUILDER_PRESS_INC . 'builders/elementor/class-bp-el-mapping.php' );

			// register custom control
			add_action( 'elementor/controls/controls_registered', array( $this, 'register_controls' ) );

			// add widget categories
			add_action( 'elementor/init', array( $this, 'register_categories' ) );
			// load widget
			add_action( 'elementor/widgets/widgets_registered', array( $this, 'load_widgets' ) );
		}

		/**
		 * @param $Controls_Manager Elementor\Controls_Manager
		 */
		public function register_controls( $Controls_Manager ) {

			$fields = apply_filters( 'builder-press/elementor/fields', array( 'link', 'radioimage_el' ) );

			if ( $fields ) {
				foreach ( $fields as $field ) {
					$file = apply_filters( 'builder-press/el-widget-file', BUILDER_PRESS_INC . "builders/elementor/fields/$field.php" );
					if ( file_exists( $file ) ) {
						include_once $file;
						//$class = "Control_" . ucfirst( $field );
						$class_name = __NAMESPACE__ . '\Control_' . ucwords( $field );
						if ( class_exists( $class_name ) ) {
							$Controls_Manager->register( $field, new $class_name() );
						}
					}
				}
			}
		}

		/**
		 * Add widget categories
		 */
		public function register_categories() {
			\Elementor\Plugin::instance()->elements_manager->add_category(
				'builder-press',
				array(
					'title' => __( 'BuilderPress', 'builderpress' ),
					'icon'  => 'fa fa-plug',
				)
			);
		}

		/**
		 * @param $widgets_manager Elementor\Widgets_Manager
		 *
		 * @throws Exception
		 */
		public function load_widgets( $widgets_manager ) {

			// parent class
			require_once( BUILDER_PRESS_INC . 'builders/elementor/class-bp-el-widget.php' );

			$widgets = builder_press_get_elements();

			foreach ( $widgets as $group => $_widgets ) {
				foreach ( $_widgets as $widget ) {
					$file = apply_filters( 'builder-press/el-widget-file', BUILDER_PRESS_INC . "elements/$group/$widget/class-el-$widget.php", $widget );
					if ( file_exists( $file ) ) {
						include_once $file;

						$class = '\BuilderPress_El_' . str_replace( '-', '_', ucfirst( $widget ) );

						if ( class_exists( $class ) ) {
							$widgets_manager->register( new $class() );
						}
					}
				}
			}
		}

		/**
		 * Instance.
		 */
		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}
		}
	}
}

BuilderPress_El::instance();
