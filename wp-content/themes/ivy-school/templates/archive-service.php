<?php
/**
 * Template Name: Archive Service
 */

global $post;

get_header();

do_action( 'thim_wrapper_loop_start' );
?>

<div id="archiveService" class="archive-service-page container">
	<?php
	// Page content
	while ( have_posts() ) : the_post();
		?>
		<div class="post-content">
			<?php the_content(); ?>
		</div>
	<?php
	endwhile;
	wp_reset_postdata();


	// Custom query content
	$args = array(
		'post_type'      => 'page',
		'posts_per_page' => - 1,
		'post_parent'    => $post->ID,
		'order'          => 'ASC',
		'order_by'       => 'menu_order'
	);

	$service_page_query = new WP_Query( $args );

	if ( $service_page_query->have_posts() ) {
		?>
		<div class="list-service">
			<div class="row">
				<?php while ( $service_page_query->have_posts() ) : $service_page_query->the_post(); ?>
					<div class="col-sm-4">
						<div class="service-wrapper">
							<a href="<?php echo esc_url(get_the_permalink()); ?>" class="link-wrapper"></a>
							<div class="service-thumbnail">
								<?php if ( has_post_thumbnail() ) {
									thim_thumbnail( get_the_ID(), '434x461', 'post', true );
								}
								?>
							</div>

                            <?php
                                $icon_service = thim_meta('thim_icon_name');
                            ?>
							<div class="service-content">
								<div class="icon">
                                    <?php
                                        echo wp_get_attachment_image($icon_service, 'full');
                                    ?>
                                </div>
								<div class="base-content">
									<h3 class="title"><?php the_title(); ?></h3>
									<div class="detail"><?php the_excerpt(); ?></div>
								</div>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</div>
		</div>
		<?php
	}
	?>
</div>

<?php

do_action( 'thim_wrapper_loop_end' );

get_footer();

