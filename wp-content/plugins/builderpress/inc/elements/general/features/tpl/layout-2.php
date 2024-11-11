<?php
/**
 * Template for displaying default template Features element layout 2.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/features/layout-2.php.
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
		$link        = $feature['link'];
		?>
		<?php if ( $name ) { ?>
            <div class="feature">
                <!-- image-->
				<?php if ( $icon_type == 'icon_upload' ) {
					$image = $feature['icon_upload'];
					if ( isset( $image ) ) { ?>
                        <div class="media">
							<?php echo wp_get_attachment_image( $image, 'full' ); ?>
                        </div>
					<?php }
				} else if ( $icon_type == 'icon_ionicon' && $feature['icon_ionicon'] ) { ?>
                    <i class="media-icon ionicons <?php echo esc_attr( $feature['icon_ionicon'] ); ?>"
                       aria-hidden="true"></i>
				<?php } else if ( $icon_type == 'icon_fontawesome' && $feature['icon_fontawesome'] ) { ?>
                    <i class="media-icon <?php echo esc_attr( $feature['icon_fontawesome'] ); ?>"
                       aria-hidden="true"></i>
				<?php } ?>

                <!--                content-->
				<?php if ( $name || $description ) { ?>
                    <div class="content">
                        <!-- name-->
						<?php if ( $name ) { ?>
                            <h4 class="title">
								<?php if ( $link && $link['url'] ) { ?>
                                <a href="<?php echo esc_url( $link['url'] ); ?>"
									<?php echo bp_template_build_link( $link ); ?>>
									<?php } ?>
									<?php echo esc_html( $name ); ?>
									<?php if ( $link ) { ?>
                                </a>
							<?php } ?>
                            </h4>
						<?php } ?>
                        <!-- description-->
						<?php if ( $description ) { ?>
                            <div class="description"><?php echo esc_html( $description ); ?></div>
						<?php }
						?>
                    </div>
				<?php } ?>
            </div>
		<?php } ?>
	<?php } ?>
</div>
