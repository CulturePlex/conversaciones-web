<?php
/**
 * Template for displaying default template Learnpress List Instructors element layout grid.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/list-instructors/layout-grid.php.
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

?>

    <div class="row">
		<?php foreach ( $instructors as $item ) { ?>
			<?php $user = learn_press_get_user( $item->ID );
			$lp_info    = get_the_author_meta( 'lp_info', $item->ID ); ?>

            <div class="custom-col col-sm-6 col-md-4">
                <!-- block teacher -->
                <div class="item-teacher">
                    <div class="pic">
                        <a href="<?php echo learn_press_user_profile_link($item->ID) ?>"><?php echo $user->get_profile_picture( '', 416 ); ?></a>
                    </div>

                    <div class="content">
                        <div class="social-link">
							<?php if ( isset( $lp_info['facebook'] ) && $lp_info['facebook'] ) : ?>
                                <a href="<?php echo esc_url( $lp_info['facebook'] ); ?>" class="item">
                                    <i class="fa fa-facebook"></i>
                                </a>
							<?php endif; ?>

							<?php if ( isset( $lp_info['twitter'] ) && $lp_info['twitter'] ) : ?>
                                <a href="<?php echo esc_url( $lp_info['twitter'] ); ?>" class="item">
                                    <i class="fa fa-twitter"></i>
                                </a>
							<?php endif; ?>

							<?php if ( isset( $lp_info['google'] ) && $lp_info['google'] ) : ?>
                                <a href="<?php echo esc_url( $lp_info['google'] ); ?>" class="item">
                                    <i class="fa fa-google-plus"></i>
                                </a>
							<?php endif; ?>

							<?php if ( isset( $lp_info['instagram'] ) && $lp_info['instagram'] ) : ?>
                                <a href="<?php echo esc_url( $lp_info['instagram'] ); ?>" class="item">
                                    <i class="fa fa-instagram" aria-hidden="true"></i>
                                </a>
							<?php endif; ?>

							<?php if ( isset( $lp_info['linkedin'] ) && $lp_info['linkedin'] ) : ?>
                                <a href="<?php echo esc_url( $lp_info['linkedin'] ); ?>" class="item">
                                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                                </a>
							<?php endif; ?>

							<?php if ( isset( $lp_info['youtube'] ) && $lp_info['youtube'] ) : ?>
                                <a href="<?php echo esc_url( $lp_info['youtube'] ); ?>" class="item">
                                    <i class="fa fa-youtube" aria-hidden="true"></i>
                                </a>
							<?php endif; ?>
                        </div>

                        <div class="info">
                            <a class="name" href="<?php echo learn_press_user_profile_link($item->ID) ?>">
								<?php echo $user->get_display_name(); ?>
                            </a>
							<?php if ( isset( $lp_info['major'] ) && $lp_info['major'] ) : ?>
                                <span class="description"><?php echo esc_html( $lp_info['major'] ); ?></span>
							<?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- end block teacher -->
            </div>
		<?php } ?>
    </div>

<?php if ( $params['show_load_more'] ) { ?>
    <a href="#" class="btn-loadmore-teacher btn-normal shape-round js-loadmore-teacher">
        Load more
    </a>
<?php } ?>