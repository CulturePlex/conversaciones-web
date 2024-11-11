<?php
/**
 * BuilderPress Elementor Demo widget
 *
 * @version     1.0.0
 * @author      ThimPress
 * @package     BuilderPress/Classes
 * @category    Classes
 * @author      Thimpress, vinhnq
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'BuilderPress_El_Demo' ) ) {
	/**
	 * Class BuilderPress_El_Demo
	 */
	class BuilderPress_El_Demo extends BuilderPress_El_Widget {

		/**
		 * @var string
		 */
		protected $config_class = 'BuilderPress_Config_Demo';

		/**
		 * Register controls.
		 */
		protected function register_controls() {
			$this->start_controls_section(
				'el-demo', [ 'label' => esc_html__( 'Demo', 'builderpress' ) ]
			);

			$controls = \BuilderPress_El_Mapping::mapping( $this->options() );

			foreach ( $controls as $key => $control ) {
				$this->add_control( $key, $control );
			}

			$this->end_controls_section();
		}
	}
}
