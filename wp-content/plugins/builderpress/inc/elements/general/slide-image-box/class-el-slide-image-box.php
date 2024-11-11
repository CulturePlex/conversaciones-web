<?php
/**
 * BuilderPress Elementor Slide Image Box widget
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

if ( ! class_exists( 'BuilderPress_El_Slide_Image_Box' ) ) {
    /**
     * Class BuilderPress_El_Slide_Image_Box
     */
    class BuilderPress_El_Slide_Image_Box extends BuilderPress_El_Widget {

        /**
         * @var string
         */
        protected $config_class = 'BuilderPress_Config_Slide_Image_Box';

        /**
         * Register controls.
         */
        protected function register_controls() {
			if ( ! is_admin() ) {
				return;
			}

            $this->start_controls_section(
                'el-slide-image-box', [ 'label' => esc_html__( 'Slide Image Box', 'builderpress' ) ]
            );
            $option = $this->options();
            for($i=0; $i<count($option);$i++){
                if($option[$i]["param_name"] == 'slide_image_box') {
                    $option[$i]["params"] = array_merge(
                        $option[$i]["params"],
                        array(
                            array(
                                'type' => 'text',
                                'heading' => __( 'Link Title', 'builderpress' ),
                                'param_name' => 'linktype_title',
                            ),
                        )
                    );
                }
            }

            $controls = \BuilderPress_El_Mapping::mapping( $option );

            foreach ( $controls as $key => $control ) {
                $this->add_control( $key, $control );
            }

            $this->end_controls_section();
        }
    }
}
