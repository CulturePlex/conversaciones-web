<?php
/**
 * Template for displaying default template Icon Box element marketing-layout-3.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/icon-box/marketing-layout-3.php.
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
<div class="icon-box">
    <div class="icon-image">
        <?php if ( !empty($link['url']) ){ ?>
            <a href="<?php echo esc_url( $link['url'] ); ?>" class="wrap-icon">
                <?php if ( $icon_type == 'icon_fontawesome' && $params['icon_fontawesome'] ) { ?>
                    <i class="<?php echo esc_attr( $params['icon_fontawesome'] ); ?>"></i>
                <?php } else if ( $icon_type == 'icon_ionicon' && $params['icon_ionicon'] ) { ?>
                    <i class="ionicons <?php echo esc_attr( $params['icon_ionicon'] ); ?>"></i>
                <?php } else if ( $icon_type == 'icon_upload' && $params['icon_upload'] ) {
                    echo wp_get_attachment_image( $params['icon_upload'], 'full' );
                } ?>
            </a>
        <?php }else{?>
            <div  class="wrap-icon">
                <?php if ( $icon_type == 'icon_fontawesome' && $params['icon_fontawesome'] ) { ?>
                    <i class="<?php echo esc_attr( $params['icon_fontawesome'] ); ?>"></i>
                <?php } else if ( $icon_type == 'icon_ionicon' && $params['icon_ionicon'] ) { ?>
                    <i class="ionicons <?php echo esc_attr( $params['icon_ionicon'] ); ?>"></i>
                <?php } else if ( $icon_type == 'icon_upload' && $params['icon_upload'] ) {
                    echo  wp_get_attachment_image( $params['icon_upload'], 'full' );
                } ?>
            </div>
        <?php } ?>
    </div>

    <div class="content">
        <?php if ( $title ) { ?>
            <?php if(!empty($link['url'])){ ?>
                <<?php echo $title_tag; ?> class="title">
                    <a href="<?php echo esc_url( $link['url'] ); ?>" <?php echo ent2ncr( $title_css ); ?>>
                        <?php echo esc_html( $title ); ?>
                    </a>
                </<?php echo $title_tag; ?>>
            <?php }else{ ?>
                    <<?php echo $title_tag; ?> class="title" <?php echo ent2ncr( $title_css ); ?>>
                        <?php echo esc_html( $title ); ?>
                    </<?php echo $title_tag; ?>>
            <?php } ?>
        <?php } ?>

        <?php if($description): ?>
            <div class="description" <?php echo ent2ncr( $des_css ) ?>>
                <?php echo esc_html($description); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
