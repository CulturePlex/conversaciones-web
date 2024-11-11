<?php
/**
 * Template for displaying default template Learnpress List Courses element layout slider.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/list-courses/layout-slider.php.
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
<div class="slide-course js-call-slick-col" data-numofslide="4" data-numofscroll="1" data-loopslide="1"
     data-autoscroll="0" data-speedauto="6000" data-respon="[4, 1], [3, 1], [2, 1], [2, 1], [1, 1]">
    <div class="slide-slick">
		<?php while ( $courses->have_posts() ) : $courses->the_post(); ?>
			<?php $course = learn_press_get_course( get_the_ID() ); ?>

            <div class="item-slick">
                <div class="course-item">
                    <a href="<?php the_permalink(); ?>" class="link-item"></a>
                    <div class="image">
						<?php $size = apply_filters( 'builder-press/list-courses/layout-slider/image-size', '284x200' );
						builder_press_get_attachment_image( get_post_thumbnail_id( get_the_ID() ), $size ); ?>
                    </div>

                    <div class="content">
                        <div class="ava">
							<?php echo $course->get_instructor()->get_profile_picture( '', 68 ); ?>
                        </div>

                        <div class="name">
							<?php echo $course->get_instructor_html(); ?>
                        </div>

						<?php
                        if( is_plugin_active( 'learnpress-course-review/learnpress-course-review.php' ) ) {
                            $num_ratings = learn_press_get_course_rate_total( get_the_ID() ) ? learn_press_get_course_rate_total( get_the_ID() ) : 0;
                            $course_rate       = learn_press_get_course_rate( get_the_ID() );
                            $non_star          = 5 - intval( $course_rate ); ?>

                            <div class="star">
                                <?php for ( $i = 0; $i < intval( $course_rate ); $i ++ ) { ?>
                                    <i class="fa fa-star"></i>
                                <?php } ?>
                                <?php for ( $j = 0; $j < intval( $non_star ); $j ++ ) { ?>
                                    <i class="fa fa-star-o"></i>
                                <?php } ?>
                            </div>
                            <?php
                        }
                        ?>

                        <h4 class="title">
                            <a href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
                            </a>
                        </h4>
                    </div>

                    <div class="info">
                        <div class="price">
							<?php echo esc_html( $course->get_price_html() ); ?>
							<?php if ( $course->has_sale_price() ) { ?>
                                <span class="old-price"> <?php echo esc_html( $course->get_origin_price_html() ); ?></span>
							<?php } ?>
                        </div>

                        <div class="numbers">
                            <span class="contact">
                                <i class="ion ion-android-contacts"></i>
	                            <?php echo intval( $course->count_students() ); ?>
                            </span>
                            <?php //if( !empty($num_ratings) ) {?>
                            <span class="chat">
                                <i class="ion ion-chatbubbles"></i>
								<?php echo esc_html( $num_ratings ); ?>
                            </span>
                            <?php //}?>
                        </div>
                    </div>
                </div>
            </div>
		<?php endwhile; ?>

    </div>

    <div class="wrap-arrow-slick">
        <div class="arow-slick prev-slick">
            <i class="ion ion-ios-arrow-left"></i>
        </div>

        <div class="arow-slick next-slick">
            <i class="ion ion-ios-arrow-right"></i>
        </div>
    </div>
</div>
