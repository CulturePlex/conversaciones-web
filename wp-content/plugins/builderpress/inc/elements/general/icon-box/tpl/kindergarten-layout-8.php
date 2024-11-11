<?php
/**
 * Template for displaying default template Icon Box element kindergarten-layout-8.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/icon-box/kindergarten-layout-8.php.
 *
 * @author      ThimPress
 * @package     BuilderPress/Templates
 * @version     1.0.0
 * @author      Thimpress, leehld
 */

/**
 * Prevent loading this file directly
 */
defined('ABSPATH') || exit;

/**
 * @var $params array - shortcode params
 */
?>

<!-- shortcode icon-box -->

    <div class="icon-box<?php echo ( $icon_type == 'icon_ionicon' || $icon_type == 'icon_fontawesome' ) ? ' type-icon' : ''; ?>">
        <?php if ( isset($link['url']) ){ ?>
            <a href="<?php echo esc_url( $link['url'] ); ?>" class="icon-image <?php echo esc_attr( $icon_shape ); ?>" <?php echo ent2ncr( $box_icon_css ); ?>>
                <?php if ( $icon_type == 'icon_fontawesome' && $params['icon_fontawesome'] ) { ?>
                    <i class="<?php echo esc_attr( $params['icon_fontawesome'] ); ?>" <?php echo ent2ncr( $icon_css ); ?>></i>
                <?php } else if ( $icon_type == 'icon_ionicon' && $params['icon_ionicon'] ) { ?>
                    <i class="ionicons <?php echo esc_attr( $params['icon_ionicon'] ); ?>" <?php echo ent2ncr( $icon_css ); ?>"></i>
                <?php } else if ( $icon_type == 'icon_upload' && $params['icon_upload'] ) {
                    echo wp_get_attachment_image( $params['icon_upload'], 'full' );
                } ?>
            </a>
        <?php } ?>

        <div class="content">
            <?php if ( $title ) { ?>
                <div class="title" <?php echo ent2ncr( $title_css ); ?>> <?php echo esc_html( $title ); ?> </div>
            <?php } ?>

            <?php if($description){ ?>
                <div class="description" <?php echo ent2ncr( $des_css ) ?>> <?php echo ent2ncr( $description ); ?> </div>
            <?php } ?>
        </div>
    </div>
<!-- end shortcode icon-box -->
