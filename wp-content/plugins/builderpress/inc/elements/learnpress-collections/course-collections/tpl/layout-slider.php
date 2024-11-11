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

<div class="slide-course js-call-slick-col" data-numofslide="<?php echo $params['items_visible'];?>" data-numofscroll="1" data-loopslide="0" data-autoscroll="0"
     data-speedauto="6000" data-respon="<?php echo $params['items_visible'];?>, 1], [<?php echo $params['items_visible'];?>, 1], [<?php echo $params['items_tablet'];?>, 1], [<?php echo $params['items_mobile'];?>, 1], [<?php echo $params['items_mobile'];?>, 1]">
    <div class="slide-slick">
		<?php while ( $collections->have_posts() ) {
			$collections->the_post(); ?>
            <div class="item-slick">
                <div class="course-item">
                    <div class="image">
                        <?php $size = apply_filters( 'builder-press/course-collections/layout-slider/image-size', '303x207' );
                        builder_press_get_attachment_image( get_post_thumbnail_id( get_the_ID() ), $size ); ?>
                    </div>

                    <div class="content">
                        <?php $icon = get_post_meta( get_the_ID(), '_thim_course_collection_icon', true );
                        if ( $icon ) { ?>
                            <div class="symbol">
                                <?php echo wp_get_attachment_image( $icon, 'full' ); ?>
                            </div>
                        <?php } ?>

                        <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

                        <p class="description">
                            <?php echo get_post_meta( get_the_ID(), '_thim_course_collection_sub_title', true ); ?>
                        </p>
                    </div>
                </div>
            </div>

		<?php } ?>
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
