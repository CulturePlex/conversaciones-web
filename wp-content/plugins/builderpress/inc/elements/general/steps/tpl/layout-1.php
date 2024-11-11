<?php
$unique_id = uniqid( 'thim_' );
$html_nav  = $html_tab_content = '';

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

/**
 * @var $params
 */

if ( $params['steps'] ):

    $active = 'active';
    foreach ( $params['steps'] as $key => $step ) {
        if ( $key != 0 ) {
            $active = '';
        }
        $icon_type = $step['icon_type'];
        $tab_id    = $unique_id . '-step-' . $key;
        $step_text = ( strtolower( $params['circle-text'] ) == 'step' ) ? ( $key + 1 ) . '<span>' . $params['circle-text'] . '</span>' : '<span>' . $params['circle-text'] . '</span>' . ( $key + 1 );

        if ( $icon_type == 'icon_fontawesome' && $step['icon_fontawesome'] ) {
            $step_text = '<i class="'. esc_attr( $step['icon_fontawesome'] ) .'"></i>';
         } elseif ( $icon_type == 'icon_ionicon' && $step['icon_ionicon'] ) {
            $step_text =  '<i class="ionicons '. esc_attr( $step['icon_ionicon'] ) .'"></i>';
        } elseif ( $icon_type == 'icon_upload' && $step['icon_upload'] ) {
            $step_text = wp_get_attachment_image( $step['icon_upload'], 'full' );
        } else {
            $step_text = ( strtolower( $params['circle-text'] ) == 'step' ) ? ( $key + 1 ) . '<span class="text">' . $params['circle-text'] . '</span>' : '<span class="text">' . $params['circle-text'] . '</span>' . ( $key + 1 );
        }

        if ( isset( $step['readmore'] ) && is_array( $step['readmore'] ) ) {
            $step_link = '<a href="' . $step['readmore']['url'] . '" class="bp-btn readmore">' . $step['readmore_text'] . '</a>';
        }
        $html_nav         .= '<li class="nav-item"><a class="nav-link ' . $active . '" data-toggle="tab" href="#' . $tab_id . '" role="tab">' . $step_text . '</a></li>';
        $html_tab_content .= '<div class="tab-pane ' . $active . '" id="' . $tab_id . '" role="tabpanel">';

        if ( ! empty( $step['description'] ) ) {
            $html_tab_content .= '<p class="description">' . $step['description'] . '</p>';
        }
        if ( isset( $step_link ) ) {
            $html_tab_content .= $step_link;
        }
        $html_tab_content .= '</div>';
    }
endif;
?>

<div class="row">
    <div class="content-box">
        <div class="steps-wrapper">
            <div class="steps">
                <ul class="nav" role="tablist">
                    <?php echo ent2ncr( $html_nav ); ?>
                </ul>
                <div class="tab-content">
                    <?php echo ent2ncr( $html_tab_content ); ?>
                </div>
            </div>
        </div>
    </div>
</div>
