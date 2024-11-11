<?php
/**
 * BuilderPress handler class
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

if ( ! class_exists( 'BuilderPress_SO' ) ) {
	/**
	 * Class BuilderPress_SO
	 */
	class BuilderPress_SO {
		/**
		 * BuilderPress_SO constructor.
		 */
		public function __construct() {

			// parent class
			require_once( BUILDER_PRESS_INC . 'builders/siteorigin/class-bp-so-widget.php' );

			// mapping params
			require_once( BUILDER_PRESS_INC . 'builders/siteorigin/class-bp-so-mapping.php' );

			// add group
			add_filter( 'siteorigin_panels_widget_dialog_tabs', array( $this, 'register_widget_groups' ) );

			// load widgets
			add_action( 'plugins_loaded', array( $this, 'load_widgets' ) );
		}

		/**
		 * @param $tabs
		 *
		 * @return array
		 */
		public function register_widget_groups( $tabs ) {
			$tabs[] = array(
				'title'  => esc_html__( 'BuilderPress Widgets', 'builderpress' ),
				'filter' => array(
					'groups' => array( 'builderpress_so_widgets' )
				)
			);

			return $tabs;
		}

		/**
		 * Load SO widgets
		 */
		public function load_widgets() {

			$widgets = builder_press_get_elements();

			foreach ( $widgets as $group => $_widgets ) {
				foreach ( $_widgets as $widget ) {
					$file = apply_filters( 'builder-press/so-widget-file', BUILDER_PRESS_INC . "elements/$group/$widget/class-so-$widget.php", $widget );
					if ( file_exists( $file ) ) {

						include_once $file;
					}
				}
			}
		}
	}
}

new BuilderPress_SO();


