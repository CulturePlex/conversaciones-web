<?php
/**
 * Template for displaying default template Counter Box element kindergarten-layout-2.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/counter-box/kindergarten-layout-2.php.
 *
 * @author      ThimPress
 * @package     BuilderPress/Templates
 * @version     1.0.0
 * @author      Thimpress, leehld
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

/**
 * @var $params array - shortcode params
 * @var $number
 * @var $unit
 * @var $title
 * @var $icon_type
 * @var $description
 * @var $title_tag
 * @var $title_css
 * @var $number_css
 * @var $des_css
 * @var $icon_css
 */
?>
<div class="counter-box">
    <div class="wrap-element">
        <div class="content">
            <?php if ( $icon_type != "none" ) { ?>
                <div class="icon" <?php echo ent2ncr( $icon_css ); ?>>
                    <?php if ( $icon_type == 'icon_fontawesome' && $params['icon_fontawesome'] ) { ?>
                        <i class="<?php echo esc_attr( $params['icon_fontawesome'] ); ?>"></i>
                    <?php } else if ( $icon_type == 'icon_ionicon' && $params['icon_ionicon'] ) { ?>
                        <i class="ionicons <?php echo esc_attr( $params['icon_ionicon'] ); ?>"></i>
                    <?php } else if ( $icon_type == 'icon_upload' && $params['icon_upload'] ) {
                        echo wp_get_attachment_image( $params['icon_upload'], 'full' );
                    } ?>
                </div>
            <?php } ?>

            <div class="number" <?php echo ent2ncr( $number_css ); ?>>
                <span class="number_counter" data-number="<?php echo esc_attr( $number ); ?>"
                      data-separator="<?php echo esc_attr( $separator ); ?>"
                      data-unit="<?php echo esc_attr( $unit ); ?>"></span>
            </div>

            <<?php echo $title_tag; ?> class="text" <?php echo ent2ncr( $title_css ); ?>>
                <?php echo esc_html( $title ); ?>
            </<?php echo $title_tag; ?>>
        </div>
    </div>
</div>