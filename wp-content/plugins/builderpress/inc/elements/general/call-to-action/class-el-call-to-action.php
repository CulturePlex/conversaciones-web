<?php
/**
 * BuilderPress Elementor Call To Action widget
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

if ( ! class_exists( 'BuilderPress_El_Call_To_Action' ) ) {
	/**
	 * Class BuilderPress_El_Call_To_Action
	 */
	class BuilderPress_El_Call_To_Action extends BuilderPress_El_Widget {

		/**
		 * @var string
		 */
		protected $config_class = 'BuilderPress_Config_Call_To_Action';

		/**
		 * Register controls.
		 */
		protected function register_controls() {
			if ( ! is_admin() ) {
				return;
			}

			$this->start_controls_section(
				'el-call-to-action', [ 'label' => esc_html__( 'Call To Action', 'builderpress' ) ]
			);

            $option = array_merge(
                array(
                    array(
                        'type' => 'text',
                        'heading' => __( 'Action Title', 'builderpress' ),
                        'param_name' => 'action_title',
                    ),
                    array(
                        'type' => 'text',
                        'heading' => __( 'Action Title 2', 'builderpress' ),
                        'param_name' => 'action_title_2',
                    )
                ),
				$this->options()
            );

            $controls = \BuilderPress_El_Mapping::mapping( $option );

			foreach ( $controls as $key => $control ) {
				$this->add_control( $key, $control );
			}

			$this->end_controls_section();
		}
	}
}
