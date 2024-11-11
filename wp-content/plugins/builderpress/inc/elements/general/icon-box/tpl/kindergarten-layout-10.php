<?php
/**
 * Template for displaying default template Icon Box element kindergarten-layout-10.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/icon-box/kindergarten-layout-10.php.
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

if ( !empty( $params['icon_hover_border_color'] ) ) {
    $icon_hover .= "color: " . $params['icon_hover_border_color'] . ";";
}

?>
<?php if ( isset($link['url']) ){ ?>
    <a href="<?php echo esc_url( $link['url'] ); ?>" class="icon-box bp-element-hover" <?php echo ent2ncr( $icon_css ); ?> data-hover="<?php echo ent2ncr( $icon_hover ) ?>">
        <div class="content">
            <?php if ( $title ) { ?>
                <div class="title bp-element-hover" <?php echo ent2ncr( $title_css ); ?> data-hover="<?php echo ent2ncr( $link_hover ) ?>">
                    <?php echo esc_html( $title ); ?>
                </div>
            <?php } ?>

            <?php if($description){ ?>
                <div class="description">
                    <?php echo ent2ncr( $description ); ?>
                </div>
            <?php } ?>
        </div>

        <div class="icon-image">
            <?php if ( $icon_type == 'icon_fontawesome' && $params['icon_fontawesome'] ) { ?>
                <i class="<?php echo esc_attr( $params['icon_fontawesome'] ); ?>" <?php echo ent2ncr( $icon_css ); ?>></i>
            <?php } else if ( $icon_type == 'icon_ionicon' && $params['icon_ionicon'] ) { ?>
                <i class="ionicons <?php echo esc_attr( $params['icon_ionicon'] ); ?>" <?php echo ent2ncr( $icon_css ); ?>></i>
            <?php } else if ( $icon_type == 'icon_upload' && $params['icon_upload'] ) {
                echo wp_get_attachment_image( $params['icon_upload'], 'full' );
            } ?>
        </div>
    </a>
<?php }else{ ?>
    <div class="icon-box">
        <div class="content">
            <?php if ( $title ) { ?>
                <div class="title" <?php echo ent2ncr( $title_css ); ?>>
                    <?php echo esc_html( $title ); ?>
                </div>
            <?php } ?>

            <?php if($description){ ?>
                <div class="description">
                    <?php echo ent2ncr( $description ); ?>
                </div>
            <?php } ?>
        </div>

        <div class="icon-image">
            <?php if ( $icon_type == 'icon_fontawesome' && $params['icon_fontawesome'] ) { ?>
                <i class="<?php echo esc_attr( $params['icon_fontawesome'] ); ?>" <?php echo ent2ncr( $icon_css ); ?>></i>
            <?php } else if ( $icon_type == 'icon_ionicon' && $params['icon_ionicon'] ) { ?>
                <i class="ionicons <?php echo esc_attr( $params['icon_ionicon'] ); ?>" <?php echo ent2ncr( $icon_css ); ?>></i>
            <?php } else if ( $icon_type == 'icon_upload' && $params['icon_upload'] ) {
                echo wp_get_attachment_image( $params['icon_upload'], 'full' );
            } ?>
        </div>
    </div>
<?php } ?>
