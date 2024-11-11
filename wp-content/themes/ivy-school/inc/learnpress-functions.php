<?php
add_action( 'learn-press/begin-section-loop-item', 'thim_add_format_icon', 10 );
if ( ! function_exists( 'thim_add_format_icon' ) ) {
	function thim_add_format_icon( $item ) {
		$format = get_post_format( $item->get_id() );
		if ( get_post_type( $item->get_id() ) == 'lp_quiz' ) {
			echo '<span class="course-format-icon"><i class="fa fa-clock-o"></i></span>';
		} elseif ( $format == 'video' ) {
			echo '<span class="course-format-icon"><i class="fa fa-play"></i></span>';
		} elseif ( $format == 'audio' ) {
			echo '<span class="course-format-icon"><i class="fa fa-music"></i></span>';
		} elseif ( $format == 'image' ) {
			echo '<span class="course-format-icon"><i class="fa fa-picture-o"></i></span>';
		} elseif ( $format == 'aside' ) {
			echo '<span class="course-format-icon"><i class="fa fa-file-o"></i></span>';
		} elseif ( $format == 'quote' ) {
			echo '<span class="course-format-icon"><i class="fa fa-quote-left"></i></span>';
		} elseif ( $format == 'link' ) {
			echo '<span class="course-format-icon"><i class="fa fa-link"></i></span>';
		} else {
			echo '<span class="course-format-icon"><i class="fa fa-file-o"></i></span>';
		}
	}
}
/**
 * Get course, lesson, ... duration in hours
 *
 * @param $id
 *
 * @param $post_type
 *
 * @return string
 */

if ( ! function_exists( 'thim_duration_time_calculator' ) ) {
	function thim_duration_time_calculator( $id, $post_type = 'lp_course' ) {
		if ( $post_type == 'lp_course' ) {
			$course_duration_meta = get_post_meta( $id, '_lp_duration', true );
			$course_duration_arr  = array_pad( explode( ' ', $course_duration_meta, 2 ), 2, 'minute' );

			list( $number, $time ) = $course_duration_arr;

			switch ( $time ) {
				case 'week':
					$course_duration_text = sprintf( _n( "%s week", "%s weeks", $number, 'ivy-school' ), $number );
					break;
				case 'day':
					$course_duration_text = sprintf( _n( "%s day", "%s days", $number, 'ivy-school' ), $number );
					break;
				case 'hour':
					$course_duration_text = sprintf( _n( "%s hour", "%s hours", $number, 'ivy-school' ), $number );
					break;
				default:
					$course_duration_text = sprintf( _n( "%s minute", "%s minutes", $number, 'ivy-school' ), $number );
			}

			return $course_duration_text;
		} else { // lesson, quiz duration
			$duration = get_post_meta( $id, '_lp_duration', true );

			if ( ! $duration ) {
				return '';
			}
			$duration = ( strtotime( $duration ) - time() ) / 60;
			$hour     = floor( $duration / 60 );
			$minute   = $duration % 60;

			if ( $hour && $minute ) {
				$time = $hour . esc_html__( 'h', 'ivy-school' ) . ' ' . $minute . esc_html__( 'm', 'ivy-school' );
			} elseif ( ! $hour && $minute ) {
				$time = $minute . esc_html__( 'm', 'ivy-school' );
			} elseif ( ! $minute && $hour ) {
				$time = $hour . esc_html__( 'h', 'ivy-school' );
			} else {
				$time = '';
			}
			return $time;
		}
	}
}

if ( ! function_exists( 'thim_landing_tabs' ) ) {
	function thim_landing_tabs() {
		learn_press_get_template( 'single-course/tabs/tabs-landing.php' );
	}
}

