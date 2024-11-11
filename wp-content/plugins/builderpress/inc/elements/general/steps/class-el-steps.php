<?php
/**
 * BuilderPress Elementor Steps widget
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

if ( ! class_exists( 'BuilderPress_El_Steps' ) ) {
	/**
	 * Class BuilderPress_El_Steps
	 */
	class BuilderPress_El_Steps extends BuilderPress_El_Widget {

		/**
		 * @var string
		 */
		protected $config_class = 'BuilderPress_Config_Steps';

		/**
		 * Register controls.
		 */
		protected function register_controls() {
			if ( ! is_admin() ) {
				return;
			}

			$this->start_controls_section(
				'steps_bpel', [ 'label' => esc_html__( 'Steps', 'builderpress' ) ]
			);

			$controls = \BuilderPress_El_Mapping::mapping( $this->options() );

			foreach ( $controls as $key => $control ) {
				$this->add_control( $key, $control );
			}

			$this->end_controls_section();
		}

		/**
		 * Render
		 */
		protected function render() {

			$settings = $this->get_settings_for_display();

			parent::render();

			//builder_press_get_template( $this->get_name(), array( 'params' => $settings ), $this->get_group() . '/' . $this->get_name() . '/tpl/' );
		}
	}
}
