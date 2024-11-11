<?php
/**
 * Template for displaying default template Learnpress Course Collections element layout layout-slider.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/course-collections/layout-slider.php.
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

<div class="slide-category-course js-call-slick-col" dir="rtl" data-rtl="1" data-numofslide="<?php echo $params['items_visible'];?>" data-numofscroll="1" data-loopslide="0" data-autoscroll="0"
     data-speedauto="6000" data-respon="<?php echo $params['items_visible'];?>, 1], [<?php echo $params['items_visible'];?>, 1], [<?php echo $params['items_tablet'];?>, 1], [<?php echo $params['items_mobile'];?>, 1], [<?php echo $params['items_mobile'];?>, 1]">
    <div class="slide-slick">
		<?php
        $i=0;
        while ( $collections->have_posts() ) {
			$collections->the_post();
			$i++;
            $src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
            ?>
            <div class="item-slick">
                <div class="course-item <?php echo ($i%2==0) ? 'color-1' : 'color-2';?>">
                    <a href="<?php the_permalink(); ?>" class="content" style="background-image: url(<?php echo $src[0];?>);">
                        <h3 class="title">
                            <?php the_title(); ?>
                        </h3>

                        <div class="description">
                            <?php echo get_post_meta( get_the_ID(), '_thim_course_collection_sub_title', true ); ?>
                        </div>
                    </a>
                </div>
            </div>

		<?php } ?>
    </div>
    <div class="wrap-arrow-slick">
        <div class="arow-slick prev-slick">
            <i class="ion ion-ios-arrow-thin-left"></i>
        </div>

        <div class="arow-slick next-slick">
            <i class="ion ion-ios-arrow-thin-right"></i>
        </div>

    </div>

    <div class="wrap-arrow-slick-clone">
        <div class="arow-slick next-slick"></div>
    </div>
</div>
