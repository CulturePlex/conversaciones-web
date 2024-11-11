<?php
/**
 * Template for displaying default template Learnpress List Courses element layout slider.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/list-courses/layout-slider.php
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
$i=0;
$num_ratings = 0;
?>
<div class="row">
    <?php while ( $courses->have_posts() ) : $courses->the_post(); $i++; ?>
    <?php
        $course = learn_press_get_course( get_the_ID() );
        if( is_plugin_active( 'learnpress-course-review/learnpress-course-review.php' ) ) {
            $num_ratings = learn_press_get_course_rate_total( get_the_ID() ) ? learn_press_get_course_rate_total( get_the_ID() ) : 0;
            $course_rate = learn_press_get_course_rate( get_the_ID() );
        }
        ?>
    <div class="custom-col col-sm-6 col-md-6 col-lg-3 wrapper-item-course">
        <div class="item-course <?php echo ($i%2==0) ? 'color-1' : 'color-2';?>">
            <div class="pic">
                <a href="<?php the_permalink(); ?>">
                <?php $size = apply_filters( 'builder-press/list-courses/layout-grid/image-size', '450x300' );
                builder_press_get_attachment_image( get_post_thumbnail_id( get_the_ID() ), $size ); ?>
                </a>

                <?php if( $course->get_price_html() ) {?>
                    <div class="price">
                        <?php echo esc_html( $course->get_price_html() ); ?>
                        <?php if ( $course->has_sale_price() ) { ?>
                            <span class="old-price"> <?php echo esc_html( $course->get_origin_price_html() ); ?></span>
                        <?php } ?>
                    </div>
                <?php }?>
            </div>

            <div class="text">
                <div class="teacher">
                    <div class="ava">
                        <?php echo $course->get_instructor()->get_profile_picture( '', 68 ); ?>
                    </div>

                    <?php echo $course->get_instructor_html(); ?>
                </div>

                <h3 class="title-course">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h3>

                <div class="info-course">
                    <span>
                        <i class="ion ion-android-person"></i>
                        <?php echo intval( $course->count_students() ); ?>
                    </span>
                    <?php
                        $courses_tag = get_the_terms($course->get_id(),'course_tag');

                    ?>
                    <?php if($courses_tag) {?>
                    <a href="<?php echo get_term_link($courses_tag[0]->term_id) ?>">
                        <i class="ion ion-ios-pricetags-outline"></i>
                        <?php
                        echo $courses_tag[0]-> name;
                        ?>
                    </a>
                    <?php }?>
                    <?php if( is_plugin_active( 'learnpress-course-review/learnpress-course-review.php' ) ) {?>
                    <span class="star">
                        <i class="ion ion-android-star"></i>
                        <?php echo intval( $course_rate );?>
                    </span>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
</div>