<?php
/**
 * Template for displaying course info of single course.
 *
 * @author   ThimPress
 * @package  CourseBuilder/Templates
 * @version  4.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$course_id = get_the_ID();
$course    = learn_press_get_course( $course_id );
$author    = $course->get_author();
$terms = get_the_terms( $course_id, 'course_category' );
$cat = !empty($terms) ? '<a href="' . get_term_link( $terms[0], 'course_category' ) . '">' . $terms[0]->name . '</a>' : '';
?>
<div class="entry-button-meta">
	<div class="entry-meta">
		<div class="list-inline-item item-author">
			<div class="author vcard">
                <?php echo get_avatar( get_post_field( 'post_author', get_the_ID() ), 60 ); ?>
                <div class="info_author">
                    <label><?php esc_html_e( 'Teacher', 'ivy-school' ); ?></label>
                    <span class="name_author"><?php echo esc_html($author->get_data( 'display_name' )); ?></span>
                </div>
            </div>
		</div>
        <?php if ( $cat ) { ?>
		<div class="list-inline-item entry-categoy">
			<label><?php esc_html_e( 'Categories', 'ivy-school' ); ?></label>
			<?php printf( '<span class="cat-links">%s</span>', $cat ); ?>
		</div>
        <?php }?>
        <?php
        // get course bbpress forum
        $forum_id = get_post_meta( $course->get_id(), '_lp_course_forum', true );
        if ( $forum_id && class_exists( 'LP_Addon_bbPress' ) && class_exists( 'bbPress' ) ) { ?>
            <div class="list-inline-item entry-forum">
                <label><?php esc_html_e( 'Visit Forum: ', 'ivy-school' ); ?></label>
                <?php LP_Addon_bbPress::instance()->forum_link(); ?>
            </div>
        <?php } ?>
		<?php if ( function_exists( "learn_press_get_course_rate" ) ) : ?>
			<?php
			$total = $course_rate = 0;

			$course_rate_res = learn_press_get_course_rate( $course_id, false );
			$course_rate     = $course_rate_res['rated'];
			$total           = $course_rate_res['total'];
			?>
			<div class="list-inline-item item-review">
				<label><?php esc_html_e( 'Review', 'ivy-school' ); ?></label>
				<div class="rating">
                    <?php
                    // rating
                    learn_press_course_review_template( 'rating-stars.php', array( 'rated' => $course_rate ) );
                    if ( is_single() ) {
                        $total = intval( $total );
                        if ( $total > 0 ) {
                            $text = sprintf( _n( '(%s Review)', '(%s Reviews)', $total, 'ivy-school' ), $total );
                        } else {
                            $text = sprintf(  __( '(%s Review)', 'ivy-school' ), 0 );
                        }
                    } else {
                        $text = sprintf( _n( '( %s Rating )', '( %s Ratings )', $total, 'ivy-school' ), $total );
                    }
                    ?>
                    <span><?php echo ent2ncr( $text );?></span>
                </div>
			</div>
		<?php endif; ?>
	</div>
</div>