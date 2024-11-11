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
<div class="slide-course js-call-slick-col" data-numofslide="3" data-numofscroll="1" data-loopslide="1" data-autoscroll="0" data-speedauto="6000" data-respon="[3, 1], [3, 1], [2, 1], [1, 1], [1, 1]" data-middlearrow=".course-image">
    <div class="slide-slick">
        <?php while ( $courses->have_posts() ) : $courses->the_post(); ?>
            <?php
                $course = learn_press_get_course( get_the_ID() );
                $time_course = get_post_meta(get_the_ID(),'thim_course_time',true);
                $day_of_week = get_post_meta(get_the_ID(),'thim_course_day_of_week',true);
                ?>
            <div class="item-slick">
                <div class="course-item">
                    <a href="<?php the_permalink(); ?>" class="link-item"></a>
                    <div class="course-image">
                        <?php $size = apply_filters( 'builder-press/list-courses/layout-slider/image-size', '360x238' );
                        builder_press_get_attachment_image( get_post_thumbnail_id( get_the_ID() ), $size ); ?>
                    </div>

                    <div class="course-text">
                        <h4 class="title">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h4>

                        <ul class="info-list">
                            <?php
                                if($time_course):
                            ?>
                                <li class="info-item">
                                    <span>Time:</span> <?php echo  esc_html($time_course); ?>
                                </li>
                            <?php endif; ?>

                            <?php
                                if($day_of_week):
                            ?>
                                <li class="info-item">
                                    <span>Days of Week:</span>  <?php echo  esc_html($day_of_week); ?>
                                </li>
                            <?php
                                endif;
                            ?>
                        </ul>

                        <div class="price">
                            <span class="number">
                                <?php echo esc_html( $course->get_price_html() ); ?>
                                <?php if ( $course->has_sale_price() ) { ?>
                                    <span class="old-price"> <?php echo esc_html( $course->get_origin_price_html() ); ?></span>
                                <?php } ?>
                            </span>
                            <span class="line">/</span>monthly
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