if ( ! function_exists( 'thim_related_courses' ) ) {

	function thim_related_courses() {
		$related_courses = thim_get_related_courses( 6 );
		if ( $related_courses ) {
			?>
			<div class="related-archive">
				<h3 class="related-title"><?php esc_html_e( 'Related Courses', 'ivy-school' ); ?></h3>

				<div class="slide-course js-call-slick-col" data-numofslide="3" data-numofscroll="1" data-loopslide="1" data-autoscroll="0" data-speedauto="6000" data-respon="[3, 1], [3, 1], [2, 1], [2, 1], [1, 1]">
					<div class="slide-slick">
						<?php foreach ( $related_courses as $course_item ) : ?>
							<?php
							$course      = LP_Course::get_course( $course_item->ID );
							$is_required = $course->is_required_enroll();
							$course_id   = $course_item->ID;
							if ( class_exists( 'LP_Addon_Course_Review' ) ) {
								$course_rate              = learn_press_get_course_rate( $course_id );
								$course_number_vote       = learn_press_get_course_rate_total( $course_id );
								$html_course_number_votes = $course_number_vote ? sprintf( _n( '(%1$s vote )', ' (%1$s votes)', $course_number_vote, 'ivy-school' ), number_format_i18n( $course_number_vote ) ) : esc_html__( '(0 vote)', 'ivy-school' );
							}
							?>
							<div class="item-slick">
								<div class="course-item">
									<a href="<?php echo get_permalink($course->get_id());?>" class="link-item"></a>
									<div class="image">
										<?php
										echo thim_feature_image( get_post_thumbnail_id( $course->get_id()), 284, 200, false );
										?>
									</div>

									<div class="content">
										<div class="ava">
											<?php echo ent2ncr($course->get_instructor()->get_profile_picture('',68)) ?>
										</div>

										<div class="name">
											<?php echo ent2ncr($course->get_instructor_html()); ?>
										</div>

										<?php
										if ( class_exists( 'LP_Addon_Course_Review' ) ) {
											$num_ratings = learn_press_get_course_rate_total( $course_id) ? learn_press_get_course_rate_total( $course_id ) : 0;
											$course_rate   = learn_press_get_course_rate( $course_id );
											$non_star = 5 - intval($course_rate);
											?>
											<div class="star">
												<?php for ($i=0;$i<intval($course_rate);$i++) {?>
													<i class="fa fa-star"></i>
												<?php }?>
												<?php for ($j=0;$j<intval($non_star);$j++) {?>
													<i class="fa fa-star-o"></i>
												<?php }?>
											</div>
										<?php }?>

										<h4 class="title">
											<a href="<?php echo get_permalink($course->get_id());?>">
												<?php echo get_the_title($course->get_id());?>
											</a>
										</h4>
									</div>

									<div class="info">
										<div class="price">
											<?php echo esc_html($course->get_price_html()); ?>
											<?php if ( $course->has_sale_price() ) { ?>
												<span class="old-price"> <?php echo esc_html($course->get_origin_price_html()); ?></span>
											<?php } ?>
										</div>

										<div class="numbers">
                                            <span class="contact">
                                                <i class="ion ion-android-contacts"></i>
                                                <?php echo intval($course->count_students());?>
                                            </span>
											<?php if ( class_exists( 'LP_Addon_Course_Review' ) ) {?>
												<span class="chat">
                                                <i class="ion ion-chatbubbles"></i>
                                                <?php echo esc_html($num_ratings);?>
                                            </span>
											<?php }?>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="courses-carousel archive-courses course-grid owl-carousel owl-theme" data-cols="3">

				</div>
			</div>
			<?php
		}
	}
}
if( !function_exists('thim_get_related_courses') ) {
	function thim_get_related_courses( $limit ) {
		if ( ! $limit ) {
			$limit = 3;
		}
		$course_id = get_the_ID();

		$tag_ids = array();
		$tags    = get_the_terms( $course_id, 'course_category' );

		if ( $tags ) {
			foreach ( $tags as $individual_tag ) {
				$tag_ids[] = $individual_tag->slug;
			}
		}

		$args = array(
			'posts_per_page'      => $limit,
			'paged'               => 1,
			'ignore_sticky_posts' => 1,
			'post__not_in'        => array( $course_id ),
			'post_type'           => 'lp_course'
		);

		if ( $tag_ids ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'course_category',
					'field'    => 'slug',
					'terms'    => $tag_ids
				)
			);
		}
		$related = array();
		if ( $posts = new WP_Query( $args ) ) {
			global $post;
			while ( $posts->have_posts() ) {
				$posts->the_post();
				$related[] = $post;
			}
		}
		wp_reset_query();

		return $related;
	}
}

