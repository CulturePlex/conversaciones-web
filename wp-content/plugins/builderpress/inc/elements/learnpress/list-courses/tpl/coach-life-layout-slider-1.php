<?php
/**
 * Template for displaying default template Learnpress List Courses element layout slider.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/list-courses/coach-life-layout-slider-1.php.
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
    <?php
        if(!empty($button['url'])):
            $title = $button['title'] ? $button['title'] : __( 'View All Courses', 'builderpress' );
            if ( isset ( $params['linktype_title'] ) && !empty($params['linktype_title'])) {
                $title = $params['linktype_title'];
            }

    ?>
        <div class="container">
            <a href="<?php echo esc_url($button['url']) ?>" class="link-element">
                <?php echo ent2ncr($title) ?>
            </a>
        </div>
    <?php
        endif;
    ?>

    <div class="slide-courses js-call-slick-col show-dot-number" data-numofslide="4" data-numofscroll="1" data-loopslide="1" data-autoscroll="0" data-speedauto="6000" data-respon="[3, 1], [3, 1], [2, 1], [2, 1], [1, 1]">
        <div class="slide-slick">
            <?php
                while ( $courses->have_posts() ) : $courses->the_post();
                    $course = learn_press_get_course( get_the_ID() );
                    if($course->get_price_html() === 'Free') {
                        $class_free = 'free-label';
                    }else {
                        $class_free = '';
                    }
            ?>
                    <div class="item-slick">
                        <div class="item-course">
                            <a href="<?php the_permalink(); ?>" class="image-course">
                                <?php
                                    $size = apply_filters( 'builder-press/list-courses/coach-life-layout-slider-1/image-size', '450x500' );
                                    builder_press_get_attachment_image( get_post_thumbnail_id( get_the_ID() ), $size );
                                ?>
                            </a>

                            <div class="price-course <?php echo esc_attr($class_free); ?>">
                                <?php echo esc_html( $course->get_price_html() ); ?>
                                <?php if ( $course->has_sale_price() ) { ?>
                                    <span class="old-price"> <?php echo esc_html( $course->get_origin_price_html() ); ?></span>
                                <?php } ?>
                            </div>

                            <div class="text-course">
                                <div class="date-course">
                                    <?php echo get_the_date("F j, Y"); ?>
                                </div>

                                <h4 class="title-course">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php echo get_the_title(); ?>
                                    </a>
                                </h4>

                                <div class="author-course">
                                    <a href="#" class="ava-author">
                                        <?php echo $course->get_instructor()->get_profile_picture( '', 28 ); ?>
                                    </a>

                                    <span class="text-author">
                                        <?php echo esc_html('by','builderpress'); ?>  <?php echo $course->get_instructor_html(); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                endwhile;
            ?>
        </div>

        <div class="container">
            <div class="wrap-arrow-slick">
                <div class="arow-slick prev-slick">
                    <i class="ion ion-ios-arrow-thin-left"></i>
                </div>

                <div class="wrap-dot-slick"></div>

                <div class="arow-slick next-slick">
                    <i class="ion ion-ios-arrow-thin-right"></i>
                </div>
            </div>
        </div>
    </div>
</div>