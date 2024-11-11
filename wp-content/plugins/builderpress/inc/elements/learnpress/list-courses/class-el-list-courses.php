<?php
/**
 * BuilderPress Elementor Learnpress List Courses widget
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

if ( ! class_exists( 'BuilderPress_El_List_Courses' ) ) {
	/**
	 * Class BuilderPress_El_List_Courses
	 */
	class BuilderPress_El_List_Courses extends BuilderPress_El_Widget {

		/**
		 * @var string
		 */
		protected $config_class = 'BuilderPress_Config_List_Courses';

		/**
		 * Register controls.
		 */
		protected function register_controls() {
			if ( ! is_admin() ) {
				return;
			}

			$this->start_controls_section(
				'el-list-courses', [ 'label' => esc_html__( 'List Courses', 'builderpress' ) ]
			);

            $option = array_merge(
                array(
                    array(
                        'type' => 'text',
                        'heading' => __( 'Link Title', 'builderpress' ),
                        'param_name' => 'linktype_title',
                        'dependency'       => array(
                            'element' => 'layout',
                            'value'   => array( 'coach-life-layout-slider-1' )
                        )
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
