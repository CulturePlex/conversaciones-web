<?php
/**
 * Template for displaying default template Our Works element layout 1.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/our-works/layout-1.php.
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
            <ul class="cat-list">
                <li class="cat-item current">
                    <a data-cat="0" data-filter="*"><?php _e( 'All', 'builderpress' ); ?></a>
                </li>

				<?php foreach ( $categories as $slug => $cat ) { ?>
                    <li class="cat-item">
                        <a data-cat="<?php echo esc_attr( $slug ); ?>"
                           data-filter=".item__<?php echo esc_attr( $slug ); ?>"><?php echo esc_html( $cat ); ?></a>
                    </li>
				<?php } ?>
            </ul>
        </div>
	<?php } ?>
</div>

<?php if ( $posts->have_posts() ) : ?>
    <div class="our-works-content">
        <div class="loop-wrapper">
			<?php
			while ( $posts->have_posts() ):
				$posts->the_post();
				$class      = '';
				$categories = get_the_portfolio_category();
				foreach ( $categories as $cat ) {
					$class .= ' item__' . $cat->slug;
				}
				?>
                <div class="item <?php echo esc_attr( $class ); ?>">
                    <div class="item__inner">
                        <div class="item__thumbnail">
							<?php
							$size = apply_filters( 'builder-press/our-works/layout-1/image-size', '434x360' );
							builder_press_get_attachment_image( get_the_ID(), $size, 'post' ); ?>
                        </div>
                        <div class="item__info">
                            <h3 class="item__title">
                                <a href="<?php echo esc_url( get_permalink( get_the_ID() ) ); ?>"
                                   class="entry-title">
									<?php echo get_the_title(); ?>
                                </a>
                            </h3>
                            <div class="item__category"><?php echo builder_press_get_entry_meta_category( 1 ); ?></div>
                        </div>
                    </div>
                </div>
			<?php endwhile;
			wp_reset_postdata();
			?>
        </div>
    </div>
<?php endif; ?>
