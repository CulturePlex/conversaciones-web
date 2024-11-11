<?php
/**
 * Template for displaying thumbnail of single course.
 *
 * @author   ThimPress
 * @package  CourseBuilder/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

global $post;
$course           = learn_press_get_course();

$video_intro      = get_post_meta( get_the_ID(), 'thim_course_media', true );
$thim_course_page = get_option( 'learn_press_single_course_image_size' );
$width            = ! empty ( $thim_course_page['width'] ) ? $thim_course_page['width'] : 1022;
$height           = ! empty ( $thim_course_page['height'] ) ? $thim_course_page['height'] : 608;
?>

<div class="course-thumbnail">
    <?php
	$image_title   = get_the_title( get_post_thumbnail_id() ) ? esc_attr( get_the_title( get_post_thumbnail_id() ) ) : '';
	$image_caption = get_post( get_post_thumbnail_id() ) ? esc_attr( get_post( get_post_thumbnail_id() )->post_excerpt ) : '""';
	$image_link    = wp_get_attachment_url( get_post_thumbnail_id() );
	$image_id = get_post_thumbnail_id( $post->ID );
	$imgurl = wp_get_attachment_image_src( $image_id, array( $width, $height ) );
	if ( ! $imgurl ) {
		$image = '<img src="' . esc_url( $image_link ) . '" alt="' . esc_attr( $image_title ) . '" title="' . esc_attr( $image_title ) . '" class="no-cropped"/>';
	} else {
		$image = '<img src="' . esc_url( $imgurl[0] ) . '" alt="' . esc_attr( $image_title ) . '" title="' . esc_attr( $image_title ) . '" />';
	}

	if ( learn_press_is_learning_course() && $course) {
		thim_thumbnail( $course->get_id(), '647x399', 'post', false );
	} else {
		echo( ent2ncr($image) );
	} ?>
    <?php if ( $video_intro ) { ?>
    <a href="<?php echo esc_url( $video_intro ); ?>" class="play-button video-thumbnail popup-youtube">
        <span class="video-thumbnail hvr-push"></span>
    </a>
    <?php } ?>
    <div class="time">
        <div class="date-start"><?php echo get_the_date( 'd' ); ?></div>
        <div class="month-start"><?php echo get_the_date( 'M, Y' ); ?></div>
    </div>

    <?php do_action('learn-press/coming-soon-countdown'); ?>
</div>