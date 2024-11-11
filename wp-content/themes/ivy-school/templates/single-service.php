<?php
/**
 * Template Name: Single Service
 */

global $post;
get_header();

do_action( 'thim_wrapper_loop_start' );
?>

<div class="single-service">
	<?php
	while ( have_posts() ) : the_post();
		?>
		<div class="post-content">
			<?php the_content(); ?>
		</div>
	<?php
	endwhile;
	wp_reset_postdata();

	$args = apply_filters( 'related_services_block_arg', array(
		'post_type'      => 'page',
		'posts_per_page' => - 1,
		'meta_value'     => 'templates/single-service.php',
		'post__not_in'   => array( $post->ID ),
		'post_parent'    => wp_get_post_parent_id( $post->ID )
	) );

	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() ) {
		?>
		<div class="related-service" id="relatedService">
			<h3 class="title"><?php esc_html_e( 'Other Services', 'ivy-school' ); ?></h3>
			<div class="row js-slider-wrapper">

				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<div class="col-md-4">
						<div class="content-inner">
							<?php
							if ( has_post_thumbnail() ) {
								thim_thumbnail( get_the_ID(), '316x344', 'post', false );
							}
							?>
                            <div class="base-content">
                                <div class="icon">
                                    <?php
                                        $icon_service = thim_meta('thim_icon_name');
                                        echo wp_get_attachment_image($icon_service, 'full');
                                    ?>
                                </div>
                                <h5 class="label">
                                    <a href="<?php the_permalink() ?>" class="page-title"><?php the_title(); ?></a>
                                </h5>
                            </div>
						</div>
					</div>
				<?php endwhile; ?>

			</div>
		</div>
		<?php
	}
	?>
</div>

<?php

do_action( 'thim_wrapper_loop_end' );

get_footer();
