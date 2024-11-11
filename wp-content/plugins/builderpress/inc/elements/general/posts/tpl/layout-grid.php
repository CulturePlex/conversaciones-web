<?php
/**
 * Template for displaying default template Posts element layout grid 1.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/posts/layout-grid.php.
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
 * @var $query
 * @var $title
 * @var $show_date
 * @var $show_author
 * @var $show_number_comments
 * @var $show_excerpt
 * @var $show_readmore
 * @var $show_number_favorite
 */
?>

<?php if( isset($title) ) {?>
    <h3 class="title"><?php echo esc_html( $title ); ?></h3>
<?php }?>

<div class="grid-posts row">
	<?php while ( $query->have_posts() ) : $query->the_post(); ?>
        <div class="item col-sm-4">
            <div class="thumb">
                <a href="<?php the_permalink(); ?>">
                <?php
                $size = apply_filters( 'builder-press/posts/image-size', '433x318' );
                builder_press_get_attachment_image( get_the_ID(), $size, 'post' );
                ?></a>
            </div>
            <div class="content">

                <h4 class="title"><a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a></h4>

				<?php if ( $show_number_comments || $show_author || $show_number_favorite  ) { ?>
                    <div class="list-meta">

						<?php if ( $show_author ) { ?>

                            <?php
                             echo '<span class="post-author"><a href="'. esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) .'">';
                                if( $avatar = get_avatar(get_the_author_meta('ID')) !== false ) {
                                echo get_avatar( get_the_author_meta( 'ID' ), 35 );
                            }
                                echo esc_html( get_the_author() );

                            echo '</a></span>';
						} ?>

                        <?php if ( class_exists( 'Favorites' ) && $show_number_favorite ) { ?>
                            <span class="entry-favorite">
                                <?php echo do_shortcode('[favorite_button]')?>
                            </span>
                        <?php } ?>

                        <?php if ( $show_number_comments ) {
							if ( comments_open() ) {
								$num_comments = (int) get_comments_number(); ?>
                                <span class="comments-meta">
                                    <a class="comment" href="<?php echo esc_url( get_comments_link() ); ?>">
                                        <i class="far fa-comments"></i> <?php echo ent2ncr( $num_comments ); ?>
                                    </a>
                                </span>
								<?php
							}
						} ?>
                    </div>
				<?php } ?>

                <?php if ( $show_excerpt ) { ?>
                    <p class="excerpt"><?php echo wp_trim_words( get_the_excerpt(), 12 ); ?></p>

                <?php }?>

                <?php if ( $show_readmore ) { ?>
                    <div class="read-more">
                        <a href="<?php the_permalink(); ?>" class="link">
                            <?php echo esc_html__('Load More', 'builderpress');?>
                        </a>
                    </div>
                <?php }?>
            </div>
        </div>
	<?php endwhile; ?>
</div>