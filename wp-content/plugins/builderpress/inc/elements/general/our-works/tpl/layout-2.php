<?php
/**
 * Template for displaying default template Our Works element layout 2.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/our-works/layout-2.php.
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

/**
 * @var $params array - shortcode params
 */

if ( ! $params['data'] ) {
	return;
}

$title = $params['title'];
$posts = new WP_Query( $params['data'] );
?>

<div class="our-works-title">
	<?php if ( $title ) { ?>
		<h3 class="title"><?php echo esc_html( $title ); ?></h3>
	<?php } ?>

	<?php
	$categories = array();
	$break_list = 4;

	while ( $posts->have_posts() ):
		$posts->the_post();
		$cats = get_the_portfolio_category();
		foreach ( $cats as $cat ) {
			$categories[ $cat->slug ] = $cat->name;
		}
	endwhile;
	wp_reset_postdata();

	if ( $categories ) { ?>
		<div class="nav-filter">
			<?php
			$list          = '<li class="cat-item current"><a data-cat="' . $params['category'] . '" data-filter="*">' . esc_html__( 'All', 'builderpress' ) . '</a></li>';
			$list_dropdown = '';
			$i             = 0;
			foreach ( $categories as $slug => $cat ) {
				if ( $i < $break_list ) {
					$list .= '<li class="cat-item"><a data-cat="' . $slug . '" data-filter=".item__' . $slug . '">' . $cat . '</a></li>';
				} else {
					$list_dropdown .= '<li class="cat-item"><a data-cat="' . $slug . '" data-filter=".item__' . $slug . '">' . $cat . '</a></li>';
				}
				$i ++;
			}

			if ( $list ) {
				echo '<ul class="cat-list">' . $list . '</ul>';
			} ?>
		</div>
	<?php } ?>
</div>

<?php if ( $posts->have_posts() ) : ?>
	<div class="our-works-content">
		<div class="slider-for">
			<?php
			while ( $posts->have_posts() ):
				$posts->the_post();
				$class      = '';
				$categories = get_the_portfolio_category();
				foreach ( $categories as $cat ) {
					$class .= ' item__' . $cat->slug;
				} ?>
				<div class="item <?php echo esc_attr( $class ); ?>">
					<div class="item-wrapper">
						<div class="thumbnail">
							<?php echo get_the_post_thumbnail( get_the_ID(), array( 480, 360 ) ); ?>
						</div>
						<div class="title"><a href="<?php echo esc_url( get_permalink( get_the_ID() ) ); ?>"><?php echo get_the_title( get_the_ID() ); ?></a></div>
						<div class="excerpt"><?php echo wp_trim_words( get_the_excerpt(), 11, '' ); ?></div>
					</div>
				</div>
			<?php endwhile;
			wp_reset_postdata();
			?>
		</div>
	</div>
<?php endif; ?>

