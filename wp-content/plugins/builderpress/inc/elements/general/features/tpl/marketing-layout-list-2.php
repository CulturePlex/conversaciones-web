<?php
/**
 * Template for displaying default template Features element marketing-layout-list-2.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/features/marketing-layout-list-2.php.
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
 * @var $features
 */
?>
<div class="wrap-element">
    <h3 class="title-element">
        <?php echo esc_html($title); ?>
    </h3>

    <ul class="list-feature">
        <?php
            foreach ( $features as $feature ):
                $name        = isset( $feature['name'] ) ? $feature['name'] : '';
                $link        = isset( $feature['link'] ) ? $feature['link'] : array();
        ?>
            <li class="item-feature">
                <?php if ( $link && $link['url'] ) { ?>
                <a href="<?php echo esc_url( $link['url'] ); ?>"
                    <?php echo bp_template_build_link( $link ); ?>>
                    <?php } ?>
                    <?php echo esc_html( $name ); ?>
                    <?php if ( $link ) { ?>
                </a>
            <?php } ?>

            </li>
        <?php endforeach; ?>
    </ul>
</div>