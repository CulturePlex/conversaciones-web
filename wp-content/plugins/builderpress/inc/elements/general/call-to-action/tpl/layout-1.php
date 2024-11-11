<?php
/**
 * Template for displaying default template Call To Action element layout 1.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/call-to-action/layout-1.php.
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
 */
$img = wp_get_attachment_image_src( $params['image'], 'full' );
?>

<div class="inner-box">
	<?php if ( $action ) { ?>
        <a class="readmore" href="<?php echo esc_url( $action['url'] ); ?>"
			<?php echo bp_template_build_link( $action ); ?>>

			<?php if ( $img ) { ?>
                <img src="<?php echo esc_url( $img[0] ) ?>"
                     alt="<?php echo esc_attr__( 'Media', 'builderpress' ); ?>">
			<?php } ?>

			<?php if ( $title ) { ?>
                <span class="title"><?php echo ent2ncr( $title ); ?></span>
			<?php } else { ?>
                <span class="title"><?php echo ent2ncr( $action['title'] ); ?></span>
			<?php } ?>
        </a>
	<?php } ?>
</div>