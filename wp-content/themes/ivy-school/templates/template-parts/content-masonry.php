<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

$column = get_theme_mod( 'archive_masonry_column', 4 );
$class  = 'masonry-item column-' . $column . ' col-md-' . ( 12 / $column );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>
    <div class="content-inner" style="height: auto">
        <?php if ( ! has_post_format( 'quote' ) && ! thim_meta( 'thim_quote_author_url' ) && ! has_post_format( 'video' ) ) { ?>
            <div class="entry-top">
                <?php do_action( 'thim_entry_top', 'full' ); ?>

                <?php
                if ( get_theme_mod( 'show_category_meta_tags', true ) ) :
                    echo thim_get_entry_meta_category();
                endif; ?>
            </div><!-- .entry-top -->
        <?php } ?>
        <?php if ( has_post_format( 'video' ) ) { ?>
            <div class="entry-top">
                <?php echo get_the_post_thumbnail( get_the_ID(), 'full' ); ?>
                <?php
                if ( get_theme_mod( 'show_category_meta_tags', true ) ) :
                    echo thim_get_entry_meta_category();
                endif; ?>
                <i class="ion-android-arrow-dropright video-icon"></i>
            </div>
        <?php } ?>

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
                <div class="entry-button-meta">
                    <?php thim_entry_meta(); ?>
                </div>

            <?php } elseif ( has_post_format( 'quote' ) && thim_meta( 'thim_quote_author_url' ) ) {
                ?>
                <?php
                if ( get_theme_mod( 'show_category_meta_tags', true ) ) :
                    echo thim_get_entry_meta_category();
                endif; ?>
                <header class="entry-header">
                    <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                </header><!-- .entry-header -->
                <div class="entry-button-meta">
                    <?php thim_entry_meta(); ?>
                </div>
                <?php
            } elseif ( has_post_format( 'audio' ) ) { ?>
                <header class="entry-header">

                </header><!-- .entry-header -->

            <?php } elseif ( has_post_format( 'video' ) ) { ?>
                <header class="entry-header">
                    <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                </header><!-- .entry-header -->
                <div class="entry-button-meta">
                    <?php thim_entry_meta(); ?>
                </div>
                <div class="entry-summary">
                    <?php
                    the_excerpt();
                    ?>
                </div><!-- .entry-summary -->

            <?php } elseif ( has_post_format( 'chat' ) ) { ?>
                <header class="entry-header">
                    <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                </header><!-- .entry-header -->
            <?php } else { ?>
                <header class="entry-header">
                    <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

                </header>
                <div class="entry-button-meta">
                    <?php thim_entry_meta(); ?>
                </div>
                <!-- .entry-header -->
                <div class="entry-summary">
                    <?php
                    the_excerpt();
                    ?>
                </div><!-- .entry-summary -->
            <?php }
            ?>
        </div><!-- .entry-content -->
    </div> <!-- .content-inner -->
</article><!-- #post-## -->
