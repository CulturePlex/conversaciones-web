<?php
/**
 * BuilderPress Elementor Video Box widget
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

if ( ! class_exists( 'BuilderPress_El_Video_Box' ) ) {
	/**
	 * Class BuilderPress_El_Video_Box
	 */
	class BuilderPress_El_Video_Box extends BuilderPress_El_Widget {

		/**
		 * @var string
		 */
		protected $config_class = 'BuilderPress_Config_Video_Box';

		/**
		 * Register controls.
		 */
		protected function register_controls() {
			if ( ! is_admin() ) {
				return;
			}

			$this->start_controls_section(
				'el-video-box', [ 'label' => esc_html__( 'Video Box', 'builderpress' ) ]
			);

            $option = array_merge(
                array(
                    array(
                        'type' => 'text',
                        'heading' => __( 'Link Title', 'builderpress' ),
                        'param_name' => 'linktype_title',
                    ),
                    array(
                        'type' => 'text',
                        'heading' => __( 'Sub Button Title', 'builderpress' ),
                        'param_name' => 'sub_button_title',
                        'dependency' => array(
                            'element' => 'layout',
                            'value'   => array( 'layout-1' ),
                        ),
                    ),
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
