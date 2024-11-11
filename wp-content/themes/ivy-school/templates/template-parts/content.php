<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

$blog_style = isset( $_GET['style'] ) ? $_GET['style'] : get_theme_mod( 'archive_style', 'default' );
$column     = isset( $_GET['column'] ) ? $_GET['column'] : get_theme_mod( 'archive_post_column', 1 );

if ( $blog_style == 'blog_list_3' ) {
    $column = 1;
}

if(!has_post_thumbnail( $post->ID )){
    $class_none_thumbnail = 'none-has-post-thumbnail';
}else{
    $class_none_thumbnail = '';
}


$class = 'column-' . $column . '-blog-archive col-md-' . ( 12 / $column ) . ' '. $class_none_thumbnail;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
    <div class="content-inner" style="height:auto !important">
        <div class="entry-top">
            <?php
            if ( $column == 1 ) {
				do_action( 'thim_entry_top', 'full' );
            } else {
				if(get_post_format() == 'gallery'){
					do_action( 'thim_entry_top');
				}else{
					do_action('thim_entry_top', array( 476, 320));
				}
             }
           ?>
            <?php thim_entry_meta_date(); ?>

        </div><!-- .entry-top -->


        <div class="entry-content">
            <?php
            if ( has_post_format( 'link' ) && thim_meta( 'thim_link_url' ) && thim_meta( 'thim_link_text' ) ) {
                $url  = thim_meta( 'thim_link_url' );
                $text = thim_meta( 'thim_link_text' );
                if ( $url && $text ) { ?>
                    <header class="entry-header">
                        <h3 class="entry-title">
                            <a class="link" href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $text ); ?></a>
                        </h3>
                    </header><!-- .entry-header -->
                    <?php
                }
                ?>


                <div class="entry-summary">
                    <?php the_excerpt(); ?>
                </div><!-- .entry-summary -->

                <?php
                if ( get_theme_mod( 'archive_read_more', true ) ): ?>
                    <div class="readmore">
                        <a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html__( 'Learn More', 'ivy-school' ); ?></a>
                    </div><!-- .read-more -->
                <?php endif;
                ?>

            <?php } elseif ( has_post_format( 'quote' ) && thim_meta( 'thim_quote_author_url' ) ) {

                $author     = thim_meta( 'thim_quote_author_text' );
                $author_url = thim_meta( 'thim_quote_author_url' );
                if ( $author_url ) {
                    $author = ' <a href=' . esc_url( $author_url ) . '>' . $author . '</a>';
                }
                ?>
                <header class="entry-header">
                    <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                </header><!-- .entry-header -->

                <div class="entry-button-meta">
                    <?php thim_entry_meta(); ?>
                </div><!-- .entry-button-meta -->


                <div class="entry-summary">
                    <?php if ( $author ) { ?>
                        <div class="box-header box-quote">
                            <blockquote>
                                <?php the_excerpt(); ?>
                                <cite><?php echo wp_kses( $author, array(
                                        'a' => array(
                                            'href' => array(),
                                        )
                                    ) ); ?></cite>
                            </blockquote>
                        </div>
                    <?php } ?>
                </div><!-- .entry-summary -->
                <?php
                if ( get_theme_mod( 'archive_read_more', true ) ): ?>
                    <div class="readmore">
                        <a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html__( 'Learn More', 'ivy-school' ); ?> <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                    </div><!-- .read-more -->
                <?php endif;
                ?>
                <?php
            } elseif ( has_post_format( 'audio' ) ) { ?>
                <header class="entry-header">
                    <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                </header><!-- .entry-header -->

                <div class="entry-button-meta">
                    <?php thim_entry_meta(); ?>
                </div><!-- .entry-button-meta -->


                <div class="entry-summary">
                    <?php
                    the_excerpt();
                    ?>
                </div><!-- .entry-summary -->
                <div class="entry-button-meta ">
                    <?php
                    if ( get_theme_mod( 'archive_read_more', true ) ): ?>
                        <div class="readmore">
                            <a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html__( 'Learn More', 'ivy-school' ); ?></a>
                        </div><!-- .read-more -->
                    <?php endif;
                    ?>
                </div>


            <?php } elseif ( has_post_format( 'chat' ) ) { ?>
                <header class="entry-header">
                    <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                </header><!-- .entry-header -->

                <div class="entry-button-meta">
                    <?php thim_entry_meta(); ?>
                </div><!-- .entry-button-meta -->


                <div class="entry-summary">
                    <?php the_excerpt(); ?>
                </div><!-- .entry-summary -->
                <div class="entry-button-meta">
                    <?php
                    if ( get_theme_mod( 'archive_read_more', true ) ): ?>
                        <div class="readmore">
                            <a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html__( 'Learn More', 'ivy-school' ); ?></a>
                        </div><!-- .read-more -->
                    <?php endif;
                    ?>
                </div>

            <?php } else { ?>
                <header class="entry-header">
                    <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                </header>
                <!-- .entry-header -->

                <div class="entry-button-meta">
                    <?php thim_entry_meta(); ?>
                </div><!-- .entry-button-meta -->


                <div class="entry-summary">
                    <?php
                    the_excerpt();
                    ?>
                </div><!-- .entry-summary -->

                <div class="entry-button-meta">
                    <?php
                    if ( get_theme_mod( 'archive_read_more', true ) ): ?>
                        <div class="readmore">
                            <a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html__( 'Learn More', 'ivy-school' ); ?></a>
                        </div><!-- .read-more -->
                    <?php endif;
                    ?>
                </div>

            <?php } ?>

            <?php
            if ( get_theme_mod( 'archive_meta_tags', false ) ) :
                echo thim_entry_meta_tags();
            endif;
            ?>

        </div><!-- .entry-content -->
    </div> <!-- .content-inner -->
</article><!-- #post-## -->
