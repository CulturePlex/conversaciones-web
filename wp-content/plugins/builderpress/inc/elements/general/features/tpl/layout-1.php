<?php
/**
 * Template for displaying default template Features element layout 1.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/features/layout-1.php.
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

<div class="features">
	<?php foreach ( $features as $feature ) {
		$icon_type   = $feature['icon_type'];
		$name        = isset( $feature['name'] ) ? $feature['name'] : '';
		$description = isset( $feature['description'] ) ? $feature['description'] : '';
		$link        = isset( $feature['link'] ) ? $feature['link'] : array();
		?>
            <div class="item">
				<?php if ( $icon_type == 'icon_upload' ) {
					$image = $feature['icon_upload'];
					if ( isset( $image ) ) { ?>
                        <div class="media">
							<?php echo wp_get_attachment_image( $image, 'full' ); ?>
                        </div>
					<?php }
				} else if ( $icon_type == 'icon_ionicon' && $feature['icon_ionicon'] ) { ?>
                    <i class="media-icon ionicons <?php echo esc_attr( $feature['icon_ionicon'] ); ?>"
                       aria-hidden="true" <?php echo ent2ncr( $icon_css ); ?>></i>
				<?php } else if ( $icon_type == 'icon_fontawesome' && $feature['icon_fontawesome'] ) { ?>
                    <i class="media-icon <?php echo esc_attr( $feature['icon_fontawesome'] ); ?>"
                       aria-hidden="true" <?php echo ent2ncr( $icon_css ); ?>></i>
				<?php } ?>

                    <div class="content">
						<?php if ( $name ) { ?>
                            <<?php echo $title_tag ?> class="title" <?php echo ent2ncr($title_css);  ?>>
								<?php if ( $link && $link['url'] ) { ?>
                                    <a href="<?php echo esc_url( $link['url'] ); ?>"
                                        <?php echo bp_template_build_link( $link ); ?>>
                                        <?php } ?>
                                        <?php echo esc_html( $name ); ?>
                                        <?php if ( $link ) { ?>
                                    </a>
							    <?php } ?>
                            </<?php echo $title_tag  ?>>

						<?php } ?>

						<?php if ( $description ) { ?>
                            <div class="description" <?php echo ent2ncr($des_css); ?> ><?php echo esc_html( $description ); ?></div>
						<?php }
						?>
                    </div>
            </div>
	<?php } ?>
</div>
