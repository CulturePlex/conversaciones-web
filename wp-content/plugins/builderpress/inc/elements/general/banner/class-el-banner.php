<?php
/**
 * BuilderPress Elementor Banner widget
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

if ( ! class_exists( 'BuilderPress_El_Banner' ) ) {
	/**
	 * Class BuilderPress_El_Banner
	 */
	class BuilderPress_El_Banner extends BuilderPress_El_Widget {

		/**
		 * @var string
		 */
		protected $config_class = 'BuilderPress_Config_Banner';

		/**
		 * Register controls.
		 */
		protected function register_controls() {
			if ( ! is_admin() ) {
				return;
			}

			$this->start_controls_section(
				'el-banner', [ 'label' => esc_html__( 'Banner', 'builderpress' ) ]
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
                        'heading' => __( 'Link Title Video', 'builderpress' ),
                        'param_name' => 'linktype_title_video',
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
