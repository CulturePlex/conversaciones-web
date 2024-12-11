<?php
/**
 * Template for displaying curriculum tab of single course.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/single-course/tabs/curriculum-v2.php.
 *
 * @author  ThimPress
 * @package  Learnpress/Templates
 * @version  4.1.6
 */

 use LearnPress\Helpers\Template;

defined( 'ABSPATH' ) || exit();

if ( empty( $args ) ) {
    return;
}

if ( isset( $args['sections'] ) && isset( $args['filters'] ) ) {
    $sections = $args['sections'];
    $filters  = $args['filters'];
} else {
    return;
}

$course = learn_press_get_course( $course_id ); 
if ( ! $course ) {
	return;
}
$curriculum_heading = apply_filters( 'learn_press_curriculum_heading', esc_html__( 'Course Content', 'ivy-school' ) );

Template::instance()->get_frontend_template('single-course/progress.php');
?>

<div class="course-curriculum" id="learn-press-course-curriculum">
    <div class="curriculum-heading">
        <?php if ( $curriculum_heading ) { ?>
        <div class="title">
            <h2 class="course-curriculum-title"><?php echo esc_html( $curriculum_heading ); ?></h2>
        </div>
        <?php } ?>

        <div class="meta-section">
            <?php
			$total_lesson = $course->count_items( 'lp_lesson' );
			$total_quiz   = $course->count_items( 'lp_quiz' );

			if ( $total_lesson || $total_quiz ) {
				echo '<span class="courses-lessons">' . esc_html__( 'Total learning: ', 'ivy-school' );
				if ( $total_lesson ) {
					echo '<span class="text">' . sprintf( _n( '%d lesson', '%d lessons', $total_lesson, 'ivy-school' ), $total_lesson ) . '</span>';
				}

				if ( $total_quiz ) {
					echo '<span class="text">' . sprintf( _n( ' / %d quiz', ' / %d quizzes', $total_quiz, 'ivy-school' ), $total_quiz ) . '</span>';
				}
				echo '</span>';
			}
			?>

            <?php
			$course_duration_text = thim_duration_time_calculator( $course->get_id(), 'lp_course' );
			$course_duration_meta = get_post_meta( $course->get_id(), '_lp_duration', true );
			$course_duration      = explode( ' ', $course_duration_meta );

			if ( ! empty( $course_duration[0] ) && $course_duration[0] != '0' ) {
				?>
            <span class="courses-time"><?php esc_html_e( 'Time: ', 'ivy-school' ); ?>
                <span class="text"><?php echo esc_html( $course_duration_text ); ?></span></span>
            <?php
			}
			?>
        </div>
    </div>
    <!-- Display Breadcrumb in sidebar course item popup -->
    <?php
        $course_id = $args['course_id'] ?? 0;
        $course = learn_press_get_course( $course_id );
        
        if ( $course ) {
            $course_title = get_the_title( $course_id );
            $course_permalink = get_permalink( $course_id );
            $categories = get_the_terms( $course_id, 'course_category' );
            
            $breadcrumb_html = '<nav class="thim-font-heading learn-press-breadcrumb">';
            $breadcrumb_html .= '<a href="' . esc_url( home_url() ) . '">' . esc_html__( 'Home', 'learnpress' ) . '</a>';
            
            $all_course_page_id = LP_Settings::instance()->get_option('courses_page_id', false);
            if ( $all_course_page_id ) {
                $breadcrumb_html .= ' <span class="delimiter">/</span> ';
                $breadcrumb_html .= '<a href="' . esc_url( get_permalink( $all_course_page_id ) ) . '">' . esc_html__( 'All Courses', 'learnpress' ) . '</a>';
            }
            
            if ( $categories && ! is_wp_error( $categories ) ) {
                $first_category = reset( $categories );
                $breadcrumb_html .= ' <span class="delimiter">/</span> ';
                $breadcrumb_html .= '<a href="' . esc_url( get_term_link( $first_category ) ) . '">' . esc_html( $first_category->name ) . '</a>';
            }
            
            $breadcrumb_html .= ' <span class="delimiter">/</span> ';
            $breadcrumb_html .= '<a href="' . esc_url( $course_permalink ) . '">' . esc_html( $course_title ) . '</a>';
            $breadcrumb_html .= '</nav>';
            
            echo $breadcrumb_html;
        }
    ?>
    <?php 
    $course_id = $args['course_id'] ?? 0;
    $course = learn_press_get_course( $course_id );
    if ( $course ) {
        Template::instance()->get_frontend_template( 'single-course/progress.php', compact('course') );
    }

    ?>
    <!-- Display course progress in course item popup -->
    <?php learn_press_course_progress(); ?>
    <!-- End -->

    <div class="curriculum-scrollable">
        <?php if ( $sections['total'] > 0 ) : ?>
        <ul class="curriculum-sections">
            <?php
				foreach ( $sections['results'] as $section ) :
					$args['section'] = $section;
					learn_press_get_template( 'loop/single-course/loop-section', $args );
				endforeach;
				?>
        </ul>
        <?php else : ?>
        <?php
			echo wp_kses_post( apply_filters( 'learnpress/course/curriculum/empty', esc_html__( 'The curriculum is empty', 'learnpress' ) ) );
			?>
        <?php endif; ?>
    </div>

    <?php if ( $sections['pages'] > 1 && $sections['pages'] > $filters->page ) : ?>
    <div class="curriculum-more">
        <button class="curriculum-more__button" data-page="<?php echo esc_attr( $filters->page ); ?>">
            <?php esc_html_e( 'Show more Sections', 'learnpress' ); ?>
        </button>
    </div>
    <?php endif; ?>
</div>