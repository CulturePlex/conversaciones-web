<?php
/**
 * Template for displaying content of learning course.
 *
 * @author      ThimPress
 * @package     CourseBuilder/Templates
 * @version     4.0.0
 */

/**
 * Prevent loading this file directly
 */
use LearnPress\Helpers\Template;

defined( 'ABSPATH' ) || exit();


$course = learn_press_get_course();
if ( ! $course  ) {
	return;
}

$has_thumbnail = has_post_thumbnail();
$has_video_intro = get_post_meta( get_the_ID(), 'thim_course_media', true );
$thumbnail_col_class = $has_thumbnail || $has_video_intro ? 'col-md-6' : 'col-md-12';
$header_info_col_class = $has_thumbnail || $has_video_intro ? 'col-md-6' : 'col-md-12';
$default_image_url = get_template_directory_uri() . '/assets/images/opengraph.png';

?>


<div class="header-course">
    <div class="header-content">
        <div class="row">
            <div class="<?php echo esc_attr( $thumbnail_col_class ); ?>">
                <?php
                   if ( $has_thumbnail ) {
                    learn_press_get_template( 'single-course/thumbnail.php' );
                } elseif ( $has_video_intro ) {
                    echo '<div class="course-thumbnail">';
                    echo '<img src="' . esc_url( $default_image_url ) . '" alt="Default Image" />';
                    echo '<a href="' . esc_url( $has_video_intro ) . '" class="play-button video-thumbnail popup-youtube">
                              <span class="video-thumbnail hvr-push"></span>
                          </a>';
                          echo'</div>';
                }
                ?>
            </div>
            <div class="<?php echo esc_attr( $header_info_col_class ); ?>">
                <div class="header-info">
                    <h1 class="course-title text-<?php echo $has_thumbnail ? 'left' : 'center'; ?>">
                        <?php the_title(); ?></h1>
                    <?php if ( get_the_excerpt() ) { ?>
                    <p class="description">
                        <?php echo wp_trim_words( get_the_excerpt(), 35 ); ?>
                    </p>
                    <?php } ?>
                </div>

                <?php
                $course_id = $args['course_id'] ?? 0;
                $course    = learn_press_get_course( $course_id );
                if ( $course ) {
                    Template::instance()->get_frontend_template( 'single-course/progress.php', compact( 'course' ) );
                }

                // get course bbpress forum
                $forum_id = get_post_meta( $course->get_id(), '_lp_course_forum', true );
                if ( $forum_id && class_exists( 'LP_Addon_bbPress' ) && class_exists( 'bbPress' ) ) { ?>
                <div class="forum-section">
                    <span class="label"><?php esc_html_e( 'Visit Forum: ', 'ivy-school' ); ?></span>
                    <?php LP_Addon_bbPress::instance()->forum_link(); ?>
                </div>
                <?php } ?>
                <?php do_action( 'learn-press/course-buttons' ); ?>
            </div>
        </div>
    </div>
</div>

<div class="course-learning-summary">
    <?php learn_press_get_template( 'single-course/tabs/tabs.php' ); ?>
</div>


<?php do_action('theme_course_extra_boxes'); ?>