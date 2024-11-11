<?php
/**
 * Template for displaying default template Posts element layout kindergarten-layout-grid-2
 *
 * This template can be overridden by copying it to yourtheme/builderpress/posts/kindergarten-layout-grid-2.php.
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
//$thim_post_number_favorites = thim_meta('thim_post_number_favorites');
?>
<div class="wrap-element">
    <div class="row">
        <?php
        $i = 1;
        while ( $query->have_posts() ) : $query->the_post(); ?>
            <div class="col-md-4">
                <div class="post-item color-<?php echo $i; ?>">
                    <div class="post-image">
                        <a href="<?php the_permalink(); ?>">
                            <?php
                            $size = apply_filters( 'builder-press/posts/kindergarten-layout-grid-2/image-size', '360x213' );
                            builder_press_get_attachment_image( get_the_ID(), $size, 'post' ); ?>
                        </a>
                    </div>

                    <div class="post-date">
                        <span class="number"><?php echo get_the_date('d') ?></span> <?php echo get_the_date('M') ?>
                    </div>

                    <div class="post-text">
                        <div class="border-top"></div>

                        <h4 class="title">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h4>

                        <div class="description">
                            <?php echo builder_press_excerpt( 11 );  ?>
                        </div>

                        <ul class="info">
                            <li>
                                <i class="fa fa-user-o"></i>
                                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>"><?php echo get_the_author(); ?></a>
                            </li>


                            <li>
                                <i class="fa fa-heart-o"></i>
                                <?php thim_post_favorites(); ?>
                            </li>

                            <?php
                                if ( comments_open() ) {
                                    $num_comments = (int) get_comments_number();
                                ?>
                                    <li>
                                        <i class="fa fa-comments-o"></i>
                                        <?php echo ent2ncr( $num_comments ); ?>
                                    </li>
                                <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php
            $i++;
        endwhile; ?>
    </div>
</div>

