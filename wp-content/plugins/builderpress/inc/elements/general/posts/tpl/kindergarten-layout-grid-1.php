<?php
/**
 * Template for displaying default template Posts element layout kindergarten-layout-grid-1
 *
 * This template can be overridden by copying it to yourtheme/builderpress/posts/kindergarten-layout-grid-1.php.
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
            while ( $query->have_posts() ) : $query->the_post(); ?>
            <div class="col-lg-6">
                <div class="post-item color-<?php echo $i; ?>">
                    <div class="post-media">
                        <a href="<?php the_permalink(); ?>">
                            <?php
                            $size = apply_filters( 'builder-press/posts/kindergarten-layout-grid-1/image-size', '260x231' );
                            builder_press_get_attachment_image( get_the_ID(), $size, 'post' ); ?>
                        </a>

                        <div class="post-date">
                            <?php echo get_the_date('d M, Y') ?>
                        </div>
                    </div>

                    <div class="post-text">
                        <h4 class="title">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h4>

                        <div class="meta-info">
                            <span class="info-item">
                                <i class="ion ion-android-person"></i>
                                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>"><?php echo get_the_author(); ?></a>
                            </span>

                            <?php
                                if ( comments_open() ) {
                                    $num_comments = (int) get_comments_number();
                                    ?>
                                    <span class="info-item">
                                        <i class="ion ion-chatbox-working"></i>
                                        <?php echo ent2ncr( $num_comments ); ?> <?php if($num_comments > 1 ) { ?> <?php echo esc_html('Comments','builderpress') ?> <?php }else{ ?> <?php echo esc_html('Comment','builderpress') ?> <?php } ?>
                                    </span>
                            <?php
                                }
                                ?>
                        </div>

                        <div class="content">
                            <?php echo builder_press_excerpt( 13 );  ?>
                        </div>

                        <a href="<?php the_permalink(); ?>" class="link-readmore">
                            <?php echo esc_html__('Read More','builderpress'); ?>
                        </a>
                    </div>
                </div>
            </div>
        <?php
            $i++;
            endwhile; ?>
    </div>
</div>
