<?php
/**
 * Related Post
 *
 */

$related         = thim_get_related_posts();
$related_columns = thim_get_related_columns_class( 'item-slick' );

if ( $related->have_posts() ) {
	?>
	<section class="related-archive">

            <h3 class="related-title"><?php esc_html_e( 'Related Posts', 'ivy-school' ); ?></h3>
            <?php
            echo '<div class="archived-posts">';
                echo '<div class="related-slider js-call-slick-col" data-numofslide="3" data-numofscroll="1" data-loopslide="1" data-autoscroll="0" data-speedauto="6000" data-respon="[3, 1], [2, 1], [2, 1], [1, 1], [1, 1]">';
                    echo '<div class="wrap-arrow-slick">';
                         echo ' <div class="arow-slick prev-slick">' ;
                              echo '<i class="ion ion-ios-arrow-left"></i>';
                         echo '</div>';

                         echo ' <div class="arow-slick next-slick">';
                               echo ' <i class="ion ion-ios-arrow-right"></i>';
                         echo '</div>';
                    echo '</div>';

                    echo '<div class="slide-slick">';
                        while ( $related->have_posts() ) {
                            $related->the_post();
                            if ( has_post_thumbnail() ) {
                                ?>
                                <div <?php post_class( $related_columns ); ?>>
                                    <div class="category-posts clear">
                                        <div class="entry-thumbnail">
                                            <?php thim_feature_image( get_post_thumbnail_id(), 284, 210, true ); ?>
                                            <?php thim_entry_meta_date(); ?>
                                        </div>
                                        <div class="rel-post-text">
                                            <h5 class="entry-title">
                                                <a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></a>
                                            </h5>
                                            <?php thim_entry_meta(); ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            } else { ?>
                                <li <?php post_class( $related_columns ); ?>>
                                    <div class="category-posts clear">
                                        <div class="rel-post-text no-thumb">
                                            <h5 class="entry-title no-images">
                                                <a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></a>
                                            </h5>

                                            <?php thim_entry_meta(); ?>
                                        </div>
                                    </div>
                                </li>
                            <?php }
                        }
                     echo '</div>';
                 echo '</div>';
            echo '</div>';
            ?>

	</section><!--.related-->
	<?php
}

wp_reset_postdata();

?>