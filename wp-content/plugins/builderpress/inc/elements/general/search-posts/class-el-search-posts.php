<?php
/**
 * BuilderPress Elementor Search Posts widget
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

if ( ! class_exists( 'BuilderPress_El_Search_Posts' ) ) {
	/**
	 * Class BuilderPress_El_Search_Posts
	 */
	class BuilderPress_El_Search_Posts extends BuilderPress_El_Widget {

		/**
		 * @var string
		 */
		protected $config_class = 'BuilderPress_Config_Search_Posts';

		/**
		 * Register controls.
		 */
		protected function register_controls() {
			if ( ! is_admin() ) {
				return;
			}

			$this->start_controls_section(
				'el-search-posts', [ 'label' => esc_html__( 'Search', 'builderpress' ) ]
			);

			$controls = \BuilderPress_El_Mapping::mapping( $this->options() );

			foreach ( $controls as $key => $control ) {
				$this->add_control( $key, $control );
			}

			$this->end_controls_section();
		}
	}
}
