<?php
/**
 * Template for displaying instructor of course within the loop.
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();
global $layout_courses, $num_ratings;
$course = learn_press_get_course();
if ( ! $course  ) {
	return;
}
if( thim_plugin_active( 'learnpress-course-review' ) ) {
    $num_ratings = learn_press_get_course_rate_total($course->get_id()) ? learn_press_get_course_rate_total($course->get_id()) : 0;
}
?>
<?php
    $layout_courses = get_theme_mod('layout_courses','default_courses');
?>
        <?php
            if($layout_courses === "left_courses") {
        ?>
                <div class="info-course">
                    <span>
                        <i class="ion ion-android-person"></i>
                        <?php echo intval($course->count_students());?>
                    </span>
                    <?php $courses_tag = get_the_terms($course->get_id(),'course_tag');?>
                    <?php if($courses_tag) {?>
                        <a href="<?php echo get_term_link($courses_tag[0]->term_id) ?>">
                            <i class="ion ion-ios-pricetags-outline"></i>
                            <?php
                            echo esc_html($courses_tag[0]-> name);
                            ?>
                        </a>
                    <?php }?>
                    <?php if( thim_plugin_active( 'learnpress-course-review' ) ) {?>
                    <span class="star">
                        <i class="ion ion-android-star"></i>
                        <?php echo intval($num_ratings); ?>
                    </span>
                    <?php }?>
                </div>
        <?php
            }else{
        ?>
                <div class="info">
                    <div class="price<?php if($course->is_free()) echo ' free';?>">
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
                        <?php
                            if( thim_plugin_active( 'learnpress-course-review' ) ) {
                                ?>
                                <span class="chat">
                                <i class="ion ion-chatbubbles"></i>
                                    <?php echo esc_html($num_ratings); ?>
                            </span>
                                <?php
                            }
                        ?>
                    </div>
                </div>
        <?php }?>
