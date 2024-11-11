<?php
/**
 * Template Name:  Coming Soon Mode
 *
 **/

get_header();

while ( have_posts() ) : the_post();

	wp_enqueue_script( 'knob-plugin' );
	wp_enqueue_script( 'countdown-js' );
	wp_enqueue_script( 'knob-js' );
	$background = thim_meta( 'thim_comingsoon_background', array(
		'type'   => 'image',
		'single' => 'true',
		'size'   => 'full'
	) );

	$logo    = thim_meta( 'thim_comingsoon_logo' );
	$heading = thim_meta( 'thim_comingsoon_text' );
	$date    = strtotime( thim_meta( 'thim_comingsoon_date' ) );

	$now = time();

	$datediff = $date - $now;
	$days     = round( $datediff / ( 60 * 60 * 24 ) );


	?>
	<div class="comingsoon-wrapper" style="background-image: url('<?php echo esc_attr( $background[0] ); ?>')">
		<div class="coom-inner">
			<?php echo wp_get_attachment_image( $logo, 'full' ) ?>
			<h3 class="heading">
				<?php echo esc_html( $heading ); ?>
			</h3>
			<div id="thim-comingsoon-countdown" data-date="<?php echo esc_attr( $days ); ?>">
				<div id="knob-countdown" class="hide"></div>
				<div class="knob-progress">
					<div class="progress-count">
						<input type="text" id="countdown-ds"
						       data-width="120"
						       data-height="120"
						       data-max="<?php echo esc_attr( $days ); ?>"
						       data-thickness=".07"
						       data-fgcolor="#fff"
						       data-bgcolor="rgba(255,255,255, .2)"
						       data-min="0"
						       class="knob"
						       data-readonly="true" />
						<label><?php esc_html_e( 'Days', 'ivy-school' ); ?></label>
					</div>

					<div class="progress-count">
						<input type="text" id="countdown-hr"
						       data-width="120"
						       data-height="120"
						       data-max="24"
						       data-thickness=".07"
						       data-fgcolor="#fff"
						       data-bgcolor="rgba(255,255,255, .2)"
						       data-min="0"
						       class="knob"
						       data-readonly="true" />
						<label><?php esc_html_e( 'Hours', 'ivy-school' ); ?></label>
					</div>

					<div class="progress-count">
						<input type="text" id="countdown-min"
						       data-width="120"
						       data-height="120"
						       data-max="60"
						       data-thickness=".07"
						       data-fgcolor="#fff"
						       data-bgcolor="rgba(255,255,255, .2)"
						       data-min="0"
						       class="knob"
						       data-readonly="true" />
						<label><?php esc_html_e( 'Minutes', 'ivy-school' ); ?></label>
					</div>

					<div class="progress-count">
						<input type="text" id="countdown-sec"
						       data-width="120"
						       data-height="120"
						       data-max="60"
						       data-thickness=".07"
						       data-fgcolor="#fff"
						       data-bgcolor="rgba(255,255,255, .2)"
						       data-min="0"
						       class="knob"
						       data-readonly="true" />
						<label><?php esc_html_e( 'Seconds', 'ivy-school' ); ?></label>
					</div>

				</div>
			</div>
			<div class="content-text">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
<?php
endwhile;

get_footer();
?>