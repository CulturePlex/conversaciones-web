<?php
/**
 * Template for displaying default template Posts element layout list 1.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/posts/layout-list-1.php.
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
 */
?>

<?php if( isset($title) ) {?>
    <h3 class="title"><?php echo esc_html( $title ); ?></h3>
<?php }?>

<div class="list-post">
    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
        <div class="item">
            <?php if ( has_post_thumbnail() ) { ?>
                <div class="thumbnail">
                    <?php
                    $size = apply_filters( 'builder-press/posts/layout-list-2/image-size', '176x176' );
                    builder_press_get_attachment_image( get_the_ID(), $size, 'post' ); ?>
                </div>
            <?php } else { ?>
                <div class="no-thumbnail"></div>
            <?php } ?>
            <div class="content">
                <h4 class="title">
                    <a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
                </h4>
                <?php if ( $show_date || $show_number_comments || $show_author ) { ?>
                    <div class="list-meta">
                        <?php if ( $show_date ) { ?>
                            <span class="post-date"><?php echo get_the_date(); ?></span>
                        <?php } ?>

                        <?php if ( $show_author ) {
                            echo '<span class="post-author">' . esc_html_x( 'by ', 'Builderpress element Posts', 'builderpress' ) . get_the_author() . '</span>';
                        } ?>

                        <?php if ( $show_number_comments ) {
                            if ( comments_open() ) {
                                $num_comments = (int) get_comments_number(); ?>
                                <span class="coments-meta"><i class="ion-ios-chatbubble-outline color"></i>
                                    <a class="comment" href="<?php echo esc_url( get_comments_link() ); ?>">
                                        <?php echo ent2ncr( $num_comments ); ?>
                                    </a>
                                </span>
                                <?php
                            }
                        } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php endwhile; ?>
</div>