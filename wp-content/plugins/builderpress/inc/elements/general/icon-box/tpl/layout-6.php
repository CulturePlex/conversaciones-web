<?php
/**
 * Template for displaying default template Icon Box element layout 6.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/icon-box/layout-6.php.
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
<div class="icon-box <?php echo ( $icon_type == 'icon_ionicon' || $icon_type == 'icon_fontawesome' ) ? ' type-icon' : ''; ?>">
    <div class="icon-image <?php echo esc_attr( $icon_shape ); ?>" <?php echo ent2ncr( $box_icon_css ); ?>>
    <?php if ( $icon_type == 'icon_fontawesome' && $params['icon_fontawesome'] ) { ?>
        <i class="<?php echo esc_attr( $params['icon_fontawesome'] ); ?>" <?php echo ent2ncr( $icon_css ); ?>></i>
    <?php } else if ( $icon_type == 'icon_ionicon' && $params['icon_ionicon'] ) { ?>
        <i class="ionicons <?php echo esc_attr( $params['icon_ionicon'] ); ?>" <?php echo ent2ncr( $icon_css ); ?>"></i>
    <?php } else if ( $icon_type == 'icon_upload' && $params['icon_upload'] ) {
        echo wp_get_attachment_image( $params['icon_upload'], 'full' );
    } ?>
</div>

<div class="content <?php echo ent2ncr( $content_css ); ?>">
    <?php if ( $title ) { ?>
    <<?php echo $title_tag; ?> class="title" <?php echo ent2ncr( $title_css ); ?>>
    <?php if ( isset($link['url']) ){ ?>
    <a class="bp-element-hover" href="<?php echo esc_url( $link['url'] ); ?>"
       data-hover="<?php echo ent2ncr( $link_hover ); ?>"
        <?php echo bp_template_build_link( $link ); ?> <?php echo ent2ncr( $link_css ); ?>>
        <?php } ?>

        <?php echo esc_html( $title ); ?>

        <?php if ( isset($link['url']) ) { ?>
    </a>
<?php } ?>
</<?php echo $title_tag; ?>>
<?php } ?>

<div class="description" <?php echo ent2ncr( $des_css ) ?>>
    <?php echo ent2ncr( $description ); ?>
</div>
</div>
<?php if ( $link && $link['url']) {
    $title = $link['title'] ? $link['title'] : __( 'Contact Now', 'builderpress' );
    if ( isset ( $params['linktype_title'] ) && !empty($params['linktype_title'])) {
        $title = $params['linktype_title'];
    }
    ?>
    <div class="button" <?php echo ent2ncr( $button_css ); ?>>
        <a class="link" href="<?php echo esc_url( $link['url'] ); ?>"
            <?php echo bp_template_build_link( $link ); ?>>
            <?php echo ent2ncr($title) ?>
            <i class="ion ion-ios-arrow-thin-right"></i>
        </a>
    </div>
<?php } ?>
</div>
