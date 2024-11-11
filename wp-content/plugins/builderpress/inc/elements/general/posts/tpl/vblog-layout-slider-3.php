<?php
/**
 * Template for displaying default template Posts element layout vblog-layout-slider-3.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/posts/vblog-layout-slider-3.php.
 *
 * @author      ThimPress
 * @package     BuilderPress/Templates
 * @version     1.0.0
 * @author      Thimpress, vinhnq
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

$i=$page=0;
$page++;
$group=array();
while ( $query->have_posts() ) : $query->the_post();
    $i++;
    $group[$page][$i] = get_the_ID();
    if($i%3==0) {
        $page++;
        $i=0;
    }
endwhile;
?>

<div class="wrap-element">
    <div class="heading-post">
        <?php if( $title ) {?>
            <h3 class="title"><?php echo esc_html( $title ); ?></h3>
        <?php }?>

        <div class="description">
            <?php
            echo ent2ncr($sub_title);
            ?>
        </div>
    </div>

    <div class="list-posts">
        <div class="slide-posts js-call-slick-gallery" data-numofshow="1" data-numofscroll="1" data-loopslide="1" data-autoscroll="0" data-speedauto="6000" data-responsive="[1, 1], [1, 1], [1, 1], [1, 1], [1, 1]">
            <div class="wrap-arrow-slick">
                <div class="arow-slick prev-slick">
                    <i class="ion ion-ios-arrow-left"></i>
                </div>

                <div class="arow-slick next-slick">
                    <i class="ion ion-ios-arrow-right"></i>
                </div>
            </div>

            <div class="slide-slick">
                <?php for($i=1;$i<=count($group);$i++) {?>
                    <?php if(isset($group[$i][1])) {?>
                    <div class="item-slick">
                        <div class="post-item">
                            <div class="row">
                                <div class="col-lg-6">
                                    <?php
                                    $categories = get_the_category($group[$i][1]);
                                    $cat = '';
                                    if ( ! empty( $categories ) ) {
                                        $cat = $categories[0]->name;
                                    }
                                    $author_id = get_post_field ('post_author', $group[$i][1]);
                                    $display_name = get_the_author_meta( 'display_name' , $author_id );
                                    ?>
                                    <div class="feature-item">
                                        <a href="<?php echo get_the_permalink($group[$i][1]); ?>">
                                            <?php $size = apply_filters( 'builder-press/posts/image-size', '570x350' );
                                            builder_press_get_attachment_image( $group[$i][1], $size, 'post' ); ?>
                                        </a>

                                        <div class="overlay"></div>

                                        <div class="content">
                                            <h4 class="title">
                                                <a href="<?php echo get_the_permalink($group[$i][1]); ?>"><?php echo get_the_title($group[$i][1]); ?></a>
                                            </h4>

                                            <div class="info">
                                                <span class="item-info"><?php echo esc_html__( 'by', 'builderpress' );?> <?php echo $display_name;;?></span>
                                                <span class="item-info"><?php echo get_the_date(get_option( 'date_format' ), $group[$i][1]); ?></span>
                                                <span class="item-info"><?php echo esc_html($cat);?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <?php if(isset($group[$i][2])) {?>
                                    <div class="item">
                                        <div class="pic">
                                            <a href="<?php echo get_the_permalink($group[$i][2]); ?>">
                                                <?php $size = apply_filters( 'builder-press/posts/image-size', '450x338' );
                                                builder_press_get_attachment_image( $group[$i][2], $size, 'post' ); ?>
                                            </a>
                                        </div>
                                        <div class="text">
                                            <div class="info">
                                                <?php echo get_the_date(get_option( 'date_format' ), $group[$i][2]); ?>
                                            </div>

                                            <h4 class="title">
                                                <a href="<?php echo get_the_permalink($group[$i][2]); ?>"><?php echo get_the_title($group[$i][2]); ?></a>
                                            </h4>

                                            <div class="description">
                                                <?php echo builder_press_excerpt( 30, $group[$i][2] ); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>
                                    <?php if(isset($group[$i][3])) {?>
                                    <div class="item">
                                        <div class="pic">
                                            <a href="<?php echo get_the_permalink($group[$i][3]); ?>">
                                                <?php $size = apply_filters( 'builder-press/posts/image-size', '450x338' );
                                                builder_press_get_attachment_image( $group[$i][3], $size, 'post' ); ?>
                                            </a>
                                        </div>
                                        <div class="text">
                                            <div class="info">
                                                <?php echo get_the_date(get_option( 'date_format' ), $group[$i][3]); ?>
                                            </div>

                                            <h4 class="title">
                                                <a href="<?php echo get_the_permalink($group[$i][3]); ?>"><?php echo get_the_title($group[$i][3]); ?></a>
                                            </h4>

                                            <div class="description">
                                                <?php echo builder_press_excerpt( 30, $group[$i][3] ); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                <?php }?>
            </div>
        </div>
    </div>
</div>