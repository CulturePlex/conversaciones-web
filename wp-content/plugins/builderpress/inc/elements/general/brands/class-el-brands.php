<?php
/**
 * BuilderPress Elementor Brands widget
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

if ( ! class_exists( 'BuilderPress_El_Brands' ) ) {
	/**
	 * Class BuilderPress_El_Brands
	 */
	class BuilderPress_El_Brands extends BuilderPress_El_Widget {

		/**
		 * @var string
		 */
		protected $config_class = 'BuilderPress_Config_Brands';

		/**
		 * Register controls.
		 */
		protected function register_controls() {
			if ( ! is_admin() ) {
				return;
			}

			$this->start_controls_section(
				'el-brands',
				[ 'label' => esc_html__( 'Brands', 'builderpress' ) ]
			);

			$controls = \BuilderPress_El_Mapping::mapping( $this->options() );

			foreach ( $controls as $key => $control ) {
				$this->add_control( $key, $control );
			}

			$this->end_controls_section();
		}
	}
}
