<?php
/**
 * Template for displaying default template Brands element layout 1.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/brands/marketing-layout-1.php.
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
 * @var $brands
 */
?>
<div class="wrap-element">
    <?php foreach( $brands as $key => $brand ) { ?>
        <div class="item">
            <?php if ( isset( $brand['img'] ) ) {
                $logo = wp_get_attachment_image_src( $brand['img'], 'full' );
                $img  = '';
                if ( $logo ) {
                    $img = '<img src="' . $logo[0] . '" width="' . $logo[1] . '" height="' . $logo[2] . '" alt="' . esc_attr__( 'Logo', 'builderpress' ) . '">';
                }

                if ( $img ) {
                    $link = isset( $brand['link'] ) ? $brand['link'] : array();
                    if ( ! empty( $link['url'] ) ) { ?>
                        <a href="<?php echo esc_url( $link['url'] ); ?>" <?php echo bp_template_build_link( $link ); ?>>
                            <?php echo ent2ncr( $img ); ?>
                        </a>
                    <?php } else {
                        echo ent2ncr( $img );
                    }
                }
            } ?>
        </div>
    <?php } ?>
</div>
