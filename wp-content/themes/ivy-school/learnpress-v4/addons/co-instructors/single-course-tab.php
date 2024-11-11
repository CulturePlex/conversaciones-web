<?php
/**
 * Template for displaying instructor tab in single course page.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/addons/co-instructor/single-course-tab.php.
 *
 * @author ThimPress
 * @package LearnPress/Co-Instructor/Templates
 * @version 3.0.2
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

/**
 * @var $instructors
 */
if ( $instructors ) {
    echo '<div class="list">';
	foreach ( $instructors as $instructor_id ) {
		$user = get_userdata( $instructor_id );
		if ( $user ) {
			$lp_info = get_the_author_meta( '_lp_extra_info', $instructor_id );
			$link    = learn_press_user_profile_link( $instructor_id );
			?>
            <div class="item">
                <div class="pic">
                    <?php echo get_avatar( $instructor_id, 150 ); ?>
                    <div class="social-link">
                        <?php if ( isset( $lp_info['facebook'] ) && $lp_info['facebook'] ) : ?>
                            <a href="<?php echo esc_url($lp_info['facebook']);?>">
                                <i class="fa fa-facebook"></i>
                            </a>
                        <?php endif; ?>

                        <?php if ( isset( $lp_info['twitter'] ) && $lp_info['twitter'] ) : ?>
                            <a href="<?php echo esc_url($lp_info['twitter']);?>">
                                <i class="fa fa-x-twitter"></i>
                            </a>
                        <?php endif; ?>

                        <?php if ( isset( $lp_info['google'] ) && $lp_info['google'] ) : ?>
                            <a href="<?php echo esc_url($lp_info['google']);?>">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        <?php endif; ?>

                        <?php if ( isset( $lp_info['instagram'] ) && $lp_info['instagram'] ) : ?>
                            <a href="<?php echo esc_url($lp_info['instagram']);?>">
                                <i class="fa fa-instagram"></i>
                            </a>
                        <?php endif; ?>

                        <?php if ( isset( $lp_info['linkedin'] ) && $lp_info['linkedin'] ) : ?>
                            <a href="<?php echo esc_url($lp_info['linkedin']);?>">
                                <i class="fa fa-linkedin"></i>
                            </a>
                        <?php endif; ?>

                    </div>
                </div>
                <div class="content">
                    <h4 class="title">
                        <a href="<?php echo esc_url( $link ); ?>"><?php echo get_the_author_meta( 'display_name', $instructor_id ); ?></a>
                    </h4>
                    <?php if ( isset( $lp_info['major'] ) && $lp_info['major'] ) : ?>
                        <div class="info"><?php echo esc_html( $lp_info['major'] ); ?></div>
                    <?php endif; ?>

                    <p class="para"><?php echo get_the_author_meta( 'description', $instructor_id ); ?></p>
                </div>
            </div>
			<?php
		}
	}
	echo '</div>';
}