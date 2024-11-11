<?php
/**
 * Template for displaying instructor of single course.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/single-course/instructor.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.3.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$course = learn_press_get_course();
if ( ! $course ) {
	return;
}
$author = $course->get_instructor();

$lp_info = get_the_author_meta( '_lp_extra_info', $author->get_id() );
$author_meta = get_user_meta( $author->get_id() );
$author_meta = array_map( 'thim_get_user_meta', $author_meta );
?>
<?php if ( ! learn_press_is_learning_course() ): ?>
	<div id="tab-instructor" style="height: 40px"></div>
<?php endif; ?>

<div class="instructor">

	<h3 class="instructor-title"><?php echo esc_html__( 'Instructor', 'ivy-school' ); ?></h3>

    <div class="list">

	<?php do_action( 'learn-press/before-single-course-instructor' ); ?>

		<div class="item">
            <div class="pic">
                <?php echo get_avatar( $author->get_id(), 150 ); ?>

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
                    <?php echo ent2ncr($course->get_instructor_html()); ?>
                </h4>

                <?php if ( ! empty( $lp_info['major'] ) ): ?>
                    <div class="info"><?php echo esc_html( $lp_info['major'] ) ?></div>
                <?php endif; ?>

                <?php if ( ! empty( $author_meta['description'] ) ): ?>
                    <p class="para"><?php echo esc_html( $author_meta['description'] ); ?></p>
                <?php endif; ?>
            </div>
        </div>

	<?php do_action( 'learn-press/after-single-course-instructor' ); ?>

    </div>

</div>

