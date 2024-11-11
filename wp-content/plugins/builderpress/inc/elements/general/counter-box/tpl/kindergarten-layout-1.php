<?php
/**
 * Template for displaying default template Counter Box element kindergarten-layout-1.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/counter-box/kindergarten-layout-1.php.
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
        <div class="number" <?php echo ent2ncr( $number_css ); ?>>
            <span class="number_counter" data-number="<?php echo esc_attr( $number ); ?>"
                  data-separator="<?php echo esc_attr( $separator ); ?>"
                  data-unit="<?php echo esc_attr( $unit ); ?>"></span>
        </div>

        <div class="line" <?php echo ent2ncr( $line_css ); ?>></div>

        <<?php echo $title_tag; ?> class="title" <?php echo ent2ncr( $title_css ); ?>>
            <?php echo esc_html( $title ); ?>
        </<?php echo $title_tag; ?>>

        <?php if ( $description ) { ?>
            <div class="description" <?php echo ent2ncr( $des_css ); ?>>
                <?php echo esc_html( $description ); ?>
            </div>
        <?php } ?>
    </div>
</div>