<?php
/**
 * The template for displaying archive pages.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 */
$blog_style = isset( $_GET['blog'] ) ? $_GET['blog'] : get_theme_mod( 'archive_style', 'default' );

if ( $blog_style == 'masonry' ) {
    $blog_class = 'blog-masonry';
} else if ( $blog_style == 'blog_list_3' ) {
    $blog_class = 'blog-list-3';
} else {
    $blog_class = 'blog-list';
}

?>
    <div class="blog-content archive_switch <?php echo esc_attr( $blog_class ); ?>">
        <div class="row">
            <?php
            while ( have_posts() ) : the_post();
                if ( $blog_style == 'masonry' ) {
                    get_template_part( 'templates/template-parts/content-masonry' );
                } else {
                    get_template_part( 'templates/template-parts/content' );
                }
            endwhile;
            ?>
        </div>
    </div><!-- .blog-content.blog-list -->
<?php if ( $blog_style == 'masonry' ) { ?>
    <div class="masonry-loadmore">
        <div class="button"><?php esc_attr_e( 'view More', 'ivy-school' ); ?></div>
    </div>
<?php } ?>
<?php if ( $blog_style != 'masonry' ) {
    thim_paging_nav();
}