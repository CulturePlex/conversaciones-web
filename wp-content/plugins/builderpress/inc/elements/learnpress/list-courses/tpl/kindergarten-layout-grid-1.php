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
<div class="wrap-element">
    <div class="row">
        <?php
            $i = 1;
            while ( $courses->have_posts() ) : $courses->the_post(); ?>
            <?php
                $course = learn_press_get_course( get_the_ID() );
                $science = get_post_meta( get_the_ID(), 'thim_course_science', true );
                $class_size = get_post_meta( get_the_ID(), 'thim_course_class_size', true );
                $year_old   = get_post_meta( get_the_ID(), 'thim_course_year_old', true );
                $price      = get_post_meta( get_the_ID(), 'thim_course_price', true ) ? get_post_meta( get_the_ID(), 'thim_course_price', true ) : esc_html__('Free','builderpress');
                $unit_price = get_post_meta( get_the_ID(), 'thim_course_unit_price', true );
                ?>
                <div class="col-md-6 col-xl-4">
                    <div class="class-item color-<?php echo $i; ?>">
                        <div class="class-image">
                            <a href="<?php the_permalink(); ?>">
                                <?php $size = apply_filters( 'builder-press/list-courses/kindergarten-layout-grid/image-size', '360x239' );
                                builder_press_get_attachment_image( get_post_thumbnail_id( get_the_ID() ), $size ); ?>
                            </a>
                        </div>

                        <div class="class-price">
                            <div class="price-background">
                                <div class="flower">
                                    <span class="petal"></span>
                                    <span class="petal"></span>
                                    <span class="petal"></span>
                                    <span class="petal"></span>
                                    <span class="petal"></span>
                                </div>
                            </div>

                            <span class="number"><?php echo $price;?></span>
                            <?php if($unit_price) echo $unit_price;?>
                        </div>

                        <div class="class-text">
                            <div class="cat">
                                <?php
                                    $category_html = bp_get_entry_meta_tax( get_the_ID(), 1,'course_category' );
                                    echo $category_html;
                                ?>
                            </div>

                            <h4 class="title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h4>

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
                                        <span><?php echo $science;?></span> <?php echo esc_html__('Science','builderpress');?>
                                    </div>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            $i++;
            endwhile; ?>
    </div>
</div>
