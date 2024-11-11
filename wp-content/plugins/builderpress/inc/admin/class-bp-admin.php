<?php
/**
 * BuilderPress Admin class
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

if ( ! class_exists( 'BuilderPress_Admin' ) ) {
	/**
	 * Class BuilderPress_Assets
	 */
	class BuilderPress_Admin {

		/**
		 * BuilderPress_Admin constructor.
		 */
		public function __construct() {

			require_once( BUILDER_PRESS_INC . 'admin/class-bp-override-template.php' );
			require_once( BUILDER_PRESS_INC . 'admin/class-bp-import-data.php' );

//			add_action( 'admin_menu', array( $this, 'admin_menu_init' ) );
		}

		/**
		 * Init admin menu.
		 */
		public function admin_menu_init() {
			add_options_page(
				__( 'BuilderPress', 'builderpress' ),
				__( 'BuilderPress', 'builderPress' ),
				apply_filters( 'builder-press/admin-menu-capability', 'manage_options' ),
				'builderpress',
				array( $this, 'admin_page' )
			);
		}

		/**
		 * Admin page
		 */
		public function admin_page() {
			$pages = array(
				'override_templates' => __( 'Override Templates', 'builderpress' ),
				'list_elements'      => __( 'Elements', 'builderpress' )
			); ?>

            <div id="bp-admin-page">
                <ul class="tabs clearfix" data-content="admin-tab-content">
					<?php
					$index = 0;
					foreach ( $pages as $func => $title ) { ?>
                        <li>
                            <a href="#<?php echo esc_attr( $func ); ?>" <?php echo ! $index ? "class='active'" : ''; ?>><?php echo esc_html( $title ); ?></a>
                        </li>
						<?php $index ++;
					} ?>
                </ul>
                <div id="admin-tab-content">
					<?php foreach ( $pages as $func => $title ) { ?>
                        <div id="<?php echo esc_attr( $func ); ?>">
							<?php call_user_func( array( $this, $func ) ); ?>
                        </div>
					<?php } ?>
                </div>
            </div>
			<?php
		}

		/**
		 * Show list elements
		 */
		public function list_elements() {

		}


		/**
		 * Show override templates
		 */
		public function override_templates() {
//			$override = BuilderPress_Helper_Override_Template::get_theme_override_templates();
		}
	}
}

new BuilderPress_Admin();