<?php
/**
 * Template for displaying default template Learnpress Course Collections element layout layout-slider.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/course-collections/layout-grid.php.
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
$size = apply_filters( 'builder-press/course-collections/layout-grid/image-size', '360x238' );
$course_link  = $params['course_link'];
?>
<div class="wrap-element">
    <?php
        if($course_link):
    ?>
            <a href="<?php echo esc_url($course_link['url']); ?>" class="link-view-all">
                <?php echo esc_html($course_link['title']); ?>
            </a>
    <?php
        endif;
    ?>
    <div class="row">
    <?php
        $i=1;
        while ( $collections->have_posts() ) {
            $collections->the_post();
    ?>
            <div class="col-sm-6 col-lg-4">
                <div class="course-item color-<?php echo $i; ?>">
                    <div class="course-image">
                        <a href="<?php the_permalink(); ?>">
                           <?php
                                builder_press_get_attachment_image( get_post_thumbnail_id( get_the_ID() ), $size );
                           ?>
                        </a>
                    </div>

                    <div class="course-text">
                        <h4 class="title">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h4>
                        <div class="content">
                            <?php echo get_post_meta( get_the_ID(), '_thim_course_collection_sub_title', true ); ?>
                        </div>
                    </div>
                </div>
            </div>

        <?php
            $i++;
    }
        ?>
</div>
</div>