<?php
/**
 * Template for displaying default template Learnpress List Courses element kindergarten layout slider 1.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/list-courses/kindergarten-layout-slider-1.php.
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
    <div class="slide-classes js-call-slick-col" data-numofslide="3" data-numofscroll="1" data-loopslide="1" data-autoscroll="0" data-speedauto="6000" data-respon="[3, 1], [2, 1], [2, 1], [1, 1], [1, 1]">
        <div class="wrap-arrow-slick">
            <div class="arow-slick prev-slick">
                <img src="<?php echo plugins_url('assets/images/arrow-prev-color-01.png', dirname(__FILE__)) ?>" alt="<?php echo esc_html__('PREV','builderpress') ?>">
            </div>

            <div class="arow-slick next-slick">
                <img src="<?php echo plugins_url('assets/images/arrow-next-color-01.png', dirname(__FILE__)) ?>" alt="<?php echo esc_html__('NEXT','builderpress')?>">
            </div>
        </div>

        <div class="slide-slick">
            <?php while ( $courses->have_posts() ) : $courses->the_post(); ?>
                <?php
                    $course = learn_press_get_course( get_the_ID() );
                    $science = get_post_meta( get_the_ID(), 'thim_course_science', true );
                    $class_size = get_post_meta( get_the_ID(), 'thim_course_class_size', true );
                    $year_old   = get_post_meta( get_the_ID(), 'thim_course_year_old', true );
                    $price      = get_post_meta( get_the_ID(), 'thim_course_price', true ) ? get_post_meta( get_the_ID(), 'thim_course_price', true ) : esc_html__('Free','builderpress');
                    $unit_price = get_post_meta( get_the_ID(), 'thim_course_unit_price', true );
                ?>
                <div class="item-slick">
                    <div class="class-item">
                        <div class="class-image">
                            <a href="<?php the_permalink(); ?>">
                                <?php $size = apply_filters( 'builder-press/list-courses/kindergarten-layout-slider-1/image-size', '360x278' );
                                builder_press_get_attachment_image( get_post_thumbnail_id( get_the_ID() ), $size ); ?>
                            </a>
                        </div>

                        <div class="class-price">
                            <span class="number"><?php echo $price;?></span> /month
                        </div>

                        <div class="class-text">
                            <div class="border-top"></div>

                            <h4 class="title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h4>

                            <div class="description">
                                <?php echo wp_trim_words( get_the_excerpt(), 20,'' ); ?>
                            </div>

                            <div class="info">
                                <?php if($year_old) {?>
                                    <div class="info-item">
                                        <span><?php echo $year_old;?></span> <?php echo esc_html__('Years Old','builderpress');?>
                                    </div>
                                    <div class="line"></div>
                                <?php }?>

                                <?php if($class_size) {?>
                                    <div class="info-item">
                                        <span><?php echo $class_size;?></span> <?php echo esc_html__('Class Size','builderpress');?>
                                    </div>
                                    <div class="line"></div>
                                <?php }?>

                                <?php if($science) {?>
                                    <div class="info-item">
                                        <span><?php echo $science;?></span> <?php echo esc_html__('Educators','builderpress');?>
                                    </div>
                                <?php }?>
                            </div>

                        </div>
                    </div>
                </div>
            <?php
                endwhile; ?>
        </div>
    </div>

</div>
