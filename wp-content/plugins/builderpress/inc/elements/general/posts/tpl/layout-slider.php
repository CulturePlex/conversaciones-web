<?php
/**
 * Template for displaying default template Posts element layout slider.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/posts/layout-slider.php.
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
<div class="heading-post">
    <?php if( isset($title) ) {?>
        <h3 class="title"><?php echo esc_html( $title ); ?></h3>
    <?php }?>
    <?php
        if($post_link):
    ?>
            <a href="<?php echo esc_url($post_link['url']); ?>" class="link">
                <?php echo esc_html($post_link['title']); ?>
            </a>
    <?php
        endif;
    ?>
</div>
<div class="list-posts">
    <div class="slide-posts js-call-slick-col" data-numofslide="3" data-numofscroll="1" data-loopslide="1"
         data-autoscroll="0" data-speedauto="6000" data-respon="[3, 1], [3, 1], [2, 1], [2, 1], [1, 1]">
        <div class="wrap-arrow-slick">
            <div class="arow-slick prev-slick">
                <i class="ion ion-ios-arrow-left"></i>
            </div>

            <div class="arow-slick next-slick">
                <i class="ion ion-ios-arrow-right"></i>
            </div>
        </div>
        <div class="slide-slick">
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <div class="item-slick">
                    <div class="post-item">
                        <div class="pic">
							<?php $size = apply_filters( 'builder-press/posts/image-size', '377x288' );
							builder_press_get_attachment_image( get_the_ID(), $size, 'post' ); ?>
                        </div>

                        <div class="content">
							<?php if ( $show_date ) { ?>
                                <div class="date"><?php echo get_the_date(); ?></div>
							<?php } ?>

                            <h4 class="title">
                                <a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
                            </h4>

                            <?php if ( $show_excerpt ) { ?>
                            <p class="description">
                                <?php echo wp_trim_words( get_the_excerpt(), 12 ); ?>
                            </p>
                            <?php }?>

                            <?php if ( $show_readmore ) { ?>
                                <a href="<?php the_permalink(); ?>" class="link">
                                    <?php echo esc_html__('Read More', 'builderpress');?>
                                </a>
                            <?php }?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>
