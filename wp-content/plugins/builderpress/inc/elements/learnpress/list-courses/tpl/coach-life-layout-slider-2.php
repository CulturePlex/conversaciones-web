<?php
/**
 * Template for displaying default template Learnpress List Courses element layout slider.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/list-courses/coach-life-layout-slider-2.php.
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

<div class="wrap-element">
    <div class="slide-course js-call-slick-col show-dot-number" data-numofslide="2" data-numofscroll="1" data-loopslide="1" data-autoscroll="0" data-speedauto="6000" data-respon="[2, 1], [2, 1], [2, 1], [1, 1], [1, 1]">

        <div class="wrap-arrow-slick">
            <div class="arow-slick prev-slick">
                <i class="ion ion-ios-arrow-thin-left"></i>
            </div>

            <div class="wrap-dot-slick"></div>

            <div class="arow-slick next-slick">
                <i class="ion ion-ios-arrow-thin-right"></i>
            </div>
        </div>

        <div class="slide-slick">
            <?php
                while ( $courses->have_posts() ) : $courses->the_post();
                    $course = learn_press_get_course( get_the_ID() );
                    $course_rate = learn_press_get_course_rate( get_the_ID() );
                    $number_students = intval($course->count_students());
                    $num = $number_students/1000 - (($number_students%1000)/1000);
                    $number_students = $num > 0 ? $num . 'K' : $number_students;
            ?>
                <div class="item-slick">
                    <div class="item-course">
                        <div class="image-course">
                            <a href="<?php the_permalink(); ?>">
                                <?php
                                    $size = apply_filters( 'builder-press/list-courses/coach-life-layout-slider-2/image-size', '360x235' );
                                    builder_press_get_attachment_image( get_post_thumbnail_id( get_the_ID() ), $size );
                                    ?>
                            </a>

                            <div class="price-course">
                                <?php echo esc_html( $course->get_price_html() ); ?>
                                <?php if ( $course->has_sale_price() ) { ?>
                                    <span class="old-price"> <?php echo esc_html( $course->get_origin_price_html() ); ?></span>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="text-course">
                            <h4 class="title-course">
                                <a href="<?php the_permalink(); ?>">
                                    <?php echo get_the_title(); ?>
                                </a>
                            </h4>

                            <div class="description-course">
                                <?php echo wp_trim_words( get_the_excerpt(), 13,'' ); ?>
                            </div>

                            <div class="foot-item">
                                <div class="author-course">
                                    <a href="#" class="ava-author">
                                        <?php echo $course->get_instructor()->get_profile_picture( '', 39 ); ?>
                                    </a>

                                    <span class="name-author">
                                        <?php echo $course->get_instructor_html(); ?>
                                    </span>
                                </div>

                                <div class="info-course">
                                    <span class="item-info">
                                        <i class="ion ion-android-person"></i> <?php echo esc_html($number_students);?>
                                    </span>

                                    <span class="item-info">
                                        <i class="ion ion-android-star"></i> <?php echo intval( $course_rate );?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                endwhile;
            ?>
        </div>

        <div class="wrap-arrow-slick">
            <div class="arow-slick prev-slick"></div>
            <div class="arow-slick next-slick"></div>
        </div>
    </div>
</div>