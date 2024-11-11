<?php
/**
 * Template for displaying default template Google-maps element.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/google-maps/layout-1.php.
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
$style_css = ! empty( $params['height']) ? ' style="height:'.intval( $params['height'] ).'px"' : ''
?>

<?php if ( ( $params['style_map'] == 'map-api-key' ) ) {
	$places = $params['list_address'];
	?>

	<div class="kcf-module">
		<div
			class="ob-google-map-canvas"<?php echo $style_css; ?> id="ob-map-canvas-<?php echo esc_attr( md5( $map_id ) ) ?>"
			<?php foreach ( $map_data as $key => $val ) : ?>
				<?php if ( ! empty( $val ) ) : ?>
					data-<?php echo esc_attr( $key ) . '="' . esc_attr( $val ) . '"' ?>
				<?php endif ?>
			<?php endforeach; ?>
		></div>
	</div>

	<?php
	if ( $places ) {
		?>
		<div class="content_maps">
			<div class="container">
				<div class="info-contact">
					<div class="area_place">
						<h3 class="title_place"><span><?php echo $places[0]['title_place']; ?></span> <i
								class="fa fa-caret-down"></i></h3>
						<ul class="content_hidden">
							<?php for ( $i = 0; $i < count( $places ); $i ++ ) { ?>
								<li data-address="<?php echo $places[ $i ]['place']; ?>"><?php echo $places[ $i ]['title_place']; ?></li>
							<?php } ?>
						</ul>
					</div>
					<div class="content_place">
						<?php for ( $i = 0; $i < count( $places ); $i ++ ) { ?>
							<ul class="item_pace">
								<li>
									<i class="fa fa-map-marker"></i>
									<span
										class="name-info"><?php echo esc_html__( 'Address', 'builderpress' ); ?></span>
									<?php echo $places[ $i ]['place']; ?>
								</li>
								<li>
									<i class="fa fa-phone"></i>
									<span
										class="name-info"><?php echo esc_html__( 'Phone', 'builderpress' ); ?></span>
									<?php echo $places[ $i ]['phone_place']; ?>
								</li>
								<li>
									<i class="fa fa-envelope-o"></i>
									<span
										class="name-info"><?php echo esc_html__( 'Email', 'builderpress' ); ?></span>
									<?php echo $places[ $i ]['email_place']; ?>
								</li>
							</ul>
						<?php } ?>

					</div>
				</div>
			</div>
		</div>
	<?php } ?>

<?php } elseif ( ( $params['style_map'] == 'map-iframe' ) ) { ?>


	<?php if ( ! empty( $params['iframe_src'] ) ) { ?>
		<div class="kcf-module">
			<div class="map_iframe"<?php echo $style_css; ?>>
				<?php echo $params['iframe_src']; ?>
			</div>
		</div>
	<?php } ?>

	<div class="content_maps">

			<div class="info-contact">
				<div class="content_place">
					<ul class="item_pace">
						<?php if ( ! empty( $params['iframe_place'] ) ) { ?>
							<li>
								<i class="fa fa-map-marker"></i>
								<span
									class="name-info"><?php echo esc_html__( 'Address', 'builderpress' ); ?></span>
								<?php echo $params['iframe_place']; ?>
							</li>
						<?php } ?>
						<?php if ( ! empty( $params['iframe_phone_place'] ) ) { ?>
							<li>
								<i class="fa fa-phone"></i>
								<span
									class="name-info"><?php echo esc_html__( 'Phone', 'builderpress' ); ?></span>
								<?php echo $params['iframe_phone_place']; ?>
							</li>
						<?php } ?>
						<?php if ( ! empty( $params['iframe_email_place'] ) ) { ?>
							<li>
								<i class="fa fa-envelope-o"></i>
								<span
									class="name-info"><?php echo esc_html__( 'Email', 'builderpress' ); ?></span>
								<?php echo $params['iframe_email_place']; ?>
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>

	</div>


<?php } ?>
