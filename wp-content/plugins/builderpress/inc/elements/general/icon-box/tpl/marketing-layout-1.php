<?php
/**
 * Template for displaying default template Icon Box element marketing-layout-1.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/icon-box/marketing-layout-1.php.
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
<?php if ( isset($link['url']) ){ ?>
    <a href="<?php echo esc_url( $link['url'] ); ?>" class="icon-box">
        <div class="icon-image">
            <?php if ( $icon_type == 'icon_fontawesome' && $params['icon_fontawesome'] ) { ?>
                <i class="<?php echo esc_attr( $params['icon_fontawesome'] ); ?>"></i>
            <?php } else if ( $icon_type == 'icon_ionicon' && $params['icon_ionicon'] ) { ?>
                <i class="ionicons <?php echo esc_attr( $params['icon_ionicon'] ); ?>"></i>
            <?php } else if ( $icon_type == 'icon_upload' && $params['icon_upload'] ) {
                echo wp_get_attachment_image( $params['icon_upload'], 'full' );
            } ?>
        </div>

        <div class="content">
            <?php if ( $title ) { ?>
                <<?php echo $title_tag; ?> class="title" <?php echo ent2ncr( $title_css ); ?>>
                    <?php echo esc_html( $title ); ?>
                </<?php echo $title_tag; ?>>
            <?php } ?>

            <?php if($description){ ?>
                <div class="description" <?php echo ent2ncr( $des_css ) ?>>
                    <?php echo ent2ncr( $description ); ?>
                </div>
            <?php } ?>
        </div>
    </a>
<?php }else { ?>
    <div class="icon-box">
        <div class="icon-image">
            <?php if ( $icon_type == 'icon_fontawesome' && $params['icon_fontawesome'] ) { ?>
                <i class="<?php echo esc_attr( $params['icon_fontawesome'] ); ?>"></i>
            <?php } else if ( $icon_type == 'icon_ionicon' && $params['icon_ionicon'] ) { ?>
                <i class="ionicons <?php echo esc_attr( $params['icon_ionicon'] ); ?>"></i>
            <?php } else if ( $icon_type == 'icon_upload' && $params['icon_upload'] ) {
                echo wp_get_attachment_image( $params['icon_upload'], 'full' );
            } ?>
        </div>

        <div class="content">
            <?php if ( $title ) { ?>
                <<?php echo $title_tag; ?> class="title" <?php echo ent2ncr( $title_css ); ?>>
                    <?php echo esc_html( $title ); ?>
                </<?php echo $title_tag; ?>>
            <?php } ?>

            <?php if($description){ ?>
                <div class="description" <?php echo ent2ncr( $des_css ) ?>>
                    <?php echo ent2ncr( $description ); ?>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>
