<?php
/**
 * Template for displaying default template Icon Box element kindergarten-layout-6.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/icon-box/kindergarten-layout-6.php.
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
<div class="icon-box bp-element-hover" <?php echo ent2ncr( $icon_css ); ?> data-hover="<?php echo ent2ncr($icon_hover) ?>">
    <?php if ( isset($link['url']) ){ ?>
        <a href="<?php echo esc_url( $link['url'] ); ?>" class="link"></a>
    <?php }?>

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

        <?php if ( $link && $link['url']) { ?>
            <a href="<?php echo esc_url( $link['url'] ); ?>" class="link-more bp-element-hover" <?php echo ent2ncr( $button_css ); ?> data-hover="<?php echo ent2ncr($icon_hover) ?>">
                <?php echo esc_html( $link['title'] ) ?>
                <i class="ion ion-ios-arrow-thin-right"></i>
            </a>
        <?php } ?>
    </div>
</div>