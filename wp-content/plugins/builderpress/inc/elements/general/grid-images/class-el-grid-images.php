<?php
/**
 * BuilderPress Elementor Grid Images widget
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

if ( ! class_exists( 'BuilderPress_El_Grid_Images' ) ) {
	/**
	 * Class BuilderPress_El_Grid_Images
	 */
	class BuilderPress_El_Grid_Images extends BuilderPress_El_Widget {

		/**
		 * @var string
		 */
		protected $config_class = 'BuilderPress_Config_Grid_Images';

		/**
		 * Register controls.
		 */
		protected function register_controls() {
			if ( ! is_admin() ) {
				return;
			}

			$this->start_controls_section(
				'el-grid-images', [ 'label' => esc_html__( 'Grid Images', 'builderpress' ) ]
			);

            $option = array_merge(
                array(
                    array(
                        'type' => 'text',
                        'heading' => __( 'Link Title', 'builderpress' ),
                        'param_name' => 'linktype_title',
                        'dependency'  => array(
                            'element' => 'layout',
                            'value'   => array(
                                'coach-life-layout-isotope-1'
                            )
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