add_action( 'thim-info-bar-position', 'thim_info_bar_position_single', 71 );
function thim_info_bar_position_single() { ?>
	<div class="wrapper-info-bar infobar-single">
		<?php learn_press_get_template( 'single-course/info-bar.php' ); ?>
	</div>
	<?php
}
// Add media for only Lesson
if ( ! function_exists( 'thim_add_media_lesson_content' ) ) {
	function thim_add_media_lesson_content() {
		$course_item      = LP_Global::course_item();
		$user          = learn_press_get_current_user();
		$course        = learn_press_get_course();
		if(! $course || ! $user){
			return;
		}
		$can_view_item = $user->can_view_item( $course_item->get_id(), $course->get_id() );
		$lesson_media_meta = get_post_meta( $course_item->get_id(), '_lp_lesson_video_intro', true );

		if ( ! empty( $lesson_media_meta ) && $can_view_item ) {
			echo '<div class="thim-lesson-media"><div class="wrapper">' . ( $lesson_media_meta ) . '</div></div>';
		}

	}
}
// add edit link in content course item

if ( !function_exists( 'thim_content_item_edit_link' ) ) {
	function thim_content_item_edit_link() {
 		$course_item = LP_Global::course_item();
 		$user          = learn_press_get_current_user();
		$course        = learn_press_get_course();
		if(! $course || ! $user){
			return;
		}
		if ( $user->can_edit_item( $course_item->get_id(), $course->get_id() ) ): ?>
			<p class="edit-course-item-link">
				<a href="<?php echo get_edit_post_link( $course_item->get_id() ); ?>"><i
						class="fa fa-pencil-square-o"></i> <?php _e( 'Edit item', 'ivy-school' ); ?>
				</a>
			</p>
		<?php endif;
	}
}

// add action show loop info
add_action( 'thim-courses-loop-item-info', 'thim_courses_loop_item_info', 5 );
if ( ! function_exists( 'thim_courses_loop_item_info' ) ) {
	function thim_courses_loop_item_info() {
		learn_press_get_template( 'loop/course/info.php' );
	}
}

// add action show loop review
if( thim_plugin_active( 'learnpress-course-review' ) ) {
	add_action( 'thim-before-courses-loop-item-title', 'thim_courses_loop_item_review', 10 );
	if ( ! function_exists( 'thim_courses_loop_item_review' ) ) {
		function thim_courses_loop_item_review() {
			learn_press_get_template( 'loop/course/review.php' );
		}
	}
}
/**
 * Add Class for body
 */
function thim_learnpress_body_classes( $classes ) {

	if ( is_singular( 'lp_course' ) ) {
		$layouts = get_theme_mod( 'learnpress_single_course_style', 1 );
		$layouts = isset( $_GET['layout'] ) ? $_GET['layout'] : $layouts;

		$classes[] = 'thim-lp-layout-' . $layouts;

		$course = learn_press_get_course();
		$user   = learn_press_get_current_user();
		if ( $user->has_course_status( $course->get_id(), array(
				'enrolled',
				'finished'
			) ) || ! $course->is_required_enroll()
		) {
			$classes[] = 'lp-learning';
		} else {
			$classes[] = 'lp-landing';
		}
	}

	if ( learn_press_is_profile() ) {
		$classes[] = 'lp-profile';
	}
	if ( thim_is_new_learnpress( '4.0.0-beta-0' ) ) {
		$classes[] = 'lp-4';
	}
	return $classes;
}

add_filter( 'body_class', 'thim_learnpress_body_classes' );
