<?php
/* Custom Option Features's shortcode */
add_filter( 'builder-press/features/config-options', 'thim_option_shortcode_features', 10, 1 );
if( !function_exists( 'thim_option_shortcode_features' ) ) {
    function thim_option_shortcode_features( $params ) {
        $params[] = array(
            'type'       => 'vc_link',
            'heading'    => esc_html__( 'Link', 'ivy-school' ),
            'param_name' => 'link',
        );
        $params[] = array(
            'type'       => 'attach_image',
            'heading'    => esc_html__( 'Link Image', 'ivy-school' ),
            'param_name' => 'link_image',
            'dependency' => array(
                'element' => 'layout',
                'value'   => 'layout-2'
            )
        );
        foreach ($params as $key => $param){
            if($param['param_name'] == 'layout'){
                $params[$key]['options']['layout-3'] = THIM_URI . 'assets/images/shortcodes/features/layout-3.jpg';
            }
        }

        return $params;
    }
}

/* Custom Option Heading's shortcode */
add_filter( 'builder-press/heading/config-options', 'thim_option_shortcode_heading', 10, 1 );
if( !function_exists( 'thim_option_shortcode_heading' ) ) {
    function thim_option_shortcode_heading( $params ) {
        foreach ($params as $key => $param){
            if($param['param_name'] == 'show_line'){
                $params[$key]['std'] = true;
            }
        }

        return $params;
    }
}
?>